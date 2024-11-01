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
class Activate
{
	public static function activate() {
		flush_rewrite_rules();
	}
}