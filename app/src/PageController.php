<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;

/**
 * @property string $ExpiryDate
 * @property string $StartDate
 * @property string $ExpiredUrl
 */
class PageController extends ContentController
{
    protected function init()
    {
        parent::init();

        Requirements::css('themes/default/bundles/main.css');
        Requirements::javascript('themes/default/bundles/app.js');
        Requirements::set_force_js_to_bottom(true);
    }
}
