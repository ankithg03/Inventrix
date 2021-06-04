<?php
/**
 * Custom Catalog Rule Based Page
 *
 * @description Extension for Custom Catalog Rule Based Page
 * @author    <ankith@codilar.com>
 * @link     https://www.codilar.com
 * @copyright Copyright © 2020 NexPWA Pvt. Ltd.. All rights reserved
 *
 * Custom Catalog Rule Based Page
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'NexPWA_CatalogRulePage',
    __DIR__
);
