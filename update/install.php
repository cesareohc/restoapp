<?php
error_reporting(0);
$db_config_path = '../application/config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST) {
    
	require_once('includes/taskCoreClass.php');
	require_once('includes/databaseLibrary.php');

	$core = new Core();
	$database = new Database();


	if($core->checkEmpty($_POST) == true)
	{

            if($database->create_database($_POST) == false)
            {
                    $message = "The database could not be created, make sure your the host, username, password, database name is correct.";
                    echo json_encode(array('st'=>0,'msg'=> $message));
            } 
            else if ($database->create_tables($_POST)['st'] == false)
            {
                    echo json_encode(array('st'=>0,'msg'=> $database->create_tables($_POST)['msg']));
            }
            else if ($core->checkFile() == false)
            {
                    $message = "File application/config/database.php is Empty";
                    echo json_encode(array('st'=>0,'msg'=> $message));
            }
            else if ($core->write_db_config($_POST) == false)
            {
                    $message = "The database configuration file could not be written, please chmod application/config/database.php file to 777";
                    echo json_encode(array('st'=>0,'msg'=> $message));
            }
            
            else if ($database->registration($_POST)['st'] == false)
            {
                    echo json_encode(array('st'=>0,'msg'=> $database->registration($_POST)['msg']));
            }
            else
            {   
                 echo json_encode(array('st'=>1));  
            }   

           
	}
	else {
		$message ='The host, username, password, database name, and others informations are required.';
        echo json_encode(array('st'=>0,'msg'=> $message));
	}
	
	
}


?>
