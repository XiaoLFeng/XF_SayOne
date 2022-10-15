<?PHP
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * API主页 - 确认是否正常运行
 */

// 编译数据
$data = array(
    'output'=>'SUCCESS',
    'code'=>200,
    'info'=>'ONLINE NOW'
);
// 输出数据
echo json_encode($data,JSON_UNESCAPED_UNICODE);