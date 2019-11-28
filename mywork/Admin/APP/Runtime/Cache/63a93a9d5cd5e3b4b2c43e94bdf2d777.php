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
		<button id="add_btn" class="btn btn-info m-r-5 m-b-10" type="button">新增帳號</button>

        <div class="modal fade" id="modal-dialog" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> 新增帳號</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>

					<form method="post" action='__APP__/AdminManage/formAddAdmin'>
						<div class="modal-body">
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">帳號 :</label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" name="addAccount" >
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">密碼 :</label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="password" name="addPassword">
								</div>
							 </div>

							 <div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label">確認密碼 :</label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="password" name="addCheckPassword">
								</div>
							 </div>
							 <div class="form-group row m-b-15">
							 	<label class="col-md-4 col-sm-4 col-form-label">權限快選 :</label>
							 	<div class="col-md-4 col-sm-4">
							 		<select name="statusSelect" id="statusSelect" class="form-control">
									 	<option value="null">請選擇</option>
									 	<?php if(is_array($DepartmentArray)): $i = 0; $__LIST__ = $DepartmentArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									 </select>
							 	</div>
							 </div>

							 <div class="form-group row m-b-15" id="meun">
							 	 <?php if(is_array($showPageArray)): foreach($showPageArray as $key=>$showPageVal): ?><label class="col-md-2 col-sm-2 col-form-label"><?php echo ($key); ?></label>
									<div class="col-md-4 col-sm-4 m-b-20">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" name ="addchkall<?php echo ($showPageVal["0"]["classId"]); ?>" onclick="addallselet(<?php echo ($showPageVal["0"]["classId"]); ?>)">
											<label class="form-check-label">全選</label>
										</div>
									   <?php if(is_array($showPageVal)): foreach($showPageVal as $key=>$PageVal): ?><div class="form-check">
											<input type="checkbox" class="form-check-input addPageClass<?php echo ($PageVal["classId"]); ?>" value="<?php echo ($PageVal["id"]); ?>" name="addPageId[]" id="set<?php echo ($PageVal["id"]); ?>">
											<label class="form-check-label"><?php echo ($PageVal["showName"]); ?></label>
										 </div><?php endforeach; endif; ?>
									</div><?php endforeach; endif; ?>
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
				<!-- begin panel -->
				<div class="panel panel-inverse" data-sortable-id="table-basic-7">
					<!-- begin panel-heading -->
					<div class="panel-heading ui-sortable-handle" data-click="panel-collapse">
						<div class="panel-heading-btn">
							<div class="btn btn-xs btn-icon btn-circle btn-warning"><i class="fa fa-minus"></i></div>
						</div>
						<h4 class="panel-title">公司帳號</h4>
					</div>
					<!-- end panel-heading -->

					<!-- begin panel-body -->
					<div class="panel-body">
								<!-- begin table-responsive -->
						<div class="table-responsive">
							<table id="table1" class="table table-striped m-b-0">
								<thead>
									<tr>
										<th>序</th>
                  	<th>帳號</th>
                  	<th>狀態</th>
                  	<th>備註</th>
                  	<th>建立時間</th>
                  	<th>修改時間</th>
                  	<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php if(is_array($showArray)): foreach($showArray as $key=>$showVal): ?><tr>
                    	<td><?php echo ($key+1); ?></td>
											<td><?php echo ($showVal["account"]); ?></td>
											<td id="<?php echo ($showVal["id"]); ?>status"><?php echo ($showVal["status"]); ?></td>
											<td><?php echo ($showVal["remark"]); ?></td>
											<td><?php echo ($showVal["createTime"]); ?></td>
											<td><?php echo ($showVal["modifyTime"]); ?></td>
											<td>
												<a onclick="openmodal('<?php echo ($showVal["id"]); ?>')" ><i class="fas fa-wrench fa-fw icon-size"></i></a>

												<?php if($showVal["status"] == "帳號正常"): ?><form id="formInquireTostop<?php echo ($showVal["id"]); ?>" class="div-style form-vertical-align" method="post" action='__APP__/AdminManage/formStopAdmin'>
														<input type="hidden" value="<?php echo ($showVal["id"]); ?>" name="stopId">
														<div class="switcher">
														  <input type="checkbox" id="switcher_checkbox_<?php echo ($showVal["id"]); ?>" checked value="<?php echo ($showVal["id"]); ?>" onclick="submitAjax('formInquireTostop','<?php echo ($showVal["id"]); ?>','stopId')">
														  <label for="switcher_checkbox_<?php echo ($showVal["id"]); ?>" class="switchbtn"></label>
														</div>
                        	</form>
												<?php else: ?>
													<form id="formInquireTostart<?php echo ($showVal["id"]); ?>" class="div-style form-vertical-align" method="post" action='__APP__/AdminManage/formStartAdmin'>
	                          	<input type="hidden" value="<?php echo ($showVal["id"]); ?>" name="startId">
                          	<div class="switcher">
														  <input type="checkbox" id="switcher_checkbox_<?php echo ($showVal["id"]); ?>"  value="<?php echo ($showVal["id"]); ?>" onclick="submitAjax('formInquireTostart','<?php echo ($showVal["id"]); ?>','startId')">
														  <label for="switcher_checkbox_<?php echo ($showVal["id"]); ?>" class="switchbtn"></label>
														</div>
                         	 </form><?php endif; ?>

                        <form id="delform<?php echo ($showVal["id"]); ?>"  class="div-style" method="post" action='__APP__/AdminManage/formDelAdmin'>
                        	<input type="hidden" value="<?php echo ($showVal["id"]); ?>" name="delId">
                        	<a onclick="submit('delform<?php echo ($showVal["id"]); ?>','<?php echo ($showVal["account"]); ?>')"><i class="fas fa-trash fa-fw icon-size"></i></a>
                        </form>
                      </td>
										</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
						</div>
						<?php if($pageNumber != ''): ?><div class="row">
			                  <div class="main col-lg-12">
			                  		<nav aria-label="Page navigation">
						                <ul class="pagination justify-content-center">

						                <?php if($pageNumber-1 != 0): ?><li id="" class="page-item"><a class="page-link" href="__APP__/<?php echo (MODULE_NAME); ?>/index&pageNumber=1">第一頁</a></li>
						                   <li class="page-item">
						                     <a class="page-link" href="__APP__/<?php echo (MODULE_NAME); ?>/index&pageNumber=<?php echo ($pageNumber-1); ?>" aria-label="Previous">
						                       <i aria-hidden="true" class="fa fa-angle-left pt10"></i>
						                       <span class="sr-only">Previous</span>
						                     </a>
						                   </li><?php endif; ?>

						                  <?php if(is_array($pageArray)): $i = 0; $__LIST__ = $pageArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($pageNumber == $vo): ?><li id="<?php echo ($vo); ?>Page" class="page-item active"><a class="page-link" href="__APP__/<?php echo (MODULE_NAME); ?>/index&pageNumber=<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li>
			                                <?php else: ?>
			                                	<li id="<?php echo ($vo); ?>Page" class="page-item"><a class="page-link" href="__APP__/<?php echo (MODULE_NAME); ?>/index&pageNumber=<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

						                  <?php if($pageNumber+1 <= $totalPage ): ?><li class="page-item">
							                    <a class="page-link" href="__APP__/<?php echo (MODULE_NAME); ?>/index&pageNumber=<?php echo ($pageNumber+1); ?>" aria-label="Next">
							                      <i aria-hidden="true" class="fa fa-angle-right pt10"></i>
							                      <span class="sr-only">Next</span>
							                    </a>
							                  </li>
							                  <li id="<?php echo ($totalPage); ?>Page" class="page-item"><a class="page-link" href="__APP__/<?php echo (MODULE_NAME); ?>/index&pageNumber=<?php echo ($totalPage); ?>">最末頁</a></li><?php endif; ?>
						                </ul>
						            </nav>
			                  </div>
		                  </div><?php endif; ?>
					</div>
				</div>
			</div>

			<!-- 操作 開始-->
			<?php if(is_array($showArray)): foreach($showArray as $key=>$showVal): ?><div class="modal fade" id="<?php echo ($showVal["id"]); ?>" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title"> 修改公司帳號資料</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>

							<form method="post" action='__APP__/AdminManage/formSetAdmin'>
								<div class="modal-body">
									<div class="form-group row m-b-15">
										<label class="col-md-4 col-sm-4 col-form-label">帳號 :</label>
										<div class="col-md-8 col-sm-8">
											<input class="form-control" type="text" readonly value="<?php echo ($showVal["account"]); ?>">
											<input type="hidden" value="<?php echo ($showVal["id"]); ?>" name="setId">
										</div>
									 </div>

									 <div class="form-group row m-b-15">
										<label class="col-md-4 col-sm-4 col-form-label">密碼 :</label>
										<div class="col-md-8 col-sm-8">
											<input class="form-control" type="password" name="setPassword">
										</div>
									 </div>

									 <div class="form-group row m-b-15">
										<label class="col-md-4 col-sm-4 col-form-label">確認密碼 :</label>
										<div class="col-md-8 col-sm-8">
											<input class="form-control" type="password" name="setCheckPassword">
										</div>
									 </div>

									 <div class="form-group row m-b-15">
										<label class="col-md-4 col-sm-4 col-form-label">備註 :</label>
										<div class="col-md-8 col-sm-8">
											<input class="form-control" type="text" name="setRemark" value="<?php echo ($showVal["remark"]); ?>">
										</div>
									 </div>

									 <div class="form-group row m-b-15">
									 	<?php if(is_array($showVal["pageData"])): foreach($showVal["pageData"] as $key=>$classVal): ?><label class="col-md-2 col-sm-2 col-form-label"><?php echo ($key); ?></label>
											<div class="col-md-4 col-sm-4 m-b-20">
												<div class="form-check">
													<input id="<?php echo ($showVal["id"]); echo ($key); ?>" type="checkbox" class="form-check-input" name ="set<?php echo ($showVal["account"]); ?>chkall<?php echo ($classVal["0"]["classId"]); ?>" onclick="setallselet(<?php echo ($classVal["0"]["classId"]); ?>,'<?php echo ($showVal["account"]); ?>')">
													<label class="form-check-label" for="<?php echo ($showVal["id"]); echo ($key); ?>">全選</label>
												</div>
											   <?php if(is_array($classVal)): foreach($classVal as $key=>$pageVal): if(($pageVal["power"]) == "1"): ?><div class="form-check">
															<input id="<?php echo ($showVal["id"]); echo ($key); echo ($pageVal["showName"]); ?>" type="checkbox" class="form-check-input set<?php echo ($showVal["account"]); ?>PageClass<?php echo ($pageVal["classId"]); ?>" checked="checked" value="<?php echo ($pageVal["id"]); ?>" name="setPageId[]">
															<label class="form-check-label" for="<?php echo ($showVal["id"]); echo ($key); echo ($pageVal["showName"]); ?>"><?php echo ($pageVal["showName"]); ?></label>
														</div>
												   	<?php else: ?>
												   		<div class="form-check">
															<input id="<?php echo ($showVal["id"]); echo ($key); echo ($pageVal["showName"]); ?>" type="checkbox" class="form-check-input set<?php echo ($showVal["account"]); ?>PageClass<?php echo ($pageVal["classId"]); ?>"  value="<?php echo ($pageVal["id"]); ?>" name="setPageId[]">
															<label class="form-check-label" for="<?php echo ($showVal["id"]); echo ($key); echo ($pageVal["showName"]); ?>"><?php echo ($pageVal["showName"]); ?></label>
														</div><?php endif; endforeach; endif; ?>
											</div><?php endforeach; endif; ?>
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
	        </div><?php endforeach; endif; ?>
        <!-- 操作 結束-->

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
function openmodal(modal_id){
	//alert(id);
	$('#'+modal_id).modal('show');
}
function addallselet(thisa)
{
   if ($("input[name='addchkall"+thisa+"']").prop('checked')) {
      $(".addPageClass"+thisa).prop("checked", true);
    } else {
      $(".addPageClass"+thisa).prop("checked", false);
    }
}
 function setallselet(thisa,AdminAccount)
 {
    if ($("input[name='set"+AdminAccount+"chkall"+thisa+"']").prop('checked')) {
       $(".set"+AdminAccount+"PageClass"+thisa).prop("checked", true);
     } else {
       $(".set"+AdminAccount+"PageClass"+thisa).prop("checked", false);
     }
 }
 $(document).ready(function(){
	//修改
	$("button[name='setbtn']").click(function(){
		var password = $("input[name='setPassword']").val();
		var checkPassword = $("input[name='setCheckPassword']").val();

		password = $.trim(password);
		checkPassword = $.trim(checkPassword);

		 if (password == 0 && checkPassword == 0){
			 //alert("1");
		 }
		 else if(password == checkPassword){
			 //alert("2");

		 }else{
			 errorMsgShow("請確認 密碼 與 確認密碼 資料是否一致");
			 return false;
		 }
	 })
	 //新增
	 $("button[name='addbtn']").click(function(){
		 var addPassword = $("input[name='addPassword']").val();
		 var addCheckPassword = $("input[name='addCheckPassword']").val();

		 addPassword = $.trim(addPassword);
		 addCheckPassword = $.trim(addCheckPassword);

		 if (addPassword == 0 || addCheckPassword == 0){
			 errorMsgShow("請輸入密碼");
			 return false;
		 }else if(addPassword != addCheckPassword){
			 errorMsgShow("請確認 密碼 與 確認密碼 資料是否一致");
			 return false;
		 }
	 })

	$("#add_btn").click(function(){
		$('#modal-dialog').modal('show');
	});

    var powerStrId  = <?php echo json_encode($powerArrayId);?>;
    var powerStr  = <?php echo json_encode($powerArray);?>;

	$("#statusSelect").change(function(){
		removeMenu();
	 	for (var i = 0; i < powerStr.length; i++) {
	 		if($(this).val() == powerStr[i][i]){
	 			removeMenu();
		    	for (var j = 0; j < powerStrId['id'].length ; j++) {
		    		if (powerStr[i]['power'][j] == 1) {
		    			$("#set" + powerStrId['id'][j]).prop("checked",true);
		    		}
		    	}
			}
 		}
	 });
	function removeMenu(){
		$("#meun input[type='checkbox']").prop('checked', false);
	}
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
  					$("#"+vo_id+"status").html('帳號停權');
     				$("#switcher_checkbox_"+vo_id).attr('onclick','submitAjax("formInquireTostart","'+vo_id+'","startId")');
		    },
			error:function(){
				errorMsgShow("網路連線錯誤，請檢查您的網路狀況。");
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
				$("#"+vo_id+"status").html('帳號正常');
     			$("#switcher_checkbox_"+vo_id).attr('onclick','submitAjax("formInquireTostart","'+vo_id+'","startId")');
		    },
			error:function(){
				errorMsgShow("網路連線錯誤，請檢查您的網路狀況。");
			}
		});
	}
}
</script>