<?php
declare(strict_types=1);

namespace App\Creator\DisplayHelpers;


/**
 * Used to generate an li element.
 *
 * This element can have plenty of fun extras.  Like a cost, book logo, and add/remove button.
 */
class Li{
    private $html;
    private $id;            //Translates to html 'id ='
    private $class;         //Translates to html 'class ='
    private $cost;          //Translates to html 'data-cost ='
    private $cost_isDefault;//Translates to html 'data-cost_isDefault ='
    private $cost_units;    //Translates to html 'data-cost_units ='

    /**
     * Create an li element.
     *
     * @param string $id    - The li's id. (Also displays this to the user)
     * @param string $class - The li's class. (defaults to "")
     */
    function __construct(string $id, string $class = "")
    {
        $this->id = $id;
        $this->class = $class;

        $this->cost = "";
        $this->cost_isDefault = "";
        $this->cost_units = "";
    }

    /**
     * Tell the user how much the li costs.
     *
     * @param int    $cost      The item's cost. (if 0, nothing is displayed)
     * @param bool   $isDefault If the item is automatically given to the player. (if true, "(Granted)" is displayed; takes precidence over $isDefault)
     * @param string $units     What is being charged
     *
     * @example $item->addCost(1): Gives "(1 cp)"
     */
    function addCost(int $cost, bool $isDefault = False, string $units = "cp"){
        $this->cost = $cost;
        $this->cost_isDefault = $isDefault;
        $this->cost_units = $units;


        $costDisplay = "(".$cost." ".$units.")";
        if($cost == 0){
            $costDisplay = "";
        }
        if($isDefault){
            $costDisplay = "(Granted)";
        }
        $this->html .=  "<span class='costInfo'>".$costDisplay."</span>";
    }

    /**
     * Add a book icon to the li.
     *
     * @param string $id The id used to look up what icon to use.
     */
    function addBookIcon(string $id){
        $this->html .= Helpers::getListStampHtml($id);
    }

    /**
     * Add a plus or checked icon.
     *
     * WARNING:  The icon will have the same id as the main li. (To fix this other code must be changed...)
     *
     * @param string $iconClass The class of the icon itself. (Used by javascript for ajax calls.)
     * @param bool   $isChecked
     */
    function addPlusChecked(string $iconClass, bool $isChecked = False){
        $icon = Icon::$checked;
        if(!$isChecked){
            $icon = Icon::$plus;
        }
        $this->html .= Icon::getHtml('addOrSelectedIcon '.$iconClass,$this->id,$icon);
    }

    /**
     * Add a plus or minus icon.
     *
     * WARNING:  The icon will have the same id as the main li. (To fix this other code must be changed...)
     *
     * @param string $iconClass The class of the icon itself. (Used by javascript for ajax calls.)
     * @param bool   $isPlus    Display the plus icon, or the minus icon.
     */
    function addPlusMinus(string $iconClass, bool $isPlus = True){
        $icon = Icon::$plus;
        if(!$isPlus){
            $icon = Icon::$minus;
        }
        $this->html .= Icon::getHtml('addOrSelectedIcon '.$iconClass,$this->id,$icon);
    }

    /**
     * Add a plus or 'X' icon.
     *
     * WARNING:  The icon will have the same id as the main li. (To fix this other code must be changed...)
     *
     * @param string $iconClass The class of the icon itself. (Used by javascript for ajax calls.)
     * @param bool   $isPlus    Display the plus icon, or the 'X' icon.
     */
    function addPlusX(string $iconClass, bool $isPlus = True){
        $icon = Icon::$plus;
        if(!$isPlus){
            $icon = Icon::$X;
        }
        $this->html .= Icon::getHtml('addOrSelectedIcon '.$iconClass,$this->id,$icon);
    }

    /**
     * Add a checked icon, or blank space.
     *
     * WARNING:  The icon will have the same id as the main li. (To fix this other code must be changed...)
     *
     * @param string $iconClass The class of the icon itself. (Used by javascript for ajax calls.)
     * @param bool   $isChecked Display the checked icon, or a blank space.
     */
    function addCheckedBlank(string $iconClass, bool $isChecked = False){
        $icon = Icon::$checked;
        if(!$isChecked){
            $icon = '';
        }
        $this->html .= Icon::getHtml('addOrSelectedIcon '.$iconClass,$this->id,$icon);
    }

    /**
     * Get the final html of the li.
     * @return string The final HTML of the Li element
     */
    function getHtml(){
        $output  = "<li class='".$this->class."' id='".$this->id."' data-cost='".$this->cost."' data-cost_isDefault='".$this->cost_isDefault."' data-cost_units='".$this->cost_units."' >";
        $output .= $this->id;
        $output .= $this->html;
        $output .= "</li>";
        return  $output;
    }
}
