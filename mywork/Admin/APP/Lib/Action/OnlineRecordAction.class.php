<?php
class OnlineRecordAction extends AdminAction {
    protected $limitTime = 30;
    //TODO: 線上紀錄 首頁
    public function index(){
        $request = $this->getRequest();
        $CommonMemberOnline = D("CommonMemberOnline");
        $startTime = time() - (60 * 60);
        $data = array(
            "startTime" => $startTime,
        );
        $return = $CommonMemberOnline->getMemberOnlineData($data,$err);
        if($return === false){
            $this->error($err);
        }
        $showArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "agent_account"=>"agentAccount",
            "member_account"=>"memberAccount",
            "online_createTime"=>"createTime",
            "online_modifyTime"=>"modifyTime",
            "online_ip"=>"ip",
            "online_os"=>"os",
            "online_url"=>"url",
            "member_id"=>"memberId",
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'online_createTime'://建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        $onlineTime = time()-$value[$key1];
                        $showArray[$key]['onlineTime'] = getSecondsChange($onlineTime);
                        break;
                    case 'online_ip':
                        $showStr = get_ip_inet_ntop($value[$key1]);//IP轉換可讀格式
                        break;
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $showArray[$key][$value1] = $showStr;
            }
        }
        $this->assign("showArray",$showArray);
        $this->assign("showEmpty","<tr><td colspan='9' align='center'>無會員資料</td></tr>");
        $this->display();
    }
    //TODO: 代理線上名單
    public function agentOnlineRecord(){
        $request = $this->getRequest();
        $CommonAgentOnline = D("CommonAgentOnline");
        $startTime = time() - (60 * 60);
        $data = array(
            "startTime" => $startTime,
        );
        $return = $CommonAgentOnline->getAgentOnlineData($data,$err);
        if($return === false){
            $this->error($err);
        }
        $showArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "agent_account"=>"agentAccount",
            "agent_identity"=>"identity",
            "sub_account"=>"subAccount",
            "online_createTime"=>"createTime",
            "online_ip"=>"ip",
            "online_os"=>"os",
            "online_url"=>"url",
            "agent_id"=>"agentId",
            "sub_id"=>"subId",
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'online_createTime'://建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        $onlineTime = time()-$value[$key1];
                        $showArray[$key]['onlineTime'] = getSecondsChange($onlineTime);
                        break;
                    case 'online_ip':
                        $showStr = get_ip_inet_ntop($value[$key1]);//IP轉換可讀格式
                        break;
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $showArray[$key][$value1] = $showStr;
            }
        }
        $this->assign("showArray",$showArray);
        $this->assign("showEmpty","<tr><td colspan='8' align='center'>無代理資料</td></tr>");
        $this->display();
    }
    //TODO: 踢除功能
    public function formGetOutId(){

        $request = $this->getRequest();
        switch ($request['selectClass']){
            case 'Member':
                if(!isset($request['memberId']) || empty($request['memberId'])){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
                }
                $CommonMemberOnline = D("CommonMemberOnline");
                $data = array(
                    "member_id" => $request['memberId'],
                );
                if($return === false){
                    $this->error($err);
                }
                $CommonMember = D("CommonMember");
                $data = array(
                    "member_id" => $request['memberId'],
                );
                $return = $CommonMember->getOutMemberLogin($data,$err);
                if($return === false){
                    $this->error($err);
                }
                break;
            case 'Agent':
                if(!isset($request['agentId']) || empty($request['agentId'])){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
                }
                if(!isset($request['identity']) || empty($request['identity'])){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
                }
                $CommonAgentOnline = D("CommonAgentOnline");
                $data = array(
                    "agent_id" => $request['agentId'],
                    "agent_identity" => $request['identity']
                );
                if($return === false){
                    $this->error($err);
                }
                switch($request['identity']){
                    case 1://代理
                        $CommonAgent = D("CommonAgent");
                        $data = array(
                            "agent_id" => $request['agentId'],
                        );
                        $return = $CommonAgent->getOutAgentLogin($data,$err);
                        if($return === false){
                            $this->error($err);
                        }
                        break;
                    case 2://子帳號
                        $CommonAgentSub = D("CommonAgentSub");
                        $data = array(
                            "sub_id" => $request['subId'],
                        );
                        $return = $CommonAgentSub->getOutAgentSubLogin($data,$err);
                        if($return === false){
                            $this->error($err);
                        }
                        break;
                    default:
                        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
                        break;
                }
                break;
            default:
                $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));
                break;
        }
        $this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));

    }
}