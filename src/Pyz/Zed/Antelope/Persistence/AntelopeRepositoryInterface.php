<?php

namespace Pyz\Zed\Antelope\Persistence;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method AntelopePersistenceFactory getFactory()
 */
interface AntelopeRepositoryInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeTransfer;

    public function getAntelopeLocationById(int $idLocation
    ): AntelopeLocationTransfer;
}
