<?php

class Tests_Token_Management extends WP_UnitTestCase {

	public function tearDown() {
		parent::tearDown();
	}

	public function test_get_access_token() {

        parent::setUp();

        $this->assertTrue(class_exists('MZ_Mindbody\Inc\Common\Token_Management'));
        
        $basic_options_set = array(
            'mz_source_name' => MBOTests\Test_Options::$_MYSOURCENAME,
            'mz_mindbody_password' => MBOTests\Test_Options::$_MYPASSWORD,
            'mz_mbo_app_name' => MBOTests\Test_Options::$_MYAPPNAME,
            'mz_mbo_api_key' => MBOTests\Test_Options::$_MYAPIKEY,
            'mz_mindbody_siteID' => '-99'
        );
        
        add_option( 'mz_mbo_basic', $basic_options_set, '', 'yes' );
		
        $basic_options = get_option('mz_mbo_basic');
                
        $tm = new MZ_Mindbody\Inc\Common\Token_Management;
        
        $result = $tm->serve_token();
        
        $this->assertTrue( ctype_alnum($result) );
        
	}
	
	public function test_stored_token_storage() {

        parent::setUp();

        $this->assertTrue(class_exists('MZ_Mindbody\Inc\Common\Token_Management'));
        
        $basic_options_set = array(
            'mz_source_name' => MBOTests\Test_Options::$_MYSOURCENAME,
            'mz_mindbody_password' => MBOTests\Test_Options::$_MYPASSWORD,
            'mz_mbo_app_name' => MBOTests\Test_Options::$_MYAPPNAME,
            'mz_mbo_api_key' => MBOTests\Test_Options::$_MYAPIKEY,
            'mz_mindbody_siteID' => '-99'
        );
        
        add_option( 'mz_mbo_basic', $basic_options_set, '', 'yes' );
		
        $basic_options = get_option('mz_mbo_basic');
                
        $tm = new MZ_Mindbody\Inc\Common\Token_Management;

        $initial_token = $tm->serve_token(); // this should save and return a new token
                        
        $tm = new MZ_Mindbody\Inc\Common\Token_Management;
        
        $new_token = $tm->serve_token(); // this should serve saved token
                
        $this->assertTrue( $new_token == $initial_token );        
        
	}

}