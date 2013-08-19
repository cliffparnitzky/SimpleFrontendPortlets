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
 * Class SimpleFrontendPortlets
 *
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class SimpleFrontendPortlets extends System
{
	/**
	 * Checks if the portlet (marked module) should be displayed for the logged member
	 */
	public function checkPortletPublicationForModul($objModule, $strBuffer)
	{
		if ($objModule->isSimpleFrontendPortlet && FE_USER_LOGGED_IN)
		{
			$this->import('FrontendUser', 'User');
			if ($this->User->visibleSimpleFrontendPortlets == null || !in_array($objModule->id, $this->User->visibleSimpleFrontendPortlets))
			{
				return '';
			}
		}
		return $strBuffer;
	}
	
	/**
	 * Checks if the portlet (marked module) should be displayed for the logged member
	 */
	public function checkPortletPublicationForContentElement($objContentElement, $strBuffer)
	{
		if ($objContentElement->type == 'module')
		{
			$this->import('Database');
			
			$objModule = $this->Database->prepare('SELECT * FROM tl_module WHERE id = ?')
						   ->limit(1)
						   ->execute($objContentElement->module);
			
			if ($objModule->numRows == 1)
			{
				$strBuffer = $this->checkPortletPublicationForModul($objModule, $strBuffer);
			}
		}
		return $strBuffer;
	}
}
?>