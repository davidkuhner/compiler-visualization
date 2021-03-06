<?php

namespace {
	
from('Hoathis')
/**
 * \Hoathis\GraphicTools\Graphic
 */
->import('GraphicTools.Graphic');
}

namespace Hoathis\GraphicTools {

/**
 * Class \Hoathis\GraphicTools\TextNode.
 *
 * Concret class that represent the string in a svg text element.
 *
 * @author     David Kühner <david.kuhner@he-arc.ch>
 * @copyright  Copyright © 2007-2013 David Kühner
 * @license    New BSD License
 */
class TextNode extends \Hoathis\GraphicTools\Graphic {
	
	/**
	 * Text content
	 */
	private $text ;
	
	
	/**
	 * Main constructor
	 */
	function __construct( $text ) {
		parent::__construct();
		$this->text = $text;
	}

	/**
	 * Build an text string.
	 *
	 * @access  public
	 * @return  string
	 */
	public function build () {
		 return $this->text;
	}

	/**
	 * Get the textNode text value
	 * 
	 * @access  public
	 * @return string The value 
	 */
	public function getText() {
		 return $this->text;
	}

	/**
	 * Set the textNode text value
	 * 
	 * @access  public
	 * @return string The value 
	 */
	public function setText( $text ) {
		 $this->text = $text;
	 }
}}
