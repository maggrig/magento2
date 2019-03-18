<?php

namespace Mageplaza\HelloWorld\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'hi all'));
        $this->_eventManager->dispatch('catalog_category_prepare_save', ['mp_text' => $textDisplay]);
        echo $textDisplay->getText();
        exit;
    }
}