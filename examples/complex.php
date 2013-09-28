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
$form->add([
    'name' => 'fieldset',
    'type' => 'Zend\Form\Fieldset',
    'options' => [
        'label' => 'Another Fieldset',
        'size' => 10
    ],
    'elements' => [
        [
            'spec' => [
                'name' => 'datetime',
                'type' => 'text',
                'options' => ['label' => 'Foo', 'size' => 4],
            ]
        ],
        [
            'spec' => [
                'name' => 'more',
                'type' => 'file',
                'options' => ['label' => 'Bar', 'size' => 6],
            ]
        ],
        [
            'spec' => [
                'name' => 'fields',
                'type' => 'color',
                'options' => ['label' => 'Baz', 'size' => 2],
            ]
        ],
    ]
]);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen"/>

    <style type="text/css">
        fieldset fieldset {
            margin-left: 2em;
        }
    </style>
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
            <?= $view->form()->setType('horizontal')->render($form->setAttribute('class', 'col-lg-offset-2 col-lg-8')) ?>
        </div>
    </div>
</div>
</body>
</html>