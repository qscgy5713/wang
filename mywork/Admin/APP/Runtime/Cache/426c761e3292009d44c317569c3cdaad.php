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
        <div class="row">
            <div class="col-md-2">
                <div>
                    <h6>重整倒數 &nbsp;<span id="min"></span>:<span id="sec"></span></h6>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-check p-t-0">
                    <input class="form-check-input is-valid" type="checkbox" id="noRenew" name="noRenew">
                    <label class="form-check-label" for="validCheckbox">不重整</label>
                </div>
            </div>
            <div>
                <div id="newMessageDIV" style="display:none">
                    <audio id="play">
                        <source src="__CSS__/mp3/DoorBell.mp3"' type="audio/wav"/>
						<source src="__CSS__/mp3/DoorBell.mp3" type="audio/mpeg"/>
					</audio>
				</div>
			</div>
		</div>
		<button type="button" class="btn btn-info m-b-10 m-r-10" onclick="self.location.href=' __APP__/<?php echo (MODULE_NAME); ?>/maliDetail'">郵件歷史紀錄 </button> <button id="add_btn" class="btn btn-info m-b-10" type="button">發送訊息</button>
                        <div class="modal fade" id="modal-dialog" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">發送訊息</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form method="post" action='__APP__/ProcessMail/sentMemberMessage'>
                                        <div class="modal-body">
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">會員帳號 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" type="text" name="sentMemAccount" id="member_account" value="<?php echo ($memberAccount); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">信件主旨 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" type="text" name="sentTitle">
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">信件內容 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <textarea class="form-control" name="sentMain" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-info f-s-15" data-dismiss="modal">取消</a>
                                            <button type="submit" name="addbtn" class="btn btn-info f-s-15">確認新增</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 ui-sortable">
                                <div class="panel panel-inverse">
                                    <div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
                                        <div class="panel-heading-btn">
                                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
                                        </div>
                                        <h4 class="panel-title">會員發問</h4>
                                    </div>
                                    <div class="panel-body">
                                        <!-- begin table-responsive -->
                                        <div class="table-responsive">
                                            <table id="table1" class="table table-striped m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>信件ID</th>
                                                        <th>會員帳號</th>
                                                        <th>建立時間</th>
                                                        <th>狀態</th>
                                                        <th>郵件IP</th>
                                                        <th>管理ID</th>
                                                        <th>信件回覆時間</th>
                                                        <th>信件回覆</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(is_array($showArray)): $i = 0; $__LIST__ = $showArray;if( count($__LIST__)==0 ) : echo "$memberEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>trid">
                                                            <td><?php echo ($vo["id"]); ?></td>
                                                            <td><?php echo ($vo["memberAccount"]); ?></td>
                                                            <td><?php echo ($vo["createTime"]); ?></td>
                                                            <td><?php echo ($vo["status"]); ?></td>
                                                            <td><?php echo ($vo["ip"]); ?></td>
                                                            <td><?php echo ($vo["adminId"]); ?></td>
                                                            <td><?php echo ($vo["modifyTime"]); ?></td>
                                                            <td>
                                                                <a onclick="openmodal('setModal','<?php echo ($vo["id"]); ?>','<?php echo ($vo["memberAccount"]); ?>','<?php echo ($vo["title"]); ?>','<?php echo ($vo["main"]); ?>')"><i class="fas fa-wrench fa-fw icon-size"></i></a>
                                                            </td>
                                                        </tr><?php endforeach; endif; else: echo "$memberEmpty" ;endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="setModal" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">信件回覆</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form method="post" action='__APP__/ProcessMail/formReplyMailManage'>
                                        <input type="hidden" value="" name="mailId" id="mailId">
                                        <div class="modal-body">
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">帳號 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" type="text" id="memberaccount" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">主旨 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" type="text" id="title" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">內容 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <textarea class="form-control" id="main" rows="10" readonly></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-15">
                                                <label class="col-md-4 col-sm-4 col-form-label">信件回覆 :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <textarea class="form-control" name="reply" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-info f-s-15" data-dismiss="modal">取消</a>
                                            <button type="submit" name="setbtn" class="btn btn-info f-s-15">確認新增</button>
                                        </div>
                                    </form>
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
            var audio = document.getElementById("play");
            var t, count = 5;
            var allDataId = "<?php echo ($allDataId); ?>";
            var dataIdArray = allDataId.split(",");
            $(document).ready(function() {

                t = setInterval(showAuto, 1000);

                $("#noRenew").change(function() {
                    var noRenew = $('#noRenew:checked').val();
                    if (noRenew == "on") {
                        clearInterval(t);
                    } else {
                        t = setInterval(showAuto, 1000);
                    }
                });
                $("#add_btn").click(function() {
                    $('#modal-dialog').modal('show');
                });
                $('#member_account').typeahead({
                    ajax: {
                        url: '__URL__/searchMemberName',
                        timeout: 200
                    }
                });
            });

            function showAuto() {
                var min = Math.floor(count / 60);
                var sec = count % 60;
                if (sec < 10) {
                    sec = '0' + sec;
                }
                $('#min').html(min);
                $('#sec').html(sec);
                if (count == 0) {
                    clearInterval(t);
                    count = 5;
                    var noRenew = $('#noRenew:checked').val();
                    if (noRenew != "on") {
                        getAjaxNewData();
                    }
                }
                --count;
            }
            var trText = '無未回覆信件';

            function getAjaxNewData() {
                $.ajax({
                    type: "post",
                    dataType: "text",
                    url: "__URL__/getAjaxMailForm",
                    success: function(data) {
                        splitArray = data.split(";;");
                        if (splitArray[0] == 'err') {
                            t = setInterval(showAuto, 1000);
                            return;
                        }
                        ajaxDataId = splitArray[0]; //資料id
                        ajaxDataStr = splitArray[1]; //資料明細
                        ajaxDataIdArray = ajaxDataId.split(",");
                        ajaxDataStrArray = ajaxDataStr.split(",");
                        for (var i = 0; i < ajaxDataIdArray.length; i++) {
                            var instr = $.inArray(dataIdArray[i], ajaxDataIdArray);
                            if (instr == -1) {
                                $("#" + dataIdArray[i] + 'trid').remove();
                            }
                        }
                        var tr0 = $($('table > tbody > tr')[0]).text();
                        if (ajaxDataIdArray != "") {
                            if(tr0 == trText){
                            	$("#table1 tr:not(:first)").html("");
                            }
                            for (var i = 0; i < ajaxDataIdArray.length; i++) {
                                var instr = $.inArray(ajaxDataIdArray[i], dataIdArray);
                                if (instr == -1) {
                                    fieldDatastrArray = ajaxDataStrArray[i].split(";");
                                    mailId = ajaxDataIdArray[i];
                                    var trData = "<tr id=" + mailId + "trid>";
                                    for (j = 0; j < fieldDatastrArray.length; j++) {
                                        if (j <= 6) {
                                            trData = trData + "<td>" + fieldDatastrArray[j] + "</td>";
                                        }
                                    }
                                    var onclick = '"setModal","' + fieldDatastrArray[0] + '","' + fieldDatastrArray[1] + '","' + fieldDatastrArray[7] + '","' + fieldDatastrArray[8] + '"';
                                    trData = trData + "<td><a onclick='openmodal(" + onclick + ")'><i class='fas fa-wrench fa-fw icon-size'></i></a></td>";
                                    trData = trData + "</tr>";
                                    $($('table > tbody > tr')[0]).before(trData);
                                    audio.play();
                                }
                            }
                        } else {
                            if (tr0 != trText) {
                                $("#table1 tr:not(:first)").html("");
                                $('table > tbody').html("<tr><td colspan='8' style='text-align:center;'>" + trText + "</td></tr>");
                            }
                        }
                        dataIdArray = ajaxDataIdArray;
                        t = setInterval(showAuto, 1000);
                    },
                    error: function() {
                        alert("網路連線錯誤，請檢查您的網路狀況");
                    }
                });
            }

            function openmodal(modalId, voMailId, voAccount, voTitle, voMain) {
                $('#mailId').val(voMailId);
                $('#memberaccount').val(voAccount);
                $('#title').val(voTitle);
                $('#main').val(voMain);
                $('#' + modalId).modal('show');
            }
            </script>