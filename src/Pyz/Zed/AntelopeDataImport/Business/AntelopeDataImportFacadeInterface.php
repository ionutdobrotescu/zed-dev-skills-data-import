<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

interface AntelopeDataImportFacadeInterface
{
    public function importAntelope(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterReportTransfer;
}
