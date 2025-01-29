<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationSearch\Communication\Plugin\Publisher;

use Pyz\Shared\AntelopeLocationSearch\AntelopeLocationSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Business\AntelopeLocationSearchFacadeInterface getFacade()
 */
class AntelopeLocationWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Pyz\Zed\AntelopeLocationSearch\Communication\Plugin\Publisher\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()->writeCollectionByAntelopeEvents($eventEntityTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            AntelopeLocationSearchConfig::ANTELOPE_LOCATION_PUBLISH,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_CREATE,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE,
        ];
    }
}
