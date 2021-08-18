<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-08-17 06:49:06 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2021-08-17 12:01:56 --> Severity: error --> Exception: Call to a member function set_flashdata() on null C:\xampp\htdocs\Restaurant\application\controllers\customer\Api.php 3098
ERROR - 2021-08-17 12:02:23 --> Severity: error --> Exception: Call to a member function set_flashdata() on null C:\xampp\htdocs\Restaurant\application\controllers\customer\Api.php 3098
ERROR - 2021-08-17 12:02:24 --> Severity: error --> Exception: Call to a member function set_flashdata() on null C:\xampp\htdocs\Restaurant\application\controllers\customer\Api.php 3098
ERROR - 2021-08-17 18:17:41 --> Query error: Unknown column 'user_type' in 'where clause' - Invalid query: SELECT * from tbl_notification_by_staff where staff_mobile_no='9760213076' and date_time and user_type='customer'LIKE '%2021-08-17%' order by date_time desc
ERROR - 2021-08-17 15:22:17 --> 404 Page Not Found: Admin/images
ERROR - 2021-08-17 15:22:39 --> 404 Page Not Found: StaffListController/images
ERROR - 2021-08-17 15:23:32 --> 404 Page Not Found: Menu/images
ERROR - 2021-08-17 15:26:04 --> 404 Page Not Found: SuperAdmin/images
ERROR - 2021-08-17 19:07:56 --> Query error: Unknown column 'rsr.status,s.name' in 'where clause' - Invalid query: SELECT `rsr`.*, `s`.`name` as `restaurant_name`
FROM `tbl_restaurant_staff_registration` AS `rsr`
INNER JOIN `spots` as `s` ON `s`.`admin_id`=`rsr`.`admin_id`
WHERE   (
`rsr`.`id` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`name` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`email` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`mobile_no` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`aadhar_no` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`pan_number` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`permanent_address` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`user_type` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`create_date` LIKE '%w%' ESCAPE '!'
OR  `rsr`.`status,s`.`name` LIKE '%w%' ESCAPE '!'
 )
ORDER BY `rsr`.`id` DESC
 LIMIT 10
ERROR - 2021-08-17 15:44:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `user_fullname` LIKE '%anja...' at line 4 - Invalid query: SELECT *
FROM `master_user`
WHERE   (
 LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `user_fullname` LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `user_email` LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `mobile_no` LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `user_password` LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `user_createdate` LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
OR  `user_role` LIKE '%anjali.rawat@goolean.tech%' ESCAPE '!'
 )
ORDER BY `id` DESC, `id` ASC
 LIMIT 10
ERROR - 2021-08-17 15:45:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `user_fullname` LIKE '%anjal...' at line 4 - Invalid query: SELECT *
FROM `master_user`
WHERE   (
 LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `user_fullname` LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `user_email` LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `mobile_no` LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `user_password` LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `user_createdate` LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
OR  `user_role` LIKE '%anjali.rawat@goolean.tec%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-08-17 15:57:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `user_fullname` LIKE '%anjali...' at line 4 - Invalid query: SELECT *
FROM `master_user`
WHERE   (
 LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `user_fullname` LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `user_email` LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `mobile_no` LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `user_password` LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `user_createdate` LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
OR  `user_role` LIKE '%anjali.rawat@goolean.ec%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-08-17 15:58:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIKE '%a%' ESCAPE '!'
OR  `user_fullname` LIKE '%a%' ESCAPE '!'
OR  `user_ema...' at line 4 - Invalid query: SELECT *
FROM `master_user`
WHERE   (
 LIKE '%a%' ESCAPE '!'
OR  `user_fullname` LIKE '%a%' ESCAPE '!'
OR  `user_email` LIKE '%a%' ESCAPE '!'
OR  `mobile_no` LIKE '%a%' ESCAPE '!'
OR  `user_password` LIKE '%a%' ESCAPE '!'
OR  `user_createdate` LIKE '%a%' ESCAPE '!'
OR  `user_role` LIKE '%a%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-08-17 15:58:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIKE '%am%' ESCAPE '!'
OR  `user_fullname` LIKE '%am%' ESCAPE '!'
OR  `user_e...' at line 4 - Invalid query: SELECT *
FROM `master_user`
WHERE   (
 LIKE '%am%' ESCAPE '!'
OR  `user_fullname` LIKE '%am%' ESCAPE '!'
OR  `user_email` LIKE '%am%' ESCAPE '!'
OR  `mobile_no` LIKE '%am%' ESCAPE '!'
OR  `user_password` LIKE '%am%' ESCAPE '!'
OR  `user_createdate` LIKE '%am%' ESCAPE '!'
OR  `user_role` LIKE '%am%' ESCAPE '!'
 )
ORDER BY `id` DESC
 LIMIT 10
