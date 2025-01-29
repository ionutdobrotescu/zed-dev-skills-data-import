<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;

interface AntelopeLocationSearchEntityManagerInterface
{
    public function createAntelopeLocationSearch(AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer): AntelopeLocationSearchTransfer;

    public function saveAntelopeLocationSearch(AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer): AntelopeLocationSearchTransfer;
}
