<?php
/**
 * MapBoxSlice.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */


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
        return $fields;
    }

    /**
     * Return a array of markers
     *
     * @return array
     */
    public function mapBoxMarkers()
    {
        if ($addresses = $this->Addresses()) {
            $markers = array();
            foreach ($this->Addresses() as $address) {
                $markers[] = self::create_marker($address);
            }
            return $markers;
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