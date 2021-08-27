<?php

use App\Models\CounterItem;
use App\Models\HeaderCardItem;
use CyberDuck\SEO\Model\Extension\SeoPageExtension;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CheckboxField;
use TheWebmen\Menustructure\Model\Menu;

/**
 * @method Image HeaderVisualImage()
 * @method Image HeaderImage()
 * @method Menu CustomMenu()
 * @mixin SeoPageExtension
 */
class Page extends SiteTree
{
    private static $db = [
        'HeaderTitlePriority' => 'Boolean',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Metadata');

        $fields->addFieldsToTab('Root.Main', [
            CheckboxField::create('HeaderTitlePriority', 'Title is H1 of the page'),
        ], 'URLSegment');

        return $fields;
    }
}
