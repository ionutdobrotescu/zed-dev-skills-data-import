<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopesBackendApi\Processor\Creator;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapperInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeCreator implements AntelopeCreatorInterface
{


    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        protected AntelopeMapperInterface $antelopeMapper
    ) {
    }

    public function createAntelope(
        AntelopesBackendApiAttributesTransfer $antelopesBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeTransfer = $this->antelopeMapper->mapAntelopesBackendApiAttributesToAntelopeTransfer(
            $antelopesBackendApiAttributesTransfer,
            new AntelopeTransfer());
        $antelopeTransfer = $this->antelopeFacade->createAntelope($antelopeTransfer);
        $antelopeCollectionTransfer = (new AntelopeCollectionTransfer())->addAntelope($antelopeTransfer);
        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollectionTransfer);
    }
}
