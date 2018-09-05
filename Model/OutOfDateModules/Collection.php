<?php

namespace Sifuen\SuppressOutOfDateDb\Model\OutOfDateModules;

use Magento\Framework\DataObject;

class Collection extends \Magento\Framework\Data\Collection
{
    /**
     * @var \Magento\Framework\Module\DbVersionInfo
     */
    private $dbVersionInfo;

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
     * @param \Magento\Framework\Module\DbVersionInfo $dbVersionInfo
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Magento\Framework\Module\DbVersionInfo $dbVersionInfo
    ) {
        parent::__construct($entityFactory);
        $this->dbVersionInfo = $dbVersionInfo;
    }

    /**
     * @param bool $printQuery
     * @param bool $logQuery
     * @return $this|\Magento\Framework\Data\Collection
     * @throws \Exception
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if (!$this->isLoaded()) {
            foreach ($this->dbVersionInfo->getDbVersionErrors() as $error) {
                $this->addItem(new DataObject($error));
            }

            $this->_setIsLoaded(true);
        }

        return $this;
    }
}
