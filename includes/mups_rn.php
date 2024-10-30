<?php








function mups_max_display_header_options_contents() {



    echo "";



}







function mups_max_display_logo_form_elements() {



	$val = get_option('mus_size');

	$maxl = get_option('mus_m');

	

     printf(



            '<input type="number" max="'.$val.'" id="number" name="number" value="%s" />',



            (null!==get_option('max_file_size') ) ? esc_attr( get_option('max_file_size')) : ''



        );



}







add_action("admin_init", "mups_max_display_optionss");



?>