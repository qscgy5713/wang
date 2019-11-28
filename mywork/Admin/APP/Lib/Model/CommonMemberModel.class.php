<?php
/*
 * 會員帳號
 */
class CommonMemberModel extends AdminModel {
    protected $tableName = "common_member";
    protected $tableId = "member_id";
    /*
     * 取得會員狀態字串
     */
    public function getMemberStatusStr($data){
        $returnStr = "";
        switch ($data){
            case "0":
                $returnStr = "正常會員";
                break;
            case "1":
                $returnStr = "停權會員";
                break;
            case "2":
                $returnStr = "測試會員";
                break;
            case "3":
                $returnStr = "驗證帳號";
                break;
            default:
                $returnStr = "狀態錯誤";
                break;
        }
        return $returnStr;
    }
    /*
     * 取得 會員 代理資料
     */
    public function getMemberAgentDataByMermberID($data){
        if(empty($data['member_id']) && $data['member_id'] !== 0){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_tree` b ON (a.`agent_id` = b.`agent_id`)
                JOIN `common_agent_ratio` c ON (a.`agent_id` = c.`agent_id`)
                WHERE `member_id` = '{$data['member_id']}'";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 註冊充託
     */
    public function getMemberDataByAgentIdUseFirstDepositwithdraw($data){
        if(empty($data['agent_tree']) && $data['agent_tree'] !== 0){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_tree` b ON (a.`agent_id` = b.`agent_id`)
                WHERE (`member_createTime` BETWEEN '{$data['member_createTime']['startTime']}' AND '{$data['member_createTime']['endTime']}')
                AND (`agent_tree` REGEXP '^{$data['agent_tree']}') AND `member_status` != 2
                ORDER BY `member_createTime` DESC;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 取得會員錢包 使用會員帳號
     */
    public function getMemberWalletByAccount($data){
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_member_wallet` b ON (a.`member_id` = b.`member_id`)
                WHERE `member_account` = '{$data["member_account"]}'
                OR `member_phone` = '{$data['member_account']}' LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得會員資料 使用於處理 託售單
     */
    public function getMemberDataUseProcessWithdraw($data,&$err=""){
        if(empty($data['member_id']) && $data['member_id'] !== 0){
            return false;
        }
        $sql = "SELECT * FROM `common_member` a
                JOIN `common_member_wallet` b ON (a.`member_id` = b.`member_id`)
                JOIN `common_member_bankdata` c ON (a.`member_id` = c.`member_id`)
                WHERE a.`member_id` = '".$data['member_id']."'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 取得 會員 資料
     */
    public function getMemberDataByAccount($data){
        //$return = $this->where($where)->limit(1)->select();
        if(isset($data['member_phone'])){
            $sqlStr = " or `member_phone` = '".$data['member_phone']."' ";
        }
        $sql = "SELECT * FROM `common_member`
                WHERE `member_account` = '".$data['member_account']."'{$sqlStr}
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得 所有會員 資料
     * 會員管理使用
     */
    public function getAllMemberData($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== 0){
            return false;
        }
        $sql = "SELECT * FROM `common_member`
                WHERE `agent_id` = '".$data['agent_id']."'
                ORDER BY `member_createTime` DESC;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 取得 加密密碼MD5
     */
    public function getMd5Password($password){
        return md5($password . C("HASH_KEY"));
    }
    /*
     * 修改 會員 資料
     */
    public function setMemberById($data){
        if(empty($data['member_id']) && $data['member_id'] !== 0){
            return false;
        }
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == 'member_id'){continue;}
            if(empty($sql)){
                $sql = "UPDATE `common_member` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `member_id` = '{$data['member_id']}'";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 搜尋 會員 帳號
     */
    public function searchMemberByMemberAccount($data){
        $sql = "SELECT `member_account`
                FROM `{$this->tableName}`
                WHERE `member_account` LIKE '{$data['member_acount']}%'
                ORDER BY `member_createTime` DESC LIMIT {$data['limit']}";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /**
     * 踢除登入會員
     */
    public function getOutMemberLogin($data ,&$err = ""){
        if(empty($data["member_id"]) && $data["member_id"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "UPDATE `common_member` SET `member_uid` = null
                WHERE `member_id` = '{$data['member_id']}'";
        $return = $this->query($sql);

        return $return;
    }
    /*
     * 取得 所有會員 總筆數
     * 會員管理使用
     */
    public function getAllTotalMemberData($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== 0){
            return false;
        }
        $whereSql = "";
        if(!empty($data['member_account']) && $data['member_account'] !== '0'){
            $whereSql = "AND `member_account` LIKE '{$data['member_account']}%'";
        }
        $sql = "SELECT COUNT(*) AS totalNumber FROM `common_member`
                WHERE `agent_id` = '{$data['agent_id']}' {$whereSql}
                ORDER BY `member_createTime` DESC;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得 所有會員 分頁
     * 會員管理使用
     */
    public function getAllMemberDataPageNumber($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== 0){
            return false;
        }
        $whereSql = "";
        if(!empty($data['member_account']) && $data['member_account'] !== '0'){
            $whereSql = "AND `member_account` LIKE '{$data['member_account']}%'";
        }
        $startSql = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $endSql = $data['page']['number'];
        $limitSql = " LIMIT {$startSql},{$endSql}";
        $sql = "SELECT * FROM `common_member`
                WHERE `agent_id` = '{$data['agent_id']}' {$whereSql}
                ORDER BY `member_createTime` DESC {$limitSql};";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 搜尋 會員 帳號 和 代理樹資料
     */
    public function searchMemberByMemberAccountUseGiven($data){
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_tree` b ON (a.`agent_id` = b.`agent_id`)
                WHERE `member_account` = '{$data['member_account']}'
                    AND `agent_tree` REGEXP '^{$data['agent_tree']}'
                LIMIT 1";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得會員資料 使用於處理 託售單
     */
    public function getMemberDataUseProcessWithdrawAccount($data,&$err=""){
        if(empty($data['member_account']) && $data['member_account'] !== 0){
            return false;
        }
        $sql = "SELECT * FROM `common_member` a
                JOIN `common_member_wallet` b ON (a.`member_id` = b.`member_id`)
                JOIN `common_member_bankdata` c ON (a.`member_id` = c.`member_id`)
                WHERE a.`member_account` = '".$data['member_account']."'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /**
     * 使用在會員管理 搜索會員 取得代理帳號
     */
    public function searchCommonMemberForAgentAccount($data){
        $sql = "SELECT b.`agent_tree`,b.`agent_id` FROM `{$this->tableName}` a
                JOIN `common_agent_tree` b ON (a.`agent_id` = b.`agent_id`)
                WHERE a.`member_account` = '{$data['member_account']}'";
        $return = $this->query($sql);
        return $return[0];
    }
    /*
     * 取得會員資料 使用於處理 託售單
     */
    public function getMemberDataUserAccount($data,&$err=""){
        if(empty($data['member_account']) && $data['member_account'] !== 0){
            return false;
        }
        $sql = "SELECT * FROM `common_member`
                WHERE `member_account` = '{$data['member_account']}'
                OR `member_phone` = '{$data['member_account']}'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得會員資料 使用於處理 託售單
     */
    public function getProcessWithdrawMemberDataUse($data,&$err=""){
        if(empty($data['member_id']) && $data['member_id'] !== 0){
            return false;
        }
        $sql = "SELECT *,a.`member_id` FROM `common_member` a
                JOIN `common_member_wallet` b ON (a.`member_id` = b.`member_id`)
                LEFT JOIN `common_member_bankdata` c ON (a.`member_id` = c.`member_id`)
                WHERE a.`member_id` = '{$data['member_id']}'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 取得會員密碼 狀態
     * 使用於 會員風控
     */
    public function getMemberPasswordStatusData($data){
        if(empty($data['member_password']) && $data['member_password'] !== 0){
            return false;
        }
        if(empty($data['member_account']) && $data['member_account'] !== 0){
            return false;
        }
        $sql = "SELECT `member_account` FROM `common_member`
                WHERE `member_password` = '{$data['member_password']}'
                AND `member_account` != '{$data['member_account']}'
                ORDER BY `member_account` ASC;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /**
     * 會員手機修改
     */
    public function setMemberPhonebyId($data){
        if(empty($data['member_id']) && $data['member_id'] !== 0){
            return false;
        }
        if(empty($data['member_phone']) && $data['member_phone']){
            return false;
        }
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == 'member_id'){continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `member_id` = '{$data['member_id']}'";
        $return = $this->execute($sql);
        return $return;
    }
    /**
     * 比對手機
     */
    public function searchPhone($data){
        $sql = "SELECT COUNT(*) AS `num` FROM `{$this->tableName}` WHERE `member_phone` = '{$data['member_phone']}'";
        $return = $this->query($sql);
        return $return[0];
    }
    /**
     * 用帳號取得ID for  eventDetail
     */
    public function getMemberIdByAccount($data){
        $sql = "SELECT `member_id` FROM `{$this->tableName}` WHERE `member_account` = '{$data['member_account']}'";
        $return = $this->query($sql);
        return $return[0];
    }
    /**
     * 取得1小時內新註冊的會員
     */
    public function getHourNewMemberData($data){
        $sql = "SELECT COUNT(*) AS totalMember FROM
                WHERE (`member_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}')";
        $return = $this->query($sql);
        return $return[0];
    }

    /*
     * 取得 會員 資料 by 會員轉換
     */
    public function getMemberDataByAgent($data){
        switch ($data['select']) {
            case 'agent_account':
                $whereSql = "`{$data['select']}` = '{$data['search']}'";
                break;
            case 'member_account':
                $whereSql = "`{$data['select']}` REGEXP '^{$data['search']}'";
                break;
            default:
                return false;
                break;
        }
        $sql = "SELECT * FROM `{$this->tableName}` WHERE {$whereSql}";
        $return = $this->query($sql);
        return $return;
    }

    /*
     * 修改 會員 資料
     */
    public function setMemberByAgentAcc($data){
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == 'member_account'){continue;}
            if(empty($sql)){
                $sql = "UPDATE `common_member` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `member_account` = '{$data['member_account']}'";
        // var_dump($sql);
        $return = $this->query($sql);
        return $return;
    }
}