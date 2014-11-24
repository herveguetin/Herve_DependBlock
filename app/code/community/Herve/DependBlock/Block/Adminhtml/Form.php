<?php
/**
 * This file is part of Herve_DependBlock for Magento.
 *
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 * @category Herve
 * @package Herve_DependBlock
 * @copyright Copyright (c) 2014 Hervé Guétin (http://www.herveguetin.com)
 */

/**
 * Adminhtml_Form Block
 * @package Herve_DependBlock
 */
class Herve_DependBlock_Block_Adminhtml_Form extends Mage_Adminhtml_Block_Widget_Form
{

// Hervé Guétin Tag NEW_CONST

// Hervé Guétin Tag NEW_VAR

    /**
     * CAUTION - This form is not ready for CRUD operations
     * It is just an example in the simpliest form to show the use of dependencies block
     */


    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTitle(Mage::helper('herve_dependblock')->__('Block Information'));
    }

    /**
     * Prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        // Create a new form
        $form = new Varien_Data_Form();

        // Add a fieldset to this form
        $fieldset = $form->addFieldset(
            'base_fieldset',
            array('legend' => Mage::helper('herve_dependblock')->__('General Information'))
        );

        // Add some fields

        $fieldset->addField(
            'show_children_field',
            'select',
            array(
                'name' => 'show_children_name',
                'label' => Mage::helper('herve_dependblock')->__('Show Children'),
                'title' => Mage::helper('herve_dependblock')->__('Show Children'),
                'options' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray()
            )
        );

        $fieldset->addField(
            'show_child_field',
            'select',
            array(
                'name' => 'show_child_name',
                'label' => Mage::helper('herve_dependblock')->__('Show Child'),
                'title' => Mage::helper('herve_dependblock')->__('Show Child'),
                'options' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray()
            )
        );

        $fieldset->addField(
            'child_text_field',
            'text',
            array(
                'name' => 'child_text_name',
                'label' => Mage::helper('herve_dependblock')->__('Child Text'),
                'title' => Mage::helper('herve_dependblock')->__('Child Text'),
                'note' => Mage::helper('herve_dependblock')->__('Type "show" and click outside the field')
            )
        );

        $fieldset->addField(
            'child_field',
            'note',
            array(
                'name' => 'child_name',
                'text' => Mage::helper('herve_dependblock')->__('<strong>Surprise!</strong>'),
                'label' => '',
                'title' => Mage::helper('herve_dependblock')->__('Child'),
            )
        );

        // Set form to be rendered in template
        $this->setForm($form);

        // Set block for the "form_after" block in template
        // @see /app/design/adminhtml/default/default/template/widget/form.phtml
        $this->setChild('form_after',

            // The content of the "form_after" block is a Mage_Adminhtml_Block_Widget_Form_Element_Dependence block typ
            $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')

                /**
                 * Map the form fields to the dependencies block IDs
                 * This is kind of a "form field" => "dependencies block identifier" association
                 */

                // Our form's "show_children_field" is used with the "show_children_depend_id" ID in the dependencies block
                ->addFieldMap('show_children_field', 'show_children_depend_id')

                // Our form's "show_child_field" is used with the "show_child_depend_id" ID in the dependencies block
                ->addFieldMap('show_child_field', 'show_child_depend_id')

                // Our form's "child_field" is used with the "child_depend_id" ID in the dependencies block
                ->addFieldMap('child_field', 'child_depend_id')

                // Our form's "child_text_field" is used with the "child_text_depend_id" ID in the dependencies block
                ->addFieldMap('child_text_field', 'child_text_depend_id')

                /**
                 * Create dependencies
                 * Each addFieldDependence() can be understood like:
                 * "Show this [dependencies block identifier] if this [dependencies block identifier] is [value]
                 *
                 * Defined dependencies adds which allows some "AND" statements
                 */

                // Show 'show_child_depend_id' if 'show_children_depend_id' is '1'
                // In other words, based on the previous mapping: "Show the 'show_child_field' if 'show_children_field' value is 1
                ->addFieldDependence('show_child_depend_id', 'show_children_depend_id', '1')

                // Show 'child_depend_id' if 'show_children_depend_id' is '1'
                ->addFieldDependence('child_depend_id', 'show_child_depend_id', '1')

                // Show 'child_text_depend_id' if 'show_children_depend_id' is '1'
                ->addFieldDependence('child_text_depend_id', 'show_child_depend_id', '1')

                // Show 'child_depend_id' if 'show_children_depend_id' is '1'
                // AND if 'show_child_depend_id' is also '1'
                // AND, for the fum, if the user has typed "show" in 'child_text_depend_id'
                ->addFieldDependence('child_depend_id', 'show_children_depend_id', '1')
                ->addFieldDependence('child_depend_id', 'show_child_depend_id', '1')
                ->addFieldDependence('child_depend_id', 'child_text_depend_id', 'show')
        );

        return parent::_prepareForm();
    }

// Hervé Guétin Tag NEW_METHOD

}