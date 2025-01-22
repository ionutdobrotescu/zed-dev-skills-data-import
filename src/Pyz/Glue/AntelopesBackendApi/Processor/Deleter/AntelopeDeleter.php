<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapperInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeDeleter implements AntelopeDeleterInterface
{

    /**
     * @param AntelopeFacadeInterface $getAntelopeFacade
     * @param AntelopeResponseBuilderInterface $createAntelopeResponseBuilder
     * @param AntelopeMapperInterface $createAntelopeMapper
     */
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        protected readonly AntelopeMapperInterface $antelopeMapper
    ) {
    }

    public function deleteAntelope(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeTransfer = (new AntelopeTransfer())->setIdAntelope((int)$glueRequestTransfer->getResource()?->getId());
        $this->antelopeFacade->deleteAntelope($antelopeTransfer);
        return $this->antelopeResponseBuilder->createAntelopeResponse(new AntelopeCollectionTransfer());
    }
}
