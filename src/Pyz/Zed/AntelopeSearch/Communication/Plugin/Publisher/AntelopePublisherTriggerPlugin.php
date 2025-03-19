<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeSearch\Communication\Plugin\Publisher;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Pyz\Shared\AntelopeSearch\AntelopeSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherTriggerPluginInterface;

/**
 * @method \Pyz\Zed\AntelopeSearch\Business\AntelopeSearchFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeSearch\Communication\Plugin\Publisher\AntelopeSearchCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeSearch\AntelopeSearchConfig getConfig()
 */
class AntelopePublisherTriggerPlugin extends AbstractPlugin implements PublisherTriggerPluginInterface
{
    public function getData(int $offset, int $limit): array
    {
        $facade = $this->getFactory()->getAntelopeFacade();
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopeCriteriaTransfer->setIdsAntelope(null);
        $paginationTransfer = new PaginationTransfer();
        $paginationTransfer->setOffset($offset);
        $paginationTransfer->setLimit($limit);
        $antelopeCriteriaTransfer->setPagination($paginationTransfer);
        $antelopes = $facade->getAntelopeCollection($antelopeCriteriaTransfer)
            ->getAntelopes()->getArrayCopy();

        return $antelopes;
    }

    public function getResourceName(): string
    {
        return AntelopeSearchConfig::ANTELOPE_RESOURCE_NAME;
    }

    public function getEventName(): string
    {
        return AntelopeSearchConfig::ANTELOPE_PUBLISH;
    }

    public function getIdColumnName(): ?string
    {
        return PyzAntelopeTableMap::COL_ID_ANTELOPE;
    }
}
