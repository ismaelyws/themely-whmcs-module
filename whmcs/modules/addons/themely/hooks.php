<?php
/**
 * WHMCS Themely Module Hooks File
 *
 * @copyright Copyright (c) 2021 inVenture Group DBA Themely
 */
add_hook('ClientAreaHeadOutput', 1, function(array $vars) {
    if ($vars['templatefile']=='configureproduct') {
    return <<<HTML
	<link rel="stylesheet" type="text/css" href="modules/addons/themely/templates/css/directory.css" />
	<script type="text/javascript" src="modules/addons/themely/templates/js/directory.js"></script>
	HTML;
	}
});

add_hook('ClientAreaPageCart', 1, function(array $vars) {
    if ($vars['templatefile']=='configureproduct') {
		$array = json_decode(trim(file_get_contents("https://d108fh6x7uy5wn.cloudfront.net/themes.json")), true);
		$themes = $array['themes'];
		return array("themely" => $themes);
	}
});

function hook_themely_cp_session($vars) {
	$hostname = $vars['params']['serverhostname'];
    $username = $vars['params']['username'];
    $password = $vars['params']['password'];
	$url = 'https://' . $hostname . ':2087/json-api/create_user_session?api.version=1&user=' . $username . '&service=cpaneld';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$header[0] = "Authorization: Basic " . base64_encode($username.":".$password) . "\n\r";
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_URL, $url);
	$result = curl_exec($curl);
	if ($result == false) {
	    error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $url");
	}
	$decoded_response = json_decode( $result, true );
	$themely_cp_session = $decoded_response['data']['cp_security_token'];
	return $themely_cp_session;
}
add_hook('AfterModuleCreate', 10, "hook_themely_cp_session");

function hook_themely_wp_install($vars) {
	$themely_cp_session = hook_themely_cp_session($vars);
	$hostname = $vars['params']['serverhostname'];
    $username = $vars['params']['username'];
    $password = $vars['params']['password'];
    $wp_site_name = 'My WordPress Website';
    $wp_site_tagline = 'Just another WordPress site';
    $wp_admin_username = $vars['params']['customfields']['WordPress Admin Username'];
    $wp_admin_password = $vars['params']['customfields']['WordPress Admin Password'];
    $wp_theme_slug = $vars['params']['customfields']['WordPress Theme Slug'];
    $wp_theme_url = $vars['params']['customfields']['WordPress Theme URL'];
    $wp_admin_email = $vars['params']['clientsdetails']['email'];
    $wp_site_protocol = 'http://www.';
    $wp_site_domain = $vars['params']['domain'].'|'.'/home/'.$vars['params']['username'].'/public_html';
    $wp_db_name = 'wp';
    $wp_db_user = 'wp';
    $wp_table_prefix = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
    $wp_submit_btn_value = 'Install WordPress';
    if (isset($wp_theme_slug) || isset($wp_theme_url)) {
    	$wp_theme_slug = $vars['params']['customfields']['WordPress Theme Slug'];
    	$wp_theme_url = $vars['params']['customfields']['WordPress Theme URL'];
    } else {
    	// If user doesn't select a theme during check, change the values of the two following variables to install a different theme
	    // Leave blank '' to install the default Twenty Twenty-One theme
	    // Enter 'latest' to install the latest theme in the directory
	    // Enter 'random' to install a random theme from the directory
	    $wp_theme_slug = ''; // CHANGE VALUES HERE
	    $wp_theme_url = ''; // CHANGE VALUES HERE
	}
	$data = array(
		'wp_site_name' => $wp_site_name,
		'wp_site_description' => $wp_site_tagline,
		'wp_admin_username' => $wp_admin_username,
		'wp_admin_password' => $wp_admin_password,
		'wp_admin_email' => $wp_admin_email,
		'wp_site_protocol' => $wp_site_protocol,
		'wp_site_domain' => $wp_site_domain,
		'wp_db_name' => $wp_db_name,
		'wp_db_user' => $wp_db_user,
		'wp_table_prefix' => $wp_table_prefix,
		'wp_theme_slug' => $wp_theme_slug,
		'wp_theme_url' => $wp_theme_url,
		'submit' => $wp_submit_btn_value,
	);
	$url = 'https://'.$hostname.':2083'.$themely_cp_session.'/frontend/paper_lantern/themely/index.live.php';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$header[0] = "Authorization: Basic ".base64_encode($username.":".$password)."\n\r";
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);   
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data) );
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
	$result = curl_exec($curl);
	if ($result == false) {
	    error_log("curl_exec threw error \"".curl_error($curl)."\" for $url");   
	}
	curl_close($curl);
}
add_hook('AfterModuleCreate', 10, "hook_themely_wp_install");