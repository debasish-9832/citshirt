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

class breadcrumbs extends Frontend_Controller{ 

	public function __construct(){ 
		parent::__construct();		
		$this->load->helper('url');
	} 
	
	public function index($id = '')
	{
		if(empty($GLOBALS['breadcrumbs']))
			$GLOBALS['breadcrumbs'] = array();
		$breadcrumbs = $GLOBALS['breadcrumbs'];		
		$this->breadcrumbs_m = $this->load->model('breadcrumbs/breadcrumbs_m');		
		$breadcrumb = $this->breadcrumbs_m->getBreadcrumb($id);
		
		if(count($breadcrumb) && count($breadcrumbs))
		{
			$css = getCss($breadcrumb, 'module');
			$this->data['css']	= $css;	
			$this->data['breadcrumb'] = $breadcrumb;	
			$this->data['breadcrumbs'] = $breadcrumbs;	
			$this->load->view('breadcrumbs', $this->data);
		}
	}
}