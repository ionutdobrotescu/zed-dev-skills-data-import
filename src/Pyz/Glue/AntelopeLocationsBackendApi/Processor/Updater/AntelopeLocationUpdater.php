<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationMapperInterface $antelopeLocationMapper,
    ) {
    }

    public function updateAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeTransfer = $this->antelopeLocationMapper->mapAntelopeLocationsBackendApiAttributesToAntelopeLocationTransfer(
            $antelopeLocationsBackendApiAttributesTransfer,
            new AntelopeLocationTransfer(),
        );
        $antelopeTransfer = $this->antelopeFacade->updateAntelope($antelopeTransfer);
        $antelopeCollectionTransfer = (new AntelopeCollectionTransfer())->addAntelope($antelopeTransfer);

        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollectionTransfer);
    }
}
