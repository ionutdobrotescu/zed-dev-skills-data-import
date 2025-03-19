<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeSearch\Persistence;

use Generated\Shared\Transfer\AntelopeSearchCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchTransfer;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Propel\Runtime\Formatter\ObjectFormatter;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeSearch\Persistence\AntelopeSearchPersistenceFactory getFactory()
 */
class AntelopeSearchRepository extends AbstractRepository implements AntelopeSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeSearchCriteriaTransfer $antelopeSearchCriteriaTransfer
     *
     * @return array<\Generated\Shared\Transfer\AntelopeSearchTransfer>
     */
    public function getAntelopeSearches(AntelopeSearchCriteriaTransfer $antelopeSearchCriteriaTransfer): array
    {
        $antelopeSearchEntities = $this->getFactory()
            ->createAntelopeSearchQuery()
            ->filterByfkAntelope_In($antelopeSearchCriteriaTransfer->getFksAntelope())
            ->find();

        $antelopeSearchTransfers = [];

        foreach ($antelopeSearchEntities as $antelopeSearchEntity) {
            $antelopeSearchTransfers[] = $this->getFactory()
                ->createAntelopeSearchMapper()
                ->mapAntelopeSearchEntityToAntelopeSearchTransfer($antelopeSearchEntity, new AntelopeSearchTransfer());
        }

        return $antelopeSearchTransfers;
    }

    public function getAntelopeSearchSynchronizationDataTransfersByIds(
        FilterTransfer $filterTransfer,
        array $antelopeSearchesIds = [],
    ): array {
        $antelopeSearchEntities = $this->getSearchEntities($antelopeSearchesIds, $filterTransfer);
        $synchronizationDataTransfers = [];
        /**
         * @var \Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeSearch $antelopeSearchEntity
         */
        foreach ($antelopeSearchEntities as $antelopeSearchEntity) {
            $synchronizationDataTransfers[] = (new SynchronizationDataTransfer())
                ->setData($antelopeSearchEntity->getData())
                ->setKey($antelopeSearchEntity->getKey());
        }

        return $synchronizationDataTransfers;
    }

    /**
     * @param array $antelopeSearchesIds
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     *
     * @return \Propel\Runtime\Collection\Collection|mixed
     */
    public function getSearchEntities(array $antelopeSearchesIds, FilterTransfer $filterTransfer): mixed
    {
        $antelopeSearchQuery = $this->getFactory()->createAntelopeSearchQuery();
        if ($antelopeSearchesIds) {
            $antelopeSearchQuery->filterByIdAntelopeSearch_In($antelopeSearchesIds);
        }

        return $this->buildQueryFromCriteria($antelopeSearchQuery, $filterTransfer)->setFormatter(
            ObjectFormatter::class,
        )->find();
    }
}
