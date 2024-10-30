<?php




function mups_upload_max_file_sizes1() {



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



		Max upload size allowed upto 5MB. <a href ="https://ziscom.today/product/max-upload-filesize/">Buy Pro Version</a> for increasing limit upto 1000 GB (Gigabytes).
		

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



add_filter('upload_size_limit', 'mups_upload_max_increase_upload1');



