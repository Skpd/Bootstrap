<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormInput extends \Zend\Form\View\Helper\FormInput
{
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
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $attributes['value'] = $element->getValue();

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
}