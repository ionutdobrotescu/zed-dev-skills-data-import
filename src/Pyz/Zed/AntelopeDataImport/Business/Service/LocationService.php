<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business\Service;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocation;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\DataImport\Dependency\Propel\DataImportToPropelConnectionInterface;

class LocationService
{
    protected const string DEFAULT_LOCATION_NAME = 'Savannah';

    public function __construct(
        protected DataImportToPropelConnectionInterface $propelConnection
    ) {
    }

    public function getOrCreateDefaultLocationId(): int
    {
        $locationQuery = PyzAntelopeLocationQuery::create();
        $location = $locationQuery->findOne();

        if ($location === null) {
            $location = $this->createDefaultLocation();
        }

        return $location->getIdAntelopeLocation();
    }

    protected function createDefaultLocation(): PyzAntelopeLocation
    {
        // $this->propelConnection->beginTransaction();
        $entity = new PyzAntelopeLocation();
        // PyzAntelopeLocationQuery::be
        //g->getConnection()->beginTransaction();
        $entity->setLocationName(self::DEFAULT_LOCATION_NAME);
        $entity->save();
        //    $this->propelConnection->endTransaction();


        return $entity;
    }
}
