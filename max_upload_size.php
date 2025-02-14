<?php



/*******************************


 * Plugin Name:  Max upload size

 
 * Plugin URI:   https://ziscom.today/product/max-upload-filesize/


 * Description:  Maximize your upload_max_filesize 


 * Version:      1.6


 * Author:       Ziscom


 * Author URI:   https://ziscom.today


 * License:      GPL2 or later


 *******************************/


 
 



// व्यवस्थापक मेनू जोड़ने के लिए हुक



add_action('admin_menu', 'mups_upload_max_file_size_add_pages');







// ऊपर हुक के लिए कार्रवाई समारोह



if ( !function_exists( 'mups_upload_max_file_size_add_pages' ) ) {



	function mups_upload_max_file_size_add_pages() {



		// सेटिंग्स के तहत एक नया मेनू जोड़ें



		add_menu_page(__('mups_upload_max_file_size', 'upload-max'), __('Max Upload Size', 'upload-max'), 'manage_options', 'mups_upload_max_file_size', 'mups_upload_max_file_size');



	}



}







// प्लगइन डैश बोर्ड पृष्ठ



function mups_upload_max_file_size() {



	?>



    <form method="post">



        <?php



        settings_fields("header_section");



        do_settings_sections("manage_options"); 
		
		
		$x = 5242880;


        wp_nonce_field('mups_upload_max_file_size_action', 'mups_upload_max_file_size_field');


        submit_button();



		$val = 5242800;



		?>



		<br/><br/> <br/>Only enter the numeric value in bytes (eg. 104857600)<br/><br/>



        1024 bytes = 1KB <br/>



		<?php $y = $x; ?>



		1048576 bytes = 1MB <br/>



		(Formula: 1048576 * number of MB required = number of Bytes to enter in above form) <br/>



        <br/>



		<?php $val2 = $val; ?>



		Max upload size allowed upto 5MB. Give us a <a href ="https://wordpress.org/plugins/max-upload-size/">5 star review</a> for increasing limit upto 1000 GB (Gigabytes).
		<br/>Once done email us at support@ziscom.today and we will match your email name with latest 5star review and send you full version of plugin, as soon as possible - within 24 hours. 
		

		<br/>



        <br/><br/><br/>



		<?php



			add_option('mus_size', $val2);

			add_option('mus_m', $y);



		?>



    </form>



    <?php



	//सबमिट प्रपत्र प्रारंभ 



    if (!isset($_POST['mups_upload_max_file_size_field']) || !wp_verify_nonce($_POST['mups_upload_max_file_size_field'], 'mups_upload_max_file_size_action')) {



        echo "<div style='float:left';>Please enter a value and save to change max file size.</div><div style='float:right; box-sizing: border-box; display: inline-block; width: 218px; border: 4px solid #0377AA;     padding: 16px 20px;'><a href='https://www.paypal.me/isingh559'><img src='https://ziscom.today/wp-content/uploads/2019/07/cropped-Logo3-1-32x32.jpg' style='margin-left: 42px;'><button style='background-color: #0073aa;



    border: 1px solid #33b3db; position: relative; display: inline-block; font-family: sans-serif; font-size: 13px; line-height: 24px; font-weight: 700; padding: 12px 34px; color: #fff; text-transform: uppercase;'>Donate</button></a></div>";



	exit;



    } else {

	$x = $_POST['number'];
	$z = get_option('mus_m');

	if($x <= 5242880){

        $number = sanitize_text_field($_POST['number']);

        update_option('max_file_size', $number);

	}

    }





}







//फ़िल्टर



add_filter('upload_size_limit', 'mups_upload_max_increase_upload');



function mups_upload_max_increase_upload() {

	

    return get_option('max_file_size');



}







//अनुभाग का नाम, प्रदर्शन नाम, खंड का वर्णन मुद्रित करने के लिए कॉलबैक, पृष्ठ किस अनुभाग में अनुलग्न है ।



function mups_max_display_options() {

	



    add_settings_section("header_section", "Increase Upload Maximum File Size", "mups_max_display_header_options_content", "manage_options");



    add_settings_field("header_logo", "Enter Value In Number", "mups_max_display_logo_form_element", "manage_options", "header_section");



    register_setting("header_section", "number");



}







function mups_max_display_header_options_content() {



    echo "";



}







function mups_max_display_logo_form_element() {



	$val = get_option('mus_size');

	$maxl = get_option('mus_m');

	

     printf(



            '<input type="number" max="'.$val.'" id="number" name="number" value="%s" />',



            (null!==get_option('max_file_size') ) ? esc_attr( get_option('max_file_size')) : ''



        );



}







add_action("admin_init", "mups_max_display_options");



?>