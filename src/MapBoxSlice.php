<?php

namespace Broarm\PageSlices;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\ORM\HasManyList;
use XD\MapBox\UseMapBox;

/**
 * Class MapBoxSlice
 * @package Broarm\PageSlices
 * @author Bram de Leeuw
 *
 * @method HasManyList Addresses
 */
class MapBoxSlice extends PageSlice implements UseMapBox
{
    private static $table_name = 'MapBoxSlice';

    private static $has_many = [
        'Addresses' => MapBoxSliceAddress::class
    ];

    private static $slice_image = 'bramdeleeuw/silverstripe-pageslices-mapbox:client/images/MapBoxSlice.png';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $gridFieldConfig = new GridFieldConfig_RecordEditor();
        $fields->addFieldsToTab('Root.Main', [
            GridField::create('Addresses', 'Addresses', $this->Addresses(), $gridFieldConfig)
        ]);

        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    /**
     * Return a array of markers
     *
     * @return array
     */
    public function mapBoxMarkers()
    {
        $markers = $this->Addresses();
        $this->extend('updateMarkers', $markers);

        if ($markers->count() > 0) {
            return $markers->toNestedArray();
        } else {
            return null;
        }
    }
}
