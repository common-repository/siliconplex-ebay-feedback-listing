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

class AdminCallbacks extends BaseController
{
	public function adminAuth()
	{
		return require_once( "$this->plugin_path/templates/admin/auth.php" );
	}

	public function adminFeedbacks()
	{
		return require_once( "$this->plugin_path/templates/admin/feedbacks.php" );
	}



	public function authSection()
	{
		echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
	}

	public function checkboxSanitize( $input )
	{
		$output = array();

		foreach ( $this->managers as $key => $value ) {
			$output[$key] = isset( $input[$key] ) ? true : false;
		}

		return $output;
	}

	

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );
		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}
}