<?php
/**
 * MapBoxSlice.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

use Broarm\Silverstripe\PageSlices\PageSlice;
use Broarm\Silverstripe\PageSlices\PageSliceController;


/**
 * MapBoxSlice
 * @method HasManyList Addresses
 */
class MapBoxSlice extends PageSlice implements UseMapBox
{
    private static $db = array();
    private static $has_one = array();

    private static $has_many = array(
        'Addresses' => 'MapBoxSliceAddress'
    );

    private static $slice_image = 'pageslices_mapbox/images/MapBoxSlice.png';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        
        $gridFieldConfig = new MapBoxSliceGridFieldConfig();
        $gridField = new GridField('Addresses', 'Addresses', $this->Addresses(), $gridFieldConfig);

        $fields->addFieldsToTab('Root.Main', array($gridField));
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
        $markers = ArrayList::create(array());
        if ($addresses = $this->Addresses()) {
            foreach ($this->Addresses() as $address) {
                $markers->add(self::create_marker($address));
            }
        }

        $this->extend('updateMarkers', $markers);

        if ($markers->count() > 0) {
            return $markers->toNestedArray();
        } else {
            return null;
        }
    }

    /**
     * @param MapBoxSliceAddress $address
     * @return array
     */
    public static function create_marker(MapBoxSliceAddress $address) {
        return array(
            'ID' => $address->ID,
            'Title' => $address->Title,
            'Lat' => $address->Lat,
            'Lng' => $address->Lng,
        );
    }
}


class MapBoxSlice_Controller extends PageSliceController
{

    private static $allowed_actions = array();


    /**
     * Set up the requirements
     */
    public function init()
    {
        parent::init();
    }
}