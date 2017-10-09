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
<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/js/add-ons.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.ui.rotatable.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/language.js'); ?>"></script>	
<script src="<?php echo base_url('assets/js/design.js'); ?>"></script>	
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/canvg.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validate.js'); ?>"></script>	

<script type="text/javascript">
	var baseURL = '<?php echo base_url(); ?>';	
	var urlCase = '<?php echo base_url('image-tool/thumbs.php'); ?>';
	var edit_text_title = '<?php echo language('edit_text', $lang);?>';
	var team_number_title = '<?php echo language('team_number', $lang);?>';
	var confirm_reset_msg = '<?php echo language('confirm_reset_msg', $lang);?>';
	var add_qty_or_size_msg = '<?php echo language('add_qty_or_size_msg', $lang);?>';
	var minimum_qty_msg = '<?php echo language('minimum_qty_msg', $lang);?>';
	var please_add_qty_or_size_msg = '<?php echo language('please_add_qty_or_size_msg', $lang);?>';
	var please_try_again_msg = '<?php echo language('please_try_again_msg', $lang);?>';
	var select_a_color_msg = '<?php echo language('select_a_color_msg', $lang);?>';
	var tick_the_checkbox_msg = '<?php echo language('tick_the_checkbox_msg', $lang);?>';
	var choose_a_file_upload_msg = '<?php echo language('choose_a_file_upload_msg', $lang);?>';
	var myAccount = '';
	var logOut = '';
	
	<?php if ( isset($user['id']) ) { ?>
	var user_id = <?php echo $user['id']; ?>;
	<?php }else{ ?>
	var user_id = 0;
	<?php } ?>
</script>

<div id="dg-wapper">
	<div id="dg-mask" class="loading"></div>
	
	<!-- Begin main -->
	<div id="dg-designer">
		<div class="col-left">
			<div class="text-center product-btn-info">					
				<a href="javascript:void(0)" data-target="#modal-product-info" data-toggle="modal" class="btn btn-default pull-left btn-sm"><i class="fa fa-info"></i> <span><?php echo language('designer_product_info', $lang); ?></span></a>
				<a href="javascript:void(0)" data-target="#modal-product-size" data-toggle="modal" class="btn btn-default pull-right btn-sm"><i class="fa fa-male"></i> <span><?php echo language('designer_size_chart', $lang); ?></span></a>
			</div>
			
			<div id="dg-left" class="width-100">
				<div class="dg-box width-100">
					<ul class="menu-left">
						<li>
							<a href="javascript:void(0)" class="view_change_products" title="" data-toggle="modal" data-target="#dg-products">
								<i class="glyphicons t-shirt"></i> <?php echo language('designer_menu_choose_product', $lang); ?>
							</a>
						</li>
						
						<li>
							<a href="javascript:void(0)" class="add_item_text" title="">
								<i class="glyphicons text_bigger"></i> <?php echo language('add_text', $lang); ?>
							</a>
						</li>
						
						<li>
							<a href="javascript:void(0)" class="add_item_clipart" title="" data-toggle="modal" data-target="#dg-cliparts">
								<i class="glyphicons picture"></i> <?php echo language('add_art', $lang); ?>
							</a>
						</li>
						
						<!--
						<li>
							<a href="javascript:void(0)" title="" data-toggle="modal" data-target="#dg-designidea">
								<i class="glyphicons sun"></i> <?php echo language('design_idea', $lang); ?>
							</a>
						</li>
						-->
						<li>
							<a href="javascript:void(0)" title="" data-toggle="modal" data-target="#dg-myclipart">
								<i class="glyphicons cloud-upload"></i> <?php echo language('designer_menu_upload_image', $lang); ?>
							</a>
						</li>
						
						<li>
							<a href="javascript:void(0)" class="add_item_team" title="">
								<i class="glyphicons soccer_ball"></i> <?php echo language('name_number', $lang); ?>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="add_item_mydesign">
								<i class="glyphicons user"></i> <?php echo language('my_design', $lang); ?>
							</a>
						</li>
						<!--
						<li>
							<a href="javascript:void(0)" title="">
								<i class="glyphicons qrcode"></i> <?php echo language('designer_menu_add_qrcode', $lang); ?>
							</a>
						</li>
						-->
					</ul>
				</div>
				
				<div class="dg-box width-100 div-layers no-active">
					<div class="layers-toolbar">
						<button type="button" class="btn btn-default">
							<i class="fa fa-long-arrow-down"></i>
							<i class="fa fa-long-arrow-up"></i>
						</button>
						<button type="button" class="btn btn-default btn-sm">
							<i class="fa fa-angle-right"></i>						
						</button>
					</div>
						
					<div class="accordion">
						<h3><?php echo language('designer_menu_login_layers', $lang); ?></h3>
						<div id="dg-layers">
							<ul id="layers">									
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-12 col-center align-center">
			<!-- Begin sidebar -->
			<div id="dg-sidebar">
				<ul class="dg-tools">
					<li>
						<a data-target="#dg-help" id="tools-help" data-toggle="modal" href="javascript:void(0)" title="<?php echo language('help', $lang); ?>">
							<i class="glyphicons circle_question_mark"></i>
							<span><?php echo language('help', $lang); ?></span>
						</a>
					</li>				
					<li>
						<a href="javascript:void(0)" data-type="preview" title="<?php echo language('preview', $lang); ?>" class="dg-tool">
							<i class="glyphicons eye_open"></i>
							<span><?php echo language('preview', $lang); ?></span>
						</a>
					</li>
					<!--
					<li>
						<a href="javascript:void(0)" data-type="undo" class="dg-tool">
							<i class="glyphicons undo"></i>
							<span>undo</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)" data-type="redo" class="dg-tool">
							<i class="glyphicons redo"></i>
							<span>redo</span>
						</a>
					</li>
					-->
					<li>
						<a href="javascript:void(0)" data-type="zoom" title="<?php echo language('zoom', $lang); ?>" class="dg-tool">
							<i class="glyphicons search"></i>
							<span><?php echo language('zoom', $lang); ?></span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)" data-type="reset" title="<?php echo language('reset', $lang); ?>" class="dg-tool">
							<i class="glyphicons bin"></i>
							<span><?php echo language('reset', $lang); ?></span>
						</a>
					</li>					
				</ul>
			</div>
			<!-- Begin sidebar -->
			
			<!-- design area -->
			<div id="design-area" class="div-design-area">
				<div id="app-wrap" class="div-design-area">
				<?php if ($product == false || (isset($product->design) && $product->design == false)) { ?>
					<div id="view-front" class="labView active">
						<div class="product-design">
							<strong><?php echo language('designer_product_data_found', $lang); ?></strong>
						</div>
					</div>
				<?php } else { ?>
					
					<!-- begin front design -->						
					<div id="view-front" class="labView active">
						<div class="product-design"></div>
						<div class="design-area"><div class="content-inner"></div></div>
					</div>						
					<!-- end front design -->
					
					<!-- begin back design -->
					<div id="view-back" class="labView">
						<div class="product-design"></div>
						<div class="design-area"><div class="content-inner"></div></div>
					</div>
					<!-- end back design -->
					
					<!-- begin left design -->
					<div id="view-left" class="labView">
						<div class="product-design"></div>
						<div class="design-area"><div class="content-inner"></div></div>
					</div>
					<!-- end left design -->
					
					<!-- begin right design -->
					<div id="view-right" class="labView">
						<div class="product-design"></div>
						<div class="design-area"><div class="content-inner"></div></div>
					</div>
					<!-- end right design -->
					
				<?php } ?>
				</div>
			</div>
			
			<div class="" id="product-thumbs"></div>
		</div>	  
		
		<div class="col-right">
			<span class="arrow-mobile" data="right"><i class="glyphicons chevron-left"></i></span>
			<div id="dg-right">
				<!-- share -->
				<div class="dg-share">
					<div class="row align-center">
						<label style="font-size: 14px;"><?php echo language('designer_save_and_share_design', $lang); ?></label>
					</div>
					<div class="row align-center">
						<div class="dg-box">
							<a href="javascript:void(0)" onclick="design.save()" class="btn btn-sm btn-warning btn-margin pull-left" title="save"><?php echo language('save_btn', $lang); ?></a>
							<ul class="list-share pull-right">
								<li>
									<span class="icon-25 share-email" data-type="email"></span>
									<span class="icon-25 share-facebook" data-type="facebook"></span>
									<span class="icon-25 share-twitter" data-type="twitter"></span>
									<span class="icon-25 share-pinterest" data-type="pinterest"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
				<!-- product -->
				<div class="align-center" id="right-options">
					<div class="dg-box">
						<div class="accordion">
							<h3><?php echo language('designer_right_product_options', $lang); ?></h3>
							<div class="product-options contentHolder" id="product-details">
							<?php if ($product != false) { ?>
								<div class="content-y">									
									<?php if (isset($product->design) && $product->design != false) { ?>
									<div class="product-info">
										<div class="form-group product-fields">
											<label for="fields"><?php echo language('designer_right_choose_product_color', $lang); ?></label>
											<div class="list-colors" id="product-list-colors">
												<?php for ($i=0; $i<count($product->design->color_hex); $i++) { ?>
												<span class="bg-colors dg-tooltip <?php if ($i==0) echo 'active'; ?>" onclick="design.products.changeColor(this, <?php echo $i; ?>)" data-color="<?php echo $product->design->color_hex[$i]; ?>" style="background-color:#<?php echo $product->design->color_hex[$i]; ?>" data-placement="top" data-original-title="<?php echo $product->design->color_title[$i]; ?>"></span>
												<?php } ?>
											</div>
										</div>										
									</div>
									<?php } ?>
									
									<form method="POST" id="tool_cart" name="tool_cart" action="">
									<div class="product-info" id="product-attributes">
										<?php if (isset($product->attribute)) { ?>
											<?php echo $product->attribute; ?>
										<?php } ?>										
									</div>
									</form>									
								</div>
							<?php } ?>
							</div>
							
							<h3><?php echo language('designer_right_color_used', $lang); ?></h3>
							<div class="color-used"></div>
							
							<h3><?php echo language('designer_right_screen_size', $lang); ?></h3>
							<div class="screen-size"></div>
							<!--
							<h3>Extra</h3>
							<div>
								Extra
							</div>
							-->
						</div>
						<div class="product-prices">
							<div id="product-price">
								<span class="product-price-title"><?php echo language('total', $lang); ?>:</span>
								<div class="product-price-list">
									<span id="product-price-old"><?php echo settingValue($setting, 'currency_symbol', '$'); ?><span class="price-old-number">123</span></span>
									<span id="product-price-sale"><?php echo settingValue($setting, 'currency_symbol', '$'); ?><span class="price-sale-number">100</span></span>
								</div>
								<span class="price-restart" title="Click to get price" onclick="design.ajax.getPrice()"><i class="glyphicons restart"></i></span>
							</div>
							<button type="button" class="btn btn-warning btn-addcart" onclick="design.ajax.addJs(this)"><i class="glyphicons shopping_cart"></i><?php echo language('buy_now_btn', $lang); ?></button>								
						</div>
					</div>
				</div>
			</div>
		</div>						
	</div>
	<!-- End main -->			
</div>

<div id="screen_colors_body" style="display:none;">
	<div id="screen_colors">
		<div class="screen_colors_top">
			<div class="col-xs-5 col-md-5 text-left" id="screen_colors_images">
			</div>
			<div class="col-xs-7 col-md-7 text-left">
				<h4><?php echo language('designer_color_select_ink_colors', $lang); ?></h4>
				<span class="help-block"><?php echo language('designer_color_select_the_colors_that_appear', $lang); ?></span>
				<span class="help-block"><?php echo language('designer_color_this_helps_us_determine', $lang); ?></span>
				<p><strong> <?php echo language('designer_color_note', $lang); ?></strong></p>
				<span id="screen_colors_error"></span>
				<div id="screen_colors_list" class="list-colors"></div>
			</div>
		</div>
		<div class="screen_colors_botton">
			<button type="button" class="btn btn-primary" onclick="design.item.setColor()"><?php echo language('designer_color_choose_colors', $lang); ?></button>
		</div>
	</div>
</div>
			
<div id="dg-modal">
	<!-- Begin product info -->
	<div class="modal fade" id="modal-product-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="products-detail col-sm-12">
						<div class="product-detail">
							<div class="row text-right">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="row">
								<div class="col-xs-6 col-md-6">
									<img src="<?php echo base_url($product->image); ?>" class="img-responsive img-thumbnail product-detail-image" alt="<?php echo $product->title; ?>" />
								</div>
								<div class="col-xs-6 col-md-6">
									<h3 class="margin-top product-detail-title"><?php echo $product->title; ?></h3>
									<p><?php echo language('id', $lang); ?>: <strong class="product-detail-id"><?php echo $product->id; ?></strong></p>
									<p><?php echo language('sku', $lang); ?>: <strong class="product-detail-sku"><?php echo $product->sku; ?></strong></p>
									<p class="product-detail-short_description"><?php echo $product->short_description; ?></p>
								</div>
							</div>
							<div class="row col-sm-12">
								<h4><?php echo language('description', $lang); ?></h4>										
								<div class="product-detail-description"><?php echo $product->description; ?></div>
							</div>								
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End product info -->
	
	<!-- Begin product size -->
	<div class="modal fade" id="modal-product-size" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-right clearfix">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="row">
						<div class="col-md-12 product-detail-size">
							<?php echo $product->size; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End product info -->
	
	<!-- Begin Login -->
	<div class="modal fade" id="f-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div id="f-login-content" class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><?php echo language('user_login_now_or_sign_up', $lang); ?></h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
				<!-- login form -->
				<div class="col-md-6">
					<h3><?php echo language('user_login', $lang); ?></h3>
					<form id="fr-login" role="form" style="margin-bottom: 5px;">						  						 
					  <div class="form-group">
						<label><?php echo language('user_your_email', $lang); ?>:</label>
						<input type="text" name="data[email]" id="login-email" class="form-control input-sm validate required" data-msg="<?php echo language('user_email_validate_msg', $lang); ?>" data-type="email" placeholder="<?php echo language('user_your_email', $lang); ?>">
					  </div>
					  <div class="form-group">
						<label><?php echo language('user_your_password', $lang); ?>:</label>
						<input type="password" name="data[password]" id="login-password" class="form-control input-sm validate required" data-msg="<?php echo language('user_password_validate_msg', $lang); ?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_your_password', $lang); ?>">
					  </div>
					  <a href="javascript:void(0)" title="" class="btn btn-default btn-primary" onclick="facebook_login()">
						<span class="login-facebook"></span>
						<?php echo language('user_login_with_facebook', $lang); ?>
					  </a>
					  <button type="button" onclick="login(this)" autocomplete="off" class="btn btn-default btn-warning" data-loading-text="<?php echo language('loading_btn', $lang); ?>"><?php echo language('login_btn', $lang); ?></button> 
					  <?php echo $this->auth->getToken(); ?>
					  <input type="hidden" name="ajax" value="1">
					</form>
					
					<a id="click_forgot" href="javascript:void(0)"><?php echo language('user_i_forgot_password', $lang); ?></a>
				</div>
				
				<!-- create account -->
				<div class="col-md-6">
					<h3><?php echo language('user_create_account', $lang); ?></h3>
					<form id="fr-register" role="form">						 
					  <div class="form-group">
						<label><?php echo language('user_username', $lang); ?>:</label>
						<input type="text" name="data[username]" id="create_username" class="form-control input-sm validate required" data-msg="<?php echo language('user_username_validate_msg', $lang); ?>" data-maxlength="200" data-minlength="2" placeholder="<?php echo language('user_username', $lang); ?>">
					  </div>
					  <div class="form-group">
						<label><?php echo language('user_email_address', $lang); ?>:</label>
						<input type="email" name="data[email]" class="form-control input-sm validate required" id="create_email" data-msg="<?php echo language('user_email_validate_msg', $lang); ?>" data-type="email" placeholder="<?php echo language('user_enter_email', $lang); ?>">
					  </div>
					  <div class="form-group">
						<label><?php echo language('user_password', $lang); ?>:</label>
						<input type="password" class="form-control input-sm validate required" name="data[password]" id="create_password" data-msg="<?php echo language('user_password_validate_msg', $lang); ?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_password', $lang); ?>">
					  </div>						  						 
					  <button type="button" onclick="login('register')" autocomplete="off" data-loading-text="<?php echo language('loading_btn', $lang); ?>" class="btn btn-default btn-primary"><?php echo language('register_btn', $lang); ?></button>
						<?php echo $this->auth->getToken(); ?>
						<input type="hidden" name="ajax" value="1">
					</form>
				</div>
			</div>
		  </div>			 
		</div>
	  </div>
	  
	  <div id="f-forgot-content" class="modal-dialog" style="display:none">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><?php echo language('user_forgot_password', $lang); ?></h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<form id="fr-forgot" role="form" style="margin-bottom: 5px;">						  						 
							<div class="form-group" style="display: table; width: 100%;">
								<label class="col-md-4"><?php echo language('user_your_email', $lang); ?>:</label>
								<div class="col-md-6">
									<input type="text" name="email" id="forgot-email" class="form-control input-sm validate required" data-msg="<?php echo language('user_email_validate_msg', $lang); ?>" data-type="email" placeholder="<?php echo language('user_your_email', $lang); ?>">
								</div>
							</div>
							<div class="form-group" style="display: table; width: 100%;">
								<label class="col-md-4"><?php echo language('user_new_password', $lang); ?>:</label>
								<div class="col-md-6">
									<input type="password" class="form-control input-sm validate required" name="forgot-password" id="forgot-password" data-msg="<?php echo language('user_new_password_validate_msg', $lang); ?>" data-maxlength="32" data-minlength="6" placeholder="<?php echo language('user_new_password', $lang); ?>">
								</div>	
							</div>	
							<div class="form-group" style="display: table; width: 100%;"> 
								<label class="col-md-4"><?php echo language('user_confirm_new_password', $lang); ?>:</label>
								<div class="col-md-6">
									<input type="password" class="form-control input-sm validate required" name="forgot-cfpassword" id="forgot-cfpassword" data-msg="<?php echo language('user_confirm_new_password_validate_msg', $lang); ?>" data-maxlength="32" data-minlength="6" placeholder="<?php echo language('user_confirm_new_password', $lang); ?>">
								</div>	
							</div>
							<div class="form-group" style="display: table; width: 100%;">
								<label class="col-md-4"></label>
								<div class="col-md-6">
									<button type="button" id="forgot-button" class="btn btn-default btn-warning" data-loading-text="<?php echo language('loading_btn', $lang); ?>"><?php echo language('send_btn', $lang); ?></button>
									<a style="margin-left: 5px;" id="click_login" href="javascript:void(0)"><?php echo language('user_login_or_register', $lang); ?></a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		  </div>			 
		</div>
	  </div>
	</div>
	<!-- End Login -->
	
	<!-- Begin products -->
	<div class="modal fade" id="dg-products" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="row">							
						<div class="col-sm-11" id="list-categories">
							<?php if ( count ($product->categories) ) { ?>
							<div class="col-xs-4 col-md-3">
								<select data-level="1" id="parent-categories-1" class="form-control input-sm" onchange="design.products.changeCategory(this)">
									<option value="0"> - <?php echo language('designer_product_select_category', $lang); ?> - </option>
									<?php 
									foreach ($product->categories as $category) { 
									if ($category->parent_id > 0) continue;
									?>
									<option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
									<?php } ?>
									
								</select>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="row">
						<!-- list product category -->
						<div class="product-list col-sm-12">
						</div>
						
						<!-- product detail -->
						<div class="products-detail col-sm-12">
							<button type="button" class="btn btn-danger btn-sm" id="close-product-detail"><?php echo language('close_btn', $lang); ?></button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo language('close_btn', $lang); ?></button>
					<button type="button" class="btn btn-primary" id="loading-change-product" data-loading-text="<?php echo language('loading_btn', $lang); ?>" onclick="design.products.changeDesign(this)"><?php echo language('designer_product_change_product', $lang); ?></button>
				</div>
			</div>
		</div>
	</div>
	<!-- End products -->
	
	<!-- Begin clipart -->
	<div class="modal fade" id="dg-cliparts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="overflow: hidden;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="col-xs-4 col-md-3">
						<h4 class="modal-title"><?php echo language('designer_art_select', $lang); ?></h4>
					</div>
					<div class="col-xs-7 col-md-4">
						<div class="input-group">
						  <input type="text" id="art-keyword" autocomplete="off" class="form-control input-sm" placeholder="<?php echo language('search_btn', $lang); ?>">
						  <span class="input-group-btn">
							<button class="btn btn-default btn-sm" onclick="design.designer.art.arts(0)" type="button"><?php echo language('search_btn', $lang); ?></button>
						  </span>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="row align-center">
						<div id="dag-art-panel">
							<a href="javascript:void(0)" title="Click to show categories">
								<?php echo language('designer_clipart_shop_library', $lang); ?> <span class="caret"></span>
							</a>
							<a href="javascript:void(0)" title="Click to show categories">
								<?php echo language('designer_clipart_store_design', $lang); ?> <span class="caret"></span>
							</a>
						</div>
					</div>						
					
					<div class="row">
						<div id="dag-art-categories" class="row col-xs-4 col-md-3"></div>
						<div class="col-xs-8 col-md-9">
							<div id="dag-list-arts"></div>
							<div id="dag-art-detail">
								<button type="button" class="btn btn-danger btn-xs"><?php echo language('close_btn', $lang); ?></button>
							</div>
						</div>								
					</div>
				</div>
				
				<div class="modal-footer">
					<div class="align-right" id="arts-pagination" style="display:none">
						<ul class="pagination">
							<li><a href="javascript:void(0)">&laquo;</a></li>
							<li class="active"><a href="javascript:void(0)">1</a></li>
							<li><a href="javascript:void(0)">2</a></li>
							<li><a href="javascript:void(0)">3</a></li>
							<li><a href="javascript:void(0)">4</a></li>
							<li><a href="javascript:void(0)">5</a></li>
							<li><a href="javascript:void(0)">&raquo;</a></li>
						</ul>
						<input type="hidden" value="0" autocomplete="off" id="art-number-page">
					</div>
					<div class="align-right" id="arts-add" style="display:none">
						<div class="art-detail-price"></div>
						<button type="button" class="btn btn-primary"><?php echo language('add_design_btn', $lang); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End clipart -->
	
	<!-- Begin Upload -->
	<div class="modal fade" id="dg-myclipart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					
					<ul role="tablist" id="upload-tabs">
						<li class="active"><a href="#upload-conputer" role="tab" data-toggle="tab"><?php echo language('designer_upload_upload_photo', $lang); ?></a></li>
						<!--<li><a href="#upload-facebook" role="tab" data-toggle="tab">Facebook</a></li>-->
						<li><a href="#uploaded-art" role="tab" data-toggle="tab"><?php echo language('designer_upload_photo_uploaded', $lang); ?></a></li>
						<!--
						<li><a href="#upload-instagram" role="tab" data-toggle="tab"><i class="fa fa-instagram"></i> Instagram</a></li>
						<li><a href="#upload-facebook" role="tab" data-toggle="tab"><i class="fa fa-flickr"></i> Flickr</a></li>
						-->
					</ul>
				</div>
				<div class="modal-body">
					<div class="tab-content">
						<div class="tab-pane active" id="upload-conputer">
							<div class="row">
								<div class="col-xs-6 col-md-6">
									<div class="form-group">
										<label><?php echo language('designer_upload_choose_a_file_upload', $lang); ?></label>
										<input type="file" id="files-upload" autocomplete="off"/>											
									</div>
									
									<div class="checkbox" style="display:none;">
										<label>
										  <input type="checkbox" autocomplete="off" id="remove-bg"> <span class="help-block"><?php echo language('designer_upload_remove_white_background', $lang); ?></span>
										</label>
									</div>
								</div>
								
								<div class="col-xs-6 col-md-6">
									<div class="form-group">
										<label><strong><?php echo language('designer_upload_accepted_file_types', $lang); ?></strong> <small>(<?php echo language('designer_upload_max_file_size', $lang); ?>: <?php echo settingValue($setting, 'site_upload_max', '0.5'); ?>MB)</small></label>
										<p><?php echo language('designer_upload_accept_the_following', $lang); ?>: <strong>PNG, JPG, GIF</strong></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="checkbox">
										<label>
										  <input type="checkbox" autocomplete="off" id="upload-copyright"> <span class="help-block"><?php echo language('designer_upload_please_read', $lang); ?> <a href="<?php echo settingValue($setting, 'site_upload_terms', '#'); ?>" target="_blank"><?php echo language('designer_upload_copyright_terms', $lang); ?></a>. <?php echo language('designer_upload_if_you_do_not_have_the_complete', $lang); ?></span>
										</label>
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-primary" id="action-upload"><?php echo language('upload_btn', $lang); ?></button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="upload-facebook">
							<?php echo language('designer_upload_facebook', $lang); ?>
						</div>
						<div class="tab-pane" id="uploaded-art">
							<div class="row" id="dag-files-images">
							</div>
							
							<div id="drop-area"></div>
							<div class="row col-md-12">
								<span class="help-block"><?php echo language('designer_upload_click_image_to_add_design', $lang); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Upload -->
	
	<!-- Begin Note -->
	<div class="modal fade" id="dg-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo language('designer_note_add_note', $lang); ?></h4>
				</div>
				<div class="modal-body">
				...
				</div>
			</div>
		</div>
	</div>
	<!-- End Note -->
	
	<!-- Begin Help -->
	<div class="modal fade" id="dg-help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo language('designer_help_designer_help', $lang); ?></h4>
				</div>
				<div class="modal-body">
					<p><?php echo language('designer_help_online_designer_allows_you_to', $lang); ?></p>
					<ul>
					  <li><?php echo language('designer_help_upload_images', $lang); ?></li>
					  <li><?php echo language('designer_help_create', $lang); ?></li>
					  <li><?php echo language('designer_help_mix_design', $lang); ?></li>						  
					</ul>
					
					<div id="help-tabs">
						<ul>
							<li><a href="<?php echo base_url(); ?>help/product.html"><?php echo language('designer_help_product_design',$lang); ?></a></li>
							<li><a href="<?php echo base_url(); ?>help/text.html"><?php echo language('add_text', $lang); ?></a></li>
							<li><a href="<?php echo base_url(); ?>help/art.html"><?php echo language('add_art', $lang); ?></a></li>
							<li><a href="<?php echo base_url(); ?>help/upload.html"><?php echo language('upload_btn', $lang); ?></a></li>
							<li><a href="<?php echo base_url(); ?>help/design_idea.html"><?php echo language('design_idea', $lang); ?></a></li>
							<li><a href="<?php echo base_url(); ?>help/tool.html"><?php echo language('designer_help_tools', $lang); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Help -->
	
	<!-- Begin My design -->
	<div class="modal fade" id="dg-mydesign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo language('my_design', $lang); ?></h4>
				</div>
				<div class="modal-body">
				...
				</div>
			</div>
		</div>
	</div>
	<!-- End my design -->
	
	<!-- Begin design ideas -->
	<div class="modal fade" id="dg-designidea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo language('design_ideas', $lang); ?></h4>
				</div>
				<div class="modal-body">
				...
				</div>
			</div>
		</div>
	</div>
	<!-- End design ideas -->	
	
	<!-- Begin team -->
	<div class="modal fade" id="dg-item_team_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo language('designer_team_enter_name', $lang); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="alert alert-danger fade in col-md-8" id="team_msg_error" style="display: none;"></div>
						<button class="btn btn-primary input-sm pull-right" onclick="design.team.addMember()" type="button"><?php echo language('add_team_member_btn', $lang); ?></button>
					</div>
					<div class="row">
						<div class="col-md-12 table-box-team-list">
							<table class="table" id="table-team-list">
						<thead>
							<tr>
								<th width="5%"><?php echo language('designer_team_order', $lang); ?></th>
								<th width="40%"><?php echo language('name', $lang); ?></th>
								<th width="25%"><?php echo language('number', $lang); ?></th>
								<th width="20%"><?php echo language('size', $lang); ?></th>
								<th width="10%"><?php echo language('designer_team_remove', $lang); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo language('close_btn', $lang); ?></button>
					<button type="button" class="btn btn-primary" onclick="design.team.save()"><?php echo language('save_btn', $lang); ?></button>
				</div>
			</div>
		</div>
	</div>
	<!-- End design ideas -->			
	
	<!-- Begin fonts -->
	<div class="modal fade" id="dg-fonts" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>						
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<?php echo language('designer_fonts_font_categories', $lang); ?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu font-categories" role="menu"></ul>
					</div>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 list-fonts"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End fonts -->
	
	<!-- Begin preview -->
	<div class="modal fade" id="dg-preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>						
				</div>
				<div class="modal-body" id="dg-main-slider">					
				</div>
			</div>
		</div>
	</div>
	<!-- End preview -->
	
	<!-- Begin Share -->
	<div class="modal fade" id="dg-share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>						
					<h4><?php echo language('designer_share_save_completed', $lang); ?></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo language('designer_share_your_design_link', $lang); ?>:</label>
						<input type="text" class="form-control" id="link-design-saved" value="" readonly>
					</div>
					
					<div class="form-group row">
						<label class="col-md-1" style="line-height: 24px;"><?php echo language('designer_share', $lang); ?>: </label>
						<div class="col-md-1">
							<a href="javascript:void(0)" onclick="design.share.email()" class="icon-25 share-email" title="Email"></a>
						</div>
						<div class="col-md-1">
							<a href="javascript:void(0)" onclick="design.share.facebook()" class="icon-25 share-facebook" title="Facebook"></a> 
						</div>
						<div class="col-md-1">
							<a href="javascript:void(0)" onclick="design.share.twitter()" class="icon-25 share-twitter" title="Twitter"></a>
						</div>
						<div class="col-md-1">
							<a href="javascript:void(0)" onclick="design.share.pinterest()" class="icon-25 share-pinterest" title="Pinterest"></a> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Share -->
</div>

<div class="popover right" id="dg-popover">
		<div class="arrow"></div>
		<h3 class="popover-title"><span><?php echo language('designer_clipart_edit_size_position', $lang); ?></span> <a href="javascript:void(0)" class="popover-close"><i class="glyphicons remove_2 glyphicons-12 pull-right"></i></a></h3>
		<div class="popover-content">
		
			<!-- BEGIN clipart edit options -->
			<div id="options-add_item_clipart" class="dg-options">
				<div class="dg-options-toolbar">
					<div aria-label="First group" role="group" class="btn-group btn-group-lg">						
						<button class="btn btn-default btn-action-edit" type="button" data-type="edit">
							<i class="glyphicon glyphicon-tint"></i> <small class="clearfix"><?php echo language('edit', $lang); ?></small>
						</button>
						<button class="btn btn-default btn-action-colors" type="button" data-type="colors">
							<i class="glyphicon glyphicon-tint"></i> <small class="clearfix"><?php echo language('colors', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="size">
							<i class="fa fa-text-height"></i> <small class="clearfix"><?php echo language('size', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="rotate">
							<i class="fa fa-rotate-right"></i> <small class="clearfix"><?php echo language('rotate', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="functions">
							<i class="fa fa-cogs"></i> <small class="clearfix"><?php echo language('designer_functions', $lang); ?></small>
						</button>
					</div>
				</div>
				
				<div class="dg-options-content">
					<div class="row toolbar-action-edit">					
						<div id="item-print-colors">
						</div>
					</div>
					<div class="row toolbar-action-size">
						<div class="col-xs-3 col-lg-3 align-center">
							<div class="form-group">
								<small><?php echo language('width', $lang); ?></small>
								<input type="text" size="2" id="clipart-width" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3 col-lg-3 align-center">
							<div class="form-group">
								<small><?php echo language('height', $lang); ?></small>
								<input type="text" size="2" id="clipart-height" readonly disabled>
							</div>
						</div>
						<div class="col-xs-6 col-lg-6 align-left">
							<div class="form-group">
								<small><?php echo language('designer_clipart_edit_unlock_proportion', $lang); ?></small><br />
								<input type="checkbox" class="ui-lock" id="clipart-lock" />
							</div>
						</div>
					</div>
					
					<div class="row toolbar-action-rotate">					
						<div class="form-group col-lg-12">
							<div class="row">
								<div class="col-xs-6 col-lg-6">
									<small><?php echo language('rotate', $lang); ?></small>
								</div>
								<div class="col-xs-6 col-lg-6 align-right">
									<span class="rotate-values"><input type="text" value="0" class="input-small rotate-value" id="clipart-rotate-value" />&deg;</span>
									<span class="rotate-refresh glyphicons refresh"></span>
								</div>
							</div>						
						</div>
					</div>
					
					<div class="row toolbar-action-colors">
						<div id="clipart-colors">
							<div class="form-group col-lg-12 text-left position-static">
								<small><?php echo language('designer_clipart_edit_choose_your_color', $lang); ?></small>
								<div id="list-clipart-colors" class="list-colors"></div>
							</div>
						</div>
					</div>
					
					<div class="row toolbar-action-functions">	
						<div class="col-lg-12 form-group">
							<span class="btn btn-default btn-xs" onclick="design.item.flip('x')">
								<i class="glyphicons transfer glyphicons-12"></i>
								 <?php echo language('designer_clipart_edit_flip', $lang); ?>
							</span>							
							<span class="btn btn-default btn-xs" onclick="design.item.center()">
								<i class="glyphicons align_center glyphicons-12"></i>
								 <?php echo language('designer_clipart_edit_center', $lang); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- END clipart edit options -->
			
			<!-- BEGIN Text edit options -->
			<div id="options-add_item_text" class="dg-options">
				<div class="dg-options-toolbar">
					<div aria-label="First group" role="group" class="btn-group btn-group-lg">
						<button class="btn btn-default" type="button" data-type="text">
							<i class="fa fa-pencil"></i> <small class="clearfix"><?php echo language('designer_text', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="fonts">
							<i class="fa fa-font"></i> <small class="clearfix"><?php echo language('designer_fonts', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="style">
							<i class="fa fa-align-justify"></i> <small class="clearfix"><?php echo language('designer_style', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="outline">
							<i class="fa fa-crop"></i> <small class="clearfix"><?php echo language('outline', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="size">
							<i class="fa fa-text-height"></i> <small class="clearfix"><?php echo language('size', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="rotate">
							<i class="fa fa-rotate-right"></i> <small class="clearfix"><?php echo language('rotate', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="functions">
							<i class="fa fa-cogs"></i> <small class="clearfix"><?php echo language('designer_functions', $lang); ?></small>
						</button>
					</div>
				</div>
				
				<div class="dg-options-content">
					<!-- edit text -->
					<div class="row toolbar-action-text">
						<div class="col-xs-12">
							<textarea class="form-control text-update" data-event="keyup" data-label="text" id="enter-text"></textarea>
						</div>
					</div>
					
					<div class="row toolbar-action-fonts">
						<div class="col-xs-8">
							<div class="form-group">
								<small><?php echo language('choose_a_font', $lang); ?></small>
								<div class="dropdown" data-target="#dg-fonts" data-toggle="modal">
									<a id="txt-fontfamily" class="pull-left" href="javascript:void(0)">
									<?php echo language('designer_clipart_edit_arial', $lang); ?>
									</a>
									<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s pull-right"></span>
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								<small><?php echo language('designer_clipart_edit_text_color', $lang); ?></small>
								<div class="list-colors">
									<a class="dropdown-color" id="txt-color" title="Click to change color" href="javascript:void(0)" data-color="black" data-label="color" style="background-color:black">
										<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="clear-line"></div>
					<div class="clear"></div>
					
					<div class="row toolbar-action-style">
						<div class="col-xs-6">
							<small><?php echo language('designer_clipart_edit_text_style', $lang); ?></small>
							<div id="text-style">
								<span id="text-style-i" class="text-update btn btn-default btn-xs glyphicons italic glyphicons-12" data-event="click" data-label="styleI"></span>
								<span id="text-style-b" class="text-update btn btn-default btn-xs glyphicons bold glyphicons-12" data-event="click" data-label="styleB"></span>							
								<span id="text-style-u" class="text-update btn btn-default btn-xs glyphicons text_underline glyphicons-12" data-event="click" data-label="styleU"></span>
							</div>
						</div>
						<div class="col-xs-6">
							<small><?php echo language('designer_clipart_edit_text_align', $lang); ?></small>
							<div id="text-align">
								<span id="text-align-left" class="text-update btn btn-default btn-xs glyphicons align_left glyphicons-12" data-event="click" data-label="alignL"></span>
								<span id="text-align-center" class="text-update btn btn-default btn-xs glyphicons align_center glyphicons-12" data-event="click" data-label="alignC"></span>
								<span id="text-align-right" class="text-update btn btn-default btn-xs glyphicons align_right glyphicons-12" data-event="click" data-label="alignR"></span>
							</div>
						</div>
					</div>
					
					<div class="clear"></div>
					
					<div class="row toolbar-action-outline">
						<!--
						<div class="col-xs-6">
							<small>Text Options</small>
							<div id="text-shape">
								<div class="dropdown">
									<a href="#" class="pull-left" data-toggle="dropdown">
									Normal <i class="caret"></i>
									</a>								
									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										<li><span class="text-update" data-label="wspacing" data-event="click">Word Spacing</span></li>
										<li><span class="text-update" data-label="style" data-value="letter-spacing:2" data-event="click">Letter Spacing</span></li>									
									</ul>
								</div>
							</div>
						</div>
						-->
						<div class="col-xs-6">
							<small><?php echo language('outline', $lang); ?></small>
							<div class="option-outline">							
								<div class="list-colors">
									<a class="dropdown-color bg-none" data-label="outline" data-placement="top" data-original-title="<?php echo language('designer_click_to_change_color', $lang); ?>" href="javascript:void(0)" data-color="none">
										<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span>
									</a>
								</div>
								<div class="dropdown-outline">
									<a data-toggle="dropdown" class="dg-outline-value" href="javascript:void(0)"><span class="outline-value pull-left">0</span> <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s pull-right"></span></a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										<li><div id="dg-outline-width"></div></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" style="display:none;">
						<div class="col-lg-12">
							<small><?php echo language('designer_clipart_edit_adjust_shape', $lang); ?></small>
							<div id="dg-shape-width"></div>
						</div>
					</div>
									
					<div class="clear"></div>
					
					<div class="row toolbar-action-size">
						<div class="col-xs-3 col-lg-3 align-center">
							<div class="form-group">
								<small><?php echo language('width', $lang); ?></small>
								<input type="text" size="2" id="text-width" readonly disabled>
							</div>
						</div>
						<div class="col-xs-3 col-lg-3 align-center">
							<div class="form-group">
								<small><?php echo language('height', $lang); ?></small>
								<input type="text" size="2" id="text-height" readonly disabled>
							</div>
						</div>
						<div class="col-xs-6 col-lg-6 align-left">
							<div class="form-group">
								<small><?php echo language('designer_clipart_edit_unlock_proportion', $lang); ?></small><br />
								<input type="checkbox" class="ui-lock" id="text-lock" />
							</div>
						</div>
					</div>
					
					<div class="row toolbar-action-rotate">					
						<div class="form-group col-lg-12">
							<div class="row">
								<div class="col-xs-6 col-lg-6">
									<small><?php echo language('rotate', $lang); ?></small>
								</div>
								<div class="col-xs-6 col-lg-6 align-right">
									<span class="rotate-values"><input type="text" value="0" class="input-small rotate-value" id="text-rotate-value" />&deg;</span>
									<span class="rotate-refresh glyphicons refresh"></span>
								</div>
							</div>						
						</div>
					</div>
					
					<div class="row toolbar-action-functions">	
						<div class="col-lg-12">
							<span class="btn btn-default btn-xs" onclick="design.item.flip('x')">
								<i class="glyphicons transfer glyphicons-12"></i>
								<?php echo language('designer_clipart_edit_flip', $lang); ?>
							</span>
							<span class="btn btn-default btn-xs" onclick="design.item.center()">
								<i class="glyphicons align_center glyphicons-12"></i>
								<?php echo language('designer_clipart_edit_center', $lang); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- END clipart edit options -->
			
			<!-- BEGIN team edit options -->
			<div id="options-add_item_team" class="dg-options">
				<div class="dg-options-toolbar">
					<div aria-label="First group" role="group" class="btn-group btn-group-lg">
						<button class="btn btn-default" type="button" data-type="name-number">
							<i class="glyphicons soccer_ball glyphicons-small"></i> <small class="clearfix"><?php echo language('add_name', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="teams">
							<i class="fa fa-users"></i> <small class="clearfix"><?php echo language('designer_teams', $lang); ?></small>
						</button>
						<button class="btn btn-default" type="button" data-type="add-list">
							<i class="fa fa-user"></i> <small class="clearfix"><?php echo language('add_team', $lang); ?></small>
						</button>						
					</div>
				</div>
				
				<div class="dg-options-content">
					<input type="hidden" id="team-height" value="">
					<input type="hidden" id="team-width" value="">
					<input type="hidden" id="team-rotate-value" value="0">
					<div class="row toolbar-action-name-number">
						<div class="col-md-12 position-static">
							<div class="checkbox">
								<label>
									<input type="checkbox" id="team_add_name" onclick="design.team.addName(this)" autocomplete="off"> <strong><?php echo language('add_name', $lang); ?></strong>
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" id="team_add_number" onclick="design.team.addNumber(this)" autocomplete="off"> <strong><?php echo language('designer_clipart_edit_add_number', $lang); ?></strong>
								</label>
							</div>
							
							<div class="form-group row">
								<div class="col-xs-3 col-md-3 position-static">
									<div class="list-colors">
										<a class="dropdown-color" id="team-name-color" data-placement="right" title="<?php echo language('designer_click_to_change_color', $lang); ?>" href="javascript:void(0)" data-color="000000" data-label="colorT" style="background-color:black">
											<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span>
										</a>
									</div>
								</div>
								<div class="col-xs-9 col-md-9">
									<div data-toggle="modal" data-target="#dg-fonts" class="dropdown">
										<a href="javascript:void(0)" class="pull-left" id="txt-team-fontfamly"><?php echo language('designer_clipart_edit_arial', $lang); ?></a>
										<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s pull-right"></span>
									</div>
								</div>
							</div>
						</div>
					</div>					
					
					<div class="row toolbar-action-teams">
						<div class="col-md-12">
							<span class="help-block">
								<?php echo language('designer_clipart_edit_enter_your_full_list', $lang); ?>
							</span>
						</div>
						
						<div class="col-md-12">
							<div class="clear-line"></div><br>
						</div>
						
						<div class="col-md-12 div-box-team-list">
							<table id="item_team_list" class="table table-bordered">
								<thead>
									<tr>
										<td width="70%"><strong><?php echo language('name', $lang); ?></strong></td>
										<td width="10%"><strong><?php echo language('number', $lang); ?></strong></td>
										<td width="20%"><strong><?php echo language('size', $lang); ?></strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="left"> </td>
										<td align="center"> </td>
										<td align="center"> </td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="clear-line"></div><br>
					<div class="row toolbar-action-add-list">
						<div class="col-md-12">
							<center><button class="btn btn-primary input-sm" data-target="#dg-item_team_list" data-toggle="modal" type="button"><?php echo language('designer_clipart_edit_add_list_name', $lang); ?></button><center>
						</div>
					</div>
				</div>
			</div>
			<!-- END team edit options -->
		</div>
    </div>
	
	<!-- BEGIN colors system -->
	<div class="o-colors" style="display:none;">		
		<div class="other-colors"></div>
	</div>
	<!-- END colors system -->
	
	
	<div id="cacheText"></div>
	
	<?php if (isset($product->design)) {?>
	<script type="text/javascript">
		var min_order = '<?php echo $product->min_order; ?>';
		var product_id = '<?php echo $product->id; ?>';
		var print_type = '<?php echo $product->print_type; ?>';
		var uploadSize = [];
		uploadSize['max']  = '<?php echo settingValue($setting, 'site_upload_max', '10'); ?>';
		uploadSize['min']  = '<?php echo settingValue($setting, 'site_upload_min', '0.5'); ?>';
		var items = {};
		items['design'] = {};
		<?php 
		$js = '';
		$elment = count($product->design->color_hex);
		for($i=0; $i<$elment; $i++)
		{			
			$js .= "items['design'][$i] = {};";
			$js .= "items['design'][$i]['color'] = \"".$product->design->color_hex[$i]."\";";
			$js .= "items['design'][$i]['title'] = \"".$product->design->color_title[$i]."\";";
			$postions	= array('front', 'back', 'left', 'right');
			foreach ($postions as $v)
			{
				$view = $product->design->$v;				
				if (count($view) > 0) 
				{
					if (isset($view[$i]) == true)
					{
						$item = (string) $view[$i];						
						$js .= "items['design'][".$i."]['".$v."']=\"".$item."\";";						
					}
					else
					{
						$js .= "items['design'][$i]['$v'] = '';";
					}
				}
				else
				{
					$js .= "items['design'][$i]['$v'] = '';";
				}				
			}
		}
		echo $js;
		?>
		items['area']	= {};
		items['area']['front'] 	= "<?php echo $product->design->area->front; ?>";
		items['area']['back'] 	= "<?php echo $product->design->area->back; ?>";
		items['area']['left'] 	= "<?php echo $product->design->area->left; ?>";
		items['area']['right']	= "<?php echo $product->design->area->right; ?>";		
		items['params']	= [];		
		items['params']['front']	= "<?php echo $product->design->params->front; ?>";		
		items['params']['back']	= "<?php echo $product->design->params->back; ?>";		
		items['params']['left']	= "<?php echo $product->design->params->left; ?>";		
		items['params']['right']	= "<?php echo $product->design->params->right; ?>";		
	</script>
	<?php } ?>
	
	<!-- BEGIN: popup cart -->
	<div class="modal fade" id="cart_notice" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo language('close_btn', $lang); ?></span></button>
			</div>
			<div class="modal-body">        
				<h5><strong><?php echo language('cart_mgs', $lang); ?></strong></h5>
				<div class="row">
					<div class="col-md-5 cart-added-img"></div>
					<div class="col-md-7 cart-added-info"></div>
				</div>
				<div class="row cart-button">
					<div class="col-md-6 pull-left text-left">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo language('continue_design', $lang); ?></button>
					</div>
					<div class="col-md-6 pull-right text-right">
						<a href="<?php echo site_url('cart'); ?>" class="btn btn-primary btn-sm"><?php echo language('checkout', $lang); ?></a>
					</div>
				</div>
			</div>
		</div>
	  </div>
	</div>	
	<!--end-->
	
	<div id="save-confirm" title="Save Your Design" style="display:none;">
		<p><?php echo language('designer_saved_design_confirm', $lang); ?></p>
	</div>

	<!--end-->
	<!--facebook-->
	<div id="id_login"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<!--End facebook-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/design_upload.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		<?php if( (string)$color  !== '0' ){ ?>
		design.imports.productColor('<?php echo (string)$color; ?>');
		<?php } ?>
		
		<?php if( $design_id  != '' ){ ?>
		design.imports.loadDesign('<?php echo $design_id; ?>');
		<?php } ?>
	});
		
	//Minh.js
	<?php $settings = getSettings(); ?>
	window.fbAsyncInit = function() {
		FB.init({
		  appId      : '<?php if(isset($settings->app_id))echo $settings->app_id;?>', // App ID
		  status     : true, // check login status
		  cookie     : true, // enable cookies to allow the server to access the session
		  xfbml      : true  // parse XFBML
		});
	}
	
	function facebook_login(){
		FB.login(function(response) {
			if (response.authResponse) 
			{
				FB.api('/me', function(response) {
					var email_address = response.email;
					if(email_address != '')
					{
						login('facebook');
					}
				});
			}
			else
			{
				console.log('User cancelled login or did not fully authorize.');
			}
		},{scope:'email,user_photos'});
		return false;
	};
	
	<?php if(isset($this->session->userdata('user')->status) && $this->session->userdata('user')->status == 1){ ?>
		jQuery('document').ready(function(){
			login('logged');
		});
	<?php }else{ ?>
		jQuery('.menu-top').children('ul').show();
	<?php } ?>
	
	<?php if($this->session->flashdata('msg') != ''){?>
		alert('<?php echo $this->session->flashdata('msg');?>');
	<?php } ?>
	</script>