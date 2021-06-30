<?php
namespace Codilar\FAQ\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ModuleConfiguration
{
    const FAQ_MODULE_STATUS = 'faq_section/general/enabled';
    const FAQ_MODULE_PAGE_TITLE = 'faq_section/general/page_title';
    const FAQ_MODULE_HEADER_LINK = 'faq_section/allow/headerlink';
    /**
     * @var ScopeConfigInterface $config
     */
    private $config;

    /**
     * ModuleConfiguration constructor.
     * @param ScopeConfigInterface $config
     */
    public function __construct(
        ScopeConfigInterface $config
    )
    {
        $this->config = $config;
    }
    /**
     * @return boolean
     */
    public function getModuleStatus()
    {
        return !!$this->config->getValue(self::FAQ_MODULE_STATUS);
    }
    /**
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->config->getValue(self::FAQ_MODULE_PAGE_TITLE);
    }


}

