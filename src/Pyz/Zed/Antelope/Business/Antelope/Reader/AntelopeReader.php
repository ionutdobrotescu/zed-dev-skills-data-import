<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Antelope\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Business\AntelopeBusinessFactory;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

/**
 * @method  AntelopeBusinessFactory getFactory()
 */
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
        $antelopeResponseTransfer->setAntelope($antelopeTransfer);
        $antelopeResponseTransfer->setIsSuccessFul(true);
        return $antelopeResponseTransfer;
    }
}
