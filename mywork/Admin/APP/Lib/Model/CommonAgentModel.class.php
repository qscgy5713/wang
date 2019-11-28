<?php
/*
 * 代理帳號
 */
class CommonAgentModel extends AdminModel {
    protected $tableName = "common_agent";
    protected $tableId = "agent_id";
    /*
     * 取得代理自己所有資料
     * 佔成，代理樹，基本資料
     */
    public function getAgentDataById($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== '0'){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_ratio` b ON (a.`agent_id` = b.`agent_id`)
                JOIN `common_agent_tree` c ON (a.`agent_id` = c.`agent_id`)
                WHERE a.`agent_id` = '".$data['agent_id']."'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }

    /*
     * 取得 未有TREE全部代理 資料
     */
    public function getAllAgentData(){

        $sql = "SELECT a.agent_id as agent_OnlyId,a.agent_account,a.agent_bossId FROM `{$this->tableName}` a
                LEFT JOIN `common_agent_tree` b ON a.`agent_id` = b.`agent_id`
                WHERE b.`agent_tree` is null LIMIT 1500;";
        $return = $this->query($sql);
        return $return;
    }
    public function getAgentBossData($data){

        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `agent_id` = '".$data['agent_id']."'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }

    /*
     * 取得 代理 資料
     */
    public function getAgentDataByAccount($data){
        if(empty($data['agent_account']) && $data['agent_account'] !== '0'){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_ratio` b ON (a.`agent_id` = b.`agent_id`)
                JOIN `common_agent_tree` c ON (a.`agent_id` = c.`agent_id`)
                WHERE `agent_account` = '".$data['agent_account']."'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 密碼MD5
     */
    public function getMd5Password($password){
        return md5($password . C("HASH_KEY"));
    }
    /*
     * 新增 代理 資料
     */
    public function addAgentData($data,&$err=""){
        //開始事務處理
        $this->startTrans();

        $ratioSuperiorGiving = $data["ratio_superiorGiving"];
        $ratioTree = $data["ratio_tree"];
        
        $paSuperiorGiving = $data["pa_superiorGiving"];
        $paTree = $data["pa_tree"];
        
        $xbsSuperiorGiving = $data["xbs_superiorGiving"];
        $xbsTree = $data["xbs_tree"];

        $sql = "INSERT INTO `{$this->tableName}` ";
        $keysql = "";
        $valuesql = "";
        foreach ($data as $key => $value) {
            if($key == "ratio_superiorGiving"){ continue;}
            if($key == "ratio_tree"){ continue;}
            if($key == "xbs_superiorGiving"){ continue;}
            if($key == "xbs_tree"){ continue;}
            if($key == "pa_superiorGiving"){ continue;}
            if($key == "pa_tree"){ continue;}
            if(empty($keysql)){
                $keysql = " (`{$key}`";
            } else {
                $keysql .= ",`{$key}`";
            }
            if(empty($valuesql)){
                $valuesql = " ('{$value}'";
            } else {
                $valuesql .= ",'{$value}'";
            }
        }
        $sql .= $keysql.") VALUES ".$valuesql.");";
        $return = $this->query($sql);
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        //新增成功 回傳ID
        $insertId = $this->getLastInsertId();
        if($insertId === false) {
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        $CommonAgentRatio = D("CommonAgentRatio");


        $data = array(
            "agent_id" => $insertId,
            "ratio_superiorGiving"=>$ratioSuperiorGiving,
            "ratio_tree"=>$ratioTree,
            "pa_superiorGiving"=>$paSuperiorGiving,
            "pa_tree"=>$paTree,
            "xbs_superiorGiving"=>$xbsSuperiorGiving,
            "xbs_tree"=>$xbsTree
        );
        $return = $CommonAgentRatio->addAgentRatioData($data);//新增代理佔成
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03'));
        }
        $this->commit();//事務處理成功
        return $insertId;

    }
    /*
     * 修改 代理 資料
     * 使用ID
     */
    public function setAgentDataById($data,&$err=""){
        if(empty($data['agent_id']) && $data['agent_id'] !== '0'){
            $err = L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }

        //開始事務處理
        $this->startTrans();
        $RatioReturn = false;
        if(isset($data['ratio_superiorGiving'])){
            $CommonAgentRatio = D("CommonAgentRatio");
            $data1 = array(
                "agent_id" => $data['agent_id'],
                "ratio_superiorGiving"=>$data['ratio_superiorGiving'],
                "ratio_tree"=>$data['ratio_tree'],
            );
            $return = $CommonAgentRatio->setAgentRatioById($data1);
            if($return === false){
                $this->rollback();//事務處理失敗 回退
                $err = L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
                return false;
            }
            if($return != 1){
                $this->rollback();//事務處理失敗 回退
                $err = L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_03'));
                return false;
            }
            $RatioReturn = true;
            
            unset($data['ratio_superiorGiving']);
            unset($data['ratio_tree']);
        }
        

        $sql = "";
        $bossIdStr = "";
        foreach ($data as $key => $value) {
            if($key == 'agent_id'){continue;}
            if($key == 'ratio_superiorGiving'){continue;}
            if($key == 'ratio_tree'){continue;}
            if($key == 'agent_bossId'){$bossIdStr = "AND `agent_bossId` = '{$data['agent_bossId']}'"; continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `agent_id` = '{$data['agent_id']}' {$bossIdStr}";

        $return = $this->execute($sql);
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_04'));
            return false;
        }
        if($return != 1 && !$RatioReturn){
            $err = L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_05'));
            $this->rollback();//事務處理失敗 回退
            return false;
        }
        $this->commit();//事務處理成功
        return $return;
    }

    /*
     * 取得 代理下級 代理資訊
     */
    public function getAgentUnderDataById($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== '0'){
            return false;
        }
        $whereSql = "";
        if(!empty($data['agent_account']) && $data['agent_account'] !== '0'){
            $whereSql = "AND a.`agent_account` LIKE '%{$data['agent_account']}'";
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_ratio` b ON (a.`agent_id` = b.`agent_id`)
                WHERE `agent_bossId` = '{$data['agent_id']}' {$whereSql}
                ;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得 新增代理 規則
     */
    public function getAgentMaxBodysByHead($data){
        if(empty($data['agent_head']) && $data['agent_head'] !== '0'){
            return false;
        }
        $sql = "SELECT max(`agent_bodys`) as MaxBodys FROM `{$this->tableName}`
                WHERE `agent_head` = '{$data['agent_head']}' LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
    public function checkAgentPowerById($data){
        $sql = "SELECT `agent_id` FROM `{$this->tableName}`
                WHERE `agent_id` = '{$data['agent_id']}' AND `agent_bossId` = '{$data['agent_bossId']}' LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        var_dump($return);exit();
        return $return[0];
    }*/

    /*
     * 搜尋 代理 帳號
     */
    public function searchAgentByAgentAccount($data){

        $sql = "SELECT `agent_account`
                FROM `{$this->tableName}` a
                JOIN `common_agent_tree` b ON (a.`agent_id` = b.`agent_id`)
                WHERE `agent_account` LIKE '{$data['agent_account']}%'
                AND `agent_tree` REGEXP '^{$data['agent_tree']}'
                LIMIT {$data['limit']}";
        //var_dump($sql);exit();
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /**
     * 踢除登入 代理
     */
    public function getOutAgentLogin($data ,&$err = ""){
        if(empty($data["agent_id"]) && $data["agent_id"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "UPDATE `{$this->tableName}`
                SET `agent_uid` = null
                WHERE `agent_id` = '{$data['agent_id']}'";
        $return = $this->query($sql);
        return $return;
    }
    /**
     * 搜索 帳號
     */
    public function sreachAgentAccount($data){
        if(!empty($data['agent_id'])){
            $whereSql = "WHERE a.`agent_id` = '{$data['agent_id']}'";
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_agent_ratio` b ON (a.`agent_id` = b.`agent_id`)
                JOIN `common_agent_tree` c ON (a.`agent_id` = c.`agent_id`)
                {$whereSql}
                ORDER BY a.`agent_id` DESC ";
        $return = $this->query($sql);
        return $return[0];
    }
}