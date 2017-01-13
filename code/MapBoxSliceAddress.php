<?php
/**
 * MapBoxSliceAddress.php
 *
 * @author Bram de Leeuw
 * Date: 12/01/17
 */
 
 
/**
 * MapBoxSliceAddress
 *
 * @method MapBoxSlice MapBoxSlice
 *
 * @property string Title
 * @property string Address Inherited from the Addressable extension
 * @property string Suburb Inherited from the Addressable extension
 * @property string State Inherited from the Addressable extension
 * @property string Postcode Inherited from the Addressable extension
 * @property string Country Inherited from the Addressable extension
 * @property float Lat Inherited from the Geocodable extension
 * @property float Lng Inherited from the Geocodable extension
 */
class MapBoxSliceAddress extends DataObject {

    private static $db = array(
        'Title' => 'Varchar(255)',
        'Sort' => 'Int'
    );
    
    private static $default_sort = 'Sort ASC';

    private static $has_one = array(
        'MapBoxSlice' => 'MapBoxSlice'
    );

    private static $summary_fields = array(
        'Title' => 'Title',
        'Address' => 'getFullAddress'
    );

    private static $translate = array(
        'Title'
    );

    public function getCMSFields() {
        $fields = new FieldList(new TabSet('Root', $mainTab = new Tab('Main')));

        $titleField = TextField::create('Title', 'Title');
        $fields->addFieldsToTab('Root.Main', array($titleField));

        $this->extend('updateCMSFields', $fields);

        $addressFields = $fields->fieldByName('Root.Address')->Fields();
        $fields->removeByName('Address');
        $fields->addFieldsToTab('Root.Main', $addressFields);

        return $fields;
    }

    public function canView($member = null) {
        return $this->MapBoxSlice()->canView($member);
    }

    public function canEdit($member = null) {
        return $this->MapBoxSlice()->canEdit($member);
    }

    public function canDelete($member = null) {
        return $this->MapBoxSlice()->canDelete($member);
    }

    public function canCreate($member = null) {
        return $this->MapBoxSlice()->canCreate($member);
    }
}