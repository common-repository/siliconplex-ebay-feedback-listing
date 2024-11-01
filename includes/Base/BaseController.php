<?php 
/**
 * @package  SpEbay
 
 * Powered by Siliconplex
 * Contact: Usama Ayaz
 * Email: usama.ayaz@siliconplex.com
 * Website: http://www.siliconplex.com

 * 
 */
namespace SpEFLInc\Base;

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;
	public $plugin_key;

	public $admin_menu_icon;
	
	public $pages_settings_sections_fields = array();
	
	
	public function __construct() {
		
		$this->plugin_path = plugin_dir_path( dirname(dirname(__FILE__) ) );
		$this->plugin_url = plugin_dir_url( dirname(dirname(__FILE__) ) );
		$this->plugin = plugin_basename( dirname(dirname(dirname(__FILE__) ) ) ) . '/sp-ebay.php';
		$this->plugin_key = 'sp_ebay';

		$this->admin_menu_icon = 'dashicons-admin-customizer';
		
		$this->pages_settings_sections_fields = array(
			$this->plugin_key.'_auth' => array(
				//'menu_slug' => 'sp_ebay_auth'
				'page_title' => 'SP Feedbacks eBay > Auth By Siliconplex.com',
				'menu_title' => 'SP Feedbacks - eBay',
				'capability' => 'manage_options',
				'callback' => 'authPage',
				'icon_url' => 'dashicons-admin-customizer',
				'position' => 110,

				'section' => array(
					//'id' => 'sp_ebay_auth_section',
					'title' => 'Credentials',
					'callback' => 'authSection',
					// 'page' => 'sp_ebay_auth'
				),
				'fields' => array(
					'_user_id' => array( 
						'label' => 'User ID',
						'place_holder' => 'User ID',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => '',
						'callback' => 'textbox',
						'name' => 'sp_ebay_auth_user_id'
					),
					'_dev_id'  => array( 
						'label' => 'Dev ID',
						'place_holder' => 'Dev ID',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => '( <a href="https://developer.ebay.com/DevZone/XML/docs/HowTo/Tokens/GettingTokens.html#step1" target="_blank">How to get dev id?</a> )',
						'callback' => 'textbox',
						'name' => 'sp_ebay_auth_dev_id'
					),
					'_app_id'  => array( 
						'label' => 'App ID / Client ID',
						'place_holder' => 'App ID',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => '( <a href="https://developer.ebay.com/DevZone/XML/docs/HowTo/Tokens/GettingTokens.html#step1" target="_blank">How to get dev id?</a> )',
						'callback' => 'textbox',
						'name' => 'sp_ebay_auth_app_id'
					),
					'_cert_id' => array( 
						'label' => 'Client Secret',
						'place_holder' => 'Client Secret',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => '( <a href="https://developer.ebay.com/DevZone/XML/docs/HowTo/Tokens/GettingTokens.html#step1" target="_blank">How to get client secret?</a> )',
						'callback' => 'textbox',
						'name' => 'sp_ebay_auth_cert_id'
					),
					'_token'   => array( 
						'label' => 'Token',
						'place_holder' => 'Token',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => '( <a href="https://developer.ebay.com/DevZone/XML/docs/HowTo/Tokens/GettingTokens.html#step1" target="_blank">How to get user token?</a> )',
						'callback' => 'textbox',
						'name' => 'sp_ebay_auth_token'
					)
				)

			),
			$this->plugin_key.'_feedbacks' => array(
				//'menu_slug' => 'sp_ebay_auth'
				'page_title' => 'Ebay Feedbacks > Settings By Siliconplex.com',
				'menu_title' => 'Feedbacks Settings',
				'capability' => 'manage_options',
				'callback' => 'feedbacksPage',
				'parent_slug' => $this->plugin_key.'_auth',

				'section' => array(
					//'id' => 'sp_ebay_auth_section',
					'title' => 'Manage',
					'callback' => 'feedbacksSection',
					// 'page' => 'sp_ebay_auth'
				),
				'fields' => array(
					'_list_title' => array( 
						'label' => 'List Title',
						'place_holder' => 'Enter Your Title',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => 'Widget Title to be displayed on the above of the grid.',
						'callback' => 'textbox',
						'name' => 'sp_ebay_feedbacks_list_title'
					),
					'_datetime_format' => array( 
						'label' => 'Datetime Format',
						'place_holder' => 'Datetime Format',
						'classes' => 'sp-ebay-text-field-full',
						'note_label' => '( <a href="https://momentjs.com/docs/#/displaying/" target="_blank">Valid Datetime Formats</a> )',
						'callback' => 'textbox',
						'name' => 'sp_ebay_feedbacks_datetime_format'
					),
				)
			)
		);

		

	}
}