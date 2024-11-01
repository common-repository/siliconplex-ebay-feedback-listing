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

class SectionsCallbacks extends BaseController
{
	public function authSection()
	{
		echo 'Enter you Ebay account credentials to get connected.';
    }
    
    public function feedbacksSection()
	{
		echo 'Manage your Ebay feedbacks as seller.';
	}
}