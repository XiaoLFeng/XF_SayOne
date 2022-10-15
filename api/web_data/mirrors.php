<?PHP 
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * API - 镜像地址获取
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/include.php');

// 参数获取
$ssid = htmlspecialchars($_GET['ssid']);

// 数据库信息获取
if (!empty($ssid)) {
    if ($ssid == $sql_ssid) {
        // 整理参数
        if (!empty($setting['Web']['Mirror'])) {
            // 读取数据库
            $result_mirror_bootstrap_css = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Mirror']." WHERE info='".$setting['Web']['Mirror']."_bootstrap_css'");
            $result_mirror_bootstrap_icon = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Mirror']." WHERE info='".$setting['Web']['Mirror']."_bootstrap_icon'");
            $result_mirror_bootstrap_js = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Mirror']." WHERE info='".$setting['Web']['Mirror']."_bootstrap_js'");
            $result_mirror_bootstrap_bundle_js = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Mirror']." WHERE info='".$setting['Web']['Mirror']."_bootstrap_bundle_js'");
            $result_mirror_jquery = mysqli_query($SQL_conn,"SELECT * FROM ".$setting['TABLE']['Mirror']." WHERE info='".$setting['Web']['Mirror']."_jquery'");
            $result_mirror_bootstrap_css_object = mysqli_fetch_object($result_mirror_bootstrap_css);
            $result_mirror_bootstrap_icon_object = mysqli_fetch_object($result_mirror_bootstrap_icon);
            $result_mirror_bootstrap_js_objetct = mysqli_fetch_object($result_mirror_bootstrap_js);
            $result_mirror_bootstrap_bundle_js_object = mysqli_fetch_object($result_mirror_bootstrap_bundle_js);
            $result_mirror_jquery_object = mysqli_fetch_object($result_mirror_jquery);
            // 整理数据
            $info = array(
                'bootstrap_css'=>$result_mirror_bootstrap_css_object->data,
                'bootstrap_icon'=>$result_mirror_bootstrap_icon_object->data,
                'bootstrap_js'=>$result_mirror_bootstrap_js_objetct->data,
                'bootstrap_bundle_js'=>$result_mirror_bootstrap_bundle_js_object->data,
                'jquery'=>$result_mirror_jquery_object->data,
            );
        } else {
            $info = array(
                'bootstrap_css'=>'/src/css/bootstrap.min.css',
                'bootstrap_icon'=>'/src/css/bootstrap-icons.css',
                'bootstrap_js'=>'/src/js/bootstrap.min.js',
                'bootstrap_bundle_js'=>'/src/js/bootstrap.bundle.min.js',
                'jquery'=>'/src/js/jquery.min.js',
                'qweather'=>'/src/css/qweather-icons.css'
            );
        }
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'数据输出成功',
            'data'=>array(
                'type'=>$setting['Web']['Mirror'],
                'info'=>$info,
            ),
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
    // 关闭数据库
    mysqli_free_result($result_ssid);
    mysqli_close($SQL_conn);
} else {
    // 编译数据
    $data = array(
        'output'=>'SSID_EMPTY',
        'code'=>403,
        'info'=>'参数 Query[ssid] 缺失'
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 403 Forbidden");
}