<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\AntelopeLocationDataImport\Business\DataSet\AntelopeLocationDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
            ->filterByLocationName($dataSet[AntelopeLocationDataSetInterface::COLUMN_NAME])
            ->findOneOrCreate();

        $antelopeLocationEntity
            ->setLocationLatitude($dataSet[AntelopeLocationDataSetInterface::COLUMN_LATITUDE])
            ->setLocationLongitude($dataSet[AntelopeLocationDataSetInterface::COLUMN_LONGITUDE]);

        if ($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()) {
            $antelopeLocationEntity->save();
        }
    }
}
