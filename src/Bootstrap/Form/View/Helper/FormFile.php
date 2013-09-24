<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormFile extends FormInput
{
    /**
     * Attributes valid for the input tag type="file"
     *
     * @var array
     */
    protected $validTagAttributes = array(
        'name'           => true,
        'accept'         => true,
        'autofocus'      => true,
        'disabled'       => true,
        'form'           => true,
        'multiple'       => true,
        'required'       => true,
        'type'           => true,
        'value'          => true,
    );

    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes          = $element->getAttributes();
        $attributes['type']  = $this->getType($element);
        $attributes['name']  = $name;
        if (array_key_exists('multiple', $attributes) && $attributes['multiple']) {
            $attributes['name'] .= '[]';
        }

        $value = $element->getValue();
        if (is_array($value) && isset($value['name']) && !is_array($value['name'])) {
            $attributes['value'] = $value['name'];
        } elseif (is_string($value)) {
            $attributes['value'] = $value;
        }

        $size = $element->getOption('size');

        if (empty($size)) {
            return sprintf(
                '<input %s%s',
                $this->createAttributesString($attributes),
                $this->getInlineClosingBracket()
            );
        }

        return sprintf(
            '<div class="col-lg-%s col-md-%s col-sm-%s col-xs-%s">
                <input %s%s
            </div>',
            $size, $size, $size, $size,
            $this->createAttributesString($attributes),
            $this->getInlineClosingBracket()
        );
    }

    /**
     * Determine input type to use
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getType(ElementInterface $element)
    {
        return 'file';
    }
}
