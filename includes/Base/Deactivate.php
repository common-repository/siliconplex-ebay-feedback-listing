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

/**
* 
*/

class Deactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}