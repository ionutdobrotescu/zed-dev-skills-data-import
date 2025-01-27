<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business\AntelopeLocation\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\AntelopeDataImport\Business\AntelopeLocation\DataSet\AntelopeLocationDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep implements DataImportStepInterface
{
    /**
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
            ->filterByLocationName($dataSet[AntelopeLocationDataSetInterface::COLUMN_LOCATION_NAME])
            ->findOneOrCreate();

        $antelopeLocationEntity->setLocationName($dataSet[AntelopeLocationDataSetInterface::COLUMN_LOCATION_NAME]);

        if ($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()) {
            $antelopeLocationEntity->save();
        }
    }
}
