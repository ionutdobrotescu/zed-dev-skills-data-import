<?php

namespace Pyz\Zed\AntelopeLocationSearch\Shared;

class AntelopeLocationSearchConfig
{
    public const string QUEUE_NAME = 'antelope_location_search_queue';

    public const string PUBLISH_EVENT = 'publish.antelope_location';

    public const string SYNC_EVENT = 'sync.antelope_location';
}
