<?php 
	$lang = getLanguages();
?>

<div class="form-group">
	<div class="row">
		<label class="col-sm-3 control-label"><?php echo language('cart_number', $lang); ?></label>
		<div class="col-sm-8">
			<input class="form-control input-sm validate <?php if(isset($checked) && $checked != '') echo 'required'; ?>" type="text" name="card_num" placeholder="<?php echo language('cart_number', $lang); ?>">
		</div>
	</div>
</div>

<div class="form-group">
	<div class="row">
		<label class="col-sm-3 control-label"><?php echo language('exp_date', $lang); ?></label>
		<div class="col-sm-4">
			<input class="form-control input-sm <?php if(isset($checked) && $checked != '') echo 'required'; ?>" type="text" name="exp_date" placeholder="<?php echo language('exp_date', $lang); ?>">
			<div class="help-block"><?php echo language('authorize_date_help', $lang); ?></div>
		</div>
	</div>
</div>