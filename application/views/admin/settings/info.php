<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-external-link-square icon-external-link-sign"></i>
		PHP INFO SUPPORT
	</div>
	<div class="panel-body">
		<span class="help-block">Please configure your php setting to match requirement listed below</span>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="30%" class="center">PHP Settings</th>
					<th width="15%" class="center">Current Settings</th>
					<th width="15%" class="center">Required Settings</th>
					<th width="15%" class="center">Status</th>
					<th width="25%" class="center">Help</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>PHP version</td>
					<td class="center"><?php echo PHP_VERSION; ?></td>
					<td class="center">>= 5.2.4</td>
					<td class="center">
						<?php  
							if (version_compare(PHP_VERSION, '5.2.4') >= 0)
								echo '<span class="text-success">Yes</span>';
							else
								echo '<span class="text-danger">No</span>';
						?>
					</td>
					<td>
						<?php 
							if (version_compare(PHP_VERSION, '5.2.4') < 0)
								echo '1. Go to control panel.<br>
									  2. Click the PHP Configuration button.<br>
									  3. Click the Update button.';
						?>
					</td>
				</tr>
				<tr>
					<td>PHP Imagick Support</td>
					<td class="center">
						<?php 
							if(class_exists('imagick'))
								echo 'Yes';
							else
								echo 'No';
						?>
					</td>
					<td class="center">Yes</td>
					<td class="center">
						<?php 
							if(class_exists('imagick'))
								echo '<span class="text-success">Yes</span>';
							else
								echo '<span class="text-danger">No</span>';
						?>
					</td>
					<td>
						<?php 
							if(!class_exists('imagick'))
								echo '1. Go to <a href="http://imagemagick.org">http://imagemagick.org</a>. Choose version to match server.<br>
									  2. Download and Installation';
						?>
					</td>
				</tr>
				<?php 
					if(!defined('CURL_VERSION_IPV6'))
					{
						echo '<tr>
								<td>IPV6</td>
								<td class="center">No</td>
								<td class="center">Yes</td>
								<td class="center"><span class="text-danger">No</span></td>
								<td>You can contact supplier the service.</td>
							</tr>';
					}
				?>
				<?php 
					if(!defined('CURLOPT_IPRESOLVE'))
					{
						echo '<tr>
							<td>PHP CURLOPT_IPRESOLVE Support</td>
							<td class="center">No</td>
							<td class="center">Yes</td>
							<td class="center">No</td>
							<td>
								Added in CURL 7.10.8<br>
								1. Go to <a href="http://curl.haxx.se">http://curl.haxx.se</a><br>
								2. Download and Installation.
							</td>
						</tr>';
					}
				?>
				<tr>
					<td>MySQL Support</td>
					<td class="center">
						<?php 
							if(function_exists("mysql_connect"))
								echo 'Yes';
							else
								echo 'No';
						?>
					</td>
					<td class="center">Yes</td>
					<td class="center">
						<?php 
							if(function_exists("mysql_connect"))
								echo '<span class="text-success">Yes</span>';
							else
								echo '<span class="text-danger">No</span>';
						?>
					</td>
					<td>
						<?php
							if(!function_exists("mysql_connect"))
							{
								echo 'Check database info.';
							}
						?>
					</td>
				</tr>
				<?php
					$permissions = array(
						0=>APPPATH .DS. 'cache',
						1=>ROOTPATH .DS. 'media',
						1=>ROOTPATH .DS. 'image-tool',
						1=>ROOTPATH .DS. 'image-tool' .DS. 'cache' .DS. 'timthumb_cacheLastCleanTime.touch',
						2=>APPPATH .DS. 'language' .DS. 'english' .DS. 'lang.ini',
						3=>APPPATH .DS. 'views' .DS. 'layouts' .DS. '404' .DS. '404.php',
						4=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'blog' .DS. 'category.php',
						5=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'blog' .DS. 'post.php',
						6=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'cart' .DS. 'cart.php',
						7=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'cart' .DS. 'checkout.php',
						8=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'categories' .DS. 'default.php',
						9=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'components' .DS. 'footer.php',
						10=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'components' .DS. 'head.php',
						11=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'design' .DS. 'default.php',
						12=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'home' .DS. 'default.php',
						13=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'idea' .DS. 'categories.php',
						14=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'idea' .DS. 'category.php',
						15=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'payment' .DS. 'confirm.php',
						16=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'product' .DS. 'default.php',
						17=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'search' .DS. 'all.php',
						18=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'user' .DS. 'login.php',
						19=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'user' .DS. 'profile.php',
						20=>APPPATH .DS. 'views' .DS. 'layouts' .DS. 'user' .DS. 'register.php',
					);
					foreach($permissions as $permiss)
					{
						if ( !is_writable($permiss) )
						{
							if(DS == '\\')
								$permiss = str_replace('/\\', '\\', $permiss);
							else
								$permiss = str_replace('//', '/', $permiss);
								
							echo '<tr>';
							echo '<td>'.$permiss.' Writeable</td>';
							echo '<td class="center">No</td>';
							echo '<td class="center">Yes</td>';
							echo '<td class="center"><span class="text-danger">No</span></td>';
							echo '<td>
									  1. Go to control panel.<br>
									  2. Find to path: "'.$permiss.'"<br>
									  3. Permission: 755<br>
								  </td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>