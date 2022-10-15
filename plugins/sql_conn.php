<?PHP 
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * 数据库文件配置
 */

//定义参数
$SQL_host = $setting['SQL']['Host'];
$SQL_dbname = $setting['SQL']['DBname'];
$SQL_username = $setting['SQL']['UserName'];
$SQL_password = $setting['SQL']['Password'];
//判断数据库端口
if($setting['SQL']['Port'] == 3306 or $setting['SQL']['Port'] == NULL){
    //定义参数
    $SQL_port = 3306;
} else {
    //定义参数
    $SQL_port = $setting['sql']['port'];
}
//连接数据库
$SQL_conn=new MySQLi($SQL_host,$SQL_username,$SQL_password,$SQL_dbname,$SQL_port);