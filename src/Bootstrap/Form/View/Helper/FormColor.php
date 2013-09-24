<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;

class FormColor extends FormInput
{
    /**
     * Attributes valid for the input tag type="color"
     *
     * @var array
     */
    protected $validTagAttributes = array(
        'name'           => true,
        'autocomplete'   => true,
        'autofocus'      => true,
        'disabled'       => true,
        'form'           => true,
        'list'           => true,
        'type'           => true,
        'value'          => true,
    );

    /**
     * Determine input type to use
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getType(ElementInterface $element)
    {
        return 'color';
    }
}
