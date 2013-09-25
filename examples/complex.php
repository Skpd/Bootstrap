<?php

require_once '_init.php';

$form = new \Zend\Form\Form();
$form->add([
    'name' => 'participants',
    'type' => 'Zend\Form\Element\Collection',
    'options' => [
        'label' => 'Participants',
        'should_create_template' => true,
        'allow_add' => true,
        'allow_remove' => true,
        'count' => 1,
        'template_placeholder' => '___' . uniqid() . '___',
        'target_element' => [
            'name' => 'team',
            'type' => 'Zend\Form\Fieldset',
            'options' => ['label' => 'Team', 'size' => 10],
            'elements' => [
                [
                    'spec' => [
                        'name' => 'name',
                        'type' => 'text',
                        'options' => ['label' => 'Name', 'size' => 10],
                    ]
                ],
                [
                    'spec' => [
                        'name' => 'players',
                        'type' => 'Zend\Form\Element\Collection',
                        'options' => [
                            'should_create_template' => true,
                            'count' => 1,
                            'label' => 'Players',
                            'template_placeholder' => '___' . uniqid() . '___',
                            'target_element' => [
                                'name' => 'player',
                                'type' => 'Zend\Form\Fieldset',
                                'options' => ['label' => 'Player', 'size' => 10],
                                'elements' => [
                                    [
                                        'spec' => [
                                            'name' => 'first_name',
                                            'type' => 'text',
                                            'options' => ['label' => 'First Name', 'size' => 10],
                                        ]
                                    ],
                                    [
                                        'spec' => [
                                            'name' => 'last_name',
                                            'type' => 'text',
                                            'options' => ['label' => 'Last Name', 'size' => 10],
                                        ]
                                    ],
                                    [
                                        'spec' => [
                                            'name' => 'email',
                                            'type' => 'email',
                                            'options' => ['label' => 'Email', 'size' => 10],
                                        ]
                                    ],
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ]
    ]
]);
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
                Complex form with nested collections
            </h1>
        </div>

        <div class="panel-body">
            <?= $view->form()->setType('horizontal')->render($form->setAttribute('class', 'col-lg-6')) ?>
        </div>
    </div>
</div>
</body>
</html>