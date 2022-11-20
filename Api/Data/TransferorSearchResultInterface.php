<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TransferorSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return TransferorInterface[]
     */
    public function getItems();

    /**
     * @param TransferorInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
