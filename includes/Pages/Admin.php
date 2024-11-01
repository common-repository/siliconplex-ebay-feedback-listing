<?php 
/**
 * @package  SpEbay
 
 * Powered by Siliconplex
 * Contact: Usama Ayaz
 * Email: usama.ayaz@siliconplex.com
 * Website: http://www.siliconplex.com

 * 
 */
namespace SpEFLInc\Pages;

use \SpEFLInc\Base\BaseController;
use \SpEFLInc\Api\SettingsApi;
use \SpEFLInc\Api\Callbacks\PagesCallbacks;
use \SpEFLInc\Api\Callbacks\SectionsCallbacks;
use \SpEFLInc\Api\Callbacks\FieldsCallbacks;


class Admin extends BaseController
{
	public $settings;

	public $callbacks_pages;
	public $callbacks_sections;
	public $callbacks_fields;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks_pages = new PagesCallbacks();
		$this->callbacks_sections = new SectionsCallbacks();
		$this->callbacks_fields = new FieldsCallbacks();

		$this->setPagesAndSubpages();

		// $this->setPages();
		// $this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Auth' )->addSubPages( $this->subpages )->register();
	}


	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Ebay Feedbacks By Siliconplex.com', 
				'menu_title' => 'Ebay Feedbacks', 
				'capability' => 'manage_options', 
				'menu_slug' => $this->plugin_key.'_auth', 
				'callback' => array( $this->callbacks_pages, 'authPage' ), 
				'icon_url' => $this->admin_menu_icon, 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => $this->plugin_key.'_auth', 
				'page_title' => 'Feedbacks', 
				'menu_title' => 'Feedbacks', 
				'capability' => 'manage_options', 
				'menu_slug' => $this->plugin_key.'_feedbacks', 
				'callback' => array( $this->callbacks_pages, 'feedbacksPage' )
			)
		);
	}


	public function setPagesAndSubpages()
	{

		foreach ( $this->pages_settings_sections_fields as $page_key => $page ) {

			if(isset($page['parent_slug'])){
				array_push(
					$this->subpages,
					array(
						'menu_slug' =>  $page_key,
						'parent_slug' => $page['parent_slug'], 
						'page_title' => $page['page_title'], 
						'menu_title' => $page['menu_title'], 
						'capability' => $page['capability'],  
						'callback' => array( $this->callbacks_pages, $page['callback'] )
					)
				);
			}
			else{
				array_push(
					$this->pages,
					array(
						'menu_slug' =>  $page_key,
						'page_title' => $page['page_title'], 
						'menu_title' => $page['menu_title'], 
						'capability' => $page['capability'],  
						'callback' => array( $this->callbacks_pages, $page['callback'] ),
						'icon_url' => $this->admin_menu_icon, 
						'position' => 110
					)
				);
			}
		}
	}






	//------------------------------------------------------------------------------------------------------------------

	public function setSettings()
	{

		$args = array();

		foreach ( $this->pages_settings_sections_fields as $page_key => $page_settings_sections_field ) {
			foreach ( $page_settings_sections_field['fields'] as $field_key => $field_att) {
				
				array_push(
					$args,
					array(
						'option_group' => $page_key.'_setting',
						'option_name' => $page_key.$field_key,
						'callback' => array( $this->callbacks_fields, $field_att['callback'].'Sanitize' )
					)
				);
			}
		}

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{

		$args = array();

		foreach ( $this->pages_settings_sections_fields as $page_key => $page_settings_sections_field ) {

			$section =  $page_settings_sections_field['section'];
			array_push(
				$args,
				array(
					'id' => $page_key.'_section',
					'title' => $section['title'],
					'callback' => array( $this->callbacks_sections, $section['callback'] ),
					'page' => $page_key
				)
			);
		}

		$this->settings->setSections( $args );
	}



	public function setFields()
	{


		$args = array();

		foreach ( $this->pages_settings_sections_fields as $page_key => $page_settings_sections_field ) {
			foreach ( $page_settings_sections_field['fields'] as $field_key => $field_att) {
				
				array_push(
					$args,
					array(
						'id' => $page_key.$field_key,
						'title' => $field_att['label'],
						'callback' => array( $this->callbacks_fields, $field_att['callback'].'Field' ),
						'page' => $page_key,
						'section' => $page_key.'_section',
						'args' => array(
							'id' => $page_key.$field_key,
							'place_holder' => $field_att['place_holder'],
							'classes' => $field_att['classes'],
							'note_label' => $field_att['note_label'],
							'name' => $field_att['name']
						)
					)
				);
			}
		}

		$this->settings->setFields( $args );
	}

	//------------------------------------------------------------------------------------------------------------------

}


