<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\Element\Button;
use Zend\Form\Element\File;
use Zend\Form\Element\Submit;
use Zend\Form\ElementInterface;

class FormRow extends \Zend\Form\View\Helper\FormRow
{
    /**
     * The class that is added to element that have errors
     *
     * @var string
     */
    protected $inputErrorClass = 'has-error';

    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param  ElementInterface $element
     * @throws \Zend\Form\Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $escapeHtmlHelper    = $this->getEscapeHtmlHelper();
        $labelHelper         = $this->getLabelHelper();
        $elementHelper       = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();

        $label = $element->getLabel();

        if (isset($label) && '' !== $label) {
            // Translate the label
            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate(
                    $label, $this->getTranslatorTextDomain()
                );
            }
        }

        if ($this->partial) {
            $vars = array(
                'element'           => $element,
                'label'             => $label,
                'labelAttributes'   => $this->labelAttributes,
                'labelPosition'     => $this->labelPosition,
                'renderErrors'      => $this->renderErrors,
            );

            return $this->view->render($this->partial, $vars);
        }

        if ($this->renderErrors) {
            $elementErrors = $elementErrorsHelper->render($element);
        } else {
            $elementErrors = '';
        }

        if (!$element->hasAttribute('id')) {
            $element->setAttribute('id', $this->getId($element));
        }

        if (isset($label) && '' !== $label) {
            $label = $escapeHtmlHelper($label);
        }

        switch ($element->getAttribute('type')) {
            case 'multi_checkbox':
            case 'radio':
                $rowClass = 'form-group';
                $markup = sprintf(
                    '<fieldset><legend>%s</legend>%s</fieldset>',
                    $label,
                    $elementHelper->render($element)
                );
                break;

            case 'checkbox':
                $rowClass = 'checkbox';
                $markup = $labelHelper->openTag() . $elementHelper->render($element) . $label . $labelHelper->closeTag();
                break;

            case $element instanceof Submit:
                $rowClass = 'form-group';
                $elementClass = $element->getAttribute('class');
                if (!empty($elementClass)) {
                    $elementClass .= ' ';
                }
                $elementClass .= 'btn' . ($element->getOption('type') ? ' btn-' . $element->getOption('type') : '');
                $element->setAttribute('class', $elementClass);

                $element->setValue($label);
                $markup = $elementHelper->render($element);
                break;

            case $element instanceof Button:
                $rowClass = 'form-group';
                $elementClass = $element->getAttribute('class');
                if (!empty($elementClass)) {
                    $elementClass .= ' ';
                }
                $elementClass .= 'btn' . ($element->getOption('type') ? ' btn-' . $element->getOption('type') : '');
                $element->setAttribute('class', $elementClass);

                $markup = $elementHelper->render($element);
                break;

            case $element instanceof File:
                $rowClass = 'form-group';
                $label = $labelHelper->openTag($this->getLabelAttributesByElement($element)) . $label . $labelHelper->closeTag();
                $markup = $label . $elementHelper->render($element);
                break;

            default:
                $rowClass = 'form-group';

                $elementClass = $element->getAttribute('class');
                if (!empty($elementClass)) {
                    $elementClass .= ' ';
                }
                $elementClass .= 'form-control';
                $element->setAttribute('class', $elementClass);

                $label = $labelHelper->openTag($this->getLabelAttributesByElement($element)) . $label . $labelHelper->closeTag();
                $markup = $label . $elementHelper->render($element);
                break;
        }

        if ($this->renderErrors) {
            $markup .= $elementErrors;
        }

        $errorClass = $this->getInputErrorClass();

        if (count($element->getMessages()) && !empty($errorClass)) {
            $rowClass .= ' ' . $errorClass;
        }

        //ensure to have space at the end to proper elements spacing in inline variant
        if ($element instanceof Submit || $element instanceof Button) {
            return $markup . ' ';
        }

        return sprintf(
            '<div class="%s">%s</div> ',
            $rowClass,
            $markup
        );
    }

    protected function getLabelAttributesByElement($element)
    {
        $labelAttributes = $element->getLabelAttributes();

        if (empty($labelAttributes)) {
            $labelAttributes = array();
        }

        if (!isset($labelAttributes['for'])) {
            $labelAttributes['for'] = $element->getAttribute('id');
        }

        if (isset($labelAttributes['class'])) {
            $labelAttributes['class'] .= ' ';
        }

        if (!isset($labelAttributes['size'])) {
            $size = $element->getOption('size') ? 2 : 0;
        } else {
            $size = $labelAttributes['size'];
            unset($labelAttributes['size']);
        }

        $labelAttributes['class'] .= 'control-label';

        if (!empty($size)) {
            $labelAttributes['class'] .= sprintf(
                ' col-lg-%s col-md-%s col-sm-%s col-xs-%s',
                $size, $size, $size, $size
            );
        }

        return $labelAttributes;
    }
}