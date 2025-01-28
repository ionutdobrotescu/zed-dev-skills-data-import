<?php

namespace Pyz\Zed\AntelopeSearch\Business;

use Generated\Shared\Transfer\EventEntityTransfer;

interface AntelopeSearchFacadeInterface
{
    /**
     * Specification:
     * - Retrieves all antelopes using IDs from $eventTransfers.
     * - Updates entities from `pyz_antelope_search` with actual data from obtained antelopes.
     * - Sends a copy of data to queue based on module config.
     *
     * @param array<EventEntityTransfer> $eventTransfers
     *
     * @return void
     * @api
     *
     */
    public function writeCollectionByAntelopeEvents(array $eventTransfers): void;
}
