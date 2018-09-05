<?php

namespace Sifuen\SuppressOutOfDateDb\Controller\Adminhtml\Modules;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Show
 * @package Sifuen\SuppressOutOfDateDb\Controller\Adminhtml\Modules
 */
class Show extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Show constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Sifuen_SuppressOutOfDateDb::system_out_of_date_modules');
        $resultPage->getConfig()->getTitle()->prepend(__('Out of Date Modules'));
        return $resultPage;
    }
}