<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\AntelopeDataImport\Business\AntelopeDataImportFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig getConfig()
 */
class AntelopeLocationDataImportPlugin extends AbstractPlugin implements
    DataImportPluginInterface
{
    public function import(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterReportTransfer {
        return $this->getFacade()->importAntelopeLocation($dataImporterConfigurationTransfer);
    }

    public function getImportType(): string
    {
        return AntelopeDataImportConfig::IMPORT_TYPE_ANTELOPE_LOCATION;
    }
}
