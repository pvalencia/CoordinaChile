<?php
class DATABASE_CONFIG {
	var $development = array(
		'driver' => 'sqlite',
		'database' => LOC_DATABASE
	);
	
	var $default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'coordina_root',
		'password' => 'coordinachile',
		'database' => 'coordina_chile',
		'encoding' => 'UTF-8',
		'prefix' => '',
	);
	
	var $test = array(
		'driver' => 'sqlite',
		'database' => '/home/rvalenzu/coordinachile/coordinachile.sqlite'
	);

        function __construct() {

                #wildcard the subdomains
		if(!isset($_SERVER['SERVER_NAME'])) {
			$this->default = $this->development;
			return;
		}
		
                $host_r = explode('.', $_SERVER['SERVER_NAME']);
                if(count($host_r)>2) while(count($host_r)>2)array_shift($host_r);
                $mainhost = implode('.', $host_r);

                #switch between servers
                switch(strtolower($mainhost)) {
                        case 'localhost':
                                $this->default = $this->development;
                                break;
				
                }
        }

        #php 4 compatibility
        function DATABASE_CONFIG() {
                $this->__construct();
        }

}
?>
