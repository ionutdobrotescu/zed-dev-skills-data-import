<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business\Antelope\DataImportStep;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Shared\AntelopeSearch\AntelopeSearchConfig;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeDataImport\Business\Antelope\DataSet\AntelopeDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @var array<int>
     */
    private static array $antelopeLocations = [];

    public function __construct(protected readonly AntelopeFacadeInterface $antelopeFacade)
    {
        if (!static::$antelopeLocations) {
            $this->setAntelopeLocations();
        }
    }

    /**
     * @return void
     */
    public function setAntelopeLocations(): void
    {
        $antelopeLocationCollection = $this->antelopeFacade->getAntelopeLocationCollection(
            (new AntelopeLocationCriteriaTransfer())->setAntelopeLocationsConditions(
                new AntelopeLocationConditionTransfer(),
            ),
        );
        $antelopeLocationIds = [];
        foreach ($antelopeLocationCollection->getAntelopeLocations() as $location) {
            $antelopeLocationIds[$location->getIdAntelopeLocation()] = $location->getIdAntelopeLocation();
        }
        self::$antelopeLocations = $antelopeLocationIds;
    }

    /**
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeEntity = PyzAntelopeQuery::create()
            ->filterByName($dataSet[AntelopeDataSetInterface::COLUMN_NAME])
            ->findOneOrCreate();
        $idLocation = (int)$dataSet[AntelopeDataSetInterface::COLUMN_ID_LOCATION];
        $idLocation = static::$antelopeLocations[$idLocation] ?? array_rand(static::$antelopeLocations, 1);
        $antelopeEntity->setFkAntelopeLocation($idLocation);
        $antelopeEntity->setColor($dataSet[AntelopeDataSetInterface::COLUMN_COLOR]);

        if ($antelopeEntity->isNew() || $antelopeEntity->isModified()) {
            $antelopeEntity->save();
            $this->addPublishEvents(AntelopeSearchConfig::ANTELOPE_PUBLISH, $antelopeEntity->getIdAntelope());
        }
    }
}
