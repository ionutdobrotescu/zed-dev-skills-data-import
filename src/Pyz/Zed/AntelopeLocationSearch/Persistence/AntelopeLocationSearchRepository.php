<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchPersistenceFactory getFactory()
 */
class AntelopeLocationSearchRepository extends AbstractRepository implements AntelopeLocationSearchRepositoryInterface
{
    /**
     * @return array<int, \Generated\Shared\Transfer\AntelopeLocationSearchTransfer>
     */
    public function findAntelopeLocationSearchByFk(): array
    {
        $antelopeLocationSearches = [];
        /**
         * @var \Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeLocationSearch $locationSearch
         */
        foreach ($this->getFactory()->createAntelopeLocationSearchQuery()->find() as $locationSearch) {
            $antelopeLocationSearches[$locationSearch->getFkAntelopeLocation()] = (new AntelopeLocationSearchTransfer(
            ))->fromArray(
                $locationSearch->toArray(),
                true,
            );
        }

        return $antelopeLocationSearches;
    }
}
