<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Model\ResourceModel\Entity;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use GhostUnicorns\CrtAmqpTransferor\Model\TransferorModel;
use GhostUnicorns\CrtAmqpTransferor\Model\ResourceModel\TransferorResourceModel;

class TransferorCollection extends AbstractCollection
{
    protected $_idFieldName = 'transferor_id';
    protected $_eventPrefix = 'crt_amqp_transferor_collection';
    protected $_eventObject = 'transferor_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TransferorModel::class, TransferorResourceModel::class);
    }
}
