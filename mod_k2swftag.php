<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_k2swftag
 *
 * @author 		Zjmainstay
 * @link		http://zjmainstay.cn
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
ini_set('display_errors','on');
error_reporting(E_ALL);
// Include helper
if(!class_exists('ModK2swftagHelper')) require __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$tags = ModK2swftagHelper::getTags($params);

require JModuleHelper::getLayoutPath('mod_k2swftag', $params->get('layout', 'default'));
