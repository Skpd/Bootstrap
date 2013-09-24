<?php

require_once '_init.php';

$form = new Zend\Form\Form();
$form->add([ 'type' => 'color', 'name' => 'color', 'options' => ['label' => 'Color', 'size' => 1] ]);
$form->add([ 'type' => 'datetime', 'name' => 'datetime', 'options' => ['label' => 'DateTime', 'size' => 2] ]);
$form->add([ 'type' => 'email', 'name' => 'email', 'options' => ['label' => 'Email', 'size' => 8] ]);
$form->add([ 'type' => 'file', 'name' => 'file', 'options' => ['label' => 'File', 'size' => 8] ]);
$form->add([ 'type' => 'month', 'name' => 'month', 'options' => ['label' => 'Month', 'size' => 3] ]);
$form->add([ 'type' => 'number', 'name' => 'number', 'options' => ['label' => 'Number', 'size' => 8] ]);
$form->add([ 'type' => 'password', 'name' => 'password', 'options' => ['label' => 'Password', 'size' => 8] ]);
$form->add([ 'type' => 'select', 'name' => 'select', 'options' => ['label' => 'Select', 'size' => 8] ]);
$form->add([ 'type' => 'text', 'name' => 'text', 'options' => ['label' => 'Text', 'size' => 8] ]);
$form->add([ 'type' => 'textarea', 'name' => 'textarea', 'options' => ['label' => 'Textarea', 'size' => 8] ]);
$form->add([ 'type' => 'url', 'name' => 'url', 'options' => ['label' => 'Url', 'size' => 8] ]);
?>

<!DOCTYPE html>
<html>
<head>
    <? $view->headLink()->appendStylesheet('css/bootstrap.css') ?>

    <?= $view->headLink() ?>
</head>
<body>
<div class="container">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h1 class="panel-title">
                Horizontal Elements
            </h1>
            <h4>Requires custom widths</h4>
            <p>Inputs, selects, and textareas are 100% wide by default in Bootstrap. To use the horizontal form, you'll have to set a size on the elements used within.</p>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                <p>To render horizontal form simply set <code>type</code> to <code>horizontal</code>.</p>
                <pre>&lt;?= $view->form()->setType('horizontal')->render($form) ?&gt;</pre>
            </li>
            <li class="list-group-item">
                <p>To control element size set <code>size</code> option</p>
                <pre>$form->add([ 'type' => 'email', 'name' => 'email', 'options' => ['label' => 'Email', 'size' => 8] ]);</pre>
            </li>
            <li class="list-group-item">
                <?= $view->form()->setType('horizontal')->render($form) ?>
            </li>
        </ul>
    </div>
</div>
</body>
</html>