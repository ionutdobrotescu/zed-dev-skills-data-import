<?php

namespace Pyz\Zed\AntelopeLocationSearch;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeLocationSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    public const PROPEL_QUERY_ANTELOPE_LOCATION = 'PROPEL_QUERY_ANTELOPE_LOCATION';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addEventBehaviorFacade($container);

        return $container;
    }

    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addAntelopeLocationPropelQuery($container);

        return $container;
    }

    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container->set(static::FACADE_EVENT_BEHAVIOR, function (Container $container) {
            return $container->getLocator()->eventBehavior()->facade();
        });

        return $container;
    }

    protected function addAntelopeLocationPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_ANTELOPE_LOCATION, $container->factory(function () {
            return PyzAntelopeLocationQuery::create();
        }));

        return $container;
    }
}