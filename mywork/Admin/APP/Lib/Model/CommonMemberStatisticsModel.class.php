<?php
/**
 * 會員統計資料
 */
class CommonMemberStatisticsModel extends AdminModel{
	protected $tableName = "common_member_statistics";
	/**
	 * 取得所有資料
	 */
	public function getMemberStatisticsData($data){
		if(!empty($data['time'])){
			$whereSql = "WHERE `statistics_hour` <= '{$data['time']['hour']}' AND `statistics_day` = '{$data['time']['day']}' AND `statistics_month` = '{$data['time']['month']}' AND `statistics_year` = '{$data['time']['year']}' ";
		}
		$sql = "SELECT * FROM `common_member_statistics` {$whereSql} ORDER BY `statistics_hour` ASC , `statistics_day` ASC, `statistics_month` ASC, `statistics_year` ASC";
		$return = $this->query($sql);
		return $return;
	}
	/**
	 * 取得所有總計
	 */
	public function getMemberStatisticsTotal($data){
		if(!empty($data['time'])){
			$whereSql = "WHERE `statistics_day` = '{$data['time']['day']}' AND `statistics_month` = '{$data['time']['month']}' AND `statistics_year` = '{$data['time']['year']}' ";
		}
		$sql = "SELECT * FROM `common_member_statistics` {$whereSql} ORDER BY `statistics_hour` ASC , `statistics_day` ASC, `statistics_month` ASC, `statistics_year` ASC";
		$return = $this->query($sql);
		return $return;
	}
	/**
	 * 紀錄上線人數
	 */
	public function upStatisticsData($data){
		$sql = "INSERT INTO `{$this->tableName}`";
		$insKey = "";
		$insVal = "";
		$dupSql = "";
		foreach ($data as $key => $value) {
			if(empty($insKey)){
				$insKey = "(`{$key}`";
			} else {
				$insKey .= ",`{$key}`";
			}
			if(empty($insVal)){
				$insVal = "('{$value}'";
			} else {
				$insVal .= ",'{$value}'";
			}
			if(empty($dupSql)){
				$dupSql = "`{$key}`='{$value}'";
			} else {
				$dupSql .= ",`{$key}`='{$value}'";
			}
		}
		$sql .= "{$insKey}) VALUES {$insVal}) ON DUPLICATE KEY UPDATE {$dupSql}";

		$return = $this->query($sql);
		return $return;
	}

	/*
	 * 取得統計資料
	 */
	public function getStatisticsDataByHour($data){
	    $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `statistics_year` = '{$data['statistics_year']}'
                AND `statistics_month` = '{$data['statistics_month']}'
                AND `statistics_day` = '{$data['statistics_day']}'
                AND (`statistics_hour` = '{$data['statistics_hour1']}' OR `statistics_hour` = '{$data['statistics_hour2']}')
                ORDER BY `statistics_hour` ASC";
	    $return = $this->query($sql);
	    return $return;
	}
}