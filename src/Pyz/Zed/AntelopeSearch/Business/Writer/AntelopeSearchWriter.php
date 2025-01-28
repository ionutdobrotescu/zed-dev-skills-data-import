<?php

namespace Pyz\Zed\AntelopeSearch\Business\Writer;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Shared\AntelopeSearch\AntelopeSearchConfig;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchEntityManagerInterface;
use Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchRepositoryInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeSearchWriter
{
    public function __construct(
        protected EventBehaviorFacadeInterface $eventBehaviorFacade,
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeSearchRepositoryInterface $antelopeSearchRepository,
        protected AntelopeSearchEntityManagerInterface $antelopeSearchEntityManager,
    ) {
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

        $batchSize = AntelopeSearchConfig::ANTELOPE_PUBLISH_BATCH_SIZE;
        $batches = array_chunk($antelopeIds, $batchSize);
        foreach ($batches as $batch) {
            $antelopeTransfersIndexed = $this->getAntelopeTransfersIndexed($batch);
            $antelopeSearchTransfersIndexed = $this->getAntelopeSearchTransfersIndexed(
                array_keys($antelopeTransfersIndexed)
            );

            foreach ($antelopeTransfersIndexed as $antelopeId => $antelopeTransfer) {
                $this->processAntelopeTransfer(
                    $antelopeId,
                    $antelopeTransfer,
                    $antelopeSearchTransfersIndexed[$antelopeId] ?? null
                );
            }
        }
    }

    protected function getAntelopeTransfersIndexed(array $antelopeIds): array
    {
        $antelopeCriteriaTransfer = (new AntelopeCriteriaTransfer())->setIdsAntelope($antelopeIds);
        $antelopeTransfers = $this->antelopeFacade->getAntelopeCollection($antelopeCriteriaTransfer);

        return $this->indexTransfers($antelopeTransfers->getAntelopes(), 'getIdAntelope');
    }

    protected function indexTransfers(iterable $transfers, string $keyGetter): array
    {
        $indexedTransfers = [];
        foreach ($transfers as $transfer) {
            $key = $transfer->{$keyGetter}();
            $indexedTransfers[$key] = $transfer;
        }
        return $indexedTransfers;
    }

    protected function getAntelopeSearchTransfersIndexed(array $antelopeIds): array
    {
        $antelopeSearchCriteriaTransfer = (new AntelopeSearchCriteriaTransfer())->setFksAntelope($antelopeIds);
        $antelopeSearchTransfers = $this->antelopeSearchRepository->getAntelopeSearches(
            $antelopeSearchCriteriaTransfer
        );

        return $this->indexTransfers($antelopeSearchTransfers, 'getFkAntelope');
    }

    protected function processAntelopeTransfer(
        int $antelopeId,
        AntelopeTransfer $antelopeTransfer,
        ?AntelopeSearchTransfer $antelopeSearchTransfer = null
    ): void {
        $searchData = $antelopeTransfer->toArray();

        $antelopeSearchTransfer = $antelopeSearchTransfer ?? new AntelopeSearchTransfer();
        $antelopeSearchTransfer
            ->setFkAntelope($antelopeId)
            ->setData($searchData);

        if ($antelopeSearchTransfer->getIdAntelopeSearch() === null) {
            $this->antelopeSearchEntityManager->createAntelopeSearch($antelopeSearchTransfer);
        } else {
            $this->antelopeSearchEntityManager->updateAntelopeSearch($antelopeSearchTransfer);
        }
    }
}
