<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-Hant-TW">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<?php if($pageShowName != ""): ?><title><?php echo ($pageShowName); ?></title>
	<?php else: ?>
		<title><?php echo ($titleName); ?></title><?php endif; ?>
	
	 <link rel="shortcut icon" type="image/x-icon" href="__CSS__/images/cow.ico">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/font-awesome/5.3/css/all.min.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/css/material/style.min.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/css/material/style-responsive.min.css" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="__CSS__/color-admin-v4.2/admin/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/pace/pace.min.js"></script>
	<link href="__CSS__/color-admin-v4.2/admin/assets/css/material/theme/pink.css" rel="stylesheet" id="theme">
	<link href="__CSS__/color-admin-v4.2/admin/assets/css/mystyle.css?t=20190626" rel="stylesheet">
	
	<!-- ================== END BASE JS ================== -->
	<link href="__CSS__/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" />
	<!-- 跑馬燈 -->
    <link href="__CSS__/marquee/css/docs.css" rel="stylesheet">
    <link href="__CSS__/marquee/css/jquery.marquee.css" rel="stylesheet">
	
	<script async="" src="https://www.google-analytics.com/analytics.js"></script>
	<link href="__CSS__/color-admin-v4.2/admin/assets/css/default/theme/default.css" rel="stylesheet" id="theme">
	<!-- icon -->
    <link href="__CSS__/fonts/icomoon/style.css" rel="stylesheet">
	<!-- 搜尋功能拉霸 -->
	<link href="__CSS__/select2/select2.css" rel="stylesheet">
	<!-- 多選拉霸 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
</head>
	<body>
		<!-- begin #page-loader -->
		<div id="loader-bg" class="loader-bg demo-3">
			<div id="loader" class="container">
				<section class="text-center p-t-200" style="background:hsl(0, 0%, 0%);">
					<img src="__CSS__/images/loading.gif">
				</section>
			</div>
	    </div>

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
    <div id="header" class="header navbar-default">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="__APP__/AdminIndex/index" class="navbar-brand">
			Admin
		</a>
	</div>
	<!-- end navbar-header -->
	<!-- <div class="search-form">
		<button class="search-btn" type="submit"><i class="material-icons">search</i></button>
		<input type="text" class="form-control" placeholder="Search Something..." />
		<a href="#" class="close" data-dismiss="navbar-search"><i class="material-icons">close</i></a>
	</div> -->
	<div class="mq-height">
		<ul id="marquee2" class="marquee">
		   <?php if(is_array($marqueeArray)): $i = 0; $__LIST__ = $marqueeArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$marquee): $mod = ($i % 2 );++$i;?><li><?php echo ($marquee["marquee_text"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div>
    	<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar" data-disable-slide-animation="true">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;">
							<div class="cover with-shadow" style="background: url(__CSS__/color-admin-v4.2/admin/assets/css/material/images/cover-sidebar-user.jpg);"></div>
							<div class="image">
								<img src="__CSS__/color-admin-v4.2/admin/assets/img/user/user-1.jpg" alt="" />
							</div>
							<div class="info">
								<?php echo ($adminAccount); ?>
								<small>HI</small>
							</div>
						</a>
					</li>
					
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header"></li>
					
					
					<?php if(is_array($showPageArray)): foreach($showPageArray as $key=>$showPageVal): ?><li id="<?php echo ($key); ?>" class="has-sub expand">
							<a href="javascript:;">
								<b class="caret"></b>
								<i class="far fa-hand-point-right"></i>
								<span><?php echo ($key); ?></span>
							</a>
							<ul class="sub-menu">
								<?php if(is_array($showPageVal)): foreach($showPageVal as $key=>$PageVal): ?><li id="<?php echo ($PageVal["actionName"]); ?>" class=""><a class="loading" href="__APP__/<?php echo ($PageVal["actionName"]); ?>/index"><?php echo ($PageVal["showName"]); ?></a></li><?php endforeach; endif; ?>
							</ul>
						</li><?php endforeach; endif; ?>
					
					<li><a class="loading" href="__APP__/AdminIndex/adminInfo"><i class="fa fa-cog"></i>修改密碼</a></li>
					<li><a class="loading" href="__APP__/AdminIndex/logout"><i class="fas fa-share"></i>登出</a></li>
					
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
    <div id="content" class="content">
        <form class="m-b-10" id="formInquire" method="post" action="__APP__/<?php echo (MODULE_NAME); ?>/<?php echo (ACTION_NAME); ?>">
            <div class="row p-l-7">
                <div class="row col-lg-12 col-xl-4 p-r-5 p-l-5 m-r-0 m-l-0">
                    <div class="col-3 col-md-2 col-xl-3 p-0"><label class="p-5">搜索帳號 :</label></div>
                    <div class="col-12 col-md-7 col-xl-5 p-r-0 p-l-0 m-b-10">
                        <input class="form-control" style="width:100%;" type="text" name="memberAccount" id="member_account" value="<?php echo ($memberAccount); ?>">
                    </div>
                    <div class="row col-12 col-md-3 col-xl-2 p-r-0 p-l-0 m-r-0 m-l-0">
                        <div class="col-md-12 col-xl-10 p-l-0 p-r-0 m-b-10"><input class="btn btn-info p-r-0 p-l-0 m-r-5 m-l-5" style="width:100%;" type="submit" value="查詢"></div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12 ui-sortable">
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">會員基本資料</h4>
                    </div>
                    <!-- end panel-heading -->
                    <div class="panel-body">
                        <!-- begin table-responsive -->
                        <div class="table-responsive">
                            <table id="memberTable" class="table table-striped m-b-0">
                                <thead>
                                    <tr>
                                        <th>會員帳號</th>
                                        <th>會員密碼</th>
                                        <th>IP狀態</th>
                                        <th>會員狀態</th>
                                        <th>會員電話</th>
                                        <th>創建日期</th>
                                        <th>創建IP</th>
                                        <th>電子錢包</th>
                                        <th>最後登入</th>
                                        <th>最後IP</th>
                                        <th>最後儲值</th>
                                        <th>銀行帳號</th>
                                        <th>累積儲值</th>
                                        <th>累積託售</th>
                                        <th>總計</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($memberArray)): $i = 0; $__LIST__ = $memberArray;if( count($__LIST__)==0 ) : echo "$memberEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                            <td><?php echo ($vo["account"]); ?></td>
                                            <td><?php echo ($passwordStatus); ?></td>
                                            <td><?php echo ($repeatStatus); ?></td>
                                            <td><?php echo ($vo["status"]); ?></td>
                                            <td><?php echo ($vo["phone"]); ?></td>
                                            <td><?php echo ($vo["createTime"]); ?></td>
                                            <td><?php echo ($vo["ip"]); ?></td>
                                            <td><?php echo ($vo["money"]); ?></td>
                                            <td><?php echo ($vo["lastLoginTime"]); ?></td>
                                            <td><?php echo ($vo["lastLoginIp"]); ?></td>
                                            <td><?php echo ($lastRechargeTime); ?></td>
                                            <td><?php echo ($bankdata); ?></td>
                                            <td class="text-red"><?php echo ($vo["totalRecharge"]); ?></td>
                                            <td class="text-green"><?php echo ($vo["totalWithdraw"]); ?></td>
                                            <?php if($vo["total"] > 0): ?><td class="text-red"><?php echo ($vo["total"]); ?></td>
                                                <?php else: ?>
                                                <td class="text-green"><?php echo ($vo["total"]); ?></td><?php endif; ?>
                                        </tr><?php endforeach; endif; else: echo "$memberEmpty" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($memberRepeatBool == 'true'): ?><div class="row">
                <div class="col-lg-12 ui-sortable">
                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading ui-sortable-handle" data-click="panel-collapse" id="error_table">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title" style="display: initial;">密碼異常列表</h4>
                            <input class="btn btn-info m-r-5 m-l-5" type="button" value="展開">
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped m-b-0">
                                    <tbody>
                                        <tr>
                                            <?php $__FOR_START_4553__=0;$__FOR_END_4553__=count($memberRepeatArray);for($i=$__FOR_START_4553__;$i < $__FOR_END_4553__;$i+=1){ if($i%10 == 0 && $i != 0): ?></tr>
                                        <tr><?php endif; ?>
        <td><a href="__APP__/<?php echo (MODULE_NAME); ?>/<?php echo (ACTION_NAME); ?>&memberAccount=<?php echo ($memberRepeatArray[$i]['member_account']); ?>"><?php echo ($memberRepeatArray[$i]['member_account']); ?></a></td><?php } ?>
        </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div><?php endif; ?>
<?php if($memberAccount != ''): ?><div class="row form-inline m-b-10" style="width:auto;">
        <div class="row col-lg-6 col-xl-4 p-r-0 p-l-0 m-r-0 m-l-0 m-b-10 p-l-7">
            <div class="m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="今日" onClick="formTime('<?php echo ($today); ?> 00:00:00','<?php echo ($today); ?> 23:59:59')" />
            </div>
            <div class="m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="昨日" onClick="formTime('<?php echo ($yesterday); ?> 00:00:00','<?php echo ($yesterday); ?> 23:59:59')" />
            </div>
            <div class="m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="明日" onClick="formTime('<?php echo ($tomorrow); ?> 00:00:00','<?php echo ($tomorrow); ?> 23:59:59')" />
            </div>
            <div class="m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="本週" onClick="formTime('<?php echo ($thisWeekA); ?> 00:00:00','<?php echo ($thisWeekB); ?> 23:59:59')" />
            </div>
            <div class="m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="上週" onClick="formTime('<?php echo ($lastWeekA); ?> 00:00:00','<?php echo ($lastWeekB); ?> 23:59:59')""/>
                  </div>

                  <div class=" m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="本月" onClick="formTime('<?php echo ($thisMonthA); ?> 00:00:00','<?php echo ($thisMonthB); ?> 23:59:59')" />
            </div>
            <div class="m-r-5">
                <input class="btn btn-info p-10 f-s-13 time-btn-rwd time-btn-rwd-p" style="width:100%;" type="button" value="上月" onClick="formTime('<?php echo ($lastMonthA); ?> 00:00:00','<?php echo ($lastMonthB); ?> 23:59:59')" />
            </div>
        </div>
        <div class="row col-lg-12 col-xl-5 p-r-5 p-l-5 m-r-0 m-l-0">
            <div class="col-5 col-xl-4 p-0">
                <input id="startTime" name="startTime" type="text" class="form-control div-style time-btn-rwd" style="width:100%;" value="<?php echo ($startTime); ?>" />
            </div>
            <div class="col-2 text-center p-0"><label class="p-5">至</label></div>
            <div class="col-5 col-xl-4 p-0">
                <input id="endTime" name="endTime" type="text" class="form-control div-style time-btn-rwd" style="width:100%;" value="<?php echo ($endTime); ?>" />
            </div>
            <div class="row col-12 col-md-3 col-xl-2 p-r-0 p-l-0 m-r-0 m-l-0">
                <div class="col-md-12 col-xl-8 p-l-0 p-r-0 m-b-10">
                    <input class="btn btn-info p-r-0 p-l-0 m-r-5 m-l-5" style="width:100%;" type='button' onClick="submitGameIframe()" value='查詢'>
                </div>
            </div>
        </div>
    </div>
    <iframe id="gameIframe" class="m-b-10" style="width: 100%;min-height: <?php echo ($gameIframeHeight); ?>px;" src="__APP__/Common/loading" frameborder="0" scrolling="no"></iframe><?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-inverse">
            <li class="nav-item">
                <a href="#default-tab-1" data-toggle="tab" class="nav-link active show">
                    <span class="d-sm-none f-s-12">儲值紀錄</span>
                    <span class="d-sm-block d-none">儲值紀錄</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">託售紀錄</span>
                    <span class="d-sm-block d-none">託售紀錄</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-3" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">登入紀錄</span>
                    <span class="d-sm-block d-none">登入紀錄</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-4" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">信件紀錄</span>
                    <span class="d-sm-block d-none">信件紀錄</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-5" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">活動紀錄</span>
                    <span class="d-sm-block d-none">活動紀錄</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-6" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">工作記事</span>
                    <span class="d-sm-block d-none">工作記事</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-7" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">重複IP</span>
                    <span class="d-sm-block d-none">重複IP</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-8" data-toggle="tab" class="nav-link">
                    <span class="d-sm-none f-s-12">會員帳變</span>
                    <span class="d-sm-block d-none">會員帳變</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="default-tab-1">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>單號</th>
                                <th>代理</th>
                                <th>會員帳號</th>
                                <th>儲值時間</th>
                                <th>金流</th>
                                <th>儲值方式</th>
                                <th>繳款代碼</th>
                                <th>儲值金額</th>
                                <th>儲值IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($rechargeArray)): $i = 0; $__LIST__ = $rechargeArray;if( count($__LIST__)==0 ) : echo "$rechargeEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["agentAccount"]); ?></td>
                                    <td><?php echo ($vo["account"]); ?></td>
                                    <td><?php echo ($vo["createTime"]); ?></td>
                                    <td><?php echo ($vo["cashflowName"]); ?></td>
                                    <td><?php echo ($vo["cashflowShowName"]); ?></td>
                                    <td><?php echo ($vo["paymentCode"]); ?></td>
                                    <td><?php echo ($vo["money"]); ?></td>
                                    <td><?php echo ($vo["ip"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "$rechargeEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="default-tab-2">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>單號</th>
                                <th>代理</th>
                                <th>會員帳號</th>
                                <th>託售時間</th>
                                <th>託售金額</th>
                                <th>託售IP</th>
                                <th>處理帳號</th>
                                <th>處理IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($withdrawArray)): $i = 0; $__LIST__ = $withdrawArray;if( count($__LIST__)==0 ) : echo "$withdrawEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["agentAccount"]); ?></td>
                                    <td><?php echo ($vo["account"]); ?></td>
                                    <td><?php echo ($vo["createTime"]); ?></td>
                                    <td><?php echo ($vo["money"]); ?></td>
                                    <td><?php echo ($vo["memberIp"]); ?></td>
                                    <td><?php echo ($vo["adminAccount"]); ?></td>
                                    <td><?php echo ($vo["adminIp"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "$withdrawEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="default-tab-3">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>序</th>
                                <th>會員帳號</th>
                                <th>登入時間</th>
                                <th>登入IP</th>
                                <th>登入裝置</th>
                                <th>登入網址</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($loginArray)): $i = 0; $__LIST__ = $loginArray;if( count($__LIST__)==0 ) : echo "$loginEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($i); ?></td>
                                    <td><?php echo ($vo["account"]); ?></td>
                                    <td><?php echo ($vo["createTime"]); ?></td>
                                    <td><?php echo ($vo["ip"]); ?></td>
                                    <td><?php echo ($vo["os"]); ?></td>
                                    <td><?php echo ($vo["url"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "$loginEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="default-tab-4">
                <div class="table-responsive">
                    <table id="" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>信件ID</th>
                                <th>會員帳號</th>
                                <th>建立時間</th>
                                <th>狀態</th>
                                <th>郵件IP</th>
                                <th>管理ID</th>
                                <th>信件回覆時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($mailArray)): $i = 0; $__LIST__ = $mailArray;if( count($__LIST__)==0 ) : echo "$mailEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["memberAccount"]); ?></td>
                                    <td><?php echo ($vo["createTime"]); ?></td>
                                    <td><?php echo ($vo["status"]); ?></td>
                                    <td><?php echo ($vo["ip"]); ?></td>
                                    <td><?php echo ($vo["adminId"]); ?></td>
                                    <td><?php echo ($vo["modifyTime"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "$mailEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="default-tab-5">
                <div class="table-responsive">
                    <table id="" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>序</th>
                                <th>活動名稱</th>
                                <th>單號</th>
                                <th>會員帳號</th>
                                <th>狀態</th>
                                <th>申請時間</th>
                                <th>申請IP</th>
                                <th>活動金額</th>
                                <th>修改時間</th>
                                <th>操作帳號</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($eventArray)): $i = 0; $__LIST__ = $eventArray;if( count($__LIST__)==0 ) : echo "$eventEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($i); ?></td>
                                    <td><?php echo ($vo["eventName"]); ?></td>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["memberAccount"]); ?></td>
                                    <td><?php echo ($vo["status"]); ?></td>
                                    <td><?php echo ($vo["createTime"]); ?></td>
                                    <td><?php echo ($vo["ip"]); ?></td>
                                    <td><?php echo ($vo["money"]); ?></td>
                                    <td><?php echo ($vo["modifyTime"]); ?></td>
                                    <td><?php echo ($vo["adminAccount"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "$eventEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="default-tab-6">
                <div class="table-responsive">
                    <?php if(is_array($noteArray)): $i = 0; $__LIST__ = $noteArray;if( count($__LIST__)==0 ) : echo "$notetEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h4><?php echo ($key); ?></h4>
                        <table id="" class="table table-striped m-b-0">
                            <thead>
                                <tr>
                                    <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><th><?php echo ($key); ?></th><?php endforeach; endif; else: echo "$notetEmpty" ;endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><td><?php echo ($vo[$key]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tr>
                            </tbody>
                        </table><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if($display == 1): echo ($notetEmpty); endif; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="default-tab-7">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>序</th>
                                <th>重複IP</th>
                                <th>重複數量</th>
                                <th>重複帳號</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($repeatIPArray)): $i = 0; $__LIST__ = $repeatIPArray;if( count($__LIST__)==0 ) : echo "$repeatIPEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($key+1); ?></td>
                                    <td><?php echo ($vo["ip"]); ?></td>
                                    <td><?php echo ($vo["number"]); ?></td>
                                    <td><?php echo ($vo["allAccount"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "$repeatIPEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="default-tab-8">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>單號</th>
                            <th>帳號</th>
                            <th>帳變操作</th>
                            <th>帳變類型</th>
                            <th>帳變前</th>
                            <th>帳變金額</th>
                            <th>帳變後金額</th>
                            <th>建立時間</th>
                            <th>操作內容</th>
                            <th>方式</th>
                            <th>IP</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php if(is_array($walletlogArray)): $i = 0; $__LIST__ = $walletlogArray;if( count($__LIST__)==0 ) : echo "$walletLogEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    	                          <td><?php echo ($vo["id"]); ?></td>
                                  <td><?php echo ($vo["account"]); ?></td>
                                  <td><?php echo ($vo["operating"]); ?></td>
                                  <td><?php echo ($vo["type"]); ?></td>
                                  <td><?php echo ($vo["before"]); ?></td>
                                  <td><?php echo ($vo["money"]); ?></td>
                                  <td><?php echo ($vo["after"]); ?></td>
                                  <td><?php echo ($vo["createTime"]); ?></td>
                                  <td><?php echo ($vo["mainStr"]); ?></td>
                                  <td><?php echo ($vo["mainType"]); ?></td>
                                  <td><?php echo ($vo["ip"]); ?></td>
    	                       </tr><?php endforeach; endif; else: echo "$walletLogEmpty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="material-icons">keyboard_arrow_up</i></a>
</div>
<div id="errorMsgDiv" style="display:none;">
	<div id="errorMsg" class="swal-overlay " tabindex="-1">
	  <div class="swal-modal" role="dialog" aria-modal="true"><div id="swal-icon" class="swal-icon">
	    <div id="x-mark" class="">
	      <span id="lineLeft" class=" "></span>
	      <span id="lineRight" class=" "></span>
	    </div>
	  </div>
	  <div class="swal-title" id="swal-title" style=""></div>
		  <div class="swal-footer">
			  <div class="swal-button-container">
			    <button class="swal-button btn btn-default" onclick="errorMsgClose()">關閉</button>
			    <div class="swal-button__loader">
			      <div></div>
			      <div></div>
			      <div></div>
			    </div>
			  </div>
		  </div>
	  </div>
	</div>
</div>
<div id="askMsgDiv" style="display:none;">
	<div id="askMsg" class="swal-overlay " tabindex="-1">
	  <div class="swal-modal" role="dialog" aria-modal="true">
		  <div class="swal-icon swal-icon--info"></div>
		  <div id="askMsgText" class="swal-title" style=""></div>

		  <div class="swal-footer">
			  <div class="swal-button-container">

			    <button class="swal-button swal-button--cancel btn btn-default" id="askMsgClose">取消</button>

			    <div class="swal-button__loader">
			      <div></div>
			      <div></div>
			      <div></div>
			    </div>

			  </div>
			  <div class="swal-button-container">
			    <button class="swal-button swal-button--confirm btn btn-primary" id="askMsgYes">確定</button>

			    <div class="swal-button__loader">
			      <div></div>
			      <div></div>
			      <div></div>
			    </div>

			  </div>
		  </div>
	  </div>
	</div>
</div>

<div id="okMsgDiv" style="display:none;">
	<div id="okMsg" class="swal-overlay" tabindex="-1">
	  <div class="swal-modal" role="dialog" aria-modal="true">
		  <div id="okDiv" class="swal-icon">
		    <span id="okSpan1" class=""></span>
		    <span id="okSpan2" class=""></span>

		    <div id="okSpan3" class=""></div>
		    <div id="okSpan4" class=""></div>
		  </div>

		  <div id="okText" class="swal-title" style=""></div>

		  <div class="swal-footer">
			  <div class="swal-button-container">
			    <button class="swal-button swal-button--cancel btn btn-default" onclick="okMsgClose()">關閉</button>
			    <div class="swal-button__loader">
			      <div></div>
			      <div></div>
			      <div></div>
			    </div>
			  </div>
		  </div>
	  </div>
	</div>
</div>
<!-- ================== BEGIN BASE JS ================== -->
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/js/theme/material.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/d3/d3.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/nvd3/build/nv.d3.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/js/demo/dashboard-v2.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/js/demo/ui-modal-notification.demo.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/js/theme/default.min.js"></script>

	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.stack.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.crosshair.min.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/plugins/flot/jquery.flot.categories.js"></script>
	<script src="__CSS__/color-admin-v4.2/admin/assets/js/demo/chart-flot.demo.min.js"></script>

	<!-- 時間選擇器 -->
	<script src="__CSS__/timepicker/jquery-ui-timepicker-addon.js"></script>
	<!-- 跑馬燈 -->
    <script src="__CSS__/marquee/lib/jquery.marquee.js"></script>

	<!-- typeahead -->
     <script type="text/javascript" src="__CSS__/js/bootstrap-notify.min.js"></script>
     <script type="text/javascript" src="__CSS__/js/bootstrap-typeahead.min.js"></script>
    <!-- 多選拉霸 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="__CSS__/bootstrap-select/defaults-zh_TW.js"></script>


<script>
$(document).ready(function() {
	App.init();
	Chart.init();
	//DashboardV2.init();
	//Notification.init();
	$("#loader-bg").hide();
	var isLogin = "<?php echo ($isLogin); ?>";
	if(isLogin == "true"){
		$("#"+"<?php echo ($classShowName); ?>").addClass("active");
		$("#"+"<?php echo (MODULE_NAME); ?>").addClass("active");
	}
});
window.onpageshow=function(e){
	if(e.persisted) {
		$("#loader-bg").hide();
		//window.location.reload();
	}
};

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-53034621-1', 'auto');
ga('send', 'pageview');

  var use_debug = false;
  function debug(){
  	if( use_debug && window.console && window.console.log ) console.log(arguments);
  }
  // on DOM ready
  jQuery(document).ready(function (){
  	jQuery(".marquee").marquee({
  		loop: -1
  		// this callback runs when the marquee is initialized
  		, init: function ($marquee, options){
  			debug("init", arguments);

  			// shows how we can change the options at runtime
  			if( $marquee.is("#marquee2") ) options.yScroll = "bottom";
  		}
  		// this callback runs before a marquee is shown
  		, beforeshow: function ($marquee, $li){
  			debug("beforeshow", arguments);

  			// check to see if we have an author in the message (used in #marquee6)
  			var $author = $li.find(".author");
  			// move author from the item marquee-author layer and then fade it in
  			if( $author.length ){
  				$("#marquee-author").html("<span style='display:none;'>" + $author.html() + "</span>").find("> span").fadeIn(850);
  			}
  		}
  		// this callback runs when a has fully scrolled into view (from either top or bottom)
  		, show: function (){
  			debug("show", arguments);
  		}
  		// this callback runs when a after message has being shown
  		, aftershow: function ($marquee, $li){
  			debug("aftershow", arguments);
  			// find the author
  			var $author = $li.find(".author");
  			// hide the author
  			if( $author.length ) $("#marquee-author").find("> span").fadeOut(250);
  		}
  	});
  });

function errorMsgShow(error){
	$("#errorMsgDiv").show();
	$("#swal-title").html(error);
	$("#errorMsg").addClass("swal-overlay--show-modal");
	$("#swal-icon").addClass("swal-icon--error");
	$("#x-mark").addClass("swal-icon--error__x-mark");
	$("#lineLeft").addClass("swal-icon--error__line swal-icon--error__line--left");
	$("#lineRight").addClass("swal-icon--error__line swal-icon--error__line--right");
}
function errorMsgClose(){
	$("#swal-title").html("");
	$("#errorMsg").removeClass("swal-overlay--show-modal");
	$("#swal-icon").removeClass("swal-icon--error");
	$("#x-mark").removeClass("swal-icon--error__x-mark");
	$("#lineLeft").removeClass("swal-icon--error__line swal-icon--error__line--left");
	$("#lineRight").removeClass("swal-icon--error__line swal-icon--error__line--right");
	$("#errorMsgDiv").hide();
}

function askMsgShow(msg){
	$("#askMsgDiv").show();
	$("#askMsg").addClass("swal-overlay--show-modal");
	$("#askMsgText").html(msg);
}
function askMsgClose_f(){
	$("#askMsg").removeClass("swal-overlay--show-modal");
	$("#askMsgText").html("");
	$("#askMsgDiv").hide();
}

function okMsgShow(msg){
	$("#okMsgDiv").show();
	$("#okMsg").addClass("swal-overlay--show-modal");
	$("#okDiv").addClass("swal-icon--success");
	$("#okSpan1").addClass("swal-icon--success__line swal-icon--success__line--long");
	$("#okSpan2").addClass("swal-icon--success__line swal-icon--success__line--tip");
	$("#okSpan3").addClass("swal-icon--success__ring");
	$("#okSpan4").addClass("swal-icon--success__hide-corners");
	$("#okText").html(msg);
}
function okMsgClose(){
	$("#okMsgDiv").hide();
	$("#okMsg").removeClass("swal-overlay--show-modal");
	$("#okDiv").removeClass("swal-icon--success");
	$("#okSpan1").removeClass("swal-icon--success__line swal-icon--success__line--long");
	$("#okSpan2").removeClass("swal-icon--success__line swal-icon--success__line--tip");
	$("#okSpan3").removeClass("swal-icon--success__ring");
	$("#okSpan4").removeClass("swal-icon--success__hide-corners");
	$("#okText").html("");
}

//設定中文語系
$.datepicker.regional['zh-TW']={
   dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
   dayNamesMin:["日","一","二","三","四","五","六"],
   monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
   monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
   prevText:"上月",
   nextText:"次月",
   weekHeader:"週"
};
//將預設語系設定為中文
$.datepicker.setDefaults($.datepicker.regional["zh-TW"]);

function datetimePicker(time1, onCloseTime1, time2, onCloseTime2){
	$( "#"+time1 ).datetimepicker({
    	dateFormat: "yy-mm-dd",
    	timeFormat: "HH:mm:ss",
        maxDate: "+0",
        changeMonth: true,
        numberOfMonths: 1,
        // showButtonPanel: true,
        onClose: function( selectedDate ) {
            $( "#"+onCloseTime1 ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#"+time2 ).datetimepicker({
    	dateFormat: "yy-mm-dd",
    	timeFormat: "HH:mm:ss",
        maxDate: "+0",
        changeMonth: true,
        numberOfMonths: 1,
        // showButtonPanel: true,
        onClose: function( selectedDate ) {
            $( "#"+onCloseTime2 ).datepicker( "option", "maxDate", selectedDate );
        }
    });
}

</script>
</body>
</html>

<script type="text/javascript">
$(function() {
    if ("<?php echo ($memberAccount); ?>" != "") {
        $("#gameIframe").attr("src", "__APP__/<?php echo (MODULE_NAME); ?>/memberReport&startTime=<?php echo ($startTime); ?>&endTime=<?php echo ($endTime); ?>&searchMemberId=<?php echo ($searchMemberId); ?>");
    }

    $('#member_account').typeahead({
        ajax: {
            url: '__URL__/searchMemberName',
            timeout: 200
        }
    });

    $("#startTime").datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "HH:mm:ss",

        maxDate: "+10m",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        // showButtonPanel: true,
        onClose: function(selectedDate) {
            $("#endTime").datepicker("option", "minDate", selectedDate);
        }
    });

    $("#endTime").datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "HH:mm:ss",

        maxDate: "+10m",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        // showButtonPanel: true,

    });
    
    $('#error_table').click();
});

function formTime(startTime, endTime) {
    $("#startTime").val(startTime);
    $("#endTime").val(endTime);
    submitGameIframe();
}

function submitGameIframe() {
    var startTime = $("#startTime").val();
    var endTime = $("#endTime").val();
    $("#gameIframe").attr("src", "__APP__/<?php echo (MODULE_NAME); ?>/memberReport&startTime=" + startTime + "&endTime=" + endTime + "&searchMemberId=<?php echo ($searchMemberId); ?>");
}
</script>