<?php
/*
 * 代理樹
 */
class CommonAgentTreeModel extends AdminModel {
    /*
     * 登入使用
     * 取得 代理樹 資料
     */
    public function getAgentTreeDataByAgentId($data){
        if(empty($data['agent_id']) && $data['agent_id'] !== '0'){
            return false;
        }
        $sql = "SELECT `agent_tree` FROM `common_agent_tree`
                WHERE `agent_id` = '".$data['agent_id']."' LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得 代理樹 多筆資料
     */
    public function getAgentTreeDataByManyAgentId($data){
        if(count($data) == 0){
            return false;
        }
        $whereSql = "";
        foreach($data as $value){
            if(empty($value)){
                continue;
            }
            if(empty($whereSql)){
                $whereSql .= "a.`agent_id` = '{$value}'";
            } else {
                $whereSql .= " OR a.`agent_id` = '{$value}'";
            }
        }
        if(empty($whereSql)){
            return false;
        }
        $sql = "SELECT `agent_tree` as agentTree,`agent_account` as agentAccount,
                        a.`agent_id` as agentId,b.`agent_mode` as agentMode,
                        b.`agent_head` as agentHead
                FROM `common_agent_tree` a
                JOIN `common_agent` b ON (a.`agent_id` = b.`agent_id`)
                WHERE {$whereSql};";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 取得 子代理 資料
     */
    public function getAgentDataByAgentBoss($data){
        if(empty($data['agent_boss']) && $data['agent_boss'] !== '0'){
            return false;
        }
        $sql = "SELECT * FROM `common_agent_tree` a JOIN `common_agent` b ON (a.`agent_id` = b.`agent_id`)
                WHERE `agent_boss` = '".$data['agent_boss']."';";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 新增 代理樹 資料
     */
    public function addAgentTreeData($data){
        $sql = "INSERT INTO `common_agent_tree` ";
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
     * 取得 子代理 總筆數
     */
    public function getTotalNumberAgentDataByAgentBoss($data){
        if(empty($data['agent_boss']) && $data['agent_boss'] !== '0'){
            return false;
        }
        $whereSql = "";
        if(!empty($data['agent_account']) && $data['agent_account'] !== "0"){
            $whereSql = "AND b.`agent_account` LIKE '{$data['agent_account']}%'";
        }
        $sql = "SELECT COUNT(*) AS totalNumber FROM `common_agent_tree` a JOIN `common_agent` b ON (a.`agent_id` = b.`agent_id`)
                WHERE `agent_boss` = '".$data['agent_boss']."' {$whereSql};";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得 子代理 資料
     */
    public function getAgentDataByAgentBossNumber($data){
        if(empty($data['agent_boss']) && $data['agent_boss'] !== '0'){
            return false;
        }
        $whereSql = "";
        if(!empty($data['agent_account']) && $data['agent_account'] !== "0"){
            $whereSql = "AND b.`agent_account` LIKE '{$data['agent_account']}%'";
        }
        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT " . $pageStart . "," . $pageEnd;
        $sql = "SELECT * FROM `common_agent_tree` a JOIN `common_agent` b ON (a.`agent_id` = b.`agent_id`)
                WHERE `agent_boss` = '".$data['agent_boss']."' {$whereSql} {$pageSql};";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
}