<?PHP
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * 前置载入组件
 */

// 载入设置
include($_SERVER['DOCUMENT_ROOT']."/setting.inc.php");

// 检查设置
    // 检查是否启用站点
    if ($setting['Web']['Start'] == FALSE) {
        header('location: /offline.php');
    }
    // 是否开启了Debug
    if ($setting['Web']['Debug'] == TRUE) {
        echo("<script>console.log('[Debug]".date("Y-m-d H:i:s")." 当前开启了 Debug 模式！');</script>");
    }

// 载入API
    // 载入网站基本信息
    $normal_url = $_SERVER['HTTP_HOST'].'/api/web_data/';    
    $normal_ch = curl_init($normal_url);
    curl_setopt($normal_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($normal_ch, CURLOPT_RETURNTRANSFER, true);
    $normal = curl_exec($normal_ch);
    $normal = json_decode($normal,true);
        // Debug
        if ($setting['Web']['Debug'] == TRUE) {
            echo("<script>console.log('[Debug]".date("Y-m-d H:i:s")." 已载入 API(normal) 内容');</script>");
        }
    // 载入镜像基本信息
    $mirror_url = $_SERVER['HTTP_HOST'].'/api/web_data/mirrors.php?ssid='.$setting['Web']['Ssid'];    
    $mirror_ch = curl_init($mirror_url);
    curl_setopt($mirror_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($mirror_ch, CURLOPT_RETURNTRANSFER, true);
    $mirror = curl_exec($mirror_ch);
    $mirror = json_decode($mirror,true);
        // Debug
        if ($setting['Web']['Debug'] == TRUE) {
            echo("<script>console.log('[Debug]".date("Y-m-d H:i:s")." 已载入 API(mirror) 内容');</script>");
        }

// Debug
if ($setting['Web']['Debug'] == TRUE) {
    echo("<script>console.log('[Debug]".date("Y-m-d H:i:s")." 已载入 /include.php 页面');</script>");
}
