<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    SimpleFrontendPortlets
 * @license    LGPL
 */

/**
 * Add palette
 */
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('assignDir;', 'assignDir;{simpleFrontendPortlet_legend:hide},visibleSimpleFrontendPortlets;', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);

/**
 * Add field
 */
$GLOBALS['TL_DCA']['tl_member']['fields']['visibleSimpleFrontendPortlets'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['visibleSimpleFrontendPortlets'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_member_SimpleFrontendPortlets', 'getPortlets'),
	'eval'                    => array('multiple'=>true, 'feEditable'=>true, 'feGroup'=>'preferences'),
);

/**
 * Class SimpleFrontendPortlets
 *
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_member_SimpleFrontendPortlets extends System
{
	/**
	 * Checks if the portlet (marked module) should be displayed for the logged member
	 */
	public function getPortlets($objModule)
	{
		$objPortlets = $this->getPortletsForMode();

		if ($objPortlets->numRows < 1)
		{
			return array();
		}

		$arrPortlets = array();
		while ($objPortlets->next())
		{
			$arrPortlets[$objPortlets->id] = $objPortlets->simpleFrontendPortletName . " (" . $objPortlets->simpleFrontendPortletDescription . ")";
		}
		return $arrPortlets;
	}
	
	/**
	 * Return the possible portlets (in FE Mode only modules of actual page).
	 */
	private function getPortletsForMode ()
	{
		$this->import('Database');
		$query = "SELECT * FROM tl_module WHERE isSimpleFrontendPortlet = ?";
		$params = array('1');
		
		if (TL_MODE == 'FE')
		{
			$query .= " AND pid IN (SELECT t.id FROM tl_theme t JOIN tl_layout l ON t.id = l.pid WHERE l.id = ?)";
			global $objPage;
			$params[] = $objPage->layout;
		}
		
		return $this->Database->prepare($query)->execute($params);
	}
}

?>