<?php

require_once '_init.php';

$form = new \Zend\Form\Form();
$form->add([
    'name' => 'Fieldset1',
    'type' => 'Zend\Form\Fieldset',
    'elements' => [
        [
            'spec' => [
                'name' => 'Collection1',
                'type' => 'Zend\Form\Element\Collection',
                'options' => [
                    'should_create_template' => true,
                    'count' => 1,
                    'target_element' => [
                        'name' => 'Fieldset2',
                        'type' => 'Zend\Form\Fieldset',
                        'elements' => [
                            [
                                'spec' => [
                                    'name' => 'text1',
                                    'type' => 'text',
                                ]
                            ],
                            [
                                'spec' => [
                                    'name' => 'Fieldset3',
                                    'type' => 'Zend\Form\Fieldset',
                                    'elements' => [
                                        [
                                            'spec' => [
                                                'name' => 'Collection2',
                                                'type' => 'Zend\Form\Element\Collection',
                                                'options' => [
                                                    'should_create_template' => true,
                                                    'count' => 1,
                                                    'target_element' => [
                                                        'name' => 'Fieldset4',
                                                        'type' => 'Zend\Form\Fieldset',
                                                        'elements' => [
                                                            [
                                                                'spec' => [
                                                                    'name' => 'text2',
                                                                    'type' => 'text',
                                                                ]
                                                            ],
                                                            [
                                                                'spec' => [
                                                                    'name' => 'text3',
                                                                    'type' => 'text',
                                                                ]
                                                            ],
                                                            [
                                                                'spec' => [
                                                                    'name' => 'text4',
                                                                    'type' => 'text',
                                                                ]
                                                            ],
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ]
                ]
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
                Basic form usage
            </h1>
        </div>

        <div class="panel-body">
            <?= $view->form()->render($form) ?>
        </div>
    </div>
</div>
</body>
</html>