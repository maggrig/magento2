<?php
/**
 * Copyright © 2017 Magefan (support@magefan.com). All rights reserved.
 * See LICENSE.txt for license details (http://opensource.org/licenses/osl-3.0.php).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

namespace Mag\News\Model;

/**
 * News model
 *
 * @method \Mag\News\Model\ResourceModel\Reviews _getResource()
 * @method \Mag\News\Model\ResourceModel\Reviews getResource()
 * @method int getStoreId()
 * @method $this setStoreId(int $value)
 * @method string getTitle()
 * @method $this setTitle(string $value)
 * @method string getMetaKeywords()
 * @method $this setMetaKeywords(string $value)
 * @method string getMetaDescription()
 * @method $this setMetaDescription(string $value)
 * @method string getIdentifier()
 * @method $this setIdentifier(string $value)
 * @method string getContent()
 * @method $this setContent(string $value)
 * @method string getContentHeading()
 * @method $this setContentHeading(string $value)
 * @method string getCreationTime()
 * @method $this setCreationTime(string $value)
 * @method string getUpdateTime()
 * @method $this setUpdateTime(string $value)
 * @method string getIsActive()
 * @method $this setIsActive(bool $value)
 */
class News extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mag\News\Model\ResourceModel\News');
    }
}
