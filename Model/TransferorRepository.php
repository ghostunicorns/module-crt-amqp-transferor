<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorInterface;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorSearchResultInterface;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorSearchResultInterfaceFactory;
use GhostUnicorns\CrtAmqpTransferor\Api\TransferorRepositoryInterface;
use GhostUnicorns\CrtAmqpTransferor\Model\TransferorModelFactory as TransferorFactory;
use GhostUnicorns\CrtAmqpTransferor\Model\ResourceModel\Entity\TransferorCollectionFactory;
use GhostUnicorns\CrtAmqpTransferor\Model\ResourceModel\TransferorResourceModel;

class TransferorRepository implements TransferorRepositoryInterface
{
    /**
     * @var TransferorFactory
     */
    private $transferorFactory;

    /**
     * @var TransferorCollectionFactory
     */
    private $collectionFactory;

    /**
     * @var TransferorSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var TransferorResourceModel
     */
    private $transferorResourceModel;

    /**
     * @param TransferorModelFactory $transferorFactory
     * @param TransferorCollectionFactory $collectionFactory
     * @param TransferorSearchResultInterfaceFactory $transferorSearchResultInterfaceFactory
     * @param TransferorResourceModel $transferorResourceModel
     */
    public function __construct(
        TransferorFactory $transferorFactory,
        TransferorCollectionFactory $collectionFactory,
        TransferorSearchResultInterfaceFactory $transferorSearchResultInterfaceFactory,
        TransferorResourceModel $transferorResourceModel
    ) {
        $this->transferorFactory = $transferorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $transferorSearchResultInterfaceFactory;
        $this->transferorResourceModel = $transferorResourceModel;
    }

    /**
     * @param int $id
     * @return TransferorInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): TransferorInterface
    {
        $transferor = $this->transferorFactory->create();
        $this->transferorResourceModel->load($transferor, $id);
        if (!$transferor->getId()) {
            throw new NoSuchEntityException(__('Unable to find CrtAmqpTransferor with ID "%1"', $id));
        }
        return $transferor;
    }

    /**
     * @param TransferorInterface $transferor
     * @throws Exception
     */
    public function delete(TransferorInterface $transferor)
    {
        $this->transferorResourceModel->delete($transferor);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TransferorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): TransferorSearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param int $activityId
     * @param string $transferorType
     * @param string $status
     * @throws AlreadyExistsException
     */
    public function createOrUpdate(int $activityId, string $transferorType, string $status)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(TransferorModel::ACTIVITY_ID, ['eq' => $activityId]);
        $collection->addFieldToFilter(TransferorModel::TRANSFEROR_TYPE, ['eq' => $transferorType]);

        /** @var TransferorModel $transferor */
        if ($collection->count()) {
            $transferor = $collection->getFirstItem();
        } else {
            $transferor = $this->transferorFactory->create();
            $transferor->setActivityId($activityId);
            $transferor->setTransferorType($transferorType);
        }

        $transferor->setStatus($status);

        $this->save($transferor);
    }

    /**
     * @param TransferorInterface $transferor
     * @return TransferorInterface
     * @throws AlreadyExistsException
     */
    public function save(TransferorInterface $transferor)
    {
        $this->transferorResourceModel->save($transferor);
        return $transferor;
    }

    /**
     * @param int $activityId
     * @param string $transferorType
     * @param string $status
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function update(int $activityId, string $transferorType, string $status)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(TransferorModel::ACTIVITY_ID, ['eq' => $activityId]);
        $collection->addFieldToFilter(TransferorModel::TRANSFEROR_TYPE, ['eq' => $transferorType]);

        if (!$collection->count()) {
            throw new NoSuchEntityException(__(
                'Non existing transferor ~ activityId:%1 ~ transferorType:%2',
                $activityId,
                $transferorType
            ));
        }

        /** @var TransferorInterface $transferor */
        $transferor = $collection->getFirstItem();
        $transferor->setStatus($status);

        $this->save($transferor);
    }

    /**
     * @param int $activityId
     * @return TransferorInterface[]
     */
    public function getAllByActivityId(int $activityId): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(TransferorModel::ACTIVITY_ID, ['eq' => $activityId]);

        /** @var TransferorInterface[] $transferors */
        $transferors = $collection->getItems();

        return $transferors;
    }
}
