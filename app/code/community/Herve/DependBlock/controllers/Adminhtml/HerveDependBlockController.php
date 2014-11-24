<?php
/**
 * This file is part of Herve_DependBlock for Magento.
 *
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Hervé Guétin <herve.guetin@gmail.com> <@herveguetin>
 * @category Herve
 * @package Herve_DependBlock
 * @copyright Copyright (c) 2014 herveguetin.com (http://www.herveguetin.com)
 */

/**
 * Adminthtml_HerveDependBlock Controller
 * @package Herve_DependBlock
 */
class Herve_DependBlock_Adminhtml_HerveDependBlockController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Create a form
     */
    public function indexAction()
    {
        $this->loadLayout();

        $block = $this->getLayout()->createBlock('herve_dependblock/adminhtml_form', 'herve_dependblock_form');
        $this->_addContent($block);

        $this->renderLayout();
    }

    /**
     * Is allowed?
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
    }

}