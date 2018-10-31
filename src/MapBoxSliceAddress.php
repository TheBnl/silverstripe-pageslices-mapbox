<?php

namespace Broarm\PageSlices;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use Symbiote\Addressable\Addressable;
use Symbiote\Addressable\Geocodable;

/**
 * class MapBoxSliceAddress
 * @author Bram de Leeuw
 *
 * @mixin Addressable
 * @mixin Geocodable
 *
 * @method MapBoxSlice MapBoxSlice()
 * @property string Title
 * @property string Link
 * @property string Target
 * @property int Sort
 */
class MapBoxSliceAddress extends DataObject
{
    private static $table_name = 'MapBoxSliceAddress';

    private static $db = [
        'Title' => 'Varchar',
        'Link' => 'Varchar',
        'Target' => 'Enum("_self,_blank", "_self")',
        'Sort' => 'Int'
    ];

    private static $default_sort = 'Sort ASC';

    private static $has_one = [
        'MapBoxSlice' => MapBoxSlice::class
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'Address' => 'FullAddress'
    ];

    private static $translate = [
        'Title'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            TextField::create('Link'),
            DropdownField::create('Target', 'Open link in', $this->getTargetOptions())
        ]);
        $this->extend('updateCMSFields', $fields);

        if (($addressTab = $fields->fieldByName('Root.Address')) && $addressFields = $addressTab->Fields()) {
            $fields->removeByName('Address');
            $fields->addFieldsToTab('Root.Main', $addressFields);
        }

        $fields->removeByName(['Sort', 'MapBoxSliceID']);
        return $fields;
    }

    /**
     * Translate the option labels
     *
     * @return array
     */
    public function getTargetOptions()
    {
        return array_map(function ($option) {
            return _t(__CLASS__ . ".$option", $option);
        }, $this->dbObject('Target')->enumValues());
    }

    public function canView($member = null)
    {
        return $this->MapBoxSlice()->canView($member);
    }

    public function canEdit($member = null)
    {
        return $this->MapBoxSlice()->canEdit($member);
    }

    public function canDelete($member = null)
    {
        return $this->MapBoxSlice()->canDelete($member);
    }

    public function canCreate($member = null, $context = [])
    {
        return $this->MapBoxSlice()->canCreate($member, $context);
    }
}