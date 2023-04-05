-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 10:11 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_menu_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `language_data`
--

CREATE TABLE `language_data` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `details` text NOT NULL,
  `english` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language_data`
--

INSERT INTO `language_data` (`id`, `keyword`, `type`, `details`, `english`) VALUES
(1, 'alert', 'admin', '', 'Alert!'),
(2, 'net_income', 'admin', '', 'Net income'),
(3, 'package_by_user', 'admin', '', 'Package by user'),
(4, 'total_user', 'admin', '', 'Total Users'),
(5, 'total_package', 'admin', '', 'Total Packages'),
(6, 'total_pages', 'admin', '', 'Total Pages'),
(7, 'new_payment_request', 'admin', '', 'New payment request'),
(8, 'not_verified', 'admin', '', 'Not Verified'),
(9, 'expired_account', 'admin', '', 'Expired account'),
(10, 'expired_date', 'admin', '', 'Expired Date'),
(11, 'toatl_revenue', 'admin', '', 'Total revenue'),
(12, 'revenue', 'admin', '', 'Revenue'),
(13, 'profile', 'admin', '', 'Profile'),
(14, 'profile_link', 'admin', '', 'Profile link'),
(15, 'copy', 'admin', '', 'Copy'),
(16, 'coppied', 'admin', '', 'Coppied'),
(17, 'free', 'user', '', 'free'),
(18, 'trial', 'admin', '', 'Trial'),
(19, 'package_type', 'user', '', 'package type'),
(20, 'features', 'admin', '', 'Features'),
(21, 'duration', 'admin', '', 'Duration'),
(22, 'package_name', 'admin', '', 'Package name'),
(23, 'using_trail_package', 'admin', '', 'You are using trail packge'),
(24, 'trail_package_expired', 'admin', '', 'Your account will expired after 1 month'),
(25, 'change_package', 'admin', '', 'Change Package'),
(26, 'account_not_active', 'admin', '', 'Your Account is not active'),
(27, 'active_now', 'admin', '', 'Active Now'),
(28, 're_subscription_msg', 'admin', '', 'You have to re-new your subscription to continue'),
(29, 'active_account', 'admin', '', 'Active Account'),
(30, 'expired_account_msg', 'admin', '', 'Sorry your account is expired'),
(31, 'payment_pending_msg', 'admin', '', 'Your payment is pending'),
(32, 'can_pay_subscription', 'admin', '', 'You can pay from subscription'),
(33, 'pay_now', 'admin', '', 'Pay now'),
(34, 'pending_request_msg', 'admin', '', 'Your payment request is pending'),
(35, 'wait_for_confirmation', 'admin', '', 'Please Wait for the confirmation'),
(36, 'try_another_method', 'admin', '', 'Try Another Method'),
(37, 'account_not_verified', 'admin', '', 'Your Account is not Verified'),
(38, 'resend_send_mail_link', 'admin', '', 'Already send a verification link on your email. if not found'),
(39, 'resend', 'admin', '', 'Resend'),
(40, 'if_mail_not_correct_msg', 'admin', '', 'If your email is not correct then change from profile option'),
(41, 'email', 'label', '', 'Email'),
(42, 'settings', 'label', '', 'settings'),
(43, 'email_sub', 'label', '', 'Email_subjects'),
(44, 'registration', 'label', '', 'registration'),
(45, 'payment_gateway', 'label', '', 'Payment Gateway'),
(46, 'recovery_password', 'label', '', 'Recovery password'),
(47, 'admin_email', 'label', '', 'Admin email'),
(48, 'php_mail', 'label', '', 'PHP Mail'),
(49, 'smtp', 'label', '', 'SMTP'),
(50, 'smtp_host', 'label', '', 'SMTP HOST'),
(51, 'smtp_port', 'label', '', 'SMTP PORT'),
(52, 'smtp_password', 'label', '', 'SMTP PASSWORD'),
(53, 'save_change', 'label', '', 'Save Change'),
(54, 'paypal', 'label', '', 'paypal'),
(55, 'new_users', 'label', '', 'New Users'),
(56, 'add_user', 'label', '', 'Add User'),
(57, 'sl', 'label', '', 'Sl'),
(58, 'username', 'label', '', 'Username'),
(59, 'active_date', 'label', '', 'Active Date'),
(60, 'account_type', 'label', '', 'Account type'),
(61, 'action', 'label', '', 'Action'),
(62, 'users', 'label', '', 'Users'),
(63, 'status', 'label', '', 'status'),
(64, 'view_profile', 'label', '', 'View Profile'),
(65, 'start_date', 'label', '', 'Start Date'),
(66, 'free_account', 'label', '', 'free account'),
(67, 'trial_package', 'label', '', 'Trial Package'),
(68, 'not_active', 'admin', '', 'Not active yet'),
(69, 'expired', 'label', '', 'expired'),
(70, 'active', 'label', '', 'active'),
(71, 'deactive', 'label', '', 'Deactive'),
(72, 'verified', 'label', '', 'verified'),
(73, 'want_to_verify_this_account', 'admin', '', 'Do you want to verified this account?'),
(74, 'want_to_active_this_account', 'admin', '', 'Do you want to active this account?'),
(75, 'payment_is_verified', 'admin', '', 'You payment is verified'),
(76, 'paid', 'admin', '', 'paid'),
(77, 'verified_offline_payment_msg', 'admin', '', 'Do You want verified this payment? Payment will count as an offline payment'),
(78, 'pending', 'admin', '', 'pending'),
(79, 'delete_user_msg', 'admin', '', 'Want to delete this user? Be careful This user will remove permanetly.'),
(80, 'current_package', 'label', '', 'Current package'),
(81, 'submit', 'label', '', 'submit'),
(82, 'click_here', 'label', '', 'click here!'),
(83, 'add_new_user', 'label', '', 'Add New User'),
(84, 'restaurant_user_name', 'admin', '', 'Restaurant Username'),
(85, 'select_package', 'label', '', 'Select Package'),
(86, 'add_password', 'label', '', 'Add password'),
(87, 'password', 'label', '', 'password'),
(88, 'password_msg_add_user', 'label', '', 'if you not select add password, Password will create randomly and  send user by email'),
(89, 'create_page', 'label', '', 'Create Page'),
(90, 'title', 'label', '', 'title'),
(91, 'slug', 'label', '', 'slug'),
(92, 'details', 'label', '', 'details'),
(93, 'live', 'label', '', 'live'),
(94, 'hide', 'label', '', 'hide'),
(95, 'cancel', 'label', '', 'cancel'),
(96, 'all_pages', 'admin', '', 'All Pages'),
(97, 'edit', 'label', '', 'Edit'),
(98, 'delete', 'label', '', 'Delete'),
(99, 'faq', 'label', '', 'Faq'),
(100, 'faq_list', 'label', '', 'Faq List'),
(101, 'want_to_delete', 'label', '', 'Want to delete?'),
(102, 'how_it_works', 'label', '', 'How it works'),
(103, 'upload_image', 'label', '', 'Upload Image'),
(104, 'max', 'label', '', 'Max'),
(105, 'image', 'label', '', 'Image'),
(106, 'team', 'label', '', 'Team'),
(107, 'designation', 'label', '', 'Designation'),
(108, 'offline_payments', 'admin', '', 'Offline Payment'),
(109, 'package', 'admin', '', 'package'),
(110, 'txn_id', 'admin', '', 'Txn id'),
(111, 'request_date', 'label', '', 'Request Date'),
(112, 'approve', 'label', '', 'Approve'),
(113, 'approved', 'label', '', 'approved'),
(114, 'cookie_privacy', 'label', '', 'Cookies & Privacy'),
(115, 'services', 'label', '', 'services'),
(116, 'home_features', 'label', '', 'Home Features'),
(117, 'add_new', 'label', '', 'Add New'),
(118, 'upload', 'admin', '', 'upload'),
(119, 'select_direction', 'admin', '', 'Select Dirtection'),
(120, 'left_side', 'label', '', 'Left Side'),
(121, 'right_side', 'label', '', 'Right Side'),
(122, 'max_character', 'label', '', 'Max character'),
(123, 'icon', 'label', '', 'icon'),
(124, 'close', 'label', '', 'close'),
(125, 'terms_condition', 'label', '', 'Terms & Conditions'),
(126, 'payment_transaction', 'label', '', 'Payment Transaction'),
(127, 'payment_by', 'label', '', 'Payment by'),
(128, 'restaurant_details', 'home', '', 'Restaurant Details'),
(129, 'restaurant_username', 'user', '', 'restaurant username'),
(130, 'must_unique_english', 'user', '', 'Must be in English & Unique'),
(131, 'county', 'user', '', 'county'),
(132, 'currency', 'user', '', 'currency'),
(133, 'dial_code', 'user', '', 'dial code'),
(134, 'phone', 'user', '', 'phone'),
(135, 'restaurant_full_name', 'user', '', 'restaurant full name'),
(136, 'short_name', 'user', '', 'Short name'),
(137, 'location', 'user', '', 'location'),
(138, 'gmap_link', 'user', '', 'Google Map link'),
(139, 'address', 'user', '', 'address'),
(140, 'logo', 'user', '', 'logo'),
(141, 'cover_photo', 'user', '', 'Cover Photo'),
(142, 'upload_cover_photo', 'user', '', 'Upload Cover Image'),
(143, 'change_pass', 'user', '', 'Change password'),
(144, 'owner_name', 'user', '', 'owner name'),
(145, 'select_county', 'user', '', 'Select Country'),
(146, 'gender', 'user', '', 'gender'),
(147, 'website', 'user', '', 'Website'),
(148, 'old_pass', 'user', '', 'Old Password'),
(149, 'new_pass', 'user', '', 'New Password'),
(150, 'confirm_password', 'user', '', 'Confirm Password'),
(151, 'profile_pic', 'user', '', 'Profile Picture'),
(152, 'add_edit_info', 'label', '', 'Add / Edit Info'),
(153, 'shop_name', 'user', '', 'Shop Name'),
(154, 'create_your_restaurant', 'user', '', 'Create Your Restaurant'),
(155, 'warning', 'user', '', 'Warning!'),
(156, 'upload_images', 'user', '', 'Upload Images'),
(157, 'select', 'user', '', 'select'),
(158, 'you_have', 'user', '', 'You have'),
(159, 'notifications', 'user', '', 'notifications'),
(160, 'new_orders_today', 'user', '', 'new Orders today'),
(161, 'reservation_today', 'user', '', 'Reservation Today'),
(162, 'completed_orders', 'user', '', 'Completed orders'),
(163, 'error', 'user', '', 'Error'),
(164, 'copyright', 'admin', '', 'copyright'),
(165, 'version', 'label', '', 'Version'),
(166, 'member_since', 'user', '', 'Member since'),
(167, 'last_login', 'admin', '', 'Last Login'),
(168, 'logout', 'label', '', 'logout'),
(169, 'dashboard', 'admin', '', 'dashboard'),
(170, 'account_management', 'admin', '', 'Account MANAGEMENT'),
(171, 'packages_management', 'admin', '', 'PACKAGES Management'),
(172, 'package_list', 'admin', '', 'package list'),
(173, 'order_types', 'admin', '', 'order types'),
(174, 'site_management', 'admin', '', 'Site management'),
(175, 'home', 'admin', '', 'home'),
(176, 'site_features', 'user', '', 'Site Features'),
(177, 'international', 'admin', '', 'INTERNATIONAL'),
(178, 'languages', 'admin', '', 'languages'),
(179, 'add_languages', 'admin', '', 'Add Languages'),
(180, 'dashboard_language', 'admin', '', 'Dashboard Languages'),
(181, 'fontend_language', 'admin', '', 'Fontend Languages'),
(182, 'site_setting', 'admin', '', 'Site Settings'),
(183, 'site_settings', 'admin', '', 'site settings'),
(184, 'email_settings', 'admin', '', 'Email Settings'),
(185, 'payment_settings', 'admin', '', 'Payment settings'),
(186, 'home_banner_setting', 'admin', '', 'Banner settings'),
(187, 'content', 'admin', '', 'Content'),
(188, 'pages', 'admin', '', 'pages'),
(189, 'add_page', 'admin', '', 'add page'),
(190, 'cookies_privacy', 'admin', '', 'Cookie & Privacy'),
(191, 'user_transaction', 'admin', '', 'User\'s Transactions'),
(192, 'backup_database', 'admin', '', 'Backup Database'),
(193, 'subscriptions', 'user', '', 'subscriptions'),
(194, 'menu', 'user', '', 'Menu'),
(195, 'menu_categories', 'user', '', 'Menu Categories'),
(196, 'items', 'user', '', 'items'),
(197, 'specialties', 'user', '', 'specialties'),
(198, 'allergens', 'user', '', 'allergens'),
(199, 'live_order', 'user', '', 'live order'),
(200, 'reservation', 'user', '', 'reservation'),
(201, 'available_days', 'user', '', 'available days'),
(202, 'portfolio', 'user', '', 'portfolio'),
(203, 'social_sites', 'user', '', 'social sites'),
(204, 'add_cover_photo', 'user', '', 'Add Cover Photo'),
(205, 'manage_features', 'user', '', 'Manage Features'),
(206, 'order_config', 'user', '', 'Order Configuration'),
(207, 'layouts', 'user', '', 'layouts'),
(208, 'deactive_account', 'user', '', 'deactive account'),
(209, 'success', 'label', '', 'success'),
(210, 'show_details', 'label', '', 'Show Details'),
(211, 'keyword', 'label', '', 'Keyword'),
(212, 'values', 'label', '', 'Values'),
(213, 'types', 'label', '', 'Types'),
(214, 'admin_language', 'admin', '', 'admin language'),
(215, 'user_dashboard', 'label', '', 'user dashboard'),
(216, 'fontend_languages', 'label', '', 'Fontent Language'),
(217, 'others', 'label', '', 'others'),
(218, 'lang_name', 'admin', '', 'Language name'),
(219, 'language_slug', 'admin', '', 'Language Slug'),
(220, 'left_to_right', 'label', '', 'Left to right'),
(221, 'right_to_left', 'admin', '', 'Right to left'),
(222, 'price', 'admin', '', 'price'),
(223, 'name', 'label', '', 'name'),
(224, 'create_category', 'user', '', 'Create Category'),
(225, 'category_name', 'user', '', 'category name'),
(226, 'select_type', 'label', '', 'Select Type'),
(227, 'pizza', 'user', '', 'Pizza'),
(228, 'burger', 'user', '', 'Burger'),
(229, 'order', 'user', '', 'order'),
(230, 'sizes', 'user', '', 'Sizes'),
(231, 'size_name', 'user', '', 'Size Name'),
(232, 'insert_category', 'user', '', 'Please Insert Category'),
(233, 'insert_item_size', 'user', '', 'Please Insert Item Sizes'),
(234, 'insert_item_size_msg', 'user', '', 'you can set price depends on size (size available for pizza & Burger)'),
(235, 'info', 'label', '', 'Info!'),
(236, 'you_can_add', 'user', '', 'You can add'),
(237, 'unlimited', 'user', '', 'Unlimited'),
(238, 'you_reached_max_limit', 'user', '', 'You reached the maximum limit'),
(239, 'you_have_remaining', 'user', '', 'You have remaining'),
(240, 'out_of', 'user', '', 'out of'),
(241, 'add_items', 'user', '', 'add items'),
(242, 'is_size', 'user', '', 'Is Size'),
(243, 'veg_type', 'label', '', 'veg type'),
(244, 'non_veg', 'label', '', 'Non veg'),
(245, 'veg', 'label', '', 'veg'),
(246, 'small_description', 'user', '', 'small description'),
(247, 'show_in_homepage', 'user', '', 'Show in home page'),
(248, 'add_packages', 'user', '', 'Add Package'),
(249, 'is_discount', 'user', '', 'Is Discount'),
(250, 'custom_price', 'user', '', 'Custom Price'),
(251, 'discount', 'user', '', 'discount'),
(252, 'is_upcoming', 'user', '', 'Is Upcoming'),
(253, 'days', 'user', '', 'days'),
(254, 'empty_item_package', 'user', '', 'Empty Item For Packages'),
(255, 'empty_item_package_msg', 'user', '', 'You have to create item without size for package'),
(256, 'is_price_msg_1', 'user', 'Is price is for custom price if you want to set custom price for package.', 'Is price is for custom price if you want to set custom price for package.'),
(257, 'is_price_msg_2', 'user', 'Otherwise price will set  after calculation all items prices', 'Otherwise price will set  after calculation all items prices'),
(258, 'discount_msg', 'user', 'If you want to set discount for this package', 'If you want to set discount for this package'),
(259, 'featured', 'user', 'Featured', 'Featured'),
(260, 'overview', 'user', 'Overview', 'overview'),
(261, 'order_id', 'user', 'Order ID', 'Order ID'),
(262, 'order_details', 'user', 'Order Details', 'Order Details'),
(263, 'delivery_charge', 'user', 'Delivery charge', 'delivery charge'),
(264, 'total_person', 'user', 'Total Person', 'Total Person'),
(265, 'pickup_time', 'user', 'Pickup time', 'Pickup time'),
(266, 'accept', 'admin', 'accept', 'accept'),
(267, 'completed', 'user', 'Completed', 'Completed'),
(268, 'accepted', 'user', 'Accepted', 'accepted'),
(269, 'cancled', 'user', 'Cancled', 'Cancled'),
(270, 'order_list', 'user', 'Order list', 'order list'),
(271, 'item_name', 'user', 'Item name', 'item name'),
(272, 'live_orders', 'user', 'Live orders', 'live orders'),
(273, 'all_orders', 'user', 'All orders', 'all orders'),
(274, 'order_number', 'user', 'Order number', 'order number'),
(275, 'order_type', 'user', 'Order type', 'order type'),
(276, 'canceled', 'user', 'Canceled', 'canceled'),
(277, 'create_trail_package_msg', 'user', 'Please Create a Trail Package first', 'Please Create a Trail Package first'),
(278, 'create_trail_package_msg_1', 'user', 'After create trial package you can able to create free/others packages', 'After create trial package you can able to create free/others packages'),
(279, 'trial_for_month', 'admin', 'Trial for 1 Month', 'Trial for 1 Month'),
(280, 'monthly', 'admin', 'monthly', 'monthly'),
(281, 'yearly', 'admin', 'yearly', 'yearly'),
(282, 'set_free_for_month', 'admin', 'Account will set Free for 1 month', 'Account will set Free for 1 month'),
(283, 'limit_text_msg_1', 'admin', 'Set limit for Order & Items. How many Order & items will available for this package', 'Set limit for Order & Items. How many Order & items will available for this package'),
(284, 'limit_text_msg_2', 'admin', 'Select limit from drop down. if you not select any limit then it will set by default', 'Select limit from drop down. if you not select any limit then it will set by default'),
(285, 'add_change_feature', 'admin', 'Change/add Features', 'Change/add Features'),
(286, 'stripe', 'admin', 'stripe', 'stripe'),
(287, 'razorpay', 'admin', 'razorpay', 'razorpay'),
(288, 'offline', 'admin', 'offline', 'offline'),
(289, 'payment_via', 'admin', 'payment via', 'payment via'),
(290, 'send_payment_req', 'admin', 'Send a payment request', 'Send a payment request'),
(291, 'payment_verified_successfully', 'admin', 'Your payment verified successfully', 'Your payment verified successfully'),
(292, 'ok', 'admin', 'ok', 'ok'),
(293, 'stripe_payment_gateway', 'admin', 'Stripe Payment Gateway', 'Stripe Payment Gateway'),
(294, 'name_on_card', 'label', 'name on card', 'name on card'),
(295, 'card_number', 'admin', 'Card number', 'Card number'),
(296, 'month', 'admin', 'month', 'month'),
(297, 'year', 'admin', 'year', 'year'),
(298, 'cvc', 'admin', 'cvc', 'cvc'),
(299, 'whatsapp_number', 'label', 'whatsapp Number', 'whatsapp Number'),
(300, 'youtube', 'home', 'youtube', 'youtube'),
(301, 'facebook', 'home', 'facebook', 'facebook'),
(302, 'facebook_link', 'home', 'facebook link', 'facebook link'),
(303, 'twitter', 'home', 'twitter', 'twitter'),
(304, 'instagram', 'home', 'instagram', 'instagram'),
(305, 'about_short', 'home', 'about Short text', 'about Short text'),
(306, 'profile_qr', 'home', 'Profile QR code', 'Profile QR code'),
(307, 'download', 'home', 'Download', 'Download'),
(308, 'start_time', 'home', 'start time', 'start time'),
(309, 'end_time', 'home', 'end time', 'end time'),
(310, 'time_picker', 'home', 'Time picker', 'Time picker'),
(311, 'reservation_types', 'home', 'reservation types', 'reservation types'),
(312, 'type_name', 'home', 'type name', 'type name'),
(313, 'reservation_type_list', 'home', 'reservation type list', 'reservation type list'),
(314, 'all_reservation_list', 'home', 'All Reservation list', 'All Reservation list'),
(315, 'todays_reservations', 'home', 'Todays Reservation', 'Todays Reservation'),
(316, 'comments', 'home', 'comments', 'comments'),
(317, 'table_reservation', 'home', 'Table Reservation', 'Table Reservation'),
(318, 'if_use_smtp', 'label', 'if You use SMTP Mail', 'if You use SMTP Mail'),
(319, 'smtp_info_msg', 'label', 'Make sure SMTP MAIL, SMTP HOST, SMTP PORT and SMTP PASSWORD is correct', 'Make sure SMTP MAIL, SMTP HOST, SMTP PORT and SMTP PASSWORD is correct'),
(320, 'registration_subject', 'admin', 'Registration Email subject', 'Registration Email subject'),
(321, 'payment_mail_subject', 'label', 'Payment mail subject', 'Payment mail subject'),
(322, 'recovery_password_heading', 'user', 'Recovery Passowrd', 'Recovery Passowrd'),
(323, 'linkedin', 'label', 'linkedin', 'linkedin'),
(324, 'home_banner', 'admin', 'Home Banner', 'Home Banner'),
(325, 'home_small_banner', 'admin', 'Home small banner', 'Home small banner'),
(326, 'section_banner', 'admin', 'section banner', 'section banner'),
(327, 'add', 'admin', 'add', 'add'),
(328, 'section_name', 'admin', 'section name', 'section name'),
(329, 'pricing', 'admin', 'pricing', 'pricing'),
(330, 'reviews', 'admin', 'reviews', 'reviews'),
(331, 'contacts', 'admin', 'contacts', 'contacts'),
(332, 'section', 'admin', 'section', 'section'),
(333, 'heading', 'label', 'heading', 'heading'),
(334, 'sub_heading', 'admin', 'sub heading', 'sub heading'),
(335, 'banner', 'admin', 'banner', 'banner'),
(336, 'paypal_payment', 'admin', 'paypal_ payment', 'paypal payment'),
(337, 'sandbox', 'admin', 'sandbox', 'sandbox'),
(338, 'paypal_email', 'admin', 'Paypal Email', 'Paypal Email'),
(339, 'paypal_business_email', 'admin', 'Paypal Business Email', 'Paypal Business Email'),
(340, 'stripe_payment', 'admin', 'stripe Payment Gateway', 'stripe Payment Gateway'),
(341, 'stripe_public_key', 'admin', 'Stripe Public key', 'Stripe Public key'),
(342, 'stripe_secret_key', 'admin', 'Stripe Secret key', 'Stripe Secret key'),
(343, 'razorpay_payment', 'admin', 'razorpay payment', 'razorpay payment'),
(344, 'razorpay_key', 'admin', 'Razorpay Key', 'Razorpay Key'),
(345, 'favicon', 'admin', 'favicon', 'favicon'),
(346, 'site_logo', 'admin', 'site_logo', 'site_logo'),
(347, 'time_zone', 'admin', 'time zone', 'time zone'),
(348, 'site_name', 'label', 'site name', 'site name'),
(349, 'description', 'admin', 'description', 'description'),
(350, 'google_analytics', 'admin', 'Google Analytics', 'Google Analytics'),
(351, 'pricing_layout', 'admin', 'pricing layout', 'pricing layout'),
(352, 'style_1', 'admin', 'Style 1', 'Style 1'),
(353, 'style_2', 'admin', 'Style 2', 'Style 2'),
(354, 'reg_system', 'admin', 'Registration System', 'Registration System'),
(355, 'auto_approval', 'label', 'auto approval', 'auto approval'),
(356, 'email_verify', 'label', 'Email Verification', 'Email Verification'),
(357, 'free_verify', 'label', 'Free Verify', 'Free Verify'),
(358, 'user_invoice', 'label', 'user invoice', 'user invoice'),
(359, 'rating', 'label', 'rating', 'rating'),
(360, 'recaptcha', 'label', 'recaptcha', 'recaptcha'),
(361, 'g_site_key', 'label', 'recaptcha site key', 'recaptcha site key'),
(362, 'g_secret_key', 'label', 'secret Key', 'secret Key'),
(363, 'order_configuration', 'label', 'Order Configuration', 'Order Configuration'),
(364, 'configuration', 'label', 'Configuration', 'Configuration'),
(365, 'whatsapp_order', 'label', 'Whatsapp Order', 'Whatsapp Order'),
(366, 'runing_package', 'user', 'Runing Package', 'Runing Package'),
(367, 'account_will_expired', 'user', 'Your package will expire after', 'Your package will expire after'),
(368, 'package_expiration', 'user', 'Package expiration', 'Package expiration'),
(369, 'lifetime', 'user', 'Lifetime', 'lifetime'),
(370, 'payment_not_active_due_to_payment', 'user', 'Your package is not active due to payment. (Pending..)', 'Your package is not active due to payment. (Pending..)'),
(371, 'package_reactive_msg', 'user', 'Your package is expired. you can re-active it again', 'Your package is expired. you can re-active it again'),
(372, 'select_this_package', 'user', 'You can also select this package', 'You can also select this package'),
(373, 'contact_email', 'user', 'Contact email', 'contact email'),
(374, 'colors', 'user', 'Colors', 'Colors'),
(375, 'color_picker', 'user', 'Color picker', 'Color picker'),
(376, 'preloader', 'user', 'Preloader', 'preloader'),
(377, 'choose_restaurant_name', 'home', 'Choose your Resaturant Name', 'Choose your Resaturant Name'),
(378, 'create_the_first_impression', 'home', 'Create The Great First Impression', 'Create The Great First Impression'),
(379, 'create', 'home', 'Create', 'Create'),
(380, 'try_with_qr_code', 'home', 'Try With QR code', 'Try With QR code'),
(381, 'quick_links', 'home', 'quick links', 'quick links'),
(382, 'cookies_msg_1', 'home', 'We use cookies in this website to give you the best experience on our', 'We use cookies in this website to give you the best experience on our'),
(383, 'cookies_msg_2', 'home', 'site and show you relevant ads. To find out more, read our', 'site and show you relevant ads. To find out more, read our'),
(384, 'copyright_text', 'home', 'All rights reserved.', 'All rights reserved.'),
(385, 'sign-up', 'home', 'Signup', 'Signup'),
(386, 'login', 'home', 'login', 'login'),
(387, 'track_order', 'home', 'track order', 'track order'),
(388, 'lets_work_together', 'home', 'Let\'s work together', 'Let\'s work together'),
(389, 'join_our_team_text', 'home', 'Join my team so that together we can achieve success', 'Join my team so that together we can achieve success'),
(390, 'forgot_password', 'home', 'Forgot Password', 'Forgot Password'),
(391, 'forget_pass_alert', 'home', 'Seems like you forgot your password for login? if true set your email to reset password', 'Seems like you forgot your password for login? if true set your email to reset password'),
(392, 'remember_password', 'home', 'Remember Password?', 'Remember Password?'),
(393, 'sign_in', 'home', 'Sign in', 'Sign in'),
(394, 'sign_in_text', 'home', 'Signup to discover your shop', 'Signup to discover your shop'),
(395, 'dont_have_account', 'home', 'Don\'t have account', 'Don\'t have account'),
(396, 'read_terms', 'home', 'I have read the', 'I have read the'),
(397, 'accept_them', 'home', 'accept them', 'accept them'),
(398, 'already_member', 'home', 'Already a Member?', 'Already a Member?'),
(399, 'message', 'home', 'message', 'message'),
(400, 'send', 'home', 'send', 'send'),
(401, 'get_start', 'home', 'Get Started', 'Get Started'),
(402, 'play_video', 'home', 'Play Video', 'Play Video'),
(403, 'read_more', 'home', 'Read More', 'Read More'),
(404, 'all', 'home', 'All', 'All'),
(405, 'has_been_add_to_cart', 'home', 'has been added to the cart', 'has been added to the cart'),
(406, 'view_cart', 'home', 'View Cart', 'View Cart'),
(407, 'size', 'home', 'size', 'size'),
(408, 'add_to_cart', 'home', 'add cart', 'add cart'),
(409, 'order_form', 'home', 'order form', 'order form'),
(410, 'full_name', 'home', 'full name', 'full name'),
(411, 'person', 'home', 'person', 'person'),
(412, 'select_person', 'home', 'select person', 'select person'),
(413, 'confirm_order', 'home', 'confirm order', 'confirm order'),
(414, 'order_confirmed', 'home', 'order confirmed', 'order confirmed'),
(415, 'your_order_id', 'home', 'your order id', 'your order id'),
(416, 'track_your_order_using_phone', 'home', 'You can track you order using your phone number', 'You can track you order using your phone number'),
(417, 'total_qty', 'home', 'Total Qty', 'Total Qty'),
(418, 'total_price', 'home', 'Total Price', 'Total Price'),
(419, 'order_date', 'home', 'Order Date', 'Order Date'),
(420, 'rejected', 'home', 'rejected', 'rejected'),
(421, 'you_have_more', 'home', 'You have more', 'You have more'),
(422, 'item_name', 'home', 'Item name', 'item name'),
(423, 'delivery_address', 'home', 'Delivery address', 'Delivery address'),
(424, 'shop_address', 'home', 'shop address', 'shop address'),
(425, 'share_your_location', 'home', 'Share your location here', 'Share your location here'),
(426, 'order_on_whatsapp', 'home', 'Order On Whatsapp', 'Order On Whatsapp'),
(427, 'order_now', 'home', 'order now', 'order now'),
(428, 'book_now', 'home', 'Book Now', 'Book Now'),
(429, 'watch_video', 'home', 'Watch Video', 'Watch Video'),
(430, 'fast_service', 'home', 'Fast Service', 'Fast Service'),
(431, 'fresh_food', 'home', 'Fresh Food', 'Fresh Food'),
(432, '24_support', 'home', '24/7 Support', '24/7 Support'),
(433, 'about_us', 'home', 'about us', 'about us'),
(434, 'maximum_order_alert', 'home', 'Sorry! This Restaurant reached the maximum orders', 'Sorry! This Restaurant reached the maximum orders'),
(435, 'contact_us', 'home', 'Contact Us', 'Contact Us'),
(436, 'checkout', 'home', 'checkout', 'checkout'),
(437, 'sorry_cant_take_order', 'home', 'Sorry! We can not take any orders', 'Sorry! We can not take any orders'),
(438, '404_not', 'home', '404 Not Found', '404 Not Found'),
(439, 'subject', 'home', 'subject', 'subject'),
(440, 'see_more', 'home', 'See More', 'See More'),
(441, 'number_of_guest', 'home', 'number of guest', 'number of guest'),
(442, 'reservation_type', 'home', 'reservation type', 'reservation type'),
(443, 'any_special_request', 'home', 'Any Special Request?', 'Any Special Request?'),
(444, 'booking_availabiti_text', 'home', 'Before booking an reservation please check our availability', 'Before booking an reservation please check our availability'),
(445, 'phone_number', 'home', 'Phone Number', 'Phone Number'),
(446, 'check', 'home', 'check', 'check'),
(447, 'search_with_username', 'home', 'Search with username', 'Search with username'),
(448, 'search', 'home', 'search', 'search'),
(449, 'restaurant_name', 'home', 'Restaurant Name', 'Restaurant Name'),
(450, 'forgot', 'home', 'forgot', 'forgot?'),
(451, 'total', 'home', 'total', 'total'),
(452, 'select_order_type', 'home', 'select order type', 'select order type'),
(453, 'quick_view', 'home', 'Quick View', 'Quick View'),
(454, 'reservation_date', 'home', 'reservation date', 'reservation date'),
(455, 'restaurant_list', 'admin', 'restaurant list', 'restaurant list'),
(456, 'total_restaurant', 'admin', 'total restaurant', 'total restaurant'),
(457, 'add restaurant', 'admin', 'add_restaurant', 'add_restaurant'),
(458, 'packages', 'admin', 'packages', 'packages'),
(459, 'features_list', 'admin', 'features list', 'features list'),
(460, 'type', 'label', 'type', 'type'),
(461, 'save_change_successfully', 'admin', 'save change successfully', 'save change successfully'),
(462, 'success_text', 'admin', 'save change successfully', 'save change successfully'),
(463, 'error_text', 'admin', 'Somethings Were Wrong!!', 'Somethings Were Wrong!!'),
(464, 'yes', 'label', 'yes', 'yes'),
(465, 'no', 'label', 'no', 'no'),
(466, 'are_you_sure', 'label', 'are_you_sure', 'are you sure'),
(467, 'item_deactive_now', 'label', 'This item is deactive now', 'This item is deactive now'),
(468, 'item_active_now', 'label', 'Item is active now', 'Item is active now'),
(469, 'want_to_reset_password', 'label', 'Want to reset Password?', 'Want to reset Password?'),
(470, 'sunday', 'user', 'Sunday', 'Sunday'),
(471, 'monday', 'user', 'Monday', 'Monday'),
(472, 'tuesday', 'user', 'Tuesday', 'Tuesday'),
(473, 'wednesday', 'user', 'Wednesday', 'Wednesday'),
(474, 'thursday', 'user', 'Thursday', 'Thursday'),
(475, 'friday', 'user', 'Friday', 'Friday'),
(476, 'saturday', 'user', 'Saturday', 'Saturday'),
(477, 'booking_date', 'admin', 'Booking Date', 'Booking Date'),
(478, 'pickup_alert', 'admin', 'Sorry Pickup is not available', 'Sorry Pickup is not available'),
(479, 'qty', 'user', 'Qty', 'qty'),
(480, 'item', 'user', 'Item', 'item'),
(481, 'order_video', 'user', 'Order video link', 'Order video link'),
(482, 'home_setting', 'user', 'Home Settings', 'Home Settings'),
(483, 'total_revenue', 'user', 'Total Revenue', 'Total Revenue'),
(484, 'categories', 'admin', 'categories', 'categories'),
(485, 'images', 'user', 'images', 'images'),
(486, 'want_to_deactive_account', 'user', 'Want to deactive your account?', 'Want to deactivate your account?'),
(487, 'want_to_active_account', 'user', 'Want to active your account?', 'Want to activate your account?'),
(488, 'back', 'user', 'Back', 'Back'),
(489, 'sorry_payment_faild', 'user', 'Sorry Payment Failed', 'Sorry Payment Failed'),
(490, 'my_cart', 'user', 'My cart', 'My cart'),
(491, 'shipping', 'user', 'shipping', 'shipping'),
(492, 'sub_total', 'user', 'Sub Total', 'Sub Total'),
(493, 'payment_not_available', 'user', 'payment not available', 'payment not available');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_info`
--

CREATE TABLE `order_payment_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `currency_code` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_types`
--

CREATE TABLE `order_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_order_types` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_types`
--

INSERT INTO `order_types` (`id`, `name`, `slug`, `status`, `is_order_types`, `created_at`) VALUES
(1, 'Cash on delivery', 'cash-on-delivery', 1, 1, '2021-04-06 16:48:57'),
(2, 'Booking', 'booking', 1, 1, '2021-04-06 16:50:12'),
(3, 'Reservation', 'reservation', 1, 0, '2021-04-06 16:50:38'),
(4, 'Pickup', 'pickup', 1, 1, '2021-04-06 16:50:38'),
(5, 'Pay in cash', 'pay-in-cash', 1, 1, '2021-04-06 16:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `users_active_order_types`
--

CREATE TABLE `users_active_order_types` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `language_data`
--
ALTER TABLE `language_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payment_info`
--
ALTER TABLE `order_payment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_types`
--
ALTER TABLE `order_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_active_order_types`
--
ALTER TABLE `users_active_order_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `language_data`
--
ALTER TABLE `language_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT for table `order_payment_info`
--
ALTER TABLE `order_payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_types`
--
ALTER TABLE `order_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_active_order_types`
--
ALTER TABLE `users_active_order_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
