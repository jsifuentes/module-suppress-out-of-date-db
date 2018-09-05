<?php

namespace Sifuen\SuppressOutOfDateDb\Model\System\Message;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\Module\DbVersionInfo;
use Magento\Framework\Notification\MessageInterface;
use Sifuen\SuppressOutOfDateDb\Helper\Config;

/**
 * Class DbOutOfDate
 * @package Sifuen\SuppressOutOfDateDb\Model\System\Message
 */
class DbOutOfDate implements MessageInterface
{
    const IDENTITY = 'sifuen_db_out_of_date';

    /**
     * @var DbVersionInfo
     */
    private $dbVersionInfo;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * DbOutOfDate constructor.
     * @param Config $config
     * @param DbVersionInfo $dbVersionInfo
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        Config $config,
        DbVersionInfo $dbVersionInfo,
        UrlInterface $urlBuilder
    )
    {
        $this->dbVersionInfo = $dbVersionInfo;
        $this->config = $config;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getIdentity()
    {
        return self::IDENTITY;
    }

    /**
     * @return bool
     */
    public function isDisplayed()
    {
        return $this->config->isModuleActive();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getText()
    {
        $dbErrors = $this->dbVersionInfo->getDbVersionErrors();
        $moduleNames = $this->getModuleNames($dbErrors);

        return __(
            'You have %1 module(s) out of date. ' .
            'Run bin/magento setup:upgrade from the Magento root directory. ' .
            'Visit the <a href="%2">out of date modules list</a> page',
            count($moduleNames),
            $this->urlBuilder->getUrl('db_out_of_date/modules/show')
        );
    }

    /**
     * @return int
     */
    public function getSeverity()
    {
        return self::SEVERITY_CRITICAL;
    }

    /**
     * @param array $dbErrors
     * @return array
     */
    private function getModuleNames(array $dbErrors)
    {
        return array_unique(array_map(function($error) {
            return $error['module'];
        }, $dbErrors));
    }
}