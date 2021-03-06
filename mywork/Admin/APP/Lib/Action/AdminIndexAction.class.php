<?php
class AdminIndexAction extends AdminAction {
    //TODO: 管理者首頁
    public function index(){
        $this->display();
    }
    //TODO: 管理者登入功能
    public function formLogin(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的帳號、密碼
        $request = $this->getRequest();
        //var_dump($request);exit();
        $InternalAdmin = D("InternalAdmin");
        $data = array(
            "admin_account" => strtolower($request['account']) //傳入的帳號
        );
        //從 InternalAdminModel getAdminDataByAccount 取得管理者資訊
        $return = $InternalAdmin->getAdminDataByAccount($data);
        if ($return === false) {
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        //檢查 是否 有此帳號
        if(!isset($return['admin_id'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //從 InternalAdminModel getMd5Password($password) 傳入密碼 取得加密後的密碼 做比對
        $password = $InternalAdmin->getMd5Password($request['password']);
        //檢查 密碼 是否正確 。
        if(!($return['admin_password'] === $password)){
            $ip = getIp();
            $ip = get_ip_inet_pton($ip);
            $nowTime = time();//取得現在時間戳
            $InternalAdminLoginLog = D("InternalAdminLoginLog");
            $data = array(
                "admin_id" => $return['admin_id'],
                "admin_account" => $return['admin_account'],
                "loginLog_status"=>0,
                "loginLog_errMessage"=>"密碼錯誤;輸入密碼;".$request['password'],
                "loginLog_createTime" => $nowTime,
                "loginLog_ip" => $ip,
                "loginLog_os" => get_os(),
                "loginLog_url" => get_url()
            );
            $return = $InternalAdminLoginLog->addAdminLoginLogData($data,$err);
            if ($return === false) {
                $this->error($err);
            }
            //否，回傳顯示 帳號、密碼錯誤。
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        //將管理者資料 存入SESSION。
        $_SESSION['Admin']['id'] = $return['admin_id'];
        $_SESSION['Admin']['account'] = $return['admin_account'];
        $_SESSION['Admin']['status'] = $return['admin_status'];
        if($return['admin_account'] != "game"){
            $_SESSION['Admin']['pageData'] = substr($return['power_main'],0,-1);
        }
        
        $_SESSION['Admin']['agentId'] = 1;
        $_SESSION['Admin']['agentAccount'] = 'game';
        $ip = getIp();
        $ip = get_ip_inet_pton($ip);
        $nowTime = time();//取得現在時間戳
        $InternalAdminLoginLog = D("InternalAdminLoginLog");
        if($this->isAdminLosePower()){
            $data = array(
                "admin_id" => $return['admin_id'],
                "admin_account" => $return['admin_account'],
                "loginLog_status"=>0,
                "loginLog_errMessage"=>"帳號停權;無法登入",
                "loginLog_createTime" => $nowTime,
                "loginLog_ip" => $ip,
                "loginLog_os" => get_os(),
                "loginLog_url" => get_url()
            );
            $return = $InternalAdminLoginLog->addAdminLoginLogData($data,$err);
            if ($return === false) {
                $this->error($err);
            }
            //否，回傳顯示 帳號、密碼錯誤。
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }

        $CommonAgentTree = D("CommonAgentTree");
        $data = array(
            "agent_id" => $_SESSION['Admin']['agentId']
        );
        $return = $CommonAgentTree->getAgentTreeDataByAgentId($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        $_SESSION['Admin']['agentTree'] = $return["agent_tree"];


        //是
        $data = array(
            "admin_id" => $_SESSION['Admin']['id'],
            "admin_account" => $_SESSION['Admin']['account'],
            "loginLog_status"=>1,
            "loginLog_createTime" => time(),
            "loginLog_ip" => $ip,
            "loginLog_os" => get_os(),
            "loginLog_url" => get_url()
        );
        $return = $InternalAdminLoginLog->addAdminLoginLogData($data,$err);
        if ($return === false) {
            $this->error($err);
        }

        $uid = $InternalAdmin->getMd5Password($nowTime); //把時間戳 變成 Token
        $_SESSION['Admin']['login_uid'] = $uid;
        $_SESSION['Admin']['uid'] = $uid;
        $data = array(
            "admin_id" => $_SESSION['Admin']['id'],
            "admin_uid" => $_SESSION['Admin']['login_uid'],
            "admin_lastLoginTime" => $nowTime,
            "admin_lastLoginIp" => $ip
        );
        $return = $InternalAdmin->setAdminDataById($data);
        if ($return === false) {
            unset($_SESSION['Admin']);
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));
        }
        $_SESSION['Admin']['isFirstLogin'] = '1';// 是否第一次登入  0不是  1是
        $_SESSION['Admin']['isRenewLoad'] = time();// 是否重新加載  紀錄時間
        //轉跳頁面，登入後首頁。
        
        $showPageArray = $this->getPageArray($request);
        //頁面權限管理
        if(!empty($request['_URL_'][0])){
            if($_SESSION['Admin']['account'] != 'game'){
                $actionNamePower = cookie('admin_adminActionPower');
                if(!empty($actionNamePower)){
                    $actionNamePowerArray = explode(",", $actionNamePower);
                    if(!in_array('GameReport',$actionNamePowerArray)){
                        redirect(__APP__.'/AdminIndex/index');
                        exit();
                    }
                }
            }
        }
        redirect(__APP__);
    }


    //TODO: 管理者登出功能
    public function logout(){
        //清除管理者資料 SESSION
        unset($_SESSION['Admin']);
        cookie(null,'admin_');
        //顯示你已登出，重新導回首頁
        redirect(__APP__.'/AdminIndex/index');
    }
    //TODO: 變更密碼頁面
    public function adminInfo(){
        $this->display();
    }
    //TODO: 變更密碼
    public function setAdminPassword(){
        $request = $this->getRequest();
        if(!isset($request['oldPassword']) || empty($request['oldPassword'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //舊密碼為空，請重新輸入舊密碼
        }
        if(!isset($request['newPassword']) || empty($request['newPassword'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'))); //新密碼為空，請重新輸入新密碼
        }
        $request = $this->getRequest();
        if(!isset($request['new2Password']) || empty($request['new2Password'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03'))); //確認密碼為空，請重新輸入確認密碼
        }
        //檢查，兩次新密碼 是否正確。
        if(!$request['new2Password'] === $request['newPassword']){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04'))); //確認密碼錯誤
        }
        if($request['oldPassword'] === $request['newPassword']){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05'))); //新密碼 不可與 舊密碼 相同
        }
        $InternalAdmin  = D('InternalAdmin');
        //使用帳號 查詢 會員資料
        $data = array(
            'admin_account' => $_SESSION['Admin']['account'],
        );
        $return = $InternalAdmin->getAdminDataByAccount($data);
        if($return === false){
            $this->error(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_06')); //資料庫錯誤
        }
        //檢查 是否有此帳號
        if(!($return['admin_id'])){
            $this->error(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_07')); //無此帳號 請重新輸入。
        }
        //從 InternalAdminModel getMd5Password($password) 傳入密碼 取得加密後的密碼做比對
        $oldPassword = $InternalAdmin->getMd5Password($request['oldPassword']);
        //檢查舊密碼
        if(!($return['admin_password'] === $oldPassword)){
            $this->error(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_08')); //舊密碼錯誤
        }
        //取得 新密碼 MD5加密
        $newPassword = $InternalAdmin->getMd5Password($request['newPassword']);
        $data = array(
            'admin_id' => $_SESSION['Admin']['id'],
            'admin_password' => $newPassword,
        );
        //修改管理密碼
        $return = $InternalAdmin->setAdminDataById($data);
        if($return === false){
            $this->error(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_09')); //修改密碼失敗，請重新登入。
        }
        $addData = array(
            'operateLog_class'=>1, //修改密碼
            'operateLog_objectId'=>$_SESSION['Admin']['agentId'],
            'operateLog_objectAccount'=>$_SESSION['Admin']['agentAccount'],
            'operateLog_main'=> array(
                'oldPassword' => $request['oldPassword'],
                'newPassword' => $request['newPassword'],
            ),
        );
        $this->addAdminOperateLog($addData);
        $this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //修改密碼成功，下次登入請使用新密碼登入
    }
}