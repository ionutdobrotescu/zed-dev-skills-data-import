<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business\Antelope\DataSet;

interface AntelopeDataSetInterface
{
    /**
     * @var string
     */
    public const string COLUMN_NAME = 'name';

    /**
     * @var string
     */
    public const string COLUMN_COLOR = 'color';

    public const string COLUMN_ID_LOCATION = 'idLocation';
}
