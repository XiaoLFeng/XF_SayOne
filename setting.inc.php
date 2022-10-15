<?PHP
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * 配置文件
 */

// 格式化数据
$setting = array();

/*---------------- 基本设置 ----------------*/
// 开启站点
$setting['Web']['Start'] = TRUE;
// 开启Debug
$setting['Web']['Debug'] = TRUE;
// 镜像选择（Jsdelivr | akass | offline）
$setting['Web']['Mirror'] = 'akass';
// 通信密钥
$setting['Web']['Ssid'] = '477747459912654';

/*---------------- 数据库 ----------------*/
// 数据库地址
$setting['SQL']['Host'] = '127.0.0.1';
// 数据库端口
$setting['SQL']['Port'] = 3306;
// 数据库名字
$setting['SQL']['DBname'] = 'xf_sayone';
// 数据库用户名
$setting['SQL']['UserName'] = 'root';
// 数据库密码
$setting['SQL']['Password'] = 'X+7ily20040722';

/*---------------- 数据表 ----------------*/
// 网站 - 数据表
$setting['TABLE']['Web'] = 'xf_web_data';
// 说说 - 数据表
$setting['TABLE']['SayOne'] = 'xf_sayone';
// 用户 - 数据表
$setting['TABLE']['User'] = 'xf_users';
// 评论 - 数据表
$setting['TABLE']['Comment'] = 'xf_comments';
// 镜像 - 数据表
$setting['TABLE']['Mirror'] = 'xf_mirrors';