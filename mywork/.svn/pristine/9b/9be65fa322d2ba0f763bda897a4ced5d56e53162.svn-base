<?php
/*
 * 
 */
class CommonModel extends Model {
    
    
    /**
     * cache query
     * @param sql sql字串
     * @param life_time 存活時間 (秒)
     */
    public function cacheQuery($sql, $life_time = 600) {
        if($_SESSION['Admin']['isFirstLogin'] == '1'){
            S($sql,NULL);
        }
        $cached_data = S($sql);
        if ($cached_data !== false) {
            return $cached_data;
        } else {
            $return = $this->query($sql);
            if ($return === false) {
                return false;
            }
            S($sql, $return, $life_time);
            return $return;
        }
    }
    protected function getLastInsertId(){
        $sql = "SELECT LAST_INSERT_ID();";
        $return = $this->query($sql);
        if ($return === false) {
            return false;
        }
        return $return[0]["LAST_INSERT_ID()"];
    }
}