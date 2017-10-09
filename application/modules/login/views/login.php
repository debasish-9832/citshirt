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
<div class="module-login">
<?php
	echo '<script type="text/javascript">var login_url_post = "'.site_url().'login/index/'.$login->id.'"</script>';
	echo $css;
	$user = $this->session->userdata('user');
	if(isset($user['id']) && $user['id'] != '')
	{
		echo '<div class="dropdown">
				<a id="user_info" class="dropdown-toggle" aria-expanded="false" role="button" aria-haspopup="true" data-toggle="dropdown" href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i> '.language('my_account', $lang).' <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="user_info">					
					<li><a href="'.site_url().'user/myaccount" title="'.language('user_profile', $lang).'">'.language('my_account', $lang).'</a></li>
					<li><a href="'.site_url().'user/changepass" title="'.language('user_change_password', $lang).'">'.language('user_change_password', $lang).'</a></li>
					<li><a href="'.site_url().'users/logout" title="'.language('logout', $lang).'">'.language('logout', $lang).'</a></li>
				</ul>
			</div>';
	}
	else
	{
		echo '<div class="dropdown">
				<a id="user_info" class="dropdown-toggle" aria-expanded="false" role="button" aria-haspopup="true" data-toggle="dropdown" href="javascript:void(0);"><i class="glyphicon glyphicon-user"></i> '.language('my_account', $lang).' <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="user_info">
					<li><a href="'.site_url().'user/login" title="'.language('login', $lang).'">'.language('login', $lang).'</a></li>
					<li><a href="'.site_url().'user/register" title="'.language('register', $lang).'">'.language('register', $lang).'</a></li>
					<li><a href="'.site_url().'user/forgotpassword" title="'.language('user_forgot_password', $lang).'">'.language('user_forgot_password', $lang).'</a></li>
				</ul>
			</div>';
	}
?>
</div>
