<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Mapper;

use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeMapperInterface
{
    public function mapAntelopesBackendApiAttributesToAntelopeTransfer(
        AntelopesBackendApiAttributesTransfer $antelopesBackendApiAttributesTransfer,
        AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;
}
