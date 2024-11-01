<?php 
/**
 * @package  SpEbay
 
 * Powered by Siliconplex
 * Contact: Usama Ayaz
 * Email: usama.ayaz@siliconplex.com
 * Website: http://www.siliconplex.com

 * 
 */
namespace SpEFLInc\Api\Callbacks;

use SpEFLInc\Base\BaseController;

class PagesCallbacks extends BaseController
{
	public function authPage()
	{
		return require_once( "$this->plugin_path/templates/admin/auth.php" );
	}

	public function feedbacksPage()
	{
		return require_once( "$this->plugin_path/templates/admin/feedbacks.php" );
	}
}