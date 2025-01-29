<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeLocationSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchPersistenceFactory getFactory()
 */
class AntelopeLocationSearchEntityManager extends AbstractEntityManager implements
    AntelopeLocationSearchEntityManagerInterface
{
    public function createAntelopeLocationSearch(
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer,
    ): AntelopeLocationSearchTransfer {
        $mapper = $this->getFactory()->createAntelopeLocationMapper();
        $antelopeLocationSearchEntity = $mapper
            ->mapAntelopeLocationSearchTransferToAntelopeLocationSearchEntity(
                $antelopeLocationSearchTransfer,
                new PyzAntelopeLocationSearch(),
            );

        $antelopeLocationSearchEntity->save();

        return $mapper->mapAntelopeLocationSearchEntityToAntelopeLocationSearchTransfer(
            $antelopeLocationSearchEntity,
            $antelopeLocationSearchTransfer,
        );
    }

    public function saveAntelopeLocationSearch(AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer): AntelopeLocationSearchTransfer
    {
        $antelopeLocationSearchEntity = $this->getFactory()
            ->createAntelopeLocationSearchQuery()
            ->filterByPrimaryKey($antelopeLocationSearchTransfer->getIdAntelopeLocationSearch())->findOne();
        $antelopeLocationSearchEntity->fromArray($antelopeLocationSearchTransfer->toArray());
        $antelopeLocationSearchEntity->save();

        return $antelopeLocationSearchTransfer->fromArray($antelopeLocationSearchEntity->toArray());
    }
}
