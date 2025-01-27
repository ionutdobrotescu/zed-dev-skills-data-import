<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\Business\Antelope\DataImportStep\AntelopeWriterStep;
use Pyz\Zed\AntelopeDataImport\Business\AntelopeLocation\DataImportStep\AntelopeLocationWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

/**
 * @method \Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig getConfig()
 */
class AntelopeDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function createAntelopeDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterInterface {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    public function createAntelopeWriterStep(): AntelopeWriterStep
    {
        return new AntelopeWriterStep();
    }

    public function createAntelopeLocationDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer,
    ): DataImporterInterface {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeLocationWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    private function createAntelopeLocationWriterStep(): AntelopeLocationWriterStep
    {
        return new AntelopeLocationWriterStep();
    }
}
