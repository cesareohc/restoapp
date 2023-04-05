    <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');
     
    class MultiLanguageSwitcher extends CI_Controller
    {
        public function __construct() {
            parent::__construct();     
        }
        // create language Switcher method
        function switch($language = "") {   
            $setting = settings();  
            $language = ($language != "") ? $language : $setting['language'];
            $this->session->set_userdata('site_lang', $language);        
            redirect($_SERVER['HTTP_REFERER']);        
        }

        
    }
    ?>

