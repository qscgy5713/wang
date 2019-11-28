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
		<button id="add_btn" class="btn btn-info m-r-5 m-b-10" type="button">新增會員</button>
		<button id="set_btn" class="btn btn-info m-r-5 m-b-10" type="button">批量修改</button>
        <div class="modal fade" id="modal-dialog" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> 新增會員</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<form method="post" action='__APP__/PrivateAccount/formAddPrivateatm'>
						<div class="modal-body">
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">會員帳號 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="addAccount" >
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行代碼 : </label>
								<div class="col-md-8 col-sm-8">
									<select name="addBankcode" id="addBankcode" class="form-control">
									 	<option value="null">請選擇</option>
									 	<?php if(is_array($bankCodeArray)): $i = 0; $__LIST__ = $bankCodeArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bankcode"]); ?>"><?php echo ($vo["bankcode"]); ?>-<?php echo ($vo["bankcodeName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									 </select>
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行帳號 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="addBankaccount">
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行名稱 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="addBankname">
								</div>
							 </div>
                             </div>
						<div class="modal-footer">
							<button type="submit" name="addbtn" class="btn btn-info f-s-15">提交</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-dialogSet" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> 批量修改</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<form method="post" action='__APP__/PrivateAccount/formBatchEditDate'>
						<div class="modal-body">
							<h3 class="m-t-0 text-center"><i class="fa fa-cog"></i> 修改前</h3>
							
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行帳號 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="beforeBankaccount">
								</div>
							</div>
							<div class="form-group row m-b-5 line-bottom">
								<label class="col-md-4 col-sm-4 col-form-label">銀行名稱 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="beforeBankname">
								</div>
							</div>
							
							<h3 class="m-t-15 text-center"><i class="fa fa-cog"></i>修改後</h3>
							
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行帳號 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="afterBankaccount">
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行名稱 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="afterBankname">
								</div>
							</div>
                        </div>
						<div class="modal-footer">
							<button type="submit" name="addbtn" class="btn btn-info f-s-15">提交</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<form class="m-b-10" id="formInquire" method="post" action="__APP__/PrivateAccount/index">
			<div class="row">
                <input type="hidden" id="pageNumber" name="pageNumber" value="">
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
				<!-- begin panel -->
				<div class="panel panel-inverse">

					<div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></a>
						</div>
						<h4 class="panel-title">專屬帳戶</h4>
					</div>

					<div class="panel-body">
						<div class="table-responsive">
							<table id="table1" class="table table-striped m-b-0">
								<thead>
									<tr>
										<th>會員ID</th>
										<th>會員帳號</th>
										<th>銀行代碼</th>
										<th>銀行帳號</th>
										<th>銀行名稱</th>
										<th>操作</th>
										<th>開關</th>
									</tr>
								</thead>
								<tbody>
									<?php if(is_array($showArray)): $i = 0; $__LIST__ = $showArray;if( count($__LIST__)==0 ) : echo "$showEmpty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				                        	<td><?php echo ($vo["id"]); ?></td>
											<td><?php echo ($vo["account"]); ?></td>
											<td><?php echo ($vo["bankcode"]); ?></td>
											<td><?php echo ($vo["bankaccount"]); ?></td>
											<td><?php echo ($vo["bankname"]); ?></td>
											<td id="<?php echo ($vo["ATMId"]); ?>enabled"><?php echo ($vo["enabled"]); ?></td>
											<td>
												<a onclick="openmodal('setModal','<?php echo ($vo["id"]); ?>','<?php echo ($vo["ATMId"]); ?>','<?php echo ($vo["account"]); ?>','<?php echo ($vo["bankcode"]); ?>','<?php echo ($vo["bankaccount"]); ?>','<?php echo ($vo["bankname"]); ?>','<?php echo ($vo["enabled"]); ?>')"><i class="fas fa-wrench fa-fw icon-size"></i></a>
											    <?php if($vo["enabled"] == '停用中'): ?><form id="formInquireTostart<?php echo ($vo["ATMId"]); ?>" class="div-style form-vertical-align" method="post" action="__APP__/PrivateAccount/formStartPrivateatm">
														<input type="hidden" name="startId" value="<?php echo ($vo["ATMId"]); ?>">
														<div class="switcher">
														  <input type="checkbox" id="switcher_checkbox_<?php echo ($vo["ATMId"]); ?>" onclick="submitAjax('formInquireTostart','<?php echo ($vo["ATMId"]); ?>','startId')">
														  <label for="switcher_checkbox_<?php echo ($vo["ATMId"]); ?>" class="switchbtn"></label>
														</div>
													</form>
												<?php elseif($vo["enabled"] == '啟用中'): ?>
													<form id="formInquireTostop<?php echo ($vo["ATMId"]); ?>" class="div-style form-vertical-align" method="post" action="__APP__/PrivateAccount/formStopPrivateatm">
														<input type="hidden" name="stopId" value="<?php echo ($vo["ATMId"]); ?>">
														<div class="switcher">
														  <input type="checkbox" id="switcher_checkbox_<?php echo ($vo["ATMId"]); ?>" checked onclick="submitAjax('formInquireTostop','<?php echo ($vo["ATMId"]); ?>','stopId')">
														  <label for="switcher_checkbox_<?php echo ($vo["ATMId"]); ?>" class="switchbtn"></label>
														</div>
													</form><?php endif; ?>
												<form id="delform<?php echo ($vo["ATMId"]); ?>" class="div-style" method="post" action="__APP__/PrivateAccount/formDelPrivateatm">
													<input type="hidden" value="<?php echo ($vo["ATMId"]); ?>" name="delPrivateatmId">
													<a onclick="submit('delform<?php echo ($vo["ATMId"]); ?>','<?php echo ($vo["account"]); ?>')"><i class="fas fa-trash fa-fw icon-size"></i></a>
												</form>
											</td>
										</tr><?php endforeach; endif; else: echo "$showEmpty" ;endif; ?>
			                     </tbody>
							</table>
						</div>
					</div>

					<?php if($pageNumber != ''): ?><div class="row">
		                  <div class="main col-lg-12">
		                  		<nav aria-label="Page navigation">
					                <ul class="pagination justify-content-center">

					                <?php if($pageNumber-1 != 0): ?><li id="" class="page-item"><a class="page-link" href="#" onClick="goPage('1')">第一頁</a></li>
					                  <li class="page-item">
					                    <a class="page-link" href="#" onClick="goPage('<?php echo ($pageNumber-1); ?>')" aria-label="Previous">
					                      <i aria-hidden="true" class="fa fa-angle-left pt10"></i>
					                      <span class="sr-only">Previous</span>
					                    </a>
					                  </li><?php endif; ?>

					                  <?php if(is_array($pageArray)): $i = 0; $__LIST__ = $pageArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($pageNumber == $vo): ?><li id="<?php echo ($vo); ?>Page" class="page-item active"><a class="page-link" href="#" onClick="goPage('<?php echo ($vo); ?>')"><?php echo ($vo); ?></a></li>
		                                <?php else: ?>
		                                	<li id="<?php echo ($vo); ?>Page" class="page-item"><a class="page-link" href="#" onClick="goPage('<?php echo ($vo); ?>')"><?php echo ($vo); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

					                  <?php if($pageNumber+1 <= $totalPage ): ?><li class="page-item">
						                    <a class="page-link" href="#" onClick="goPage('<?php echo ($pageNumber+1); ?>')" aria-label="Next">
						                      <i aria-hidden="true" class="fa fa-angle-right pt10"></i>
						                      <span class="sr-only">Next</span>
						                    </a>
						                  </li>
						                  <li id="<?php echo ($totalPage); ?>Page" class="page-item"><a class="page-link" href="#" onClick="goPage('<?php echo ($totalPage); ?>')">最末頁</a></li><?php endif; ?>
					                </ul>
					            </nav>
		                  </div>
	                  </div><?php endif; ?>
				</div>
			</div>
        </div>

        <div class="modal fade" id="setModal" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> 修改會員</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<form method="post" action='__APP__/PrivateAccount/formSetPrivateatm'>
					<input type="hidden" value="<?php echo ($vo["ATMId"]); ?>" id="setPrivateatmId" name="setPrivateatmId">
						<div class="modal-body">
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行代碼 : </label>
								<div class="col-md-8 col-sm-8">
									<select name="setBankcode" id="setBankcode" class="form-control">
									 	<option value="null">請選擇</option>
									 	<?php if(is_array($bankCodeArray)): $i = 0; $__LIST__ = $bankCodeArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bankcode"]); ?>"><?php echo ($vo["bankcode"]); ?>-<?php echo ($vo["bankcodeName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									 </select>
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行帳號 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" id="setBankaccount" name="setBankaccount" value="">
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">銀行名稱 : </label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" id="setBankname" name="setBankname" value="">
								</div>
							 </div>
							<div class="modal-footer p-b-0">
								<button type="submit" name="setbtn" class="btn btn-info f-s-15">修改</button>
							</div>
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

<script>
 $(document).ready(function(){
	$("#add_btn").click(function(){
		$('#modal-dialog').modal('show');
	});
	$("#set_btn").click(function(){
		$('#modal-dialogSet').modal('show');
	});

	$('#member_account').typeahead({
	    ajax: {
	      url: '__URL__/searchMemberName',
	      timeout: 200
	    }
	});
});
 function submit(formId,vo_acc){
    askMsgShow('是否刪除' + vo_acc);
    $("#askMsgClose").on('click', function(e) {
        askMsgClose_f();
    })
    $("#askMsgYes").on('click', function(e) {
        $("#" + formId).submit();
        askMsgClose_f();
        okMsgShow('已刪除');
    })
}
 function openmodal(modal_id,vo_id,vo_ATMId,vo_account,vo_bankcode,vo_bankaccount,vo_bankname,vo_enabled){
		//alert(id);
		$('#seId').val(vo_id);
		$('#setPrivateatmId').val(vo_ATMId);
		$('#setAccount').val(vo_account);
		$('#setBankcode').val(vo_bankcode);
		$('#setBankaccount').val(vo_bankaccount);
		$('#setBankname').val(vo_bankname);
		$('#setEnabled').val(vo_enabled);
		$('#'+modal_id).modal('show');
	}
 function goPage(pageNumber){
		$("#pageNumber").val(pageNumber);
		$("#formInquire").submit();
	}
function submitAjax(mod_id,vo_id,mode_id){
	$("#switcher_checkbox_"+vo_id).attr("disabled",true);
	if(mod_id == 'formInquireTostop'){
		$.ajax({
			type:"POST",
			url:"__URL__/ajaxSwitch",
			data:{stopId:vo_id,mode_id:mode_id},
		    dataType: "text",
		    success:function(data){
		    	$("#switcher_checkbox_"+vo_id).attr("disabled",false);
				$("#"+vo_id+"enabled").html('停用中');
	 			$("#switcher_checkbox_"+vo_id).attr('onclick','submitAjax("formInquireTostart","'+vo_id+'","startId")');
		    },
			error:function(){
				alert("網路連線錯誤，請檢查您的網路狀況。");
			}
		});
	} else if(mod_id == 'formInquireTostart'){
		$.ajax({
			type:"POST",
			url:"__URL__/ajaxSwitch",
			data:{startId:vo_id,mode_id:mode_id},
		    dataType: "text",
		    success:function(data){
		    	$("#switcher_checkbox_"+vo_id).attr("disabled",false);
				$("#"+vo_id+"enabled").html('啟用中');
				$("#switcher_checkbox_"+vo_id).attr('onclick','submitAjax("formInquireTostop","'+vo_id+'","stopId")');
		    },
			error:function(){
				alert("網路連線錯誤，請檢查您的網路狀況。");
			}
		});
	}
}
</script>