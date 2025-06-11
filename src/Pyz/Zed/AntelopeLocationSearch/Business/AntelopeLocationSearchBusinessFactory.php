<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

use Pyz\Zed\AntelopeLocationSearch\AntelopeLocationSearchDependencyProvider;
use Pyz\Zed\AntelopeLocationSearch\Business\Writer\AntelopeLocationSearchWriter;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchEntityManagerInterface;
use Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchRepositoryInterface;

/**
 * @method AntelopeLocationSearchEntityManagerInterface getEntityManager()
 * @method AntelopeLocationSearchRepositoryInterface getRepository()
 */
class AntelopeLocationSearchBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeLocationSearchWriter()
    {
        return new AntelopeLocationSearchWriter(
            $this->getEventBehaviorFacade(),
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    public function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}