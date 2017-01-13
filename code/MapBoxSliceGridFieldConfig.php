<?php
/**
 * MapBoxSliceGridFieldConfig.php
 *
 * @author Bram de Leeuw
 * Date: 12/01/17
 */


/**
 * Class MapBoxSliceGridFieldConfig
 */
class MapBoxSliceGridFieldConfig extends GridFieldConfig
{

    /**
     * MapBoxSliceGridFieldConfig constructor.
     *
     * @param string $sortField
     */
    public function __construct($sortField = 'Sort')
    {
        parent::__construct();
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent(new GridFieldAddNewButton('toolbar-header-right'));
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new GridFieldDetailForm());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldOrderableRows($sortField));
    }
}