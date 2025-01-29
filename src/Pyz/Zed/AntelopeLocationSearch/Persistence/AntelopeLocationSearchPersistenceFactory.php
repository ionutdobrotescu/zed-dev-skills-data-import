<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeLocationSearchQuery;
use Pyz\Zed\AntelopeLocationSearch\Persistence\Propel\Mapper\AntelopeLocationSearchMapper;

class AntelopeLocationSearchPersistenceFactory
{
    public function createAntelopeLocationSearchQuery(): PyzAntelopeLocationSearchQuery
    {
        return PyzAntelopeLocationSearchQuery::create();
    }

    public function createAntelopeLocationMapper(): AntelopeLocationSearchMapper
    {
        return new AntelopeLocationSearchMapper();
    }
}
