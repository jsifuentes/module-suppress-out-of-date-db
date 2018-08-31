<?php

namespace Sifuen\SuppressOutOfDateDb\Framework\Module\Plugin;

use Magento\Framework\Cache\FrontendInterface;
use Magento\Framework\Module\DbVersionInfo;
use Magento\Framework\Module\Plugin\DbStatusValidator as OriginalDbStatusValidator;
use Sifuen\SuppressOutOfDateDb\Helper\Config;

/**
 * Class DbStatusValidator
 * @package Sifuen\SuppressOutOfDate\Framework\Module\Plugin
 */
class DbStatusValidator extends OriginalDbStatusValidator
{
    /**
     * @var Config
     */
    private $configHelper;

    /**
     * DbStatusValidator constructor.
     * @param FrontendInterface $cache
     * @param DbVersionInfo $dbVersionInfo
     * @param Config $configHelper
     */
    public function __construct(
        FrontendInterface $cache,
        DbVersionInfo $dbVersionInfo,
        Config $configHelper
    )
    {
        parent::__construct($cache, $dbVersionInfo);
        $this->configHelper = $configHelper;
    }

    /**
     * @param \Magento\Framework\App\FrontController $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundDispatch(
        \Magento\Framework\App\FrontController $subject,
        \Closure $proceed,
        \Magento\Framework\App\RequestInterface $request
    )
    {
        if (!$this->configHelper->isModuleActive()) {
            return parent::aroundDispatch($subject, $proceed, $request);
        }

        return $proceed($request);
    }
}