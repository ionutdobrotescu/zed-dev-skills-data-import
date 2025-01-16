<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * @method AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     * @throws AmbiguousComparisonException
     */
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeTransfer {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByName(
            $antelopeCriteriaTransfer->getName(),
        )->findOne();
        if ($antelopeEntity === null) {
            throw new EntityNotFoundException(sprintf('Antelope %s not found', $antelopeCriteriaTransfer->getName()));
        }
        return (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(),
            true);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationById(int $idLocation
    ): AntelopeLocationTransfer {
        $antelopeLocationEntity = $this->getFactory()
            ->createAntelopeLocationQuery()->findPk($idLocation);

        if ($antelopeLocationEntity === null) {
            throw new EntityNotFoundException(sprintf('Antelope Location %d not found', $idLocation));
        }
        return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(),
            true);
    }
}
