<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class AntelopeSearchConfig extends AbstractBundleConfig
{
    public function getAntelopeSynchronizationQueuePoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
