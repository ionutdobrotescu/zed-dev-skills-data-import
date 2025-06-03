<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep\AntelopeLocationWriterStep;
use Pyz\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

/**
 * @method \Pyz\Zed\AntelopeLocationDataImport\AntelopeLocationDataImportConfig getConfig()
 */
class AntelopeLocationDataImportBusinessFactory extends DataImportBusinessFactory
{
        /**
         * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
         *
         * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
         */
    public function createAntelopeLocationDataImport(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeLocationWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep\AntelopeLocationWriterStep
     */
    public function createAntelopeLocationWriterStep(): AntelopeLocationWriterStep
    {
        return new AntelopeLocationWriterStep();
    }
}
