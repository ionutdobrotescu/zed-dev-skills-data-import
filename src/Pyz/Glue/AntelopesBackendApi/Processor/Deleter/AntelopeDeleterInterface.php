<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeDeleterInterface
{
    public function deleteAntelope(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer;
}
