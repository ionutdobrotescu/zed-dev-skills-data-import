<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeLocationSearch;

class AntelopeLocationSearchMapper
{
    public function mapAntelopeLocationSearchTransferToAntelopeLocationSearchEntity(
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer,
        PyzAntelopeLocationSearch $antelopeLocationSearchEntity,
    ): PyzAntelopeLocationSearch {
        return $antelopeLocationSearchEntity->fromArray($antelopeLocationSearchTransfer->modifiedToArray());
    }

    public function mapAntelopeLocationSearchEntityToAntelopeLocationSearchTransfer(
        PyzAntelopeLocationSearch $antelopeLocationSearchEntity,
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer,
    ): AntelopeLocationSearchTransfer {
        return $antelopeLocationSearchTransfer->fromArray($antelopeLocationSearchEntity->toArray(), true);
    }
}
