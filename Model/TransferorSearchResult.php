<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpTransferor\Model;

use Magento\Framework\Api\Search\SearchResult;
use GhostUnicorns\CrtAmqpTransferor\Api\Data\TransferorSearchResultInterface;

class TransferorSearchResult extends SearchResult implements TransferorSearchResultInterface
{

}
