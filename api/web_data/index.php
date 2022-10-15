<?PHP 
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * API - 网站基本信息获取
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/include.php');

// 载入参数
$ssid = htmlspecialchars($_GET['ssid']);

// 函数构建
if (!empty($ssid)) {
    if ($ssid == $sql_ssid) {
        $result_web = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Web']);
        while ($result_web_object = mysqli_fetch_object($result_web)) {
            $array[$result_web_object->info] = array(
                'id'=>$result_web_object->id,
                'text'=>$result_web_object->data,
                'look'=>$result_web_object->look
            );
        }
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'数据输出成功',
            'data'=>$array,
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } else {
        // 编译数据
        $data = array(
            'output'=>'SSID_ERROR',
            'code'=>403,
            'info'=>'参数 Query[ssid] 密钥错误'
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        header("HTTP/1.1 403 Forbidden");
    }
} else {
    $result_web = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Web']);
    while ($result_web_object = mysqli_fetch_object($result_web)) {
        if ($result_web_object->info !== 'system_ssid') {
            $array[$result_web_object->info] = array(
                'id'=>$result_web_object->id,
                'text'=>$result_web_object->data,
                'look'=>$result_web_object->look
            );
        }
    }
    // 编译数据
    $data = array(
        'output'=>'SUCCESS',
        'code'=>200,
        'info'=>'数据输出成功',
        'data'=>$array,
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
}