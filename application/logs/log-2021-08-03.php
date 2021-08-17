<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-08-03 06:49:09 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2021-08-03 08:11:19 --> Severity: Notice --> Undefined variable: rest_type C:\xampp\htdocs\Restaurant\application\views\dashboard.php 404
ERROR - 2021-08-03 08:11:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\Restaurant\application\views\dashboard.php 404
ERROR - 2021-08-03 08:11:20 --> 404 Page Not Found: Admin/images
ERROR - 2021-08-03 13:39:52 --> Query error: Unknown column 'oi.get_payment' in 'field list' - Invalid query: SELECT `oi`.`admin_id`, `oi`.`order_id`, `oi`.`get_payment`, `oi`.`total_order_amount`, `od`.`get_payment`
FROM `order_invoice` as `oi`
LEFT JOIN `tbl_order_detail_for_restaurant` AS `od` ON `oi`.`order_id`=`od`.`order_id`
WHERE `oi`.`admin_id` = 'HRGR00005'
AND `oi`.`status` = 1
ERROR - 2021-08-03 13:46:23 --> Query error: Unknown column 'oi.gst' in 'field list' - Invalid query: SELECT `oi`.`admin_id`, `oi`.`order_id`, `oi`.`discount_amount`, `oi`.`total_order_amount`, `oi`.`gst`, `oi`.`creation_date`, `od`.`get_payment`, `pt`.`payment_mode`
FROM `order_invoice` as `oi`
LEFT JOIN `tbl_order_detail_for_restaurant` AS `od` ON `oi`.`order_id`=`od`.`order_id`
LEFT JOIN `payment_txns` AS `pt` ON `pt`.`order_id`=`od`.`order_id`
WHERE `oi`.`admin_id` = 'HRGR00005'
AND `oi`.`status` = 1
ERROR - 2021-08-03 12:54:49 --> Severity: error --> Exception: syntax error, unexpected '.=' (T_CONCAT_EQUAL) C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 5088
ERROR - 2021-08-03 16:59:28 --> Query error: Unknown column 'md.creation_date' in 'where clause' - Invalid query: SELECT `oi`.`admin_id`, `oi`.`order_id`, `oi`.`discount_amount`, `oi`.`total_order_amount`, `oi`.`total_gst`, `oi`.`creation_date`, `od`.`get_payment`, `pt`.`payment_mode`, `od`.`net_pay_amount`, `od`.`discount`
FROM `order_invoice` as `oi`
LEFT JOIN `tbl_order_detail_for_restaurant` AS `od` ON `oi`.`order_id`=`od`.`order_id`
LEFT JOIN `payment_txns` AS `pt` ON `pt`.`order_id`=`oi`.`order_id`
WHERE `oi`.`admin_id` = 'HRGR00005'
AND `oi`.`status` = 1
AND `oi`.`creation_date` >= '2021-07-18'
AND `md`.`creation_date` <= '2021-07-29'
