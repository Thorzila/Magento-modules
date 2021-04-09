<?php

namespace OmniPro\SampleDataPatch\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Setup\EavSetup;

class AdditionalDescription implements DataPatchInterface
{

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    protected ModuleDataSetupInterface $_moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    protected EavSetupFactory $_eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface  $moduleDataSetup
     * @param EavSetupFactory           $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return $this
     */
    public function apply()
    {
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);
        try {
            $eavSetup->addAttribute('catalog_product', 'additional_description', [
                'type' => 'varchar',
                'label' => 'Descripción adicional',
                'input' => 'text',
                'validate_rules' => '{"max_text_length":255,"min_text_length":1}',
                'required' => false,
                'used_in_product_listing' => true,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL
            ]);
        } catch (LocalizedException | \Zend_Validate_Exception $e) {
            var_dump($e);
        }
    }
}
