<?php
namespace Codilar\Supplier\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SupplierProduct implements DataPatchInterface {

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * SupplierProduct constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct( ModuleDataSetupInterface $moduleDataSetup, EavSetupFactory $eavSetupFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return SupplierProduct|void
     */
    public function apply() {

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'supplier', [
            'group' => 'General',
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 210,
            'label' => 'Supplier',
            'input' => 'select',
            'class' => '',
            'source' => 'Codilar\Supplier\Model\Source\Config\Supplier\Source',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'apply_to' => ''
        ]);
    }

    /**
     * @return array
     */
    public static function getDependencies() {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases() {
        return [];
    }
}


