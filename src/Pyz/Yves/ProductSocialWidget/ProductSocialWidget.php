<?php

namespace Pyz\Yves\ProductSocialWidget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

class ProductSocialWidget extends AbstractWidget
{
    public static function getName(): string
    {
        return 'ProductSocialWidget';
    }

    public static function getTemplate(): string
    {
        return '@ProductSocialWidget/views/product-social-widget/product-social-widget.twig';
    }
}
