<?php 
/*
 * 代理子帳號 
 */
class CommonAgentSubModel extends AdminModel {
    protected $tableName = "common_agent_sub";
    protected $tableId = "sub_id";
    /**
     * 踢除登入 子帳號代理
     */
    public function getOutAgentSubLogin($data ,&$err = ""){
        if(empty($data["sub_id"]) && $data["sub_id"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "UPDATE `{$this->tableName}` 
                SET `sub_uid` = null 
                WHERE `sub_id` = '{$data['sub_id']}'";
        $return = $this->query($sql);
        return $return;
    }
}