<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_k2swftag
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JFactory::getDocument()->addScript(JURI::root().'modules/mod_k2swftag/assets/swfobject.js');	//load in js for create swf object
$swfUrl = JURI::root().'modules/mod_k2swftag/assets/tagcloud.swf';								//path for swf
$height = $params->get('height',200);
$width = $params->get('width',200);
$color = $params->get('color','#FFF');
?>
<style>
#tagcloudflash<?php echo $module->id;?> {width:100%;}
</style>
<div class="k2swftag<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
	<div id="k2swftag<?php echo $module->id;?>"></div>
	<script type="text/javascript">
		var tags = "<?php echo $tags; ?>";
		var swfObj<?php echo $module->id;?> = new SWFObject("<?php echo $swfUrl;?>", "tagcloudflash<?php echo $module->id;?>", "<?php echo $width; ?>", "<?php echo $height;?>", "9", "<?php echo $color;?>");
		var widget_k2swftag<?php echo $module->id;?> = swfObj<?php echo $module->id;?>;
		widget_k2swftag<?php echo $module->id;?>.addParam("allowScriptAccess", "always");
		widget_k2swftag<?php echo $module->id;?>.addVariable("tcolor", "0x333333");
		widget_k2swftag<?php echo $module->id;?>.addVariable("tcolor2", "0x333333");
		widget_k2swftag<?php echo $module->id;?>.addVariable("hicolor", "0x000000");
		widget_k2swftag<?php echo $module->id;?>.addVariable("tspeed", "100");
		widget_k2swftag<?php echo $module->id;?>.addVariable("distr", "true");
		widget_k2swftag<?php echo $module->id;?>.addVariable("mode", "tags");
		widget_k2swftag<?php echo $module->id;?>.addVariable("tagcloud", tags);
		widget_k2swftag<?php echo $module->id;?>.write("k2swftag<?php echo $module->id;?>");
	</script>
</div>