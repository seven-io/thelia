<?php namespace Seven\Controller;

use Seven\Seven;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Tools\URL;

class ConfigurationController extends BaseAdminController {
    public function editConfiguration() {
        $response = $this->checkAuth(AdminResources::MODULE, [Seven::DOMAIN_NAME],
            AccessManager::UPDATE);

        if (null !== $response) return $response;

        $form = $this->createForm('seven.config.form');
        $error_message = null;

        try {
            $data = $this->validateForm($form)->getData();

            Seven::setApiKey($data);
            Seven::setSmsFrom($data);

            return RedirectResponse::create(
                URL::getInstance()->absoluteUrl('/admin/module/Seven'));
        } catch (FormValidationException $e) {
            $error_message = $this->createStandardFormValidationErrorMessage($e);
        }

        if (null !== $error_message) {
            $this->setupFormErrorContext('configuration', $error_message, $form);

            $response = $this->render('module-configure', ['module_code' => 'Seven']);
        }

        return $response;
    }
}
