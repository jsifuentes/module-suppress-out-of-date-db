<?php

namespace Sifuen\SuppressOutOfDateDb\Helper;

use Magento\Config\Model\ResourceModel\Config\Data\Collection as ConfigCollection;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory as ConfigCollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Sifuen\SuppressOutOfDateDb\Helper
 */
class Config extends AbstractHelper
{
    const CONFIG_ACTIVE = 'sifuen/suppress_out_of_date_db/active';

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * @var ConfigCollectionFactory
     */
    private $collectionFactory;

    /**
     * Config constructor.
     * @param Context $context
     * @param WriterInterface $configWriter
     * @param ConfigCollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        WriterInterface $configWriter,
        ConfigCollectionFactory $collectionFactory
    )
    {
        parent::__construct($context);
        $this->configWriter = $configWriter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return bool
     */
    public function isModuleActive()
    {
        /** @var ConfigCollection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('path', self::CONFIG_ACTIVE)
            ->addFieldToFilter('scope', 'default')
            ->addFieldToFilter('scope_id', '0');

        /** @var \Magento\Framework\App\Config\Value $config */
        $config = $collection->getFirstItem();

        try {
            return ($config->getId() ? !!$config->getValue() : false);
        } catch (LocalizedException $e) {
            return false;
        }
    }

    /**
     * @param bool|int $status
     * @return $this
     */
    public function setIsModuleActive($status)
    {
        $this->configWriter->save(self::CONFIG_ACTIVE, !!$status);
        return $this;
    }
}