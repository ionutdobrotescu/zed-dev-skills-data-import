<?php

namespace Pyz\Zed\Antelope\Business\Antelope\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $antelopeRepository
    ) {
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer {
        $antelopeTransfer = $this->antelopeRepository->getAntelope($antelopeCriteriaTransfer);
        $antelopeResponseTransfer = new AntelopeResponseTransfer();
        $antelopeResponseTransfer->setIsSuccessFul(false);
        $antelopeResponseTransfer->setAntelope($antelopeTransfer);
        $antelopeResponseTransfer->setIsSuccessFul(true);
        return $antelopeResponseTransfer;
    }
}
