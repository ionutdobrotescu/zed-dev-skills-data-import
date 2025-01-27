<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport;

use Spryker\Zed\DataImport\DataImportConfig;

class AntelopeDataImportConfig extends DataImportConfig
{
    public const string IMPORT_TYPE_ANTELOPE = 'antelope';

    public const string IMPORT_TYPE_ANTELOPE_LOCATION = 'antelope-location';
}
