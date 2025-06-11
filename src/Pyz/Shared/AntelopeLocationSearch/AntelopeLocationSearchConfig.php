<?php

namespace Pyz\Shared\AntelopeLocationSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class AntelopeLocationSearchConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Defines queue name as used for processing antelope location publish messages.
     *
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_PUBLISH_SEARCH_QUEUE = 'publish.search.antelope_location';

    /**
     * Specification:
     * - Defines queue name as used for processing antelope location sync messages.
     *
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_SYNC_SEARCH_QUEUE = 'sync.search.antelope_location';

    /**
     * Specification:
     * - Represents pyz_antelope_location entity creation event.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_CREATE = 'Entity.pyz_antelope_location.create';

    /**
     * Specification:
     * - Represents pyz_antelope_location entity change event.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE = 'Entity.pyz_antelope_location.update';

    /**
     * Specification:
     * - Represents pyz_antelope_location entity deletion event.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_ANTELOPE_LOCATION_DELETE = 'Entity.pyz_antelope_location.delete';

    /**
     * Specification:
     * - This event is used for antelope location publishing.
     *
     * @api
     *
     * @var string
     */
    public const ANTELOPE_LOCATION_PUBLISH = 'AntelopeLocationSearch.antelope_location.publish';

    /**
     * Specification:
     * - This event is used for antelope location unpublishing.
     *
     * @api
     */
    public const ANTELOPE_LOCATION_UNPUBLISH = 'AntelopeLocationSearch.antelope_location.unpublish';
}