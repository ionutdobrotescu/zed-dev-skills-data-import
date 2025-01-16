<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepository $antelopeRepository
    ) {
    }


    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationById(
        int $idLocation
    ): AntelopeLocationTransfer {
        try {
            return $this->antelopeRepository->getAntelopeLocationById($idLocation);
        } catch (EntityNotFoundException $exception) {
            throw new EntityNotFoundException(
                sprintf('Antelope Location %d not found', $idLocation),
                $exception->getCode(),
                $exception
            );
        }
    }
}
