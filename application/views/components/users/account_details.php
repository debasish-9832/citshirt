<script src="<?php echo site_url();?>assets/plugins/validate/validate.js"></script>	
<?php $lang = getLanguages(); ?>
<div class="profile">
	<h2><?php echo language('user_account_detail', $lang);?></h2>
	<hr/>
	<?php if(isset($msg)) { ?><div class="alert alert-success"><?php echo $msg; ?></div><?php } ?>
	<?php if(isset($error)) { ?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_account_info', $lang); ?></h4>
				</div>
				
				<div class="panel-body">
					<form class="form-horizontal" action="<?php echo site_url('user/accountdetails'); ?>" method="POST">
						<div class="form-group">
							<label class="control-label col-md-2"><?php echo language('user_name', $lang); ?><span class="symbol required"></span></label>
							<div class="col-md-6">
								<input class="form-control validate required" name="name" data-maxlength="255" data-minlength="2" data-msg="<?php echo language('user_name_validate_msg', $lang); ?>" value="<?php echo set_value('name', $user->name); ?>">
							</div>
						</div>
						
						<?php
							if(count($form_value))
							{
								foreach($form_value as $val)
								{
									$data_fields[$val->field_id] = $val->value;
								}
							}
							foreach($forms as $form)
							{
								echo '<div class="form-group">';
								$required = '';
								if($form->validate == 1)
									$required = '<span class="symbol required"></span>';
								if($form->title != '' && $form->type != 'checkbox') echo '<label class="control-label col-md-2">'.$form->title.$required.'</label>';
								$params = json_decode($form->params);
								
								// set value.
								if(!isset($data_fields[$form->id]) && $form->type == 'checkbox')
									$data_fields[$form->id] = '';
								elseif(!isset($data_fields[$form->id]))
									$data_fields[$form->id] = $form->value;
								$validate = '';
								if($form->validate == 1)
									$validate = 'validate required';
										
								if($form->type == 'text'){
									echo '<div class="col-md-6">';
									echo '<input class="form-control '.$validate.'" type="text" name="fields['.$form->id.']" placeholder="'.$form->title.'" data-minlength="2" data-maxlength="200" data-msg="'.$form->title.' must be at least 2 to 200 characters." value="'.$data_fields[$form->id].'">';
									echo '</div>';
								}elseif($form->type == 'email'){
									echo '<div class="col-md-6">';
									echo '<input class="form-control '.$validate.'" type="text" name="fields['.$form->id.']" placeholder="'.$form->title.'" data-type="email" data-msg="Email format is incorrect" value="'.$data_fields[$form->id].'">';
									echo '</div>';
								}elseif($form->type == 'password'){
									echo '<div class="col-md-6">';
									echo '<input class="form-control '.$validate.'" type="password" name="fields['.$form->id.']" placeholder="'.$form->title.'" data-minlength="6" data-maxlength="128" data-msg="'.$form->title.' must be at least 6 to 128 characters." value="'.$data_fields[$form->id].'">';
									echo '</div>';
								}elseif($form->type == 'radio'){
									echo '<div class="col-md-6">';
									$value = json_decode($form->value, true);
									if(is_array($value))
									{
										foreach($value as $key=>$val)
										{
											$checked = '';
											if($data_fields[$form->id] == $val)
												$checked = 'checked="checked"';
											echo '<label class="radio-inline"><input type="radio" '.$checked.' name="fields['.$form->id.']" value="'.$val.'"> '.$key.'</label>';
										}
									}
									echo '</div>';
								}elseif($form->type == 'checkbox'){
									$checked = '';
									if($data_fields[$form->id] == $form->value)
										$checked = 'checked="checked"';
									echo '<div class="col-md-2"></div>';	
									echo '<div class="col-md-6">';
									echo '<div class="checkbox">';
									echo '<label><input type="checkbox" name="fields['.$form->id.']" '.$checked.' value="'.$form->value.'" placeholder="'.$form->title.'"> '.$form->title.'</label>';
									echo '</div>';
									echo '</div>';
								}elseif($form->type == 'select'){
									$values	= json_decode($form->value);
									
									if (count($values) > 0)
									{
										$field	= '<select autocomplete="off" name="fields['.$form->id.']" class="form-control '.$validate.'">';
										foreach ($values as $key => $value)
										{
											if ($data_fields[$form->id] == $value)
												$selected	= 'selected="selected"';
											else
												$selected	= '';
												
											$field	.= '<option value="'.$value.'" '.$selected.'> '.$key.'</option>';
										}
										$field	.= '</select>';
										echo '<div class="col-md-6">';
										echo $field;
										echo '</div>';
									}
								}elseif($form->type == 'textarea'){
									echo '<div class="col-md-6">';
									echo '<textarea rows="3" class="form-control '.$validate.'" name="fields['.$form->id.']">'.$data_fields[$form->id].'</textarea>';
									echo '</div>';
								}
								echo '</div>';
							}
						?>
						<div class="form-group">
							<div class="col-md-2"></div>
							<div class="col-md-6">
								<button class="btn btn-primary" type="submit"><?php echo language('save_btn', $lang);?></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_your_account', $lang);?></h4>
				</div>
				
				<div class="panel-body">
					<ul class="nav nav-list list-manager">
						<li <?php if(uri_string() == 'user/myaccount') echo 'class="active"';?>><a href="<?php echo site_url('user/myaccount'); ?>"><?php echo language('my_account', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/accountdetails') echo 'class="active"';?>><a href="<?php echo site_url('user/accountdetails'); ?>"><?php echo language('user_account_detail', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/changepass') echo 'class="active"';?>><a href="<?php echo site_url('user/changepass'); ?>"><?php echo language('user_change_password', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/orderhistory' || strpos(uri_string(), '/orderdetail')) echo 'class="active"';?>><a href="<?php echo site_url('user/orderhistory'); ?>"><?php echo language('user_order_history', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/userdesign/default') echo 'class="active"';?>><a href="<?php echo site_url('user/userdesign/default'); ?>"><?php echo language('user_manage_design', $lang);?></a></li>
						<li><a href="<?php echo site_url('users/logout'); ?>"><?php echo language('logout', $lang);?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery('.form-horizontal').validate();
</script>