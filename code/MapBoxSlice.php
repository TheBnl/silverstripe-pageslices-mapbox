<?php
/**
 * UserFormSlice.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */


/**
 * UserFormSlice
 */
class MapBoxSlice extends PageSlice
{
    private static $db = array();
    private static $has_one = array();
    private static $slice_image = 'pageslices_mapbox/images/MapBoxSlice.png';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $addressFields = $fields->fieldByName('Root.Address')->Fields();
        $fields->removeByName('Address');
        $fields->addFieldsToTab('Root.Main', $addressFields);

        return $fields;
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