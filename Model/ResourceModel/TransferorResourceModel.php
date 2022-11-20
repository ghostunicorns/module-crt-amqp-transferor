<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TransferorResourceModel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('crt_amqp_transferor', 'transferor_id');
    }
}
