<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\AntelopePage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AntelopePageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public const string ROUTE_NAME_ANTELOPE_NAME = '/antelope/_name_';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $this->addAntelopeAntelopeGetRoute($routeCollection);
        $this->addGetAntelopesRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @return void
     */
    private function addAntelopeAntelopeGetRoute(
        RouteCollection $routeCollection,
    ): void {
        $this->addGetAntelopeRoute($routeCollection);
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return void
     */
    public function addGetAntelopeRoute(RouteCollection $routeCollection): void
    {
        $route = $this->buildRoute(
            '/antelope/{name}',
            'AntelopePage',
            'Antelope',
            'getAction',
        );
        $route = $route->setMethods(['GET']);
        $routeCollection->add(
            static::ROUTE_NAME_ANTELOPE_NAME,
            $route,
        );
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return void
     */
    public function addGetAntelopesRoute(RouteCollection $routeCollection): void
    {
        $route = $this->buildRoute(
            '/antelopes',
            'AntelopePage',
            'Antelope',
        );
        $route = $route->setMethods(['GET']);
        $routeCollection->add(
            static::ROUTE_NAME_ANTELOPE_NAME,
            $route,
        );
    }
}
