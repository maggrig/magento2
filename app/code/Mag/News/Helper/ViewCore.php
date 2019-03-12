<?php
/**
 * Created by PhpStorm.
 * User: grig
 * Date: 12.03.2019
 * Time: 19:23
 */

namespace Mag\News\Helper;


use Magento\Framework\App\Bootstrap;
use Symfony\Component\Console\Output\OutputInterface;

class ViewCore extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $context;
    public $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

//     function viewCoreWeb(OutputInterface $output)
     function viewCoreWeb()
    {
//        $output->writeln('Base URL :'.$this->scopeConfig->getValue('web/unsecure/base_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
//        $output->writeln('Base Link URL :'.$this->scopeConfig->getValue('web/unsecure/base_link_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
//        $output->writeln('Base URL for User Media Files :'.$this->scopeConfig->getValue('web/unsecure/base_media_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
//        $output->writeln('Base URL for Static View Files :'.$this->scopeConfig->getValue('web/unsecure/base_static_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
return array(
    '0'=>'Base URL                       : '.$this->scopeConfig->getValue('web/unsecure/base_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
    '1'=>'Base Link URL                  : '.$this->scopeConfig->getValue('web/unsecure/base_link_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
    '2'=>'Base URL for User Media Files  : '.$this->scopeConfig->getValue('web/unsecure/base_media_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
    '3'=>'Base URL for Static View Files : '.$this->scopeConfig->getValue('web/unsecure/base_static_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE))    ;
    }
}