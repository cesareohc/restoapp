<?php
error_reporting(1);
class Database {

	function create_database($data)
	{
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');
		if(mysqli_connect_errno())
			return false;
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);
		$mysqli->close();
		return true;
	}

	function create_tables($data)
	{
		// Connect to the database
		$conn = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);
		if(mysqli_connect_errno())
			return false;

		if (!$conn->select_db($data['database'])) {
		    $msg = "Sorry ".$data['database']." databse NOT EXISTS Please import database first";
			return ['st'=>false,'msg'=>$msg];
		}else{
			return ['st'=>true,'msg'=>''];
		}

	}

	function registration($data){
		$conn = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);
		if(mysqli_connect_errno())
			return false;

			$old_version = 2.7;
			$new_version = 2.8;
			$conn->query("SET sql_mode = ''");
			$conn->set_charset("utf8");
			$siteUrl =   str_replace(basename($_SERVER['SCRIPT_NAME']), '',$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
     		$siteUrl = str_replace('update/', '', $siteUrl);

     		$dt = new DateTime('now',new DateTimezone('Asia/Dhaka'));
	       	$date = $dt->format('Y-m-d H:i:s');


			$get = "SELECT * FROM settings";
			$result = $conn->query($get); 

			if($result->num_rows > 0):
				while ($row = $result-> fetch_array()) {
					if($row['version'] < 1.1):
						$msg = "You are missing some version. Please contact us to update";
						return ['st'=>false,'msg'=>$msg];
						exit();
					endif;

					if($row['version'] > 2.4):
						$msg = "You are using version {$row['version']}. No need to update from here. Just login as admin and wait, you will get the update wizard.";
						return ['st'=>false,'msg'=>$msg];
						exit();
					endif;



					if($row['version']==$new_version):

						if($row['version']==2.6){
							$result = $conn->query("SHOW COLUMNS FROM restaurant_list LIKE 'is_questions'");
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
							if(isset($row['Field'])){
								$st_1 = $conn->query('ALTER TABLE restaurant_list CHANGE  `is_questions` `is_question` INT  NOT NULL DEFAULT 0') or print json_encode(array('st'=>0,'msg'=>$conn->error));
							}


							$result1 = $conn->query("SHOW COLUMNS FROM staff_list LIKE 'questions'");
							$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
							if(isset($row1['Field'])){
								$st_1 = $conn->query('ALTER TABLE staff_list CHANGE  `questions` `question` INT  NOT NULL DEFAULT 0') or print json_encode(array('st'=>0,'msg'=>$conn->error));
							}

							$st_1 = $conn->query('ALTER TABLE settings MODIFY `social_sites` LONGTEXT NULL') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						}



						$msg = "You are using updated version. Thank you!";
						return ['st'=>false,'msg'=>$msg];
						exit();
					endif;

					if($row['version'] < 1.2){
						$new_version = 1.2;

						$conn->query('DROP TABLE language_data') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$query = '';
						$sqlScript = file('database/database_1.2.sql');

						foreach ($sqlScript as $line)	{

							$startWith = substr(trim($line), 0 ,2);
							$endWith = substr(trim($line), -1 ,1);

							if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
								continue;
							}

							$query = $query . $line;
							if ($endWith == ';') {
								mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
								$query= '';		
							}
						}



						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (currency_code VARCHAR(10) NOT NULL, icon VARCHAR(10) NOT NULL, dial_code VARCHAR(10) NOT NULL, country_id INT NOT NULL, is_whatsapp INT NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE settings ADD (is_order_video INT NOT NULL DEFAULT 1, environment VARCHAR(255) NOT NULL DEFAULT "live", is_user INT NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (is_payment INT NOT NULL, payment_by VARCHAR(10) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE users ADD (site_info VARCHAR(255) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE user_settings ADD (paypal_config VARCHAR(255) NOT NULL, stripe_config VARCHAR(255) NOT NULL, razorpay_config VARCHAR(255) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));




						$st_1 = $conn->query('ALTER TABLE settings ADD (site_url VARCHAR(255) NOT NULL,updated_at datetime)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE item_packages ADD (is_home INT NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$insert = $conn->query("UPDATE settings SET version=1.2,updated_at='$date',site_url='$siteUrl' WHERE id=1");

					} //end verion 1.2


					if($row['version'] < 1.3){
						$new_version = 1.3;

						$query = '';
						$sqlScript = file('database/database.sql');

						foreach ($sqlScript as $line)	{

							$startWith = substr(trim($line), 0 ,2);
							$endWith = substr(trim($line), -1 ,1);

							if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
								continue;
							}

							$query = $query . $line;
							if ($endWith == ';') {
								mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
								$query= '';		
							}
						}

						$st_1 = $conn->query('ALTER TABLE users ADD (dial_code VARCHAR(20) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE item_sizes ADD (shop_id INT(11) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE items ADD (in_stock INT(11) NOT NULL, remaining INT(11) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE item_packages ADD (in_stock INT(11) NOT NULL DEFAULT 0, remaining INT(11) NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (stock_status INT(11) NOT NULL DEFAULT 0, is_stock_count INT(11) NOT NULL, gmap_key VARCHAR(255) NOT NULL, is_gmap INT(11) NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (pickup_point INT(11) NOT NULL, es_time VARCHAR(20) NOT NULL, time_slot VARCHAR(20) NOT NULL, estimate_time datetime NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query("INSERT INTO language_data(keyword,type,english) VALUES 
							('stock_status','label','Stock Status'),
							('in_stock','label','In stock'),
							('remaining','label','remaining'),
							('reset_counter','label','reset counter'),
							('reset_stock_count','label','Stock Count will reset'),
							('delete_success','label','Delete successfull'),
							('availability','label','Availability'),
							('out_of_stock','label','Out of stock'),
							('set_stock','label','set stock'),
							('select_pickup_area','label','Select Pickup area'),
							('show_map','label','show map'),
							('google_map_api_key','label','Google map api key'),
							('pickup_point','label','Pickup Point'),
							('google_map_status','label','google map status'),
							('pickup_time_alert','label','Pickup time not set yet'),
							('dine-in','label','Dine in'),
							('create_table','label','Create table'),
							('table','label','Table'),
							('area','label','area'),
							('areas','label','areas'),
							('size','label','size'),
							('add_new_area','label','Add New Area'),
							('select_area','label','Select area'),
							('area_name','label','Area name'),
							('add_new_table','label','Add New Table'),
							('table_list','label','Table List'),
							('set_time','label','Set Time'),
							('set_prepared_time','label','Set Prepared Time'),
							('prepared_time','label','Prepared Time'),
							('hours','label','hours'),
							('minutes','label','Minutes'),
							('order_status','label','order status'),
							('order_accept_msg','label','Order Accept by shop. order will shift after'),
							('order_delivery_msg','label','Your order will on the way soon'),
							('select_table','label','Select Table')") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query("INSERT INTO `order_types` (`id`, `name`, `slug`, `status`, `is_order_types`, `created_at`) VALUES (NULL, 'Dine-in', 'dine-in', '1', '1', '2021-04-06 16:50:38')") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$insert = $conn->query("UPDATE settings SET version=1.3,updated_at='$date',site_url='$siteUrl' WHERE id=1");

					} // end versio  1.3


					if($row['version'] < 1.4){
						$new_version = 1.4;

						$st_1 = $conn->query('ALTER TABLE settings ADD (seo_settings text  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE user_settings ADD (seo_settings text  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query("INSERT INTO language_data(keyword,type,english) VALUES 
							('seo_settings','admin','Seo Settings'),
							('keyword','admin','keywords'),
							('description','admin','description'),
							('keywords','label','keywords')") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$insert = $conn->query("UPDATE settings SET version=1.4,updated_at='$date' WHERE id=1");
					}


					if($row['version'] < 1.5){
						$new_version = 1.5;

						$st_1 = $conn->query('ALTER TABLE order_item_list ADD (is_extras INT(11) NOT NULL DEFAULT 0, extra_id VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						
						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (is_extras INT(11) NOT NULL DEFAULT 0,delivery_area VARCHAR(255) NULL,is_preparing INT(11) NOT NULL DEFAULT 0,token_number VARCHAR(255) NULL,dine_id INT(11) NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE users ADD (hit INT(11) NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE item_packages ADD (table_no INT(11) NOT NULL DEFAULT 0,qr_link VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query("INSERT INTO features(id,features,slug,status,is_features,created_at) VALUES 
							('10','Digital Payment','online-payment','1','1','2021-06-01 23:04:31')") or print json_encode(array('st'=>0,'msg'=>$conn->error));
						
						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (is_kds INT(11) NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('CREATE TABLE `item_extras` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_id` int(11) NOT NULL,
						  `shop_id` int(11) NOT NULL,
						  `item_id` int(11) NOT NULL,
						  `ex_name` varchar(255) NOT NULL,
						  `ex_price` double NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;') or print json_encode(array('st'=>0,'msg'=>$conn->error));



						$st_1 = $conn->query('CREATE TABLE `dine_in` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(255) NOT NULL,
						  `price` double NOT NULL,
						  `table_no` int(11) NOT NULL,
						  `item_id` varchar(255) NOT NULL,
						  `status` int(11) NOT NULL DEFAULT 1,
						  `created_at` datetime NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query("INSERT INTO language_data(keyword,type,english) VALUES 
							('confirm_oder','admin','confirm oder'),
							('add_extras','admin','Add Extras'),
							('add_new_extras','admin','Add new extras'),
							('save','admin','save'),
							('write_you_name_here','user','Write Your Name Here'),
							('order_tracking','admin','Order Tracking'),
							('google_map_link','user','Google map link'),
							('status_history','user','Status History'),
							('just_created','user','Just created'),
							('status_from','user','Status from'),
							('by_admin','user','By admin'),
							('admin','user','Admin'),
							('order_is_on_the_way','user','Order is on the way'),
							('complete','user','Complete'),
							('new_order','user','New Order'),
							('served','user','served'),
							('serve','user','serve'),
							('start_preparing','user','Start Preparing'),
							('today_remaining_off','user','Today is our off day'),
							('prepared_finish','user','Prepared finish'),
							('create_menu','user','Create Menu'),
							('generate_qr_code','user','Generate QR code'),
							('menu_name','user','Menu name'),
							('download_qr','user','Download QR'),
							('congratulations','user','Congratulations'),
							('order_place_successfully','user','Order is completed and have been placed successfully'),
							('please_wait_msg','user','please wait..'),
							('token_number','user','token_number'),
							('create_qr','user','Create QR'),
							('qr_builder','user','Qr Builder'),
							('new_dine_order','user','new dine order'),
							('restaurant_dine_in','user','Restaurant Dine-in'),
							('kds','user','KDS'),
							('qr_code_generate_msg','user','After generate Qr code download the Qr code and add in you custom  flyer'),
							('extras','label','Extras')") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						   $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date' WHERE id=1");


					}

					if($row['version'] < 1.6){
						$new_version = 1.6;

						$st_1 = $conn->query('ALTER TABLE settings ADD (active_key VARCHAR(155) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

							$key = sha1($row['purchase_code'].$siteUrl.$row['active_code']);



							$result = $conn->query("SHOW COLUMNS FROM restaurant_list LIKE 'paypal_config'");
						    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						    if(!isset($row['Field'])){
						    	$conn->query('ALTER TABLE restaurant_list ADD (paypal_config VARCHAR(255) NULL, stripe_config VARCHAR(255) NULL,razorpay_config VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						       
						    }


							$st_1 = $conn->query('CREATE TABLE `staff_list` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `user_id` int(11) NOT NULL,
								  `uid` varchar(255) NOT NULL,
								  `name` varchar(255) NOT NULL,
								  `email` varchar(255) NOT NULL,
								  `phone` varchar(255) NOT NULL,
								  `password` varchar(255) NOT NULL,
								  `status` int(11) NOT NULL DEFAULT 1,
								  `last_login` datetime NOT NULL,
								  `created_at` datetime NOT NULL,
								  `permission` varchar(255) NOT NULL,
								  PRIMARY KEY (`id`)
								)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

							$st_1 = $conn->query('CREATE TABLE `permission_list` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `title` varchar(255) NOT NULL,
								  `slug` varchar(255) NOT NULL,
								  `status` int(11) NOT NULL DEFAULT 1,
								  PRIMARY KEY (`id`)
								)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						   $st_1 = $conn->query("INSERT INTO permission_list(id,title,slug,status) VALUES 
							(1, 'Add New Item', 'add', 1),
							(2, 'Update', 'update', 1),
							(3, 'Delete', 'delete', 1),
							(4, 'Control Settings', 'setting-control', 1),
							(5, 'Order Control', 'order-control', 1),
							(6, 'Profile Control', 'profile-control', 1),
							(7, 'Order cancel', 'order-cancel', 1),
							(8, 'Change Status', 'change-status', 1)") or print json_encode(array('st'=>0,'msg'=>$conn->error));


						   $st_1 = $conn->query("INSERT INTO language_data(keyword,type,english) VALUES 
							('order_running_msg','admin','Your order is still running! you can not oder same item until it completed'),
							('staff','admin','Staff'),
							('staff_list','admin','Staff list'),
							('permission_list','admin','permission list'),
							('add_straff','admin','Add Staff'),
							('email_exits_in','admin','Email already exist into user table'),
							('email_alreay_exits','admin','Email already exits'),
							('available_permossion','admin','Available permossion'),
							('not_found','label','Not found'),
							('live_order_status','label','Live order status'),
							('extras','label','Extras')") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						   $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',site_url='$siteUrl',active_key='$key' WHERE id=1");

					}

					if($row['version'] < 1.7){
						$new_version = 1.7;

						$st_1 = $conn->query('ALTER TABLE settings ADD (is_signup int(11) NOT NULL DEFAULT 1,	is_auto_verified int(11) NOT NULL DEFAULT 0, twillo_sms_settings TEXT NULL,license_name VARCHAR(255) NULL )') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE user_settings ADD (twillo_sms_settings TEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						   $st_1 = $conn->query("INSERT INTO language_data(keyword,type,english) VALUES 
							('trial_for_week','admin','Trial for 1 week'),
							('trial_for_fifteen','admin','Trial for 15 days'),
							('weekly','admin','Weekly'),
							('15_days','admin','15 days'),
							('is_signup','admin','Show signup button'),
							('is_auto_verified','admin','Auto approved Trail user'),
							('twillo_sms_settings','admin','Twillo SMS Settings'),
							('account_sid','admin','Account SID'),
							('auth_token','admin','Auth Token'),
							('twillo_virtual_number','admin','Twillo Virtual Number'),
							('inactive','admin','Inactive'),
							('accept_sms','admin','Accept SMS'),
							('complete_sms','admin','Complete SMS'),
							('sms_sent','admin','Message Sent'),
							('accept_message','admin','Accept Message'),
							('completed_message','admin','Completed Message'),
							('upgrade','admin','Upgrade'),
							('show','label','show')") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						    $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date' WHERE id=1");

						  
					}


					if($row['version'] < 1.8){
						$new_version = 1.8;

						$result = $conn->query("SHOW COLUMNS FROM user_settings LIKE 'twillo_sms_settings'");
						    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						    if(!isset($row['Field'])){
						    	$st_1 = $conn->query('ALTER TABLE user_settings ADD (twillo_sms_settings TEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						       
						    }

						$st_1 = $conn->query('ALTER TABLE staff_list ADD (role VARCHAR(255) NULL DEFAULT "staff",country_id VARCHAR(5) NULL )') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (customer_id int(11) NOT NULL,dboy_id int(11) NOT NULL,dboy_status int(11) NOT NULL,is_picked int(11) NOT NULL,is_db_accept int(11) NOT NULL,is_db_completed int(11) NOT NULL,discount VARCHAR(20)NULL, `dboy_accept_time` DATETIME NULL, `dboy_picked_time` DATETIME NULL, `dboy_completed_time` DATETIME NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (es_time int(11) NOT NULL,time_slot VARCHAR(20) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE settings ADD (country_id int(11) NOT NULL,is_update int(11) NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE items ADD (img_type int(11) NOT NULL DEFAULT 1, img_url VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE item_packages ADD (img_type int(11) NOT NULL DEFAULT 1, img_url VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						   $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
									('sorry_we_are_closed', 'label', '', 'Sorry We are closed'),
									('please_check_the_available_list', 'label', '', 'Please check the available list'),
									('paypal_environment', 'label', '', 'Paypal Environment'),
									('pickup_points', 'label', '', 'Pickup Points'),
									('order_is_waiting_for_picked', 'label', '', 'Order is waiting for picked'),
									('phone_already_exits', 'label', '', 'Phone already exits'),
									('customer_login', 'label', '', 'Customer Login'),
									('date', 'label', '', 'Date'),
									('order_status', 'label', '', 'Order status'),
									('customer', 'label', '', 'Customer'),
									('unit_price', 'label', '', 'Unit price'),
									('amount', 'label', '', 'Amount'),
									('export', 'label', '', 'Export'),
									('print', 'label', '', 'Print'),
									('customer_name', 'label', '', 'Customer Name'),
									('delivery_staff_panel', 'label', '', 'Delivery Staff panel'),
									('delivery_staff', 'label', '', 'Delivery Staff'),
									('default_prepared_time', 'label', '', 'Default Prepared time'),
									('total_earnings', 'label', '', 'Total Earnings'),
									('picked', 'label', '', 'Picked'),
									('mark_as_picked', 'label', '', 'Mark as picked'),
									('mark_as_completed', 'label', '', 'Mark as completed'),
									('mark_as_accepted', 'label', '', 'Mark as Accepted'),
									('account', 'label', '', 'Account'),
									('ongoing', 'label', '', 'On Going'),
									('earning', 'label', '', 'Earning'),
									('cod', 'label', '', 'COD'),
									('accepted_by_delivery_staff', 'label', '', 'Accepted By Delivery Staff'),
									('accepted_by', 'label', '', 'Accepted By'),
									('delivery_staff', 'label', '', 'Delivery Staff'),
									('picked_by_delivery_staff', 'label', '', 'Picked By Delivery Staff'),
									('picked_by', 'label', '', 'Picked By'),
									('delivered_by', 'label', '', 'Delivered By'),
									('customer_info', 'label', '', 'Customer info'),
									('delivered_by_delivery_staff', 'label', '', 'Delivered By Delivery Staff'),
									('thank_you_purchase_msg', 'label', '', 'Thank you for shopping with us . Please come again'),
									('ordered_placed', 'label', '', 'Order Placed'),
									('we_have_received_your_order', 'label', '', 'We have received your order'),
									('order_confirmed', 'label', '', 'Order confirmed'),
									('your_order_has_been_confirmed', 'label', '', 'Your order has beeb confirmed'),
									('Order Processed', 'label', '', 'Order Processed'),
									('date', 'label', '', 'Date'),
									('we_are_preparing_your_order', 'label', 'We are preparing your order', 'We are preparing your order'),
									('ready_to_pickup', 'label', 'Ready to pickup', 'Ready to pickup'),
									('your_order_is_ready_to_pickup', 'label', 'Your order is ready for pickup', 'Your order is ready for pickup'),
									('order_confirmed_by_dboy', 'label', 'Order confirm by delivery staff', 'Order confirm by delivery staff'),
									('order_accept_by_dboy', 'label', 'Order accepted by delivery staff', 'Order accepted by delivery staff'),
									('order_picked', 'label', 'Order Picked', 'Order Picked'),
									('order_picked_by_dboy', 'label', 'Order picked by delivery staff', 'Order picked by delivery staff'),
									('order_delivered', 'label', 'Order Delivered', 'Order Delivered'),
									('order_delivered_successfully', 'label', 'Order delivered successfully', 'Order delivered successfully'),
									('filter', 'admin', 'Filter', 'Filter'),
									('clear', 'admin', 'Clear', 'Clear'),
									('shipping_address', 'admin', 'Shipping Address', 'Shipping Address'),
									('get_direction', 'admin', 'Get direction', 'Get direction'),
									('call_now', 'admin', 'Call now', 'Call now'),
									('order_items', 'admin', 'OrderItems', 'OrderItems'),
									('shop_configuration', 'admin', 'Shop Configuration', 'Shop Configuration'),
									('staffs', 'admin', 'Staffs', 'Staffs'),
									('restaurants', 'admin', 'Restaurants', 'Restaurants'),
									('preferences', 'admin', 'Preferences', 'Preferences'),
									('recaptcha_settings', 'admin', 'Recaptcha Settings', 'Recaptcha Settings'),
									('on', 'admin', 'On', 'on'),
									('off', 'admin', 'Off', 'off'),
									('enable_to_allow_signup_system', 'admin', 'Enable to allow sign up users to your system', 'Enable to allow sign up users to your system'),
									('enable_to_allow_auto_approve', 'admin', 'Enable to allow auto-approved when users sign up to your system', 'Enable to allow auto-approved when users sign up to your system'),
									('enable_to_allow_email_verification', 'admin', 'Enable to allow email verification when users sign up to your system', 'Enable to allow email verification when users sign up to your system'),
									('enable_to_allow_free_email_verification', 'admin', 'Enable to allow email verification when users sign up with free package to your system', 'Enable to allow email verification when users sign up with free package to your system'),
									('user_get_an_invoice', 'admin', 'Users get an invoice when signing up to your system', 'Users get an invoice when signing up to your system'),
									('rating_in_landing_page', 'admin', 'Show rating in landing page', 'Show rating in landing page'),
									('show_signup_button', 'admin', 'Enable to Show signup button in menu', 'Enable to Show signup button in menu'),
									('auto_approve_trial_user', 'admin', 'Enable to Auto Approved trial users when registration in system', 'Enable to Auto Approved trial users when registration in system'),
									('add_restaurant', 'admin', 'Add New Restaurant', 'Add New Restaurant'),
									('country', 'admin', 'Country', 'Country'),
									('fifteen', 'admin', 'Fifteen', 'Fifteen'),
									('language_data', 'admin', 'Language Data', 'Language Data'),
									('enable_to_allow_in_your_system', 'admin', 'Enable to allow in your system', 'Enable to allow in your system'),
									('stock_counter', 'admin', 'Stock counter', 'Stock counter'),
									('payment_history', 'admin', 'Payment History', 'Payment History'),
									('default_email', 'admin', 'Default Email', 'Default Email'),
									('invoice', 'admin', 'Invoice', 'Invoice'),
									('table_order', 'admin', 'Table Order', 'Table Order'),
									('restaurant_configuration', 'admin', 'Restaurant configuration', 'Restaurant configuration'),
									('tables', 'admin', 'Tables', 'Tables'),
									('img_url', 'admin', 'Image URL', 'Image URL'),
									('dboy_list', 'admin', 'Delivery staff List', 'Delivery staff List'),
									('delivery_guy_login', 'admin', 'Delivery Guy Login', 'Delivery Guy Login'),
									('personal_info', 'admin', 'Personal Info', 'Personal Info'),
									('customer_panel', 'admin', 'Customer panel', 'Customer panel'),
									('orders', 'admin', 'Orders', 'Orders'),
									('pos_print', 'admin', 'POS Print', 'POS Print'),
									('change_password', 'admin', 'Change Password', 'Change Password'),
									('order_processed', 'admin', 'Order Processed', 'Order Processed'),
									('new_registration', 'admin', 'New Registration', 'New Registration'),
									('already_have_account', 'admin', 'Already have account', 'Already have account'),
									('login_success', 'admin', 'Login successfull', 'Login successfull'),
									('welcome', 'admin', 'Welcome', 'Welcome'),
									('invalid_login', 'admin', 'Invalid login', 'Invalid login'),
									('registration_successfull', 'admin', 'Registration successfull', 'Registration successfull'),
									('sorry', 'admin', 'Sorry', 'Sorry'),
									('top_10_selling_item', 'admin', 'Top 10 Selling Item', 'Top 10 Selling Item'),
									('top_10_most_earning_items', 'admin', 'Top 10 Most Earning Items', 'Top 10 Most Earning Items'),
									('total_amount', 'admin', 'Total Amount', 'Total Amount'),
									('times', 'admin', 'Times', 'Times');") or print json_encode(array('st'=>0,'msg'=>$conn->error));

						    $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date' WHERE id=1");

						  
					}


					if($row['version'] < 1.9){
						$new_version = 1.9;

						$st_1 = $conn->query('CREATE TABLE `shop_location_list` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_id` int(11) NOT NULL,
						  `shop_id` int(11) NOT NULL,
						  `address` varchar(255) NOT NULL,
						  `latitude` varchar(255) NOT NULL,
						  `longitude` varchar(255) NOT NULL,
						  `created_at` datetime NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						

						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (tax_fee double NOT NULL, min_order double NOT NULL,discount double NOT NULL,pickup_time_slots TEXT NULL,is_review int  NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE staff_list ADD (address TEXT  NULL,gmap_link TEXT  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE settings ADD (is_lang_list int  NOT NULL DEFAULT 1,purchase_date DATETIME NULL,license_code VARCHAR(255) NULL,is_update int(11) NOT NULL DEFAULT 0,is_item_search int  NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (tax_fee double NOT NULL, sub_total double NOT NULL, `pickup_time` VARCHAR(255) NULL,customer_rating VARCHAR(50) NULL, customer_review TEXT NULL,rating_time DATETIME NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						
						$st_1 = $conn->query('ALTER TABLE order_user_list MODIFY discount double NOT NULL') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE `settings` ADD `razorpay_key_id` VARCHAR(255) NULL AFTER `razorpay_key`') or print json_encode(array('st'=>0,'msg'=>$conn->error));



					   $st_1 = $conn->query("INSERT INTO `language_data` (`id`, `keyword`, `type`, `details`, `english`) VALUES
						('tax_fee', 'admin', 'Tax Fee', 'Tax Fee'),
						('minimum_order', 'admin', 'Minumum Order', 'Minumum Order'),
						('tax', 'admin', 'Tax', 'Tax'),
						('dine_in', 'admin', 'Dine-In', 'Dine-In'),
						('language_list', 'admin', 'Languages List', 'Languages List'),
						('show_language_dropdown_in_home', 'admin', 'Show Languages Dropdown in landing page', 'Show Languages Dropdown in landing page'),
						('cart_is_empty', 'admin', 'Cart is empty', 'Cart is empty'),
						('razorpay_key_id', 'admin', 'Razorpay Key Id', 'Razorpay Key Id'),
						('secret_key', 'admin', 'Secret Key', 'Secret Key'),
						('view_shop', 'admin', 'View Shop', 'View Shop'),
						('give_your_feedback', 'admin', 'Please give your feedback', 'Please give your feedback'),
						('sort_by_newest', 'admin', 'Sort By Newest', 'Sort By Newest'),
						('sort_by_highest_rating', 'admin', 'Sort BY Highest Rating', 'Sort BY Highest Rating'),
						('sort_by_lowest_rating', 'admin', 'Sort BY Lowest Rating', 'Sort BY Lowest Rating'),
						('one_min_ago', 'admin', 'one minute ago', 'one minute ago'),
						('minutes_ago', 'admin', 'minutes ago', 'minutes ago'),
						('an_hour_ago', 'admin', 'an hour ago', 'an hour ago'),
						('hrs_ago', 'admin', 'hrs ago', 'hrs ago'),
						('yesterday', 'admin', 'Yesterday', 'Yesterday'),
						('days_ago', 'admin', 'days ago', 'days ago'),
						('a_week_ago', 'admin', 'a week ago', 'a week ago'),
						('weeks_ago', 'admin', 'weeks ago', 'weeks ago'),
						('a_month_ago', 'admin', 'a month ago', 'a month ago'),
						('months_ago', 'admin', 'months ago', 'months ago'),
						('one_year_ago', 'admin', 'one year ago', 'one year ago'),
						('years_ago', 'admin', 'years ago', 'years ago'),
						('statistics', 'admin', 'Statistics', 'Statistics'),
						('total_purchased_item', 'admin', 'Total Purchased Items', 'Total Purchased Items'),
						('average_based_on', 'admin', 'average based on', 'average based on'),
						('test_mail', 'admin', 'Test Mail', 'Test Mail'),
						('documentation', 'admin', 'Documentation', 'Documentation'),
						('customer_list', 'admin', 'Customer List', 'Customer List'),
						('total_orders', 'admin', 'Total Orders', 'Total Orders'),
						('add_customer', 'admin', 'Add Customer', 'Add Customer'),
						('empty-phone', 'admin', 'your phone is empty, please insert your phone number', 'your phone is empty, please insert your phone number'),
						('empty-country-1', 'admin', 'Your country is empty, please Set your country', 'Your country is empty, please Set your country'),
						('empty-country-2', 'admin', 'County will helps you to set your phone code and currency.', 'County will helps you to set your phone code and currency.'),
						('empty-profile', 'admin', 'Your Profile picture is empty, Please Set your Profile picture.', 'Your Profile picture is empty, Please Set your Profile picture.'),
						('restaurant_empty_msg-0', 'admin', 'If You do not find menu and other options', 'If You do not find menu and other options'),
						('restaurant_empty_msg-1', 'admin', 'Make sure Restaurant profile is complete', 'Make sure Restaurant profile is complete'),
						('restaurant_empty_msg-2', 'admin', 'You have to add phone, dial code and country', 'You have to add phone, dial code and country'),
						('staff_password_msg', 'admin', 'Staff password will set 1234', 'Staff password will set 1234'),
						('staff_password_change_msg', 'admin', 'Staff can change their password after login', 'Staff can change their password after login'),
						('dboy_password_msg', 'admin', 'Delivery guy password will set 1234', 'Delivery guy password will set 1234'),
						('dboy_password_change_msg', 'admin', 'Delivery guy can change password after login', 'Delivery guy can change password after login'),
						('customer_password_msg', 'admin', 'Customer password will set 1234', 'Customer password will set 1234'),
						('customer_password_change_msg', 'admin', 'Customer can change their password after login', 'Customer can change their password after login'),
						('customer_details', 'admin', 'Customer Details', 'Customer Details'),
						('general', 'admin', 'General', 'General'),
						('update_with_my_old_information', 'admin', 'Update with my old information', 'Update with my old information'),
						('minimum_price_msg_for_cod', 'admin', 'Price not sufficient for COD', 'Price not sufficient for COD'),
						('minimum_price', 'admin', 'Minimum Price', 'Minimum Price'),
						('add_new_location', 'admin', 'Add New Location', 'Add New Location'),
						('click_the_map_to_get_lan_ln', 'admin', 'Click the map to get Lat/Lng!', 'Click the map to get Lat/Lng!'),
						('customer_will_find_restaurant_with_location', 'admin', 'Customer will find your restaurant using this location', 'Customer will find your restaurant using this location'),
						('search_for_items', 'admin', 'Search For Items', 'Search For Items'),
						('near_me', 'admin', 'Near Me', 'Near Me'),
						('shop_rating', 'admin', 'Shop Rating', 'Shop Rating'),
						('available_time', 'admin', 'Available Time', 'Available Time'),
						('variants', 'admin', 'Variants', 'Variants'),
						('total_sell', 'admin', 'Total Sell', 'Total Sell'),
						('popular_store', 'admin', 'Popular Store', 'Popular Store'),
						('popular_items', 'admin', 'Popular Items', 'Popular Items'),
						('item_search', 'admin', 'Item Search', 'Item Search'),
						('locations', 'admin', 'Locations', 'Locations'),
						('latitude', 'admin', 'Latitude', 'Latitude'),
						('longitude', 'admin', 'Longitude', 'Longitude'),
						('payment_configuration', 'admin', 'Payment configuration', 'Payment configuration'),
						('virtual_number', 'admin', 'Virtual Number', 'Virtual Number'),
						('please_select_your_payment_menthod', 'admin', 'Please select your payment method', 'Please select your payment method'),
						('show_item_search_in_landing_page', 'admin', 'Show Item search  in landing page', 'Show Item search  in landing page');") or print json_encode(array('st'=>0,'msg'=>$conn->error));

					    $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					  
					}


					if($row['version'] < 2.0){
						$new_version = 2.0;

						$st_1 = $conn->query('CREATE TABLE `delivery_area_list` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_id` int(11) NOT NULL,
						  `shop_id` int(11) NOT NULL,
						  `area` varchar(255) NOT NULL,
						  `cost` varchar(255) NOT NULL,
						  `created_at` datetime NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('CREATE TABLE `call_waiter_list` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_id` int(11) NOT NULL,
						  `shop_id` int(11) NOT NULL,
						  `table_no` int(11) NOT NULL,
						  `status` int(11) NOT NULL,
						  `is_ring` int(11) NOT NULL,
						  `created_at` datetime NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('CREATE TABLE `payment_method_list` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(255) NULL,
						  `slug` varchar(255) NULL,
						  `active_slug` varchar(255) NULL,
						  `status_slug` varchar(255) NULL,
						  `status` int(11) NOT NULL DEFAULT 1,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						

						$st_1 = $conn->query('ALTER TABLE settings ADD (is_landing_page int  NOT NULL DEFAULT 0,landing_page_url VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE settings ADD (pixel_id VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE user_settings ADD (pixel_id VARCHAR(255) NULL,analytics_id VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



						$st_1 = $conn->query('ALTER TABLE settings ADD (paypal_status int  NOT NULL DEFAULT 1,stripe_status int  NOT NULL DEFAULT 1,razorpay_status int  NOT NULL DEFAULT 1,stripe_fpx_status int  NOT NULL DEFAULT 0,mercado_status int  NOT NULL DEFAULT 0,paytm_status int  NOT NULL DEFAULT 0,flutterwave_status int  NOT NULL DEFAULT 0,is_fpx int  NOT NULL DEFAULT 1,fpx_config LONGTEXT NULL,is_mercado int  NOT NULL DEFAULT 0,mercado_config LONGTEXT NULL, is_paytm int  NOT NULL DEFAULT 0, paytm_config LONGTEXT NULL, is_flutterwave int  NOT NULL DEFAULT 0, flutterwave_config LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (is_paypal int  NOT NULL DEFAULT 1, is_stripe int  NOT NULL DEFAULT 1, is_razorpay int  NOT NULL DEFAULT 1, paypal_status int  NOT NULL DEFAULT 1,stripe_status int  NOT NULL DEFAULT 1,razorpay_status int  NOT NULL DEFAULT 1,stripe_fpx_status int  NOT NULL DEFAULT 0,mercado_status int  NOT NULL DEFAULT 0,paytm_status int  NOT NULL DEFAULT 0,flutterwave_status int  NOT NULL DEFAULT 0,is_fpx int  NOT NULL DEFAULT 1,fpx_config LONGTEXT NULL,is_mercado int  NOT NULL DEFAULT 0,mercado_config LONGTEXT NULL, is_paytm int  NOT NULL DEFAULT 0, paytm_config LONGTEXT NULL, is_flutterwave int  NOT NULL DEFAULT 0, flutterwave_config LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (is_customer_login int  NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (currency_position int  NOT NULL DEFAULT 1, number_formats int  NOT NULL DEFAULT 1,is_area_delivery int  NOT NULL DEFAULT 0,is_call_waiter int  NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (shipping_id int  NOT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE items ADD (extra_images LONGTEXT null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE user_settings ADD (icon_settings LONGTEXT null,qr_config LONGTEXT null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						
						$st_1 = $conn->query('ALTER TABLE items MODIFY 	allergen_id VARCHAR(255) NULL') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE payment_info  MODIFY 	payment_type VARCHAR(255) NULL') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE payment_info ADD (all_info LONGTEXT  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE order_payment_info ADD (all_info LONGTEXT  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query("INSERT INTO `payment_method_list` (`id`, `name`, `slug`, `active_slug`, `status_slug`, `status`) VALUES
								(1, 'Paypal', 'paypal', 'paypal_status', 'is_paypal', 1),
								(2, 'Stripe', 'stripe', 'stripe_status', 'is_stripe', 1),
								(3, 'Razorpay', 'razorpay', 'razorpay_status', 'is_razorpay', 1),
								(4, 'Stripe FPX', 'stripe_fpx', 'stripe_fpx_status', 'is_fpx', 1),
								(5, 'Paytm', 'paytm', 'paytm_status', 'is_paytm', 1),
								(6, 'Mercadopago', 'mercado', 'mercado_status', 'is_mercado', 1),
								(7, 'Flutterwave', 'flutterwave', 'flutterwave_status', 'is_flutterwave', 1);") or print json_encode(array('st'=>0,'msg'=>$conn->error));


					   $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('locations', 'admin', 'Locations', 'Locations'),
						('latitude', 'admin', 'Latitude', 'Latitude'),
						('longitude', 'admin', 'Longitude', 'Longitude'),
						('payment_configuration', 'admin', 'Payment configuration', 'Payment configuration'),
						('virtual_number', 'admin', 'Virtual Number', 'Virtual Number'),
						('please_select_your_payment_menthod', 'admin', 'Please select your payment method', 'Please select your payment method'),
						('none', 'admin', 'None', 'None'),
						('add_image', 'admin', 'Add Image', 'Add Image'),
						('add_new_images', 'admin', 'Add new images', 'Add new images'),
						('customer_login_msg', 'admin', 'Enabled customer login in the checkout page', 'Enabled customer login in the checkout page'),
						('reset', 'admin', 'Reset', 'Reset'),
						('new', 'admin', 'New', 'New'),
						('delivery_area', 'admin', 'Delivery Area', 'Delivery Area'),
						('add_delivery_area', 'admin', 'Add delivery Area', 'Add delivery Area'),
						('call_waiter', 'admin', 'Call Waiter', 'Call Waiter'),
						('call', 'admin', 'Call', 'Call'),
						('enable_to_allow_call_waiter', 'admin', 'Enable to allow call waiter service', 'Enable to allow call waiter service'),
						('call_waiter_msg', 'admin', 'Waiter will get a notification and will available soon!', 'Waiter will get a notification and will available soon!'),
						('waiting_notification_msg', 'admin', 'Please wait waiter will be available soon', 'Please wait, Waiter will be available soon'),
						('charge', 'admin', 'Charge', 'Charge'),
						('show_image', 'admin', 'Show Image', 'Show Image'),
						('active_image', 'admin', 'Active Image', 'Active Image'),
						('image_url', 'admin', 'Image URL', 'Image URL'),
						('is_svg', 'admin', 'Is SVG', 'Is SVG'),
						('icon_settings', 'admin', 'Icon Settings', 'Icon Settings'),
						('qr_generator', 'admin', 'QR Code Generator', 'QR Code Generator'),
						('foreground_color', 'admin', 'Foreground Color', 'Foreground Color'),
						('background_color', 'admin', 'Background Color', 'Background Color'),
						('mode', 'admin', 'Mode', 'Mode'),
						('text', 'admin', 'Text', 'Text'),
						('normal', 'admin', 'Normal', 'Normal'),
						('text_color', 'admin', 'Text Color', 'Text Color'),
						('position_x', 'admin', 'Position X', 'Position X'),
						('position_y', 'admin', 'Position Y', 'Position Y'),
						('qrcode', 'admin', 'Qr Code', 'Qr Code'),
						('padding', 'admin', 'Padding', 'Padding'),
						('custom_landing_page', 'admin', 'Custom Landing Page', 'Custom Landing Page'),
						('enable_custom_landing_page', 'admin', 'Enable Custom Landing page', 'Enable Custom Landing page'),
						('landing_page_url', 'admin', 'Landing Page URL', 'Landing Page URL'),
						('custom_landing_page_msg', 'admin', 'IF you enable this, user will redirect in your customer page URL when they enter in systems landing page', 'IF you enable this, user will redirect in your customer page URL when they enter in systems landing page'),
						('installed', 'admin', 'Installed', 'Installed'),
						('install', 'admin', 'Install', 'Install'),
						('uninstall', 'admin', 'Uninstall', 'Uninstall'),
						('not_installed', 'admin', 'Not Installed', 'Not Installed'),
						('paytm', 'admin', 'Paytm', 'Paytm'),
						('stripe_fpx', 'admin', 'Stripe FPX', 'Stripe FPX'),
						('flutterwave', 'admin', 'Flutterwave', 'Flutterwave'),
						('mercado', 'admin', 'Mercadopago', 'Mercadopago'),
						('mercadopago', 'admin', 'Mercadopago', 'Mercadopago'),
						('public_key', 'admin', 'Public key', 'Public key'),
						('access_token', 'admin', 'Access Token', 'Access Token'),
						('environment', 'admin', 'Environment', 'Environment'),
						('area_based_delivery_charge', 'admin', 'Area based delivery charge', 'Area based delivery charge'),
						('facebook_pixel', 'admin', 'Facebook Pixel', 'Facebook Pixel'),
						('facebook_pixel_id', 'admin', 'Facebook Pixel ID', 'Facebook Pixel ID'),
						('google_analytics_id', 'admin', 'Google Analytics ID', 'Google Analytics ID'),
						('customer_waiting_msg', 'admin', 'Customer is waiting at table number', 'Customer is waiting at table number');") or print json_encode(array('st'=>0,'msg'=>$conn->error));

					    $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					  
					}

					if($row['version'] < 2.1){
						$new_version = 2.1;


						
						$st_1 = $conn->query('ALTER TABLE items ADD (orders int  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE item_packages ADD (orders int  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (is_admin_gmap int  NOT NULL DEFAULT 0, whatsapp_number VARCHAR(255) NULL, whatsapp_msg TEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE settings ADD (gmap_config LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE menu_type ADD (thumb VARCHAR(255) NULL, images VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE user_settings ADD (pwa_config TEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE settings ADD (is_pwa INT NOT NULL DEFAULT 0, pwa_config TEXT NULL, system_fonts VARCHAR(255) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE users ADD (menu_style INT NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (pickup_date date  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (is_language int  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



					   $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('weight', 'admin', 'Weight', 'Weight'),
						('calories', 'admin', 'Calories', 'Calories'),
						('is_variants', 'admin', 'Is variants', 'Is variants'),
						('allow_access_google_map_key', 'admin', 'Allow to access google map api key', 'Allow to access google map api key'),
						('allow_gmap_access', 'admin', 'Allow Gmap Access', 'Allow Gmap Access'),
						('enable', 'admin', 'Enable', 'Enable'),
						('disable', 'admin', 'Disable', 'Disable'),
						('add_more_item', 'admin', 'Add More Items', 'Add More Items'),
						('item_added_successfully', 'admin', 'Item Added Successfully', 'Item Added Successfully'),
						('edit_order', 'admin', 'Edit Order', 'Edit Order'),
						('duplicate_item', 'admin', 'Duplicate Item', 'Duplicate Item'),
						('clone_item', 'admin', 'Clone Item', 'Clone Item'),
						('order_again', 'admin', 'Order again', 'Order again'),
						('moved_successfull', 'admin', 'Moved successfully', 'Moved successfully'),
						('add_new_item', 'admin', 'Add New Item', 'Add New Item'),
						('add_those_extras_also', 'admin', 'Add those Extras also', 'Add those Extras also'),
						('whatsapp_config', 'admin', 'WhatsApp Config', 'WhatsApp Config'),
						('currency_position', 'admin', 'Currency Position', 'Currency Position'),
						('number_format', 'admin', 'Number Format', 'Number Format'),
						('pwa', 'admin', 'PWA', 'PWA'),
						('pwa_config', 'admin', 'PWA Config', 'PWA Config'),
						('enable_to_allow_for_all', 'admin', 'Enable to allow PWA in this system', 'Enable to allow PWA in this system'),
						('google_font_name', 'admin', 'Google Font name', 'Google Font name'),
						('menu_style', 'admin', 'Menu Style', 'Menu Style'),
						('menu_bottom', 'admin', 'Menu Bottom', 'Menu Bottom'),
						('menu_top', 'admin', 'Menu Top', 'Menu Top'),
						('more', 'admin', 'More', 'More'),
						('today', 'admin', 'Today', 'Today'),
						('pickup_date', 'admin', 'Pickup Date', 'Pickup Date'),
						('pasta', 'admin', 'Pasta', 'Pasta'),
						('add_to_home_screen', 'admin', 'Add to Home Screen', 'Add to Home Screen');") or print json_encode(array('st'=>0,'msg'=>$conn->error));

					    $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					  
					}


					if($row['version'] < 2.2){
						$new_version = 2.2;
 
						$st_1 = $conn->query('ALTER TABLE user_settings ADD (table_qr_config LONGTEXT null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE settings ADD (custom_css LONGTEXT null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						$st_1 = $conn->query('ALTER TABLE settings ADD (long_description LONGTEXT null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (is_coupon int not null DEFAULT 0, coupon_percent VARCHAR(255) null, coupon_id INT not null DEFAULT 0, tips double null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (is_pin int not null DEFAULT 0, pin_number VARCHAR(255) null)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (date_format int not null DEFAULT 8, time_format int not null DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE order_user_list ADD (use_payment INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE order_payment_info ADD (order_type INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



					   $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('theme_color','admin','Theme Color','Theme Color'),
						('change_domain','admin','Change Domain','Change Domain'),
						('upgrade_license','admin','Upgrade License','Upgrade License'),
						('time_format','admin','Time Format','Time Format'),
						('date_format','admin','Date Format','Date Format'),
						('security_pin_not_match','admin','Security Pin doesn\'t Match', 'Security Pin doesn\'t Match'),
						('enable_pin_when_customer_track_order','admin','Enable Pin when customer track their order and when they place call waiter','Enable Pin when customer track their order and when they place call waiter'),
						('security_pin','admin','Security Pin','Security Pin'),
						('custom_css','admin','Custom CSS','Custom CSS'),
						('add_more_image','admin','Add More Images','Add More Images'),
						('coupon_applied_successfully','admin','Coupon Applied Successfully','Coupon Applied Successfully'),
						('add_to_home_screen','admin','Add to home screen','Add to home screen');") or print json_encode(array('st'=>0,'msg'=>$conn->error));

					    $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					  
					}

					if($row['version'] < 2.3){
						$new_version = 2.3;

						$result = $conn->query("SHOW COLUMNS FROM order_user_list LIKE 'use_payment'");
					    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


					    if(!isset($row['Field'])){
					    	$st_1 = $conn->query('ALTER TABLE order_user_list ADD (use_payment INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
							
					    }

						$result = $conn->query("SHOW COLUMNS FROM order_payment_info LIKE 'order_type'");
					    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					    if(!isset($row['Field'])){
					    	$st_1 = $conn->query('ALTER TABLE order_payment_info ADD (order_type INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
					       
					    }


					
					    $row = $conn->query("select 1 from coupon_list");
					    if(!isset($row)){
						    $st_1 = $conn->query('CREATE TABLE `coupon_list` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `shop_id` int(11) NOT NULL,
							  `user_id` int(11) NOT NULL,
							  `title` varchar(255) DEFAULT NULL,
							  `coupon_code` varchar(255) NOT NULL,
							  `discount` double NOT NULL,
							  `total_limit` int(11) NOT NULL,
							  `total_used` int(11) NOT NULL,
							  `created_at` datetime NOT NULL,
							  `start_date` date DEFAULT NULL,
							  `end_date` date DEFAULT NULL,
							  `status` int(11) NOT NULL DEFAULT 1,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						}
						
					$st_1 = $conn->query("UPDATE country SET currency_symbol='₸' WHERE id=94") or print json_encode(array('st'=>0,'msg'=>$conn->error));


					$st_1 = $conn->query('ALTER TABLE  users_active_order_types ADD (is_payment INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

					 $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
					('pickup_area','admin','Pickup Area','Pickup Area'),
					('required_alert','admin','Please fill up the % field','Please fill up the %s field'),
					('import','admin','Import','Import'),
					('pay_later','admin','Pay Later','Pay Later'),
					('enable_payment','admin','Enable Payment','Enable Payment'),
					('order_types_config','admin','Order Types Configuration','Order Types Configuration'),
					('please_config_the_shop_settings_configuration','admin','Please configure restaurant settings and shop configuration','Please configure restaurant settings and shop configuration'),
					('restaurant_name_is_missing','admin','Restaurant Name is missing','Restaurant Name is missing'),
					('those_steps_are_most_important','admin','Those Steps are most important to configure first','Those Steps are most important to configure first'),
					('please_confing_the_email','admin','Please configure the Email settings','Please configure the Email settings'),
					('email_is_missing','admin','Email is missing','Email is missing'),
					('please_config_your_site_settings','admin','Please configure the site settings','Please configure the site settings'),
					('site_name_is_missing','admin','Site Name is missing','Site Name is missing'),
					('Please_add_your_phone_number','admin','Please add your phone number','Please add your phone number'),
					('phone_number_is_missing','admin','Phone Number is missing','Phone Number is missing'),
					('restaurant_empty_alert_msg-3','admin','You have to add phone, dial code and country','You have to add phone, dial code and country'),
					('restaurant_empty_alert_msg-2','admin','Make sure Restaurant profile is complete','Make sure Restaurant profile is complete'),
					('restaurant_empty_alert_msg','admin','If You do not find menu and other options','If You do not find menu and other options, ');") or print json_encode(array('st'=>0,'msg'=>$conn->error));



				    

					  $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					  
					}


					if($row['version'] < 2.4){
						$new_version = 2.4;

						$result = $conn->query("SHOW COLUMNS FROM order_user_list LIKE 'use_payment'");
					    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


					    if(!isset($row['Field'])){
					    	$st_1 = $conn->query('ALTER TABLE order_user_list ADD (use_payment INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
							
					    }

						$result = $conn->query("SHOW COLUMNS FROM order_payment_info LIKE 'order_type'");
					    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					    if(!isset($row['Field'])){
					    	$st_1 = $conn->query('ALTER TABLE order_payment_info ADD (order_type INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
					       
					    }


					
					    $row = $conn->query("select 1 from coupon_list");
					    if(!isset($row)){
						    $st_1 = $conn->query('CREATE TABLE `coupon_list` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `shop_id` int(11) NOT NULL,
							  `user_id` int(11) NOT NULL,
							  `title` varchar(255) DEFAULT NULL,
							  `coupon_code` varchar(255) NOT NULL,
							  `discount` double NOT NULL,
							  `total_limit` int(11) NOT NULL,
							  `total_used` int(11) NOT NULL,
							  `created_at` datetime NOT NULL,
							  `start_date` date DEFAULT NULL,
							  `end_date` date DEFAULT NULL,
							  `status` int(11) NOT NULL DEFAULT 1,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						}
						
				


					$st_1 = $conn->query('ALTER TABLE  restaurant_list ADD (is_coupon INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

					 $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('add_coupon','admin','Add Coupon','Add Coupon'),
						('used','admin','Used','Used'),
						('use_coupon_code','admin','Use Coupon Code','Use Coupon Code'),
						('import','admin','Import','Import'),
						('coupon_discount','admin','Coupon Discount','Coupon Discount'),
						('limit','admin','Limit','Limit'),
						('apply','admin','Apply','Apply'),
						('do_you_have_coupon','admin','Do you have coupon?','Do you have coupon?'),
						('end_date','admin','End Date','End Date'),
						('coupon_code','admin','Coupon Code','Coupon Code'),
						('coupon_code_reached_the_max_limit','admin','Coupon code reached the maximum limit','Coupon code reached the maximum limit'),
						('coupon_code_not_exists','admin','Coupon code not exists','Coupon code not exists'),
						('coupon_list','admin','Coupon List','Coupon List');") or print json_encode(array('st'=>0,'msg'=>$conn->error));



				    

					  $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					  
					}

					if($row['version'] < 2.5){
						$new_version = 2.5;
						$result = $conn->query("SELECT *FROM payment_method_list WHERE slug ='paystack'");
						$features = mysqli_fetch_array($result, MYSQLI_ASSOC);
						if(!isset($features['slug'])){
							$conn->query('INSERT INTO payment_method_list(name,slug,active_slug,status_slug,status) VALUES ("Paystack","paystack","paystack_status","is_paystack",1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						}

						$st_1 = $conn->query('ALTER TABLE settings ADD (paystack_status int  NOT NULL DEFAULT 1, is_paystack int  NOT NULL DEFAULT 0, paystack_config LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));



						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (paystack_status int  NOT NULL DEFAULT 1, is_paystack int  NOT NULL DEFAULT 0, paystack_config LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE settings ADD (nearby_length VARCHAR(20) NULL DEFAULT 5, extras LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query("CREATE TABLE `extra_libraries` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `shop_id` INT NOT NULL , `name` VARCHAR(255) NOT NULL ,`price` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL DEFAULT 1, PRIMARY KEY (`id`)) ENGINE = InnoDB;") or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE item_extras ADD (ex_id INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('ALTER TABLE settings ADD (`notifications` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`is_admin_onsignal` INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));


					  $st_1 = $conn->query('ALTER TABLE users_active_order_types ADD (`is_required` INT NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

				


					  $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('payment_required','admin','Payment Required','Payment Required'),
						('hide_pay_later','admin','Hide Pay later','Hide Pay later'),
						('notifications_send_successfully','admin','Notifications send successfully','Notifications send successfully'),
						('send_notifications','admin','Send Notification','Send Notification'),
						('custom_link','admin','Custom Link','Custom Link'),
						('disabled_onsignal_access','admin','Disabled onSignal Notification','Disabled onSignal Notification'),
						('allow_onsignal_access','admin','Allow onSignal Notification','Allow onSignal Notification'),
						('user_auth_key','admin','User Auth Key','User Auth Key'),
						('onsignal_app_id','admin','Onesignal App ID','Onesignal App ID'),
						('onsignal_api','admin','onSignal API','onSignal API'),
						('add_extra','admin','Add Extra','Add Extra'),
						('all_extras','admin','All Extras','All Extras'),
						('nearby_radius','admin','Nearby Radius','Nearby Radius'),
						('paystack_payment_gateways','admin','Paystack Payment Gateways','Paystack Payment Gateways'),
						('paystack_secret_key','admin','Paystack Secret Key','Paystack Secret Key'),
						('paystack_publick_key','admin','Paystack Public Key','Paystack Public Key'),
						('paystack','admin','Paystack','Paystack');") or print json_encode(array('st'=>0,'msg'=>$conn->error));

					  $st_1 = $conn->query('CREATE TABLE `subscriber_list` (
					  	`id` int(11) NOT NULL AUTO_INCREMENT,
					  	`shop_id` int(11) NOT NULL,
					  	`auth_id` int(11) NOT NULL,
					  	`user_id` VARCHAR(255) NOT NULL,
					  	`created_at` datetime NOT NULL,
					  	`status` int(11) NOT NULL DEFAULT 1,
					  	PRIMARY KEY (`id`)
					  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						 $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					}


					if($row['version'] < 2.6){
						$new_version = 2.6;
						
						$st_1 = $conn->query('ALTER TABLE items MODIFY 	allergen_id VARCHAR(255) NULL') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE order_user_list ADD (`is_change` INT  NOT NULL DEFAULT 0,`change_amount` VARCHAR(50) NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`is_question` INT  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`is_radius` INT  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`radius_config` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`is_tax` INT  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`tax_status` VARCHAR(10)  NOT NULL DEFAULT "+")') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`is_kds_pin` INT(11)  NOT NULL DEFAULT 0, `kds_pin` VARCHAR(20) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE staff_list ADD (`question` LONGTEXT  NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE items ADD (`tax_fee` varchar(10)  NOT NULL DEFAULT 0)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE items ADD (`tax_status` varchar(10)  NOT NULL DEFAULT "+")') or print json_encode(array('st'=>0,'msg'=>$conn->error));


						$st_1 = $conn->query('CREATE TABLE `question_list` (
						  	`id` int(11) NOT NULL AUTO_INCREMENT,
						  	`title` VARCHAR(255) NOT NULL,
						  	`user_id` VARCHAR(255) NOT NULL,
						  	`created_at` datetime NOT NULL,
						  	`status` int(11) NOT NULL DEFAULT 1,
						  	PRIMARY KEY (`id`)
						  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));
					  
						$st_1 = $conn->query('ALTER TABLE settings MODIFY `social_sites` LONGTEXT NULL') or print json_encode(array('st'=>0,'msg'=>$conn->error));

					  $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('enter_pin','admin','Enter Pin','Enter Pin'),
						('kds_pin','admin','KDS Pin','KDS Pin'),
						('tax_excluded','admin','Tax Excluded','Tax Excluded'),
						('tax_included','admin','Tax Included','Tax Included'),
						('item_tax_status','admin','Item Tax Status','Item Tax Status'),
						('price_tax_msg','admin','Tax are only for showing tax status in invoice. Set your price including/excluding tax','Tax are only for showing tax status in invoice. Set your price including/excluding tax'),
						('not_found_msg','admin','Not Found Message','Not Found Message'),
						('radius','admin','Radius','Radius'),
						('radius_base_delivery_settings','admin','Enable Radius Based Delivery Settings','Radius Based Delivery Settings'),
						('delivery_settings','admin','Delivery Settings','Delivery Settings'),
						('enable_radius_base_delivery','admin','Enable Raduis Based Delivery','Enable Radius Based Delivery'),
						('change_amount','admin','Change Amount','Change Amount'),
						('change','admin','Change','Change'),
						('security_question_ans_not_correct','admin','Security Questions answer is not correct','Security Questions answer is not correct'),
						('enable_security_question','admin','Enable Security Question','Enable Security Question'),
						('write_your_answer_here','admin','Write your answer here','Write your answer here'),
						('security_question','admin','Security Question','Security Question'),
						('signup_questions','admin','Signup Questions','Signup Questions'),
						('half_yearly','admin','Half Year / 6 month','Half Year- 6 month'),
						('6_month','admin','Half Year / 6 month','Half Year / 6 month'),
						('table_no','admin','Table No','Table No');") or print json_encode(array('st'=>0,'msg'=>$conn->error));


						 $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					}


					if($row['version'] < 2.7){
						$new_version = 2.7;
						
						 $st_1 = $conn->query('ALTER TABLE settings ADD (`restaurant_demo` VARCHAR(50) NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						 $st_1 = $conn->query('ALTER TABLE packages ADD (`custom_fields_config` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE users_active_order_types ADD (`is_admin_enable` INT(11) NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE settings ADD (`sendgrid_api_key` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE settings ADD (`currency_position` INT NOT NULL DEFAULT 1, `number_formats` INT NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE settings ADD (`offline_status` INT NOT NULL DEFAULT 1, `is_offline` INT NOT NULL DEFAULT 1,`offline_config` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE user_settings ADD (`onesignal_config` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE restaurant_list ADD (`order_view_style` INT NOT NULL DEFAULT 1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						 $st_1 = $conn->query('ALTER TABLE user_settings ADD (`extra_config` LONGTEXT NULL)') or print json_encode(array('st'=>0,'msg'=>$conn->error));




						$result = $conn->query("SELECT *FROM payment_method_list WHERE slug ='offline'");
						$features = mysqli_fetch_array($result, MYSQLI_ASSOC);
						if(!isset($features['slug'])){
							$conn->query('INSERT INTO payment_method_list(name,slug,active_slug,status_slug,status) VALUES ("Offline","offline","offline_status","is_offline",1)') or print json_encode(array('st'=>0,'msg'=>$conn->error));
						}


						$result = $conn->query("SELECT *FROM features WHERE slug ='pwa-push'");
						$features = mysqli_fetch_array($result, MYSQLI_ASSOC);
						if(!isset($features['slug'])){
							$conn->query("INSERT INTO features(id,features,slug,status,is_features,created_at) VALUES 
							('11','OneSignal & PWA','pwa-push','1','1','2022-09-08 23:04:31')") or print json_encode(array('st'=>0,'msg'=>$conn->error));
						}




						$st_1 = $conn->query('CREATE TABLE `admin_notification` (
						  	`id` int(11) NOT NULL AUTO_INCREMENT,
						  	`notification_id` INT(11) NULL,
						  	`restaurant_id` INT(11)  NULL,
						  	`status` INT(11)  NOT NULL DEFAULT 1,
						  	`seen_status` INT(11)  NOT NULL DEFAULT 0,
						  	`is_admin_enable` INT(11)  NOT NULL DEFAULT 1,
						  	`created_at` datetime  NULL,
						  	`send_at` datetime  NULL,
						  	`seen_time` datetime  NULL,
						  	PRIMARY KEY (`id`)
						  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));

						$st_1 = $conn->query('CREATE TABLE `admin_notification_list` (
						  	`id` int(11) NOT NULL AUTO_INCREMENT,
						  	`title` VARCHAR(255) NULL,
						  	`details` LONGTEXT NULL ,
						  	`status` INT(11)  NOT NULL DEFAULT 1,
						  	`created_at` datetime  NULL,
						  	PRIMARY KEY (`id`)
						  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;') or print json_encode(array('st'=>0,'msg'=>$conn->error));



					  $st_1 = $conn->query("INSERT INTO `language_data` (`keyword`, `type`, `details`, `english`) VALUES
						('Qr Code','admin','Qr code','Qr code'),
						('specialities','admin','Specialities','Specialities'),
						('subscriber list','admin','Subscribers List','Subscribers List'),
						('subscribers','admin','Subscribers','Subscribers'),
						('third-party_chatting_app','admin','Third-party chatting apps','Third-party chatting apps'),
						('choose_an_app','admin','Choose an App','Choose an App'),
						('app_id','admin','App ID','App ID'),
						('onesignal_configuration','admin','OneSignal Configuration','OneSignal Configuration'),
						('verify_payment','admin','Verify Payment','Verify Payment'),
						('transaction_id','admin','Transaction ID','Transaction ID'),
						('bank_details','admin','Bank Details','Bank Details'),
						('enable_transaction_id_field','admin','Enable Transaction ID field','Enable Transaction ID field'),
						('sendgrid_api_key','admin','SendGrid API KEy','SendGrid API Key'),
						('api_key','admin','API Key','API Key'),
						('sendgrid','admin','SendGrid','SendGrid'),
						('activities','admin','Activities','Activities'),
						('mark_as_unread','admin','Mark as Unread','Mark as Unread'),
						('mark_as_read','admin','Mark as read','Mark as read'),
						('send_payment_mail_to_user','admin','Send Payment Mail to the user','Send Payment Mail to the user'),
						('unseen_notification','admin','Unseen Notification','Unseen Notification'),
						('seen_notification','admin','Seen Notification','Seen Notification'),
						('unseen','admin','Unseen','Unseen'),
						('unseen_last_notification','admin','Unseen Last Notification','Unseen Last Notification'),
						('send_notification','admin','Send Notification','Send Notification'),
						('seen','admin','Seen','Seen'),
						('send_time','admin','Send Time','Send Time'),
						('select_notification','admin','Select Notification','Select Notification'),
						('notification_list','admin','Notification List','Notification List'),
						('create_notification','admin','Create Notification','Create Notification'),
						('manage_order_types','admin','Manage Order Types','Manage Order Types'),
						('select_all','admin','Select All','Select All'),
						('checked_all','admin','Checked All','Checked All'),
						('custom_fields','admin','Custom Fields','Custom Fields'),
						('demo','admin','Demo','Demo'),
						('restaurant_demo','admin','Restaurant Demo ','Demo Restaurant');") or print json_encode(array('st'=>0,'msg'=>$conn->error));


						 $insert = $conn->query("UPDATE settings SET version=$new_version,updated_at='$date',is_update=1 WHERE id=1");

					}



					return ['st'=>true,'msg'=>''];

				} // end while
		
			else:
				$msg = "Sorry ".$data['database']." settings table not EXISTS";
				return ['st'=>false,'msg'=>$msg];
			endif;
	
		
		

		
	}//end registration function

	

}



