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

?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/view_design.css'); ?>"/>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/canvg.js'); ?>"></script>
<div class="modal-header">
	<h4 class="modal-title"><?php echo language('view_design', $lang);?></h4>
</div>
	<div class="modal-body">
		<div class="row">
			<?php $error = ''; ?>
			<?php if(isset($product->vectors)){ ?>
			<?php $vectors = json_decode($product->vectors, true); ?>
			<?php if(is_array($vectors))foreach($vectors as $key=>$vector){?>
				<?php if(count($vector) != 0){ $checkdata = true; ?>
					<div class="col-sm-12">
						<fieldset>
							<legend><?php echo language($key.'_legend', $lang);?></legend>
							<div class="col-sm-5 view_product">
								<?php if(isset($product->image)){ ?>
									<a target="_blank" href="<?php echo site_url('design/index/'.$product->product_id.'/'.$product->product_options.'/'.$product->design_id); ?>" title="Click to edit design">
									<img id="view_product-<?php echo $key; ?>" src="<?php echo base_url(str_replace('front', $key, $product->image));?>" alt=""/>
									</a>
								<?php } ?>
							</div>
							
							<div class="col-sm-7 view_vector">
								<?php foreach($vector as $value){?>
									<div class="row">
										<?php if(isset($value['type'])){?>
											<label class="col-sm-3"><?php echo language('designer_'.$value['type'].'_label', $lang);?></label>
										<?php }?>
										<div class="col-sm-9">
										<?php if(isset($value['text'])){ ?>
											<p class="text"><?php echo $value['text']; ?></p>
										<?php }elseif(isset($value['thumb'])){ ?>
											<img class="clipart_thumb" src="<?php echo $value['thumb'];?>" alt=""/>
										<?php } ?>
											<ul>
												<?php foreach($value as $k=>$v){ ?>
													<?php if($k != 'text' && $k != 'zIndex' && $k != 'type' && $k != 'svg' && $k != 'outlineC' && $k != 'outlineW' && $k != 'title' && $k != 'file_name' && $k != 'file' && $k != 'thumb' && $k != 'url' && $k != 'change_color'){ ?>
														
														<li>
															<span><?php echo language($k, $lang) ?></span>
															<?php if ($k == 'fontFamily') { ?>
																<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $v); ?>' rel='stylesheet' type='text/css'>
																<a target="_blank" href="http://www.google.com/fonts/specimen/<?php echo str_replace(' ', '+', $v); ?>" title="Click to download this font" style="font-family:'<?php echo $v; ?>'"><?php echo $v; ?></a>
																
															<?php } else { ?>
															
																<?php echo $v; ?>
																
															<?php } ?>
														</li>
														
													<?php }elseif(($k == 'outlineC' || $k == 'outlineW') && $v != 'none'){?>
														<li><span><?php echo language($k, $lang); ?></span><?php echo $v; ?></li>
													<?php } ?>
												<?php } ?>
											</ul>
										</div>
									</div>
								<?php } ?>
							</div>
						</fieldset>
					</div>
				<?php } ?>
			<?php }else{ $error = '<div class="col-sm-12"><div class="alert alert-danger" role="alert">'.language('data_not_found', $lang).'</div></div>';} ?>
			<?php }else{ $error = '<div class="col-sm-12"><div class="alert alert-danger" role="alert">'.language('data_not_found', $lang).'</div></div>';} ?>
			<?php 
				if($error != '')
				{
					echo $error;
				}elseif(empty($checkdata) && $error == '')
				{
					echo '<div class="col-sm-12"><div class="alert alert-danger" role="alert">'.language('data_not_design_product', $lang).'</div></div>';
				}
			?>
		</div>
	</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onclick="parent.jQuery.fancybox.close();"><?php echo language('close_btn', $lang);?></button>
</div>