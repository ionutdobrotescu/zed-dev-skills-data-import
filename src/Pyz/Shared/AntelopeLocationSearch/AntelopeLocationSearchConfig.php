<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\AntelopeLocationSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class AntelopeLocationSearchConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Defines queue name as used for processing antelope publish messages.
     *
     * @api
     *
     * @var string
     */
    public const string ANTELOPE_LOCATION_PUBLISH_SEARCH_QUEUE = 'publish.search.antelope_location';

    /**
     * Specification:
     * - Defines queue name as used for processing antelope sync messages.
     *
     * @api
     *
     * @var string
     */
    public const string ANTELOPE_LOCATION_SYNC_SEARCH_QUEUE = 'sync.search.antelope_location';

    /**
     * Specification:
     * - Represents pyz_antelope entity creation event.
     *
     * @api
     *
     * @var string
     */
    public const string ENTITY_PYZ_ANTELOPE_LOCATION_CREATE = 'Entity.pyz_antelope_location.create';

    /**
     * Specification:
     * - Represents pyz_antelope entity change event.
     *
     * @api
     *
     * @var string
     */
    public const string ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE = 'Entity.pyz_antelope_location.update';

    /**
     * Specification:
     * - Represents pyz_antelope entity deletion event.
     *
     * @api
     *
     * @var string
     */
    public const string ENTITY_PYZ_ANTELOPE_LOCATION_DELETE = 'Entity.pyz_antelope_location.delete';

    /**
     * Specification:
     * - This event is used for antelope publishing.
     *
     * @api
     *
     * @var string
     */
    public const string ANTELOPE_LOCATION_PUBLISH = 'AntelopeLocationSearch.antelope_location.publish';

    /**
     * Specification:
     * - This event is used for antelope unpublishing.
     *
     * @api
     *
     * @var string
     */
    public const string ANTELOPE_LOCATION_UNPUBLISH = 'AntelopeLocationSearch.antelope_location.unpublish';

    public const int ANTELOPE_LOCATION_PUBLISH_BATCH_SIZE = 100;
}
