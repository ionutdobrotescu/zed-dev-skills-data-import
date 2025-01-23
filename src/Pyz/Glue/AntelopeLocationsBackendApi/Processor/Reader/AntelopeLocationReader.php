<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        private readonly AntelopeLocationExpanderInterface $antelopeLocationExpander,
    ) {
    }

    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        //dd($glueRequestTransfer->getResource());
        $conditions->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $antelopeLocationCriteriaTransfer->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function getAntelopeLocationCollectionTransfer(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCollectionTransfer = $this->antelopeFacade
            ->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationCollectionTransfer,
        );
    }

    public function getAntelopeLocationCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $this->antelopeLocationExpander->expandWithFilters(
            $conditions,
            $glueRequestTransfer,
        );
        $antelopeLocationCriteriaTransfer->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }
}
