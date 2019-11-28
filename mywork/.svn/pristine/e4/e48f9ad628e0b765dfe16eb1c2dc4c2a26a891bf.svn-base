<?php
class CommonAgentOnlineModel extends AdminModel {
    protected $tableName = "common_agent_online";
    protected $tableId = "online_id";


    /*
     * 取得 資料
     */
    public function getAgentOnlineData($data,&$err=""){
        if(empty($data["startTime"]) && $data["startTime"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` 
                WHERE `online_modifyTime` > '{$data['startTime']}' 
                ORDER BY `online_createTime` DESC";
        $return = $this->query($sql);
        if($return === false){//否，顯示錯誤
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        return $return;
    }
    
    /*
     * 刪除 資料
     */
    public function delAgentOnlineDataById($data,&$err=""){
        if(empty($data["agent_id"]) && $data["agent_id"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        if(empty($data["agent_identity"]) && $data["agent_identity"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `agent_id` = '{$data['agent_id']}'
                    AND `agent_identity` = '{$data['agent_identity']}';";
        $return = $this->execute($sql);
        return $return;
    }
}