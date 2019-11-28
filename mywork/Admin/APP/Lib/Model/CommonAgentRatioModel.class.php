<?php
/*
 * 管理者帳號
 */
class CommonAgentRatioModel extends AdminModel {
    protected $tableName = "common_agent_ratio";
    protected $tableId = "ratio_id";
    
    public function getAgentAllData(){
        $sql = "SELECT * FROM `{$this->tableName}`";
        $return = $this->query($sql);
        return $return;
    }
    
    
    /*
     * 取得 佔成 資料
     * 使用AgentID
     */
    public function getAgentHighestRatioDataById($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== '0'){
            return false;
        }
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
     * 新增 佔成 資料
     */
    public function addAgentRatioData($data){
        $sql = "INSERT INTO `{$this->tableName}` ";
        $keysql = "";
        $valuesql = "";
        foreach ($data as $key => $value) {
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
        return $return;
    }
    /*
     * 修改 佔成 資料
     * 使用ID
     */
    public function setAgentRatioById($data){
        if(empty($data["agent_id"]) && $data["agent_id"] !== '0'){
            return false;
        }
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == "agent_id"){continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `agent_id` = '{$data["agent_id"]}';";
        //echo $sql;return true;
        $return = $this->execute($sql);
        
        return $return;
    }
    
}