<?php
class CommonMemberOnlineModel extends AdminModel {
    protected $tableName = "common_member_online";
    protected $tableId = "online_id";

    /*
     * 取得 資料
     */
    public function getMemberOnlineData($data,&$err=""){
        if(empty($data["startTime"]) && $data["startTime"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "SELECT * FROM  `{$this->tableName}`
                WHERE `online_modifyTime` > '{$data["startTime"]}'
                order by `online_createTime` desc";
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
    public function delMemberOnlineDataById($data,&$err=""){
        if(empty($data["member_id"]) && $data["member_id"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `member_id` = '{$data['member_id']}';";
        $return = $this->execute($sql);
        return $return;
    }
    
    /*
     * 取得 時間內 資料
     * 使用於 統計腳本
     */
    public function getMemberOnlineDataUseStatistics($data,&$err=""){
        if(empty($data["startTime"]) && $data["startTime"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        if(empty($data["endTime"]) && $data["endTime"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "SELECT * FROM  `{$this->tableName}`
                WHERE (`online_createTime` <= '{$data["startTime"]}' AND `online_modifyTime` >= '{$data["startTime"]}') OR
                      (`online_createTime` >= '{$data["startTime"]}' AND `online_createTime` < '{$data["endTime"]}') ";
        $return = $this->query($sql);
        if($return === false){//否，顯示錯誤
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        return $return;
    }
}