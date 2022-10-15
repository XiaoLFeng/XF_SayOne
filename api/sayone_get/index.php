<?PHP 
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * API - 说说信息获取
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/include.php');

// 获取参数
$data_ssid = htmlspecialchars($_GET['ssid']);
$data_page = htmlspecialchars($_GET['page']);
$data_desc = htmlspecialchars($_GET['desc']);

// 函数构建
if (!empty($data_ssid) and $data_ssid == $sql_ssid) {
    // 修正数据
    if (empty($data_page)) {
        $data_page = '0,5';
    }
    if (empty($data_desc)) {
        $data_desc = 'DESC';
    }
    $num = 1; // 定义数据
    // 数据库查找数据
    $result_sayone = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['SayOne']." ORDER BY id $data_desc limit $data_page");
    $result_sayone_row = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['SayOne']." ORDER BY id");
    while ($result_sayone_object = mysqli_fetch_object($result_sayone)) {
        $array[$num] = array(
            'id'=>$result_sayone_object->id,
            'text'=>$result_sayone_object->text,
            'time'=>$result_sayone_object->time,
            'update_time'=>$result_sayone_object->update_time,
            'look'=>$result_sayone_object->look,
        );
        $num ++;
    }
    // 编译数据
    $data = array(
        'output'=>'SUCCESS',
        'code'=>200,
        'info'=>'数据输出完毕',
        'row'=>$result_sayone_row->num_rows,
        'data'=>$array,
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
} else {
    // 编译数据
    $data = array(
        'output'=>'SSID_ERROR',
        'code'=>403,
        'info'=>'参数 Query[ssid] 密钥错误或为空'
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 403 Forbidden");
}