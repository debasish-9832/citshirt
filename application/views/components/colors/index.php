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
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><?php echo language('select_color', $lang); ?></h4>
		</div>
		
		<div class="modal-body">
		
			<div class="row">				
				<div class="col-md-4"><input type="text" class="form-control" placeholder="<?php echo language('color_title', $lang)?>" id="add-color-title" /></div>
				<div class="col-md-2"><input type="text" class="form-control color {pickerPosition:'botton'}" placeholder="<?php echo language('color_hex', $lang)?>" id="add-color-color" /></div>
				<div class="col-md-2"><ul class="add-more-colors"></ul></div>
				<div class="col-md-2"><a href="javascript:void(0)" onclick="dgUI.product.color.add()" title="<?php echo language('add_more_colors', $lang)?>" class="btn btn-green"><i class="fa fa-plus"></i></a></div>
				<div class="col-md-2"><a href="javascript:void(0)" onclick="dgUI.product.addHex()" class="btn btn-primary"><?php echo language('add', $lang); ?></a></div>				
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">					
					<input type="text" class="form-control" placeholder="<?php echo language('find_color', $lang)?>" onkeyup="dgUI.product.color.find('key', this)">
				</div>
				<div class="col-md-4">
					<select id="color-type" class="form-control" onchange="dgUI.product.color.find('', this)">
						<option value="all"><?php echo language('all', $lang);?></option>
						<option value="basic"><?php echo language('basic', $lang);?></option>
						<option value="general"><?php echo language('general', $lang);?></option>
					</select>
				</div>
			</div>
			<br />
			<div class="clear-line"></div>
			
			<?php if($content) { ?>
			<ul class="colors">
			
			<?php foreach($content as $color) { ?>
				
				<li>
				<?php if($function == null) $function = "dgUI.product.addColor"; ?>
					<?php
						if(isset($id) && $id != null)
							$js = $function . "('".$color->title."', '".$color->hex."', '".$id."')";
						else
							$js = $function . "('".$color->title."', '".$color->hex."')";
					?>
					<a class="box-color" href="javascript:void(0);" data-type="<?php echo strtolower($color->type); ?>" onclick="<?php echo $js; ?>">
						<span class="color-bg" style="background-color:#<?php echo $color->hex; ?>"></span>
						<?php echo $color->title; ?>
					</a>
				</li>
				
			<?php } ?>
			
			</ul>
			<?php } ?>
		
		</div>
		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo language('cancel_btn', $lang); ?></button>
		</div>
	</div>
</div>