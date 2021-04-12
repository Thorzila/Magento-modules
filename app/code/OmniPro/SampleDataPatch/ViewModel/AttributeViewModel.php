<?php
namespace OmniPro\SampleDataPatch\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class AttributeViewModel implements ArgumentInterface
{
    protected $_product = null;
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Framework\Registry $registry
    )
    {
        $this->_coreRegistry = $registry;
    }

    public function getProduct() {
        if(!$this->_product){
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    public function getAttributeValue() {
        return $this->getProduct()->getAttributeText('additional_description');
    }
}
