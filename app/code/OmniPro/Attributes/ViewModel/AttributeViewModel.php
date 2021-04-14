<?php
namespace OmniPro\Attributes\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class AttributeViewModel implements ArgumentInterface
{
    /**
     * @param \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param \OmniPro\Attributes\Helper\Data
     */
    private $helperData;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \OmniPro\Attributes\Helper\Data $helperData
    )
    {
        $this->storeManager = $storeManager;
        $this->helperData = $helperData;
    }

    public function getConfig() {
        $id = $this->storeManager->getStore()->getId();
        $config = $this->helperData->getOmniproField($id);
        return $config;
    }   
}
