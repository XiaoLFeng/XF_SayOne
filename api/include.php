<?PHP
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * API - 前置配置文件
 */

// 设置请求头
//header('Content-Type: application/json;charset=utf-8');

// 获取数据（获取数据库信息）
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/sql_conn.php');

// 从数据库获取数据
$result_ssid = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Web']." WHERE info='system_ssid'");
$result_ssid_object = mysqli_fetch_object($result_ssid);
$sql_ssid = $result_ssid_object->data;

// 日志记录
    // 日志记录时间
    $logs_time = date("Y-m-d H:i:s");
    // 日志记录用户使用的IP情况
    $logs_ip = $_SERVER["REMOTE_ADDR"];