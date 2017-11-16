<?php
 class captcha
 {
public static function checkresponce($response){
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => '6Lfu_DgUAAAAAHFoJrBqtg2r93DSEuwh6z5f2g4v',
			'response' => $_POST["g-recaptcha-response"]
		);
		$options = array(
			'http' => array (
				'method' => 'POST',
				'header' =>
				"Content-Type: application/x-www-form-urlencoded\r\n".
				"Authorization: Bearer sdf541gs6df51gsd1bsb16etb16teg1etr1ge61g\n",
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$verify = file_get_contents($url, false, $context);
		$captcha_success=json_decode($verify);
		return $captcha_success->success;
	
}
}