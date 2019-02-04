<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\View\Requirements;

    class PageController extends ContentController
    {
        protected function init()
        {
            parent::init();

            Requirements::css('themes/default/css/main.css');
            Requirements::javascript('themes/default/javascript/bundle.js');

        }
    }
}
