<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method AntelopeDataImportBusinessFactory getFactory()
 */
class AntelopeDataImportFacade extends AbstractFacade implements
    AntelopeDataImportFacadeInterface
{
    public function importAntelope(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterReportTransfer {
        return $this->getFactory()
            ->createAntelopeDataImport($dataImporterConfigurationTransfer)
            ->import($dataImporterConfigurationTransfer);
    }
}
