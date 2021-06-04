<?php
namespace Dhruvi\HelloWorld\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
        /**
        * EAV setup factory
        *
        * @var EavSetupFactory
        */
        private $eavSetupFactory;

        /**
        * Init
        *
        * @param EavSetupFactory $eavSetupFactory
        */
        public function __construct(EavSetupFactory $eavSetupFactory)
        {
        $this->eavSetupFactory = $eavSetupFactory;
        }

        /**
        * {@inheritdoc}
        * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
        */
        public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
        {
        /* @var EavSetup $eavSetup /
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        /**
        * Add attributes to the eav/attribute
        */
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'call_for_price_active');
        $eavSetup->addAttribute(
        \Magento\Catalog\Model\Product::ENTITY, 'text_demo',
        [

        'type' => 'varchar',
        'backend' => '',
        'frontend' => '',
        'label' => 'Text Demo',
        'input' => 'boolean',
        'class' => '',
        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
        'visible' => true,
        'required' => false,
        'user_defined' => false,
        'default' => 0,
        'searchable' => false,
        'filterable' => false,
        'comparable' => false,
        'visible_on_front' => false,
        'used_in_product_listing' => true,
        'unique' => false
        ]
        );
        }
}