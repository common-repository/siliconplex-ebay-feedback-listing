<?php 

/**
 * @package  SpEbay
 
 * Powered by Siliconplex
 * Contact: Usama Ayaz
 * Email: usama.ayaz@siliconplex.com
 * Website: http://www.siliconplex.com

 * 
 */

 ?>
<h1>SP Ebay Feedbacks > Auth</h1>
<div class="wrap">
	<?php settings_errors(); ?>
	<form method="post" action="options.php">
		<?php 
			settings_fields( 'sp_ebay_auth_setting' ); //option_group of setting
			do_settings_sections( 'sp_ebay_auth' ); //page of section
			submit_button();
		?>
	</form>
	<br/>
	<div class="container">
		<h3>Instructions to display the Ebay Feedbacks:</h3>

		<p>
			<span>Add this shortcode to display the your ebay feedback lists: <b>[sp_sc_ebay_feedbacks]</b></span>
		</p>
		<p>
			<br/>
			<span>Copyright &copy; 2018-2019, Siliconplex. All Rights Reserved.</span>
		</p>
	</div>
</div>