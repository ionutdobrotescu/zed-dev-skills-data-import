<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeDataImport\Business\AntelopeDataImportBusinessFactory getFactory()
 */
class AntelopeDataImportFacade extends AbstractFacade implements
    AntelopeDataImportFacadeInterface
{
    public function importAntelope(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterReportTransfer {
        return $this->getFactory()
            ->createAntelopeDataImport($dataImporterConfigurationTransfer)
            ->import($dataImporterConfigurationTransfer);
    }

    public function importAntelopeLocation(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterReportTransfer {
        return $this->getFactory()
            ->createAntelopeLocationDataImport($dataImporterConfigurationTransfer)
            ->import($dataImporterConfigurationTransfer);
    }
}
