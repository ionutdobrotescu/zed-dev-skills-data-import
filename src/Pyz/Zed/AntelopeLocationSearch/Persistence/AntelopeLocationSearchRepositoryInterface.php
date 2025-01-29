<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchPersistenceFactory getFactory()
 */
interface AntelopeLocationSearchRepositoryInterface
{
    /**
     * @return array<int, \Generated\Shared\Transfer\AntelopeLocationSearchTransfer>
     */
    public function findAntelopeLocationSearchByFk(): array;
}
