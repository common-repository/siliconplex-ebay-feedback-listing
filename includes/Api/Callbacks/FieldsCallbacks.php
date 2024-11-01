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

class FieldsCallbacks extends BaseController
{

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
    

    public function textboxSanitize( $input )
	{
		return $input;
	}

	public function textboxField( $args )
	{
        $id = $args['id'];
        $name = $args['name'];
        $place_holder = $args['place_holder'];
        $classes = $args['classes'];
        $note_label = $args['note_label'];
        
        $value = esc_attr( get_option( $id ) );
        echo '<input type="text" class="' . $classes . ' id="' . $id . '" name="' . $name . '" value="' . $value . '" placeholder="' . $place_holder . '">'.
        '<lable>' . $note_label . '</label>';
	}
}

