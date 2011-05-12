<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Christian Opitz <co@netzelf.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'Symlink Content Element' for the 'symce' extension.
 *
 * @author	Christian Opitz <co@netzelf.de>
 * @package	TYPO3
 * @subpackage	tx_symce
 */
class tx_symce_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_symce_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_symce_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'symce';	// The extension key.
	var $pi_checkCHash = false;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		
		$recConfig = array(
			'source' => $this->cObj->data['records'],
			'tables' => 'tt_content'
		);
		
		if (!$conf['conf'] && !$conf['conf.'] && (!$conf['keepHeaders'] || !$conf['keepStdWrap'])) {
			$recConfig['conf.'] = array(
				'tt_content' => $GLOBALS['TSFE']->tmpl->setup['tt_content'],
				'tt_content.' => $GLOBALS['TSFE']->tmpl->setup['tt_content.']
			);
			if (!$conf['keepHeaders']) {
				foreach ($recConfig['conf.']['tt_content.'] as $key => $item) {
					if (key != 'setup') {
						$recConfig['conf.']['tt_content.'][$key]['10'] = null;
						$recConfig['conf.']['tt_content.'][$key]['10.'] = null;
					}
				}
			}
			if (!$conf['keepStdWrap']) {
				unset($recConfig['conf.']['tt_content.']['stdWrap.']);
			}
		}elseif ($conf['conf'] && $conf['conf.']){
			$recConfig['conf.'] = array(
				'tt_content' => $conf['conf'],
				'tt_content.' => $conf['conf.']
			);
		}
		
		return $this->cObj->cObjGetSingle('RECORDS', $recConfig);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/symce/pi1/class.tx_symce_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/symce/pi1/class.tx_symce_pi1.php']);
}

?>