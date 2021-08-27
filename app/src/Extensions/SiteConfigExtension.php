<?php

namespace App\Extensions;

use App\Widgets\CtaWidget;
use App\Widgets\UspBarWidget;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'CustomHeadCode' => 'Text',
        'CustomBodyCode' => 'Text',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('Tagline');

        $fields->addFieldsToTab('Root.CustomCode', [
            TextareaField::create('CustomHeadCode'),
            TextareaField::create('CustomBodyCode'),
        ]);
    }
}
