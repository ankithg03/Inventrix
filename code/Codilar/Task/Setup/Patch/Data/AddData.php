<?php
namespace Codilar\Task\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddData implements DataPatchInterface {

    private $moduleDataSetup;

   
    private $eavSetupFactory;

    
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    
    public function apply() {
        
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'custom_dropdown', [
            'group' => 'General',
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'sort_order' => 210,
            'label' => 'Enabled',
            'input' => 'select',
            'class' => '',
            'source' => 'Codilar\Task\Model\Source\Customdropdown',
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

    
    public static function getDependencies() {
        return [];
    }

    
    public function getAliases() {
        return [];
    }
}


?>

    