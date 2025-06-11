<?php

namespace Pyz\Zed\AntelopeSearch\Business\Writer;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchTransfer;
// use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
// use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeSearchQuery;
use Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchEntityManagerInterface;
use Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchRepositoryInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeSearchWriter
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    /**
     * @var \Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchRepositoryInterface
     */
    protected $antelopeSearchRepository;

    /**
     * @var \Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchEntityManagerInterface
     */
    protected $antelopeSearchEntityManager;

    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchRepositoryInterface $antelopeSearchRepository
     * @param \Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchEntityManagerInterface $antelopeSearchEntityManager
     */
    public function __construct(
        EventBehaviorFacadeInterface $eventBehaviorFacade,
        AntelopeSearchRepositoryInterface $antelopeSearchRepository,
        AntelopeSearchEntityManagerInterface $antelopeSearchEntityManager
    ) {
        $this->eventBehaviorFacade = $eventBehaviorFacade;
        $this->antelopeSearchRepository = $antelopeSearchRepository;
        $this->antelopeSearchEntityManager = $antelopeSearchEntityManager;
    }

    public function writeCollectionByAntelopeEvents(array $eventTransfers): void
    {
        $antelopeIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);

        $this->writeCollectionByAntelopeIds($antelopeIds);
    }

    protected function writeCollectionByAntelopeIds(array $antelopeIds): void
    {
        if (!$antelopeIds) {
            return;
        }

        // Note: The following code should not be part of the Business Layer because it contains persistence logic.
        // For training purposes we keep this block here to focus on the publish&synchronize process.
        // In an optional exercise you will have the task to move the persistence logic properly into the Persistence Layer.

        // foreach ($antelopeIds as $antelopeId) {
        //     $antelopeEntity = PyzAntelopeQuery::create()
        //         ->filterByIdAntelope($antelopeId)
        //         ->findOne();

        //     $searchEntity = PyzAntelopeSearchQuery::create()
        //         ->filterByFkAntelope($antelopeId)
        //         ->findOneOrCreate();
        //     $searchEntity->setFkAntelope($antelopeId);

        //     $searchData = $antelopeEntity->toArray();
        //     $searchEntity->setData($searchData);

        //     $searchEntity->save();
        // }
        $antelopeTransfersIndexed = $this->getAntelopeTransfersIndexed($antelopeIds);
        $antelopeSearchTransfersIndexed = $this->getAntelopeSearchTransfersIndexed(array_keys($antelopeTransfersIndexed));

        foreach ($antelopeTransfersIndexed as $antelopeId => $antelopeTransfer) {
            $searchData = $antelopeTransfer->toArray();

            $antelopeSearchTransfer = $antelopeSearchTransfersIndexed[$antelopeId] ?? new AntelopeSearchTransfer();

            $antelopeSearchTransfer
                ->setFkAntelope($antelopeId)
                ->setData($searchData);

            if ($antelopeSearchTransfer->getIdAntelopeSearch() === null) {
                $this->antelopeSearchEntityManager->createAntelopeSearch($antelopeSearchTransfer);

                continue;
            }

            $this->antelopeSearchEntityManager->updateAntelopeSearch($antelopeSearchTransfer);
        }
    }

        /**
     * @param int[] $antelopeIds
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer[]
     */
    protected function getAntelopeTransfersIndexed(array $antelopeIds): array
    {
        $antelopeCriteriaTransfer = (new AntelopeCriteriaTransfer())
            ->setIdsAntelope($antelopeIds);

        $antelopeTransfers = $this->antelopeSearchRepository
            ->getAntelopes($antelopeCriteriaTransfer);

        $antelopeTransfersIndexed = [];
        foreach ($antelopeTransfers as $antelopeTransfer) {
            $antelopeTransfersIndexed[$antelopeTransfer->getIdAntelope()] = $antelopeTransfer;
        }

        return $antelopeTransfersIndexed;
    }

    /**
     * @param int[] $antelopeIds
     *
     * @return \Generated\Shared\Transfer\AntelopeSearchTransfer[]
     */
    protected function getAntelopeSearchTransfersIndexed(array $antelopeIds): array
    {
        $antelopeSearchCriteriaTransfer = (new AntelopeSearchCriteriaTransfer())
            ->setFksAntelope($antelopeIds);

        $antelopeSearchTransfers = $this->antelopeSearchRepository
            ->getAntelopeSearches($antelopeSearchCriteriaTransfer);

        $antelopeSearchTransfersIndexed = [];
        foreach ($antelopeSearchTransfers as $antelopeSearchTransfer) {
            $antelopeSearchTransfersIndexed[$antelopeSearchTransfer->getFkAntelope()] = $antelopeSearchTransfer;
        }

        return $antelopeSearchTransfersIndexed;
    }
}