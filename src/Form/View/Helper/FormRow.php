<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\Element\Button;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\File;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Submit;
use Zend\Form\ElementInterface;

class FormRow extends \Zend\Form\View\Helper\FormRow
{
    protected $renderHelp = true;

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

        if ($element instanceof MultiCheckbox || $element instanceof Radio) {
            $rowClass = 'form-group';
            $markup = sprintf(
                '<fieldset><legend>%s</legend>%s</fieldset>',
                $label,
                $elementHelper->render($element)
            );
        } else if ($element instanceof Checkbox) {
            $rowClass = 'checkbox';
            $markup = $labelHelper->openTag() . $elementHelper->render($element) . $label . $labelHelper->closeTag();
        } else if ($element instanceof Submit) {
            $rowClass = 'form-group';
            $elementClass = $element->getAttribute('class');
            if (!empty($elementClass)) {
                $elementClass .= ' ';
            }
            $elementClass .= 'btn' . ($element->getOption('type') ? ' btn-' . $element->getOption('type') : '');
            $element->setAttribute('class', $elementClass);

            $element->setValue($label);
            $markup = $elementHelper->render($element);
        } else if ($element instanceof Button) {
            $rowClass = 'form-group';
            $elementClass = $element->getAttribute('class');
            if (!empty($elementClass)) {
                $elementClass .= ' ';
            }
            $elementClass .= 'btn' . ($element->getOption('type') ? ' btn-' . $element->getOption('type') : '');
            $element->setAttribute('class', $elementClass);

            $markup = $elementHelper->render($element);
        } else if ($element instanceof File) {
            $rowClass = 'form-group';
            $label = $labelHelper->openTag($this->getLabelAttributesByElement($element)) . $label . $labelHelper->closeTag();
            $markup = $label . $elementHelper->render($element);
        } else {
            $rowClass = 'form-group';

            $elementClass = $element->getAttribute('class');
            if (!empty($elementClass)) {
                $elementClass .= ' ';
            }
            $elementClass .= 'form-control';
            $element->setAttribute('class', $elementClass);

            $label = $labelHelper->openTag($this->getLabelAttributesByElement($element)) . $label . $labelHelper->closeTag();
            $markup = $label . $elementHelper->render($element);
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

        $help = $element->getOption('help');

        if ($this->renderHelp && !empty($help)) {
            if (!is_array($help)) {
                $help = array('text' => $help);
            }

            if (!empty($help['collapse'])) {
                if (empty($help['placement'])) {
                    $help['placement'] = 'right';
                }

                $markup .= sprintf(
                    '<span class="help-block">
                        <i data-placement="%s" data-toggle="tooltip" data-title="%s" class="glyphicon glyphicon-question-sign"></i>
                    </span>',
                    $help['placement'],
                    $help['text']
                );
            } else {
                $markup .= '<span class="help-block">' . $help['text'] . '</span>';
            }
        }

        return sprintf(
            '<div class="%s">%s</div> ',
            $rowClass,
            $markup
        );
    }

    /**
     * @param ElementInterface $element
     * @return array
     */
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
        } else {
            $labelAttributes['class'] = '';
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

    /**
     * @param mixed $renderHelp
     */
    public function setRenderHelp($renderHelp)
    {
        $this->renderHelp = $renderHelp;
    }

    /**
     * @return mixed
     */
    public function renderHelp()
    {
        return $this->renderHelp;
    }
}