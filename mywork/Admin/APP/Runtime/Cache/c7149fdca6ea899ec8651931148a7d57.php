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

<style>
</style>
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
            <form action="__APP__/MemberChart/index" method="post" id="formSub" style="width: 100%;">
                <div class="row col-lg-12 col-xl-6 p-r-5 p-l-5 m-r-0 m-l-0">
                    <div class="col-3 col-md-2 col-xl-1 text-center p-0 m-b-10"><label class="p-5">日期:</label></div>
                    <div class="col-9 col-md-7 col-xl-3 p-r-10 p-l-0 m-b-10">
                        <input class="form-control" style="width:100%;" type="text" value="<?php echo ($today); ?>" name="today" id="today" autocomplete="off">
                    </div>
                    <div class="row col-12 col-md-3 col-xl-2 p-r-10 p-l-0 m-r-0 m-l-0">
                        <div class="col-md-12 col-xl-10 p-l-0 p-r-0 m-b-10"><input class="btn btn-info p-r-0 p-l-0 m-r-5 m-l-5" style="width:100%;" type='submit' value='搜尋'></div>
                    </div>
                </div>
            </form>
            <div class="col-lg-12 ui-sortable">
                <div class="panel panel-inverse" data-sortable-id="flot-chart-1">
                    <div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">上線人數</h4>
                    </div>
                    <div class="panel-body">
                        <div id="placeholder" class="height-sm" style="padding: 0px; position: relative;"></div>
                        <p id="choices" style="float:right; width:135px;"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 ui-sortable">
                <div class="panel panel-inverse" data-sortable-id="flot-chart-1">
                    <div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">托售/儲值人數</h4>
                    </div>
                    <div class="panel-body">
                        <div id="money_placeholder" class="height-sm" style="padding: 0px; position: relative;"></div>
                        <p id="moneyChoices" style="float:right; width:135px;"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 ui-sortable">
                <div class="panel panel-inverse" data-sortable-id="flot-chart-1">
                    <div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">總金額</h4>
                    </div>
                    <p>當日資料</p>
                    <div class="panel-body">
                        <div id="pie-placeholder" class="height-sm" style="padding: 0px; position: relative;"></div>
                        <div id="hover"></div>
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

<script>
var totalData = JSON.parse('<?php echo ($totalData); ?>');
var timeData = JSON.parse('<?php echo ($timeData); ?>');
var timeNameData = JSON.parse('<?php echo ($timeNameData); ?>');

$(function() {
	//折線圖
    /**
     * 折線圖數據修改
     * label => 標題
     * data => 數據
     * color => 線顏色
     */

    var datasetTotal = {
        'totalMem':{
            label: timeNameData['totalMem'],
            data: []
        },
        'registeredName':{
            label: timeNameData['registeredName'],
            data: []
        }
    }
    var datasetMoney = {
        'withdrawName':{
            label: timeNameData['withdrawName'],
            data: [],
            yaxis: 1,
        },
        'rechargeName':{
            label: timeNameData['rechargeName'],
            data: [],
            yaxis: 1,
        },
        'withdrawMoney':{
            label: timeNameData['withdrawMoney'],
            data: [],
            yaxis: 2,
        },
        'rechargeMoney':{
            label: timeNameData['rechargeMoney'],
            data: [],
            yaxis: 2,
        }

    }
    if(timeData.hour){
        for (var i = 0; i < timeData.hour.length; i++) {
            datasetTotal.totalMem.data.push([timeData['hour'][i], timeData['peopleTotal'][i]]); //總人數
            datasetTotal.registeredName.data.push([timeData['hour'][i], timeData['registeredPer'][i]]); //註冊人數
            datasetMoney.withdrawName.data.push([timeData['hour'][i], timeData['withdrawPer'][i]]); //脫售人數
            datasetMoney.rechargeName.data.push([timeData['hour'][i], timeData['rechargePer'][i]]); //儲值人數
            datasetMoney.withdrawMoney.data.push([timeData['hour'][i], timeData['withdrawTotal'][i]]); //脫售金額
            datasetMoney.rechargeMoney.data.push([timeData['hour'][i], timeData['rechargeTotal'][i]]); //儲值金額
        }
    }

    var options = {
        lines: {
            show: true,
        },
        series: {
            lines: {lineWidth: 2}
        },
        points: {
            show: true
        },
        xaxis: {
            tickDecimals: 0,
            tickSize: 1
        },
        yaxes: [
            {
                position: "left",
            },
            {
                position: "right",
            },
        ],
        legend: {
            show: true, //不顯示例圖
        },
        grid: {
            hoverable: true,// 開啟 hoverable 事件
        }
    };

    //上線人數
    var i = 0;
    $.each(datasetTotal, function(key, val) {
        val.color = i;
        ++i;
    });

    var choiceContainer = $("#choices");
    $.each(datasetTotal, function(key, val) {
        choiceContainer.append("<br/><input type='checkbox' name='" + key +
            "' checked='checked' id='id" + key + "'></input>" +
            "<label for='id" + key + "'>"
            + val.label + "</label>");
    });

    choiceContainer.find("input").click(plotAccordingToChoices);

    function plotAccordingToChoices() {
        var data = [];
        choiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasetTotal[key]) {
                data.push(datasetTotal[key]);
            }
        });
        if (data.length > 0) {
            $.plot("#placeholder", data, options);
        }
    }
    plotAccordingToChoices();
    //結束

    //託售/儲值折線圖
    var j = 0;
    $.each(datasetMoney, function(key, val) {
        val.color = j;
        ++j;
    });

    var moneyChoiceContainer = $("#moneyChoices");
    $.each(datasetMoney, function(key, val) {
        moneyChoiceContainer.append("<br/><input type='checkbox' name='" + key +
            "' checked='checked' id='id1" + key + "'></input>" +
            "<label for='id1" + key + "'>"
            + val.label + "</label>");
    });

    moneyChoiceContainer.find("input").click(plotAccordingToChoicesMoney);

    function plotAccordingToChoicesMoney() {
        var data = [];
        moneyChoiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasetMoney[key]) {
                data.push(datasetMoney[key]);
            }
        });

        if (data.length > 0) {
            $.plot("#money_placeholder", data, options);
        }
    }
    plotAccordingToChoicesMoney();
    //結束



    var previousPoint = null;

    // 绑定提示事件
    $("#placeholder").bind("plothover", function(event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);
                var tip = "人數：";
                showTooltip(item.pageX, item.pageY, tip + y + " 人");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });

    // 绑定提示事件
    $("#money_placeholder").bind("plothover", function(event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);
                var tip = "人數：";
                if(item.series.label == "出售次數" || item.series.label == "儲值次數"){
                    showTooltip(item.pageX, item.pageY, tip + y + " 人");
                } else if(item.series.label == "出售金額" || item.series.label == "儲值金額"){
                    showTooltip(item.pageX, item.pageY,  y + " 元");
                }
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
    //折線圖結束

    //圓餅圖
    var options1 = {
	    series: {
	        pie: {
	            show: true,
	        },
	    },
	    legend: {
	        show: true, //不顯示利圖
	    },
	    grid: {
	    	hoverable: true,
	    	clickable: true,
	     } // 開啟 hoverable clickable事件
	};

	/**
	 * 更改圓餅圖數據
	 * label => 標題
	 * data => 數據
	 * colot => 顏色
	 */
    var dataset1 = [
	    { label: totalData['rechargeName'], data: totalData['rechargeTotal'], color: "#005CDE" },
	    { label: totalData['withdrawName'], data: totalData['withdrawTotal'], color: "#00A36A" },
	];

    $.plot("#pie-placeholder", dataset1, options1);
    $("#pie-placeholder").bind("plothover", function(event, pos, item){
    	if(item) {
			var data = item.datapoint[1][0][1];
            var y = data.toFixed(0);
            percent = parseFloat(item.series.percent).toFixed(2);
       		$("#hover").html('<span style="font-weight: bold; color: '+item.series.color+'">'+item.series.label+' : '+y+' ('+percent+'%)</span>');
        }
    });
    //圓餅圖結束

    $("#today").datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "",
        maxDate: "+0",
        changeMonth: true,
        numberOfMonths: 1,
    });
});

// 節點提示
function showTooltip(x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y + 10,
        left: x + 10,
        border: '1px solid #fdd',
        padding: '2px',
        'background-color': '#ffffff',
        opacity: 0.80
    }).appendTo("body").fadeIn(200);
}
</script>