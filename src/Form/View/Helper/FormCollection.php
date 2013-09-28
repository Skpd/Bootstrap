<?php

namespace Skpd\Bootstrap\Form\View\Helper;

use Zend\Form\Element\Collection as CollectionElement;
use Zend\Form\Element\Collection;
use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\Form\FieldsetInterface;

class FormCollection extends \Zend\Form\View\Helper\FormCollection
{
    protected $removeButtonMarkup  = '<button onclick="%s" type="button" class="close">%s</button>';
    protected $removeButtonContent = '&times;';
    protected $removeButtonEvent   = "this.parentElement.tagName == 'fieldset' ? this.parentElement.remove() : this.parentElement.parentElement.remove()";

    protected $addButtonEvent = "
        var parent = this.parentElement.tagName == 'fieldset' ? this.parentElement : this.parentElement.parentElement;
        var template = parent.lastChild;
        var currentId = parent.querySelectorAll('fieldset').length;
        template.insertAdjacentHTML('beforebegin', template.dataset.template.replace(/__placeholder__/g, currentId));
    ";

    public function __invoke(ElementInterface $element = null, $allowRemove = false)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element, $allowRemove);
    }


    public function render(ElementInterface $element, $allowRemove = false)
    {
        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }

        $markup       = '';
        $addButton    = '';
        $removeButton = '';

        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $elementHelper    = $this->getElementHelper();
        $fieldsetHelper   = $this->getFieldsetHelper();

        foreach ($element->getIterator() as $elementOrFieldset) {
            if ($elementOrFieldset instanceof FieldsetInterface) {
                if ($fieldsetHelper instanceof $this && $element instanceof Collection) {
                    $markup .= $fieldsetHelper($elementOrFieldset, $element->allowRemove());
                } else {
                    $markup .= $fieldsetHelper($elementOrFieldset);
                }
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                $markup .= $elementHelper($elementOrFieldset);
            }
        }

        // If $templateMarkup is not empty, use it for simplify adding new element in JavaScript
        if ($element instanceof CollectionElement && $element->shouldCreateTemplate()) {
            $markup .= $this->renderTemplate($element);

            if ($element->allowAdd()) {
                $addButton = '<button onclick="'
                    . str_replace('__placeholder__', $element->getTemplatePlaceholder(), $this->addButtonEvent)
                    . '" type="button" class="close"><i class="glyphicon glyphicon-plus"></i></button>';
            }
        } elseif ($element instanceof Fieldset && $allowRemove) {
            $removeButton = sprintf($this->removeButtonMarkup, $this->removeButtonEvent, $this->removeButtonContent);
        }

        $label = $element->getLabel();

        if (!empty($label)) {

            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate(
                    $label, $this->getTranslatorTextDomain()
                );
            }

            $label = $escapeHtmlHelper($label);
            $label = sprintf('<legend>%s%s%s</legend>', $label, $removeButton, $addButton);

            $wrapper = $label;
        } else {
            $wrapper = sprintf(
                '<div class="collection-header">%s%s</div>',
                $removeButton,
                $addButton
            );
        }

        $markup = sprintf(
            '<fieldset>%s%s</fieldset>',
            $wrapper,
            $markup
        );

        return $markup;
    }

    public function renderTemplate(CollectionElement $collection)
    {
        $elementHelper          = $this->getElementHelper();
        $escapeHtmlAttribHelper = $this->getEscapeHtmlAttrHelper();
        $templateMarkup         = '';

        $elementOrFieldset = $collection->getTemplateElement();

        if ($elementOrFieldset instanceof FieldsetInterface) {
            $templateMarkup .= $this->render($elementOrFieldset, $collection->allowRemove());
        } elseif ($elementOrFieldset instanceof ElementInterface) {
            $templateMarkup .= $elementHelper($elementOrFieldset);
        }

        return sprintf(
            '<span data-template="%s"></span>',
            $escapeHtmlAttribHelper($templateMarkup)
        );
    }


    /**
     * @return \Zend\Form\View\Helper\FormElement
     */
    protected function getElementHelper()
    {
        return parent::getElementHelper();
    }
}