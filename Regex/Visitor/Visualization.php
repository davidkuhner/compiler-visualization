<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2013, Ivan Enderlin. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace {

from('Hoa')
/**
 * \Hoa\Visitor\Visit
 */
-> import('Visitor.Visit');

from('Hoathis')
/**
 * \Hoathis\GraphicTools\*
 */
->import('GraphicTools.*');
}

namespace Hoathis\Regex\Visitor {

/**
 * Class \Hoathis\Regex\Visitor\Visualization.
 *
 * Compile AST of a PCRE to SVG.
 *
 * @author     David Kühner <david.kuhner@he-arc.ch>
 * @copyright  Copyright © 2007-2013 David Kühner
 * @license    New BSD License
 */
class Visualization implements \Hoa\Visitor\Visit {

	/**
	 * Visit an element.
	 *
	 * @access  public
	 * @param   \Hoa\Visitor\Element  $element    Element to visit.
	 * @param   mixed                 &$handle    Handle (reference).
	 * @param   mixed                 $eldnah     Handle (not reference).
	 * @return  mixed
	 */
	public function visit ( \Hoa\Visitor\Element $element,
							&$handle = null, $eldnah = null ) {
		$graphic = null;
		$id = str_replace( '#', '' , $element->getId() );
		$graphicCreator = \Hoathis\GraphicTools\SvgCreator::getInstance();

		switch($id) {
			case 'expression':
				$graphic = $graphicCreator->createExpression();
				break;
			case 'quantification':
				$graphic = $graphicCreator->createQuantification();
				break;
			case 'alternation':
				$graphic = $graphicCreator->createAlternation();
				break;
			case 'concatenation':
				$graphic = $graphicCreator->createConcatenation();
				break;
			case 'class':
				$graphic = $graphicCreator->createClass();
				break;
			case 'negativeclass':
				$graphic = $graphicCreator->createNegativeClass();
				break;
			case 'range':
				$graphic = $graphicCreator->createRange();
				break;
			case 'token':
				$value = $element->getValue();
				$graphic = $graphicCreator->createToken($value['token'], $value['value']);
				break;
			case 'lookahead':
				$graphic = $graphicCreator->createLookahead();
				break;
			case 'negativelookahead':
				$graphic = $graphicCreator->createNegativeLookahead();
				break;
			case 'lookbehind':
				$graphic = $graphicCreator->createLookbehind();
				break;
			case 'negativelookbehind':
				$graphic = $graphicCreator->createNegativeLookbehind();
				break;
			case 'absolutecondition':
				// Still under construction
				throw new \Exception( ' \Hoathis\Regex\Visitor\Visualization exception : Unhandled element "#' . $id . '" ' );
				//$graphic = $graphicCreator->createAbsoluteCondition();
				break;
			default:
				throw new \Exception( ' \Hoathis\Regex\Visitor\Visualization exception : Unhandled element "#' . $id . '" ' );
		}
		$graphic->setAttribute( "class", $id );

		foreach($element->getChildren() as $child) {
			$childGraphic = $child->accept($this, $handle, $eldnah);
			$graphic->addChild($childGraphic);
		}

		if ($id == 'expression') {
			return $graphic->build();
		} else {
			return $graphic;
		}
	}
}}
