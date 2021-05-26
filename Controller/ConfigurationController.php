<?php namespace Sms77\Controller;

use Sms77\Sms77;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Tools\URL;

class ConfigurationController extends BaseAdminController {
    public function editConfiguration() {
        $response = $this->checkAuth(AdminResources::MODULE, [Sms77::DOMAIN_NAME],
            AccessManager::UPDATE);

        if (null !== $response) return $response;

        $form = $this->createForm('sms77.config.form');
        $error_message = null;

        try {
            $data = $this->validateForm($form)->getData();

            Sms77::setConfigValue(Sms77::SETTING_API_KEY, $data[Sms77::SETTING_API_KEY]);

            return RedirectResponse::create(
                URL::getInstance()->absoluteUrl('/admin/module/Sms77'));
        } catch (FormValidationException $e) {
            $error_message = $this->createStandardFormValidationErrorMessage($e);
        }

        if (null !== $error_message) {
            $this->setupFormErrorContext('configuration', $error_message, $form);

            $response = $this->render("module-configure", ['module_code' => 'Sms77']);
        }

        return $response;
    }
}
