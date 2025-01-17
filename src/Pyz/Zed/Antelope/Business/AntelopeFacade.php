<?php

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method  AntelopeBusinessFactory getFactory()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->getFactory()->createAntelopeWriter()->createAntelope($antelopeTransfer);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationById(
        int $idLocation
    ): ?AntelopeLocationTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationById($idLocation);
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer {
        return $this->getFactory()->createAntelopeReader()->getAntelope($antelopeCriteriaTransfer);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($antelopeLocationTransfer);
    }
}
