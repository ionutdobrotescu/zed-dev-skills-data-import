<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\Business\DataImportStep\AntelopeWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class AntelopeDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function createAntelopeDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
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
}
