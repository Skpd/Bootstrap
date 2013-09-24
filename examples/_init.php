<?php

use Zend\Loader\StandardAutoloader;

require_once '../../../zendframework/zendframework/library/Zend/Loader/StandardAutoloader.php';

$loader = new StandardAutoloader(array('autoregister_zf' => true));
$loader->registerNamespace('Skpd\\Bootstrap\\', '../src');

$loader->register();

$view = new \Zend\View\Renderer\PhpRenderer();
$view->getHelperPluginManager()->setInvokableClass('form', 'Skpd\Bootstrap\Form\View\Helper\Form');
$view->getHelperPluginManager()->setInvokableClass('formColor', 'Skpd\Bootstrap\Form\View\Helper\FormColor');
$view->getHelperPluginManager()->setInvokableClass('formDateTime', 'Skpd\Bootstrap\Form\View\Helper\FormDateTime');
$view->getHelperPluginManager()->setInvokableClass('formEmail', 'Skpd\Bootstrap\Form\View\Helper\FormEmail');
$view->getHelperPluginManager()->setInvokableClass('formFile', 'Skpd\Bootstrap\Form\View\Helper\FormFile');
$view->getHelperPluginManager()->setInvokableClass('formInput', 'Skpd\Bootstrap\Form\View\Helper\FormInput');
$view->getHelperPluginManager()->setInvokableClass('formMonth', 'Skpd\Bootstrap\Form\View\Helper\FormMonth');
$view->getHelperPluginManager()->setInvokableClass('formNumber', 'Skpd\Bootstrap\Form\View\Helper\FormNumber');
$view->getHelperPluginManager()->setInvokableClass('formPassword', 'Skpd\Bootstrap\Form\View\Helper\FormPassword');
$view->getHelperPluginManager()->setInvokableClass('formRow', 'Skpd\Bootstrap\Form\View\Helper\FormRow');
$view->getHelperPluginManager()->setInvokableClass('formSelect', 'Skpd\Bootstrap\Form\View\Helper\FormSelect');
$view->getHelperPluginManager()->setInvokableClass('formTel', 'Skpd\Bootstrap\Form\View\Helper\FormTel');
$view->getHelperPluginManager()->setInvokableClass('formText', 'Skpd\Bootstrap\Form\View\Helper\FormText');
$view->getHelperPluginManager()->setInvokableClass('formTextArea', 'Skpd\Bootstrap\Form\View\Helper\FormTextarea');
$view->getHelperPluginManager()->setInvokableClass('formUrl', 'Skpd\Bootstrap\Form\View\Helper\FormUrl');

$view->getHelperPluginManager()->setInvokableClass('formLabel', 'Zend\Form\View\Helper\FormLabel');
$view->getHelperPluginManager()->setInvokableClass('formElement', 'Zend\Form\View\Helper\FormElement');
$view->getHelperPluginManager()->setInvokableClass('formElementErrors', 'Zend\Form\View\Helper\FormElementErrors');
$view->getHelperPluginManager()->setInvokableClass('formCheckbox', 'Zend\Form\View\Helper\FormCheckbox');
$view->getHelperPluginManager()->setInvokableClass('formSubmit', 'Zend\Form\View\Helper\FormSubmit');
$view->getHelperPluginManager()->setInvokableClass('formButton', 'Zend\Form\View\Helper\FormButton');

$view->getHelperPluginManager()->setInvokableClass('headScript', 'Zend\View\Helper\HeadScript');
$view->getHelperPluginManager()->setInvokableClass('headLink', 'Zend\View\Helper\HeadLink');