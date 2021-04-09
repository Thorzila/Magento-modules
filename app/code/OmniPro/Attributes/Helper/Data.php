<?php
namespace OmniPro\Attributes\Helper;
use \Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\APp\Helper\AbstractHelper
{

    const CONFIG_PATH = 'omniprosection/omniprogroup/omniprofield';

    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        parent::__construct($context);
    }

    public function getConfig($config, $storeId = null){
        return $this->scopeConfig->getValue(self::CONFIG_PATH . $config, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getOmniproFiedl($storeId = null){
        return $this->getConfig('omniprofield', $storeId);
    }
}
