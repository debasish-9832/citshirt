<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$lang = getLanguages();
?>
<div class="row">
	<?php if (count ($data) == 0) { ?>
		<strong><?php echo language('data_not_found', $lang); ?></strong>
	<?php }else{ ?>
	
		<?php foreach($data as $design) { ?>
		<div class="col-md-3 design-box">
			<a href="<?php echo site_url('design/index/'.$design->product_id .'/'. $design->product_options .'/'. $design->design_id); ?>" title="Click to load this design">
				<img src="<?php echo base_url($design->image); ?>" class="img-responsive img-thumbnail" alt="">
			</a>
			<span class="design-action design-action-remove" onclick="design.ajax.removeDesign(this)" data-id="<?php echo $design->id; ?>" title="Remove this design">
				<i class="red glyphicons remove_2"></i>
			</span>
		</div>
		<?php } ?>
		<div class="pull-right"><?php echo $links; ?></div>
	<?php } ?>
</div>
<script type="text/javascript">
	jQuery('.pagination').children('.page').children('a').each(function(e){
		var href = jQuery(this).attr('href');
		jQuery(this).attr('href', 'javascript:void(0)');
		var perpage  = href.replace('<?php echo site_url('user/userdesign/ajax').'/'; ?>', '');
		jQuery(this).attr('onclick', 'design.ajax.mydesign(' +perpage+ ');');
	}); 
</script>