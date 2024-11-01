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

use \SpEFLInc\Base\BaseController;
use \SpEFLInc\Api\EbayFeedbacksApi;

class Enqueue extends BaseController
{	
     
	public function register() {
		$feedbackController = new EbayFeedbacksApi();

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue' ) );
		add_action( 'wp_ajax_nopriv_sp_ebay_review_fetch', array( $feedbackController, 'SpEbayFeedbackHandler' ) );
		add_action( 'wp_ajax_sp_ebay_review_fetch', array( $feedbackController, 'SpEbayFeedbackHandler') );
	}
	
	function admin_enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'admin_css_style', $this->plugin_url . 'assets/admin/css/style.css' );
		wp_enqueue_script( 'admin_js_script', $this->plugin_url . 'assets/admin/js/script.js', array('jquery','moment') );
	}

	function public_enqueue() {
		$feedbackController = new EbayFeedbacksApi();

		// enqueue all our scripts
		wp_enqueue_style( 'public_css_ebay_feedbacks', $this->plugin_url . 'assets/public/css/ebay_feedbacks.css' );
		wp_enqueue_script( 'public_js_ebay_feedbacks', $this->plugin_url . 'assets/public/js/ebay_feedbacks.js', array('jquery', 'moment') );
		
		$title_nonce = wp_create_nonce( $feedbackController->getSecretKey() );
		$url = admin_url( 'admin-ajax.php' );

		wp_localize_script( 'public_js_ebay_feedbacks', 'sp_ebay_review', array(
			'ajax_url' => $url,
			'nonce'    => $title_nonce,
		 ) );
	}

}