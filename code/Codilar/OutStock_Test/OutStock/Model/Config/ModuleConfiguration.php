<?php


namespace Codilar\OutStock\Model\Config;


use Magento\Framework\App\Config\ScopeConfigInterface;

class ModuleConfiguration
{

//    for taking value assign id of system.xml file (here field id )
    const OUTSTOCK_MODULE_STATUS = 'outstock/general/enabled';
    const OUTSTOCK_MODULE_GROUP = 'outstock/general/customer_groups';

    const OUTSTOCK_MODULE_SENDER = 'outstock/general/sender';
    const OUTSTOCK_MODULE_SUBSCRIBED ='outstock/general/subscribed_customer';

    const OUTSTOCK_MODULE_POPHEADING = 'outstock/popup/popup_heading';
    const OUTSTOCK_MODULE_POPDESCRIPTION = 'outstock/popup/popup_desc';
    const OUTSTOCK_MODULE_POPEMAILPLACEHOLDER = 'outstock/popup/email_placeholder';
    const OUTSTOCK_MODULE_POPBUTTON = 'outstock/popup/button';
    const OUTSTOCK_MODULE_POPFOOTER = 'outstock/popup/footer_content';


    /**
     * @var ScopeConfigInterface $config
     */
    private $config;

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
        return !!$this->config->getValue(self::OUTSTOCK_MODULE_STATUS);
    }


    /**
     * @return string
     */
    public function getCustomerGroup(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_GROUP);
    }


    /**
     * @return string
     */
    public function getEmailSender(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_SENDER);
    }

        public function getSubscribed(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_SUBSCRIBED);
    }

        /**
     * @return string
     *
     */
    public function getPopHeading(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_POPHEADING);
    }


    /**
     * @return string
     *
     */
    public function getPopDes(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_POPDESCRIPTION);
    }


    /**
     * @return string
     *
     */
    public function getPOPEmail(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_POPEMAILPLACEHOLDER);
    }

    /**
     * @return string
     *
     */
    public function getPopButton(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_POPBUTTON);
    }


    /**
     * @return string
     *
     */
    public function getPopFooter(): string
    {
        return $this->config->getValue(self::OUTSTOCK_MODULE_POPFOOTER);
    }


}

