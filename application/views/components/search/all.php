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

$count = count($products) + count($designs) + count($blog);
$this->load->helper('text');
?>
<div class="row">
	<div class="col-sm-6 text-left">
		<h2><?php echo language('search_results', $lang); ?></h2>
		<p><?php echo language('search_all_your_search_for', $lang); ?> <strong><?php echo $keyword; ?></strong> <?php echo language('search_all_returned', $lang); ?> <?php echo $count; ?> <?php echo language('search_all_results', $lang); ?></p>
	</div>
	
	<div class="col-sm-6 text-right">
		<br/>
		<div class="text-left pull-right">
			<p><?php echo language('search_filter_by', $lang); ?></p>
			<a href="#" class="btn btn-default btn-sm"><span class="badge"><?php echo $count; ?></span> <?php echo language('all', $lang); ?></a>
			 <a href="#" class="btn btn-default btn-sm"><span class="badge"><?php echo count($products); ?></span> <?php echo language('products', $lang); ?></a>
			 <a href="#" class="btn btn-default btn-sm"><span class="badge"><?php echo count($designs); ?></span> <?php echo language('designs', $lang); ?></a>
			 <a href="#" class="btn btn-default btn-sm"><span class="badge"><?php echo count($blog); ?></span> <?php echo language('posts', $lang); ?></a>
		</div>
	</div>
</div>

<!-- list products -->
<?php if (count($products)) { ?>
<hr />
<h3><?php echo language('products', $lang); ?></h3>
<div class="row">
	<div class="category-products clearfix" style="display: table; width: 100%;">
		
		<?php foreach($products as $product) { ?>
		<div class="col-xs-6 col-sm-4 col-md-2 text-center form-group" style="display:inline-block;float:none;">
			
			<div class="thumbnail layout-product">
				<a title="<?php echo $product->title; ?>" href="<?php echo site_url('product/'.$product->id.'-'.$product->slug); ?>">
					<img class="img-responsive" alt="<?php echo $product->title; ?>" src="<?php echo base_url($product->image); ?>">
					<br />
					<center><?php echo $product->title; ?></center>
				</a>
			</div>
			
		</div>
		<?php } ?>
		
	</div>
</div>
<?php } ?>

<!-- list design -->
<?php if (count($designs)) { ?>
<h3><?php echo language('designs', $lang); ?></h3>
<hr />
<div class="row">
	<div class="category-products clearfix">
		
		<?php foreach($designs as $design) { ?>
		<div class="col-xs-6 col-sm-4 col-md-2 text-center form-group" style="display:inline-block;float:none;">
			<?php 
				$images = explode(';', $design->image);
				if(isset($images[0]))
					$image = $images[0];
				else
					$image = '';
			?>
			<div class="thumbnail layout-product">
				<a title="<?php echo $design->title; ?>" href="<?php echo site_url('design/index/'.$design->product_id.'/'.$design->product_options.'/'.$design->design_key); ?>">
					<img class="img-responsive" alt="<?php echo $design->title; ?>" src="<?php echo base_url($image); ?>">
					<br />
					<center><?php echo $design->title; ?></center>
				</a>
			</div>
			
		</div>
		<?php } ?>
		
	</div>
</div>
<?php } ?>

<!-- list blog -->
<?php if (count($blog)) { ?>
<h3><?php echo language('page_blog_posts', $lang); ?></h3>
<hr />
<div class="row">
	<div class="category-products clearfix">
		
		<?php foreach($blog as $post) { ?>
		<div class="col-md-12 form-group article-show">			
			<h5>
			<a title="<?php echo $post->title; ?>" href="<?php echo site_url('blog/post/'.$post->id.'-'.$post->slug); ?>">
				<strong><?php echo $post->title; ?></strong>
			</a>
			</h5>
			<p>
				<?php echo word_limiter(strip_tags($post->description), 40); ?>
			</p>
			<a title="<?php echo $post->title; ?>" href="<?php echo site_url('blog/post/'.$post->id.'-'.$post->slug); ?>" class="btn btn-xs btn-primary"> <?php echo language('read_more', $lang); ?></a>			
			
		</div>
		
		<?php } ?>
		
	</div>
</div>
<?php } ?>

<?php if ($count == 0) { ?>
<hr />
<h3><?php echo language('data_not_found', $lang); ?></h3>
<br />
<?php } ?>