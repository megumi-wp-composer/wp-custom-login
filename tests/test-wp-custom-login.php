<?php

class CustomLoginTest extends WP_UnitTestCase {

	function test_sample() {
		new Megumi\WP\CustomLogin();
		$this->assertRegExp( '/<form name="custom_login_form"/', do_shortcode( '[login_form]' ) );
	}
}
