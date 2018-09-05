<?php

namespace Sifuen\SuppressOutOfDateDb\Block\Adminhtml;

/**
 * Class Container
 * @package Sifuen\SuppressOutOfDateDb\Block\Modules
 */
class Container extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'module';
        $this->_headerText = __('Modules out of date');
        parent::_construct();
        $this->buttonList->remove('add');
    }
}
