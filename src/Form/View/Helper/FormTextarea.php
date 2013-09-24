<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormTextarea extends \Zend\Form\View\Helper\FormTextarea
{
    /**
     * Render a form <textarea> element from the provided $element
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $name   = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $attributes         = $element->getAttributes();
        $attributes['name'] = $name;
        $content            = (string) $element->getValue();
        $escapeHtml         = $this->getEscapeHtmlHelper();

        $size = $element->getOption('size');

        if (empty($size)) {
            return sprintf(
                '<textarea %s>%s</textarea>',
                $this->createAttributesString($attributes),
                $escapeHtml($content)
            );
        }

        return sprintf(
            '<div class="col-lg-%s col-md-%s col-sm-%s col-xs-%s">
                <textarea %s>%s</textarea>
            </div>',
            $size, $size, $size, $size,
            $this->createAttributesString($attributes),
            $escapeHtml($content)
        );
    }
}
