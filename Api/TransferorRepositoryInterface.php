<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorInterface;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorSearchResultInterface;

interface TransferorRepositoryInterface
{
    /**
     * @param int $id
     * @return TransferorInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): TransferorInterface;

    /**
     * @param TransferorInterface $transferor
     * @return TransferorInterface
     */
    public function save(TransferorInterface $transferor);

    /**
     * @param TransferorInterface $transferor
     * @return void
     */
    public function delete(TransferorInterface $transferor);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TransferorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): TransferorSearchResultInterface;

    /**
     * @param int $activityId
     * @param string $transferorType
     * @param string $status
     */
    public function createOrUpdate(int $activityId, string $transferorType, string $status);

    /**
     * @param int $activityId
     * @param string $transferorType
     * @param string $status
     */
    public function update(int $activityId, string $transferorType, string $status);

    /**
     * @param int $activityId
     * @return TransferorInterface[]
     */
    public function getAllByActivityId(int $activityId): array;
}
