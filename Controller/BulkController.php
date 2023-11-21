<?php namespace Seven\Controller;

use DateTime;
use Propel\Runtime\Collection\ObjectCollection;
use ReflectionObject;
use Seven\Seven;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\HttpFoundation\Response;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Model\Customer;
use Thelia\Model\CustomerQuery;

class BulkController extends BaseAdminController {
    /** @var array $messages */
    private $messages = [];

    public function index(): Response {
        return $this->render('Seven-bulk-sms', ['messages' => $this->messages]);
    }

    private function getCustomers(array $data): ObjectCollection {
        //TODO: use criteria for filtering - they were not applied last time I tried
        /** @var ObjectCollection $customers */
        $customers = CustomerQuery::create()->find();

        foreach ($customers as $k => $customer) {
            $remove = false;
            /** @var Customer $customer */
            $address = $customer->getDefaultAddress();
            $phone = $address->getCellPhone();

            if (null === $phone || '' === $phone) $remove = true;

            if ((int)$data['filter_reseller'] === $customer->getReseller()) $remove = true;

            if ($remove) $customers->remove($k);
        }

        return $customers;
    }

    public function send(): Response {
        $response = $this->checkAuth(AdminResources::MODULE, [Seven::DOMAIN_NAME],
            AccessManager::UPDATE);
        if (null !== $response) return $response;

        $form = $this->createForm('Seven.bulk.sms.form');
        $err = null;

        try {
            $data = $this->validateForm($form)->getData();
            $this->sms($this->getCustomers($data), $data);
        } catch (FormValidationException $e) {
            $err = $this->createStandardFormValidationErrorMessage($e);
        }

        if (null !== $err) $this->setupFormErrorContext(
            'Seven ' . $this->getTranslator()->trans('bulk_sms', [], Seven::DOMAIN_NAME),
            $err, $form);

        return $this->index();
    }

    private function getCustomerPhones(ObjectCollection $customers): array {
        $phones = [];

        foreach ($customers as $customer) {
            /** @var Customer $customer */
            $phones[] = $customer->getDefaultAddress()->getCellPhone();
        }

        return $phones;
    }

    private function sms(ObjectCollection $customers, array $data) {
        $text = $data['text'];
        $requests = [];
        $matches = [];
        preg_match_all('{{{+[a-z]*_*[a-z]+}}}', $text, $matches);
        $hasPlaceholders = is_array($matches) && !empty($matches[0]);

        if ($hasPlaceholders) foreach ($customers as $customer) {
            /** @var Customer $customer */

            $personalText = $text;

            $reflect = new ReflectionObject($customer);

            foreach ($matches[0] as $match) {
                $key = trim($match, '{}');
                $replace = '';
                if ($reflect->hasProperty($key)) {
                    $prop = $reflect->getProperty($key);
                    $prop->setAccessible(true);
                    $replace = $prop->getValue($customer);
                }
                $personalText = str_replace($match, $replace, $personalText);
                $personalText = preg_replace('/\s+/', ' ', $personalText);
                $personalText = str_replace(' ,', ',', $personalText);
            }

            $requests[] = ['text' => $personalText,
                'to' => $customer->getDefaultAddress()->getCellPhone()];
        }
        else $requests[] = [
            'text' => $text,
            'to' => implode(',', $this->getCustomerPhones($customers)),
        ];

        if (empty($requests)) {
            $this->messages[] = $this->getTranslator()
                ->trans('no_request', [], Seven::DOMAIN_NAME);
            return;
        }

        $params = [
            'delay' => $data['delay'] instanceof DateTime
                ? $data['delay']->getTimestamp() : null,
            'flash' => (int)$data['flash'],
            'foreign_id' => $data['foreign_id'],
            'from' => $data['from'],
            'label' => $data['label'],
            'no_reload' => (int)$data['no_reload'],
            'performance_tracking' => (int)$data['performance_tracking'],
        ];
        foreach ($requests as $i => $req) $requests[$i] = array_merge($params, $req);
        $this->request('sms', $requests);
    }

    private function request(string $endpoint, array $requests) {
        $apiKey = Seven::getApiKey();

        if ('' === $apiKey) {
            $this->messages[] = $this->getTranslator()
                ->trans('api_key_missing', [], Seven::DOMAIN_NAME);
            return;
        }

        $headers = [
            'Accept: application/json',
            'Content-type: application/json',
            'SentWith: Thelia',
            'X-Api-Key: ' . $apiKey,
        ];

        foreach ($requests as $request) {
            $ch = curl_init('https://gateway.Seven.io/api/' . $endpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            curl_close($ch);
            $this->messages[] = $res;
        }
    }
}
