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
 * Extend palettes of tl_module
 */
foreach ($GLOBALS['TL_DCA']['tl_module']['palettes'] as $name=>$palette) {
	if ($name == '__selector__')
	{
		continue;
	}
	$GLOBALS['TL_DCA']['tl_module']['palettes'][$name] = str_replace("{expert_legend:hide}", "{simpleFrontendPortlet_legend},isSimpleFrontendPortlet;{expert_legend:hide}", $palette);
}

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['isSimpleFrontendPortlet'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['isSimpleFrontendPortlet'],
	'exclude'                 => true,
	'inputType'               => 'checkbox'
);

?>