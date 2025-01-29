<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\Antelope\Persistence;

use Codeception\Test\Unit;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group Antelope
 * @group Persistence
 * @group AntelopeRepositoryTest
 * Add your own group annotations below this line
 */
class AntelopeRepositoryTest extends Unit
{
    protected AntelopeRepository $repository;

    /**
     * @return void
     */
    public function testGetAntelopeLocationByIdThrowsExceptionWhenNotFound(): void
    {
        $nonExistentId = 99999;

        $this->expectException(EntityNotFoundException::class);
        $this->expectExceptionMessage(sprintf('Antelope Location %d not found', $nonExistentId));

        $this->repository->getAntelopeLocationById($nonExistentId);
    }

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->repository = new AntelopeRepository();
    }
}
