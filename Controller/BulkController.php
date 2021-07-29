<?php namespace Sms77\Controller;

use Propel\Runtime\Collection\ObjectCollection;
use ReflectionObject;
use Sms77\Sms77;
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
        return $this->render('sms77-bulk-sms', ['messages' => $this->messages]);
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
        $response = $this->checkAuth(AdminResources::MODULE, [Sms77::DOMAIN_NAME],
            AccessManager::UPDATE);
        if (null !== $response) return $response;

        $form = $this->createForm('sms77.bulk.sms.form');
        $err = null;

        try {
            $data = $this->validateForm($form)->getData();
            $this->sms($this->getCustomers($data), $data);
        } catch (FormValidationException $e) {
            $err = $this->createStandardFormValidationErrorMessage($e);
        }

        if (null !== $err) $this->setupFormErrorContext(
            'Sms77 ' . $this->getTranslator()->trans('bulk_sms', [], Sms77::DOMAIN_NAME),
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
                ->trans('no_request', [], Sms77::DOMAIN_NAME);
            return;
        }

        foreach ($requests as $request) $responses[] =
            $this->request('sms', array_merge($this->buildBaseParams($data), $request));
    }

    private function buildBaseParams(array $data): array {
        return ['from' => $data['from']];
    }

    private function request(string $endpoint, array $data) {
        $apiKey = Sms77::getApiKey();

        if ('' === $apiKey) {
            $this->messages[] = $this->getTranslator()
                ->trans('api_key_missing', [], Sms77::DOMAIN_NAME);
            return;
        }

        $ch = curl_init('https://gateway.sms77.io/api/' . $endpoint);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-type: application/json',
            'SentWith: Thelia',
            'X-Api-Key: ' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        $this->messages[] = $res;
    }
}
