<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_k2swftag
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_k2swftag
 *
 * @package     Joomla.Site
 * @subpackage  mod_k2swftag
 * @since       1.5
 */
class ModK2swftagHelper
{
	public static function getTags(&$params)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name')->from('#__k2_tags')->where('published=1');
		
		$max_tags = $params->get('tag_maximum_tags',0);
		if(	isset($max_tags) && $max_tags > 0){
			$tags = $db->setQuery($query,0,$max_tags)->loadObjectList('id');
		}else{
			$tags = $db->setQuery($query)->loadObjectList('id');
		}
				
		$fontsize = $params->get('tag_font_size',null);
		$domain = rtrim(JURI::base(),'/');
		if(empty($fontsize)) $fontsize = '8pt';
		$tagTpl = "<a href='%s' class='tag' title='%s' style='font-size: %s;'>%s</a>";
		$tagString = '<tags>';
		if(!empty($tags)){
			$tag_urllocation = $params->get('tag_url_location',1);
			if($tag_urllocation == 2){
			$query2 = $db->getQuery(true);
			$query2->select('alias')->from('#__menu')->where(' (link="index.php?option=com_k2&view=itemlist&layout=category" OR link="index.php?option=com_k2&view=itemlist&layout=category&task=&id=") AND type="component" AND published=1');
			$result = $db->setQuery($query2)->loadObject();
			}
			foreach ($tags as $tagId => $tag) {

				//we have alias found results or user selection
				if( $tag_urllocation == 2 || ( isset($result) && count($result) >= 1) ){
					$aliasmenu = $result->alias;
					$seturl = str_replace("%2F", "/", urlencode(JRoute::_('/'.$aliasmenu.'/tag/'.$tag->name)));
				}else{
					//$seturl = JRoute::_('index.php?option=com_k2&view=itemlist&task=tagid&tagid='.$tag->id);
					$seturl = str_replace("%2F", "/", urlencode(JRoute::_('/component/k2/tag/'.$tag->name)));
				}		
				
				//fix + bug in case of space between words
				$seturl	= str_replace("+", "%20", $seturl);
				
				$tagString .= vsprintf($tagTpl,array(
					//'href'=>$domain . JRoute::_('index.php?option=com_k2&view=itemlist&task=tagid&tagid='.$tag->id),
					//'href'=>$domain . JRoute::_('index.php?option=com_k2&view=itemlist&task=tag&tag='.$tag->name),
					'href'=>$domain . $seturl,
					'title'=>$tag->name,
					'fontsize'=>$fontsize,
					'text'=>$tag->name,
				));
			}
		}
		$tagString .= '</tags>';
		return urlencode($tagString);
	}
}
