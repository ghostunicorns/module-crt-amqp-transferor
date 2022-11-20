<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Model;

use DateTime;
use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Model\AbstractExtensibleModel;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorInterface;

class TransferorModel extends AbstractExtensibleModel implements TransferorInterface
{
    const ID = 'transferor_id';
    const ACTIVITY_ID = 'activity_id';
    const TRANSFEROR_TYPE = 'transferor_type';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CACHE_TAG = 'crt_amqp_transferor';
    protected $_cacheTag = 'crt_amqp_transferor';
    protected $_eventPrefix = 'crt_amqp_transferor';

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getActivityId(): int
    {
        return (int)$this->getData(self::ACTIVITY_ID);
    }

    /**
     * @param int $activityId
     * @return void
     */
    public function setActivityId(int $activityId)
    {
        $this->setData(self::ACTIVITY_ID, $activityId);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return (string)$this->getData(self::STATUS);
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @return string
     */
    public function getTransferorType(): string
    {
        return (string)$this->getData(self::TRANSFEROR_TYPE);
    }

    /**
     * @param string $transferorType
     */
    public function setTransferorType(string $transferorType)
    {
        $this->setData(self::TRANSFEROR_TYPE, $transferorType);
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->getData(self::CREATED_AT));
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->getData(self::UPDATED_AT));
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\TransferorResourceModel::class);
    }
}
