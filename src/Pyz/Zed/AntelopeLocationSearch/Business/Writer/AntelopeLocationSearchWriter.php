<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Business\Writer;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchEntityManagerInterface;
use Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchRepositoryInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeLocationSearchWriter
{
    public function __construct(
        protected readonly AntelopeLocationSearchEntityManagerInterface $antelopeLocationSearchEntityManager,
        protected readonly AntelopeLocationSearchRepositoryInterface $antelopeLocationSearchRepository,
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly EventBehaviorFacadeInterface $eventBehaviorFacade,
    ) {
    }

    /**
     * @return void
     */
    public function writeCollectionByAntelopeEvents(array $eventTransfers): void
    {
        $antelopeLocationIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);

        $this->writeCollectionAntelopeLocations($antelopeLocationIds);
    }

    /**
     * @return void
     */
    protected function writeCollectionAntelopeLocations(array $antelopeLocationIds): void
    {
        $antelopeLocationSearchData = $this->getAntelopeLocationSearchData();
        $antelopeLocations = $this->getAntelopeLocationsById($antelopeLocationIds);
        foreach ($antelopeLocations as $antelopeLocation) {
            $locationData = $antelopeLocation->toArray();
            $antelopeLocationSearchTransfer = $antelopeLocationSearchData[$antelopeLocation->getIdAntelopeLocation(
            )] ?? new AntelopeLocationSearchTransfer();

            $antelopeLocationSearchTransfer->setData($locationData);
            $antelopeLocationSearchTransfer->setFkAntelopeLocation($antelopeLocation->getIdAntelopeLocation());
            if ($antelopeLocationSearchTransfer->getIdAntelopeLocationSearch() === null) {
                $this->antelopeLocationSearchEntityManager->createAntelopeLocationSearch(
                    $antelopeLocationSearchTransfer,
                );
            } else {
                $this->antelopeLocationSearchEntityManager->saveAntelopeLocationSearch($antelopeLocationSearchTransfer);
            }
        }
    }

    /**
     * @return array<int, \Generated\Shared\Transfer\AntelopeLocationSearchTransfer>
     */
    private function getAntelopeLocationSearchData(): array
    {
        return $this->antelopeLocationSearchRepository->findAntelopeLocationSearchByFk();
    }

    /**
     * @param array $antelopeLocationIds
     *
     * @return array<int, \Generated\Shared\Transfer\AntelopeLocationTransfer>
     */
    private function getAntelopeLocationsById(array $antelopeLocationIds): array
    {
        $locations = [];
        $locationCriteria = new AntelopeLocationCriteriaTransfer();
        $antelopeLocationCondition = new AntelopeLocationConditionTransfer();
        $antelopeLocationCondition->setAntelopeLocationsIds($antelopeLocationIds);
        $locationCriteria->setAntelopeLocationsConditions($antelopeLocationCondition);
        $antelopeLocationCollection = $this->antelopeFacade->getAntelopeLocationCollection($locationCriteria);
        foreach ($antelopeLocationCollection->getAntelopeLocations() as $location) {
            $locations[$location->getIdAntelopeLocation()] = $location;
        }

        return $locations;
    }
}
