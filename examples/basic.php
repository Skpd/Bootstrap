<?php

require_once '_init.php';

$form = new Zend\Form\Form();
$form->add([
    'type' => 'email',
    'name' => 'email',
    'options' => ['label' => 'Email address'],
    'attributes' => ['placeholder' => 'Enter email']
]);
$form->add([
    'type' => 'text',
    'name' => 'password',
    'options' => ['label' => 'Password'],
    'attributes' => ['placeholder' => 'Password']
]);

$form->add([
    'type' => 'file',
    'name' => 'file',
    'options' => ['label' => 'File input', 'help' => 'Example block-level help text here.']
]);

$form->add([
    'type' => 'checkbox',
    'name' => 'checkbox',
    'options' => ['label' => 'Check me out']
]);

$form->add([
    'type' => 'submit',
    'name' => 'submit',
    'options' => ['label' => 'Submit', 'type' => 'primary']
]);

$form->add([
    'type' => 'submit',
    'name' => 'cancel',
    'options' => ['label' => 'Cancel', 'type' => 'danger']
]);

$form->add([
    'type' => 'button',
    'name' => 'reset',
    'options' => ['label' => 'Reset', 'type' => 'default']
]);

$form->prepare();

?>
<!DOCTYPE html>
<html>
<head>
    <? $view->headLink()->appendStylesheet('css/bootstrap.css') ?>

    <?= $view->headLink() ?>
</head>
<body>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title">
                Basic form usage
            </h1>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                <?= $view->form()->render($form) ?>
            </li>
            <li class="list-group-item">
    <pre>
$form = new Zend\Form\Form();
$form->add([
    'type' => 'email',
    'name' => 'email',
    'options' => ['label' => 'Email address'],
    'attributes' => ['placeholder' => 'Enter email']
]);

$form->add([
    'type' => 'password',
    'name' => 'password',
    'options' => ['label' => 'Password'],
    'attributes' => ['placeholder' => 'Password']
]);

$form->add([
    'type' => 'file',
    'name' => 'file',
    'options' => ['label' => 'File input', 'help' => 'Example block-level help text here.']
]);

$form->add([
    'type' => 'checkbox',
    'name' => 'checkbox',
    'options' => ['label' => 'Check me out']
]);

$form->add([
    'type' => 'submit',
    'name' => 'submit',
    'options' => ['label' => 'Submit', 'type' => 'primary']
]);

$form->add([
    'type' => 'submit',
    'name' => 'cancel',
    'options' => ['label' => 'Cancel', 'type' => 'danger']
]);

$form->add([
    'type' => 'button',
    'name' => 'reset',
    'options' => ['label' => 'Reset', 'type' => 'default']
]);
    </pre>
            </li>
        </ul>
    </div>
</div>
</body>
</html>