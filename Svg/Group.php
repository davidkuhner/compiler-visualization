<?php

namespace Hoathis\Svg {
	
require_once __DIR__.'/Graphic.php';

/**
 * Class \Hoathis\Svg\Group.
 *
 * Concrete class that represents a composite element
 * for Composite pattern.
 *
 * @author     David Kühner <david.kuhner@he-arc.ch>
 * @copyright  Copyright © 2007-2013 David Kühner
 * @license    New BSD License
 */

class Group  extends \Hoathis\Svg\Graphic {
	
	/**
	 * List of elements in the group 
	 */
	private $elements;
	
	/**
     * Main constructor
     */
	function __construct() {
		$this->elements = array();
	}

    /**
     * Build an svg element.
     *
     * @access  public
     * @param   boolean		$isRoot     Is this element the svg root ?
     * @return  string
     */
     public function build ( boolean $isRoot=Null ) {
		$openerTag = '<g>';
		$closerTag = '</g>';
		
		$builder = $openerTag;
		foreach ( (array)$this->elements as $element ) {
				$builder .= $element->build();
			}
		$builder .= $closerTag;
		return $builder;
	 }
    
    /**
     * Add a child svg element.
     *
     * @access  public
     * @param   \Hoathis\Svg\Graphic	$element     The child element to add.
     * @return  string
     */
    public function add ( \Hoathis\Svg\Graphic $element ) {
		$this->elements[] = $element;
	}
	
}

}
