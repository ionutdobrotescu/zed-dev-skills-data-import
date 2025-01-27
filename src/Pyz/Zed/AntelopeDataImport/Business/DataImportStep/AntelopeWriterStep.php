<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\AntelopeDataImport\Business\DataSet\AntelopeDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeWriterStep implements DataImportStepInterface
{
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeEntity = PyzAntelopeQuery::create()
            ->filterByName($dataSet[AntelopeDataSetInterface::COLUMN_NAME])
            ->findOneOrCreate();
        $antelopeEntity->setIdLocation(1);
        $antelopeEntity->setColor($dataSet[AntelopeDataSetInterface::COLUMN_COLOR]);

        if ($antelopeEntity->isNew() || $antelopeEntity->isModified()) {
            $antelopeEntity->save();
        }
    }
}
