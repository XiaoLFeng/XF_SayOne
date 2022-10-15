<?PHP
/*
 * XF_SayOne 说说
 * 由筱锋个人开发，与锋叶FrontLeaves组织无关系
 * 如未授权，禁止商用
 * 
 * 主访问程序
 */

// 载入组件
include($_SERVER['DOCUMENT_ROOT']."/include.php");

// 载入参数 
$page = htmlspecialchars($_GET['page']);

// 数据处理
if (empty($page) or $page == 1) {
    $page = 1;
    $calcs = 1 * 5 - 5;
} else {
    $calcs = $page * 5 - 5;
}

// 载入说说
$sayone_url = $_SERVER['HTTP_HOST'].'/api/sayone_get/?ssid='.$setting['Web']['Ssid'].'&page='.$calcs.',5';    
$sayone_ch = curl_init($sayone_url);
curl_setopt($sayone_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($sayone_ch, CURLOPT_RETURNTRANSFER, true);
$sayone = curl_exec($sayone_ch);
$sayone = json_decode($sayone,true);
    // Debug
    if ($setting['Web']['Debug'] == TRUE) {
        echo("<script>console.log('[Debug]".date("Y-m-d H:i:s")." 已载入 API(sayone) 内容');</script>");
    }

// 判断页数
$page_5 = floor($sayone['row']/5) + 1;
// 判断是否出现错误
if ($page > $page_5) {
    header('location: /');
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?PHP echo $normal['data']['web_title']['text'] ?> | <?PHP echo $normal['data']['web_desc']['text'] ?></title>
    <link rel="shortcut icon" href="<?PHP echo $normal['data']['web_icon']['text'] ?>" type="image/x-icon">
    <!-- Css -->
    <link rel="stylesheet" href="<?PHP echo $mirror['data']['info']['bootstrap_css'] ?>">
    <link rel="stylesheet" href="<?PHP echo $mirror['data']['info']['bootstrap_icon'] ?>">
</head>
<body>
<!-- 菜单 -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid py-2">
            <a class="navbar-brand" href="/"><?PHP echo $normal['data']['web_title']['text'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li>
                        <a class="nav-link" aria-current="page" href="<?PHP echo $normal['data']['link_home']['text'] ?>"><i class="bi bi-house"></i> 首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/"><i class="bi bi-chat"></i> 说说</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/"><i class="bi bi-person"></i> 管理</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- 正文 -->
<div class="container">
    <div class="row">
        <div class="col-12 mb-1 fs-4 text-center"><?PHP echo $normal['data']['web_title']['text'] ?></div>
        <div class="col-12 mb-4 fs-5 text-center"><?PHP echo $normal['data']['web_desc']['text'] ?></div>
        <div class="col-12">
            <div class="row">
                <?PHP
                $num = 1;
                while ($sayone['data'][$num]['id'] !== NULL) {
                    ?>
                    <div class="col-12 mb-3">
                        <div class="col-12 col-lg-6" style="margin:0 auto">
                            <div class="card shadow rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3"><?PHP echo $sayone['data'][$num]['text'] ?></div>
                                        <div class="col-12 text-secondary text-end"><?PHP echo $sayone['data'][$num]['time'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?PHP
                    $num ++;
                }
                ?>
                <div class="col-12 mb-3">
            </div>
        </div>
    </div>
</div>
<!-- 分页 -->
<div class="container">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?PHP if ($page == 1) {echo 'disabled';}?>">
                <a class="page-link" href="?page=<?PHP echo $page-1; ?>">上一页</a>
            </li>
            <?PHP
            // 翻页 1
            if ($page == 1) {
                $pages = 1;
                echo '<li class="page-item active"><a class="page-link" href="?page='.$pages.'">'.$pages.'</a></li>';
            } elseif ($page == $page_5) {
                $pages = $page_5 - 2;
                echo '<li class="page-item"><a class="page-link" href="?page='.$pages.'">'.$pages.'</a></li>';
            } else {
                $pages = $page - 1;
                echo '<li class="page-item"><a class="page-link" href="?page='.$pages.'">'.$pages.'</a></li>';
            }
            // 翻页 2
            if ($page == 1) {
                $pages_1 = 2;
                echo '<li class="page-item"><a class="page-link" href="?page='.$pages_1.'">'.$pages_1.'</a></li>';
            } elseif ($page == $page_5) {
                $pages_1 = $page_5 - 1;
                echo '<li class="page-item"><a class="page-link" href="?page='.$pages_1.'">'.$pages_1.'</a></li>';
            } else {
                $pages_1 = $page;
                echo '<li class="page-item active"><a class="page-link" href="?page='.$pages_1.'">'.$pages_1.'</a></li>';
            }
            // 翻页 3
            if ($page == 1) {
                $pages_2 = 3;
                echo '<li class="page-item"><a class="page-link" href="?page='.$pages_2.'">'.$pages_2.'</a></li>';
            } elseif ($page == $page_5) {
                $pages_2 = $page_5;
                echo '<li class="page-item active"><a class="page-link" href="?page='.$pages_2.'">'.$pages_2.'</a></li>';
            } else {
                $pages_2 = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="?page='.$pages_2.'">'.$pages_2.'</a></li>';
            }
            ?>
            <li class="page-item <?PHP if ($page == $page_5) {echo 'disabled';}?>">
                <a class="page-link" href="?page=<?PHP echo $page+1; ?>">下一页</a>
            </li>
        </ul>
    </nav>
</div>
<!-- 页脚 -->
<footer>
    <div class="container my-4">
        <div class="row text-center">
            <div class="col-12 mb-1">Copyright © <?PHP echo $normal['data']['web_start_time']['text'] ?> - <?PHP echo date("Y") ?> <a class="text-decoration-none" href="<?PHP echo $normal['data']['web_autor_link']['text'] ?>"><?PHP echo $normal['data']['web_autor']['text'] ?></a>. All Rights Reserved.</div>
            <div class="col-12 mb-1"><a class="text-decoration-none" href="https://beian.miit.gov.cn/"><i class="iconfont icon-ICPbeian"></i> 粤ICP备2022014822号</a></div>
        </div>
    </div>
</footer>
</body>
<!-- JavaScript -->
<script src="<?PHP echo $mirror['data']['info']['bootstrap_js'] ?>"></script>
<script src="<?PHP echo $mirror['data']['info']['bootstrap_bundle_js'] ?>"></script>
<script src="<?PHP echo $mirror['data']['info']['bootstrap_jquery'] ?>"></script>
</html>