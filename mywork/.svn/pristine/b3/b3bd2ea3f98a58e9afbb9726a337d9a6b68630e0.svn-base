<?php
/**
 * kotsms_main
 */
class KotsmsMainModel extends AdminModel
{
	protected $tableName = "kotsms_main";
	/**
	 * 取得總筆數
	 */
	public function getKotsmsMainNumData($data)
	{
		$sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}`";
		$return = $this->query($sql);
		return $return[0];
	}
	/**
	 * 取得分頁資料
	 */
	public function getKotsmsMainPageData($data){
		$startSql = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
		$endSql = $data['page']['number'];
		$pageSql = "LIMIT {$startSql}, {$endSql}";
		$sql = "SELECT * FROM `{$this->tableName}` {$pageSql}";
		$return = $this->query($sql);
		return $return;
	}
	/**
	 * 新增簡訊預設
	 */
	public function addKotsmsMainData($data){
		$keySql = "";
		$valSql = "";
		$sql = "INSERT INTO `{$this->tableName}`";
		foreach ($data as $key => $value) {
			if(empty($keySql)){
				$keySql = "(`{$key}`";
			} else {
				$keySql .= ",`{$key}`";
			}
			if(empty($valSql)){
				$valSql = "('{$value}'";
			} else {
				$valSql .= ",'{$value}'";
			}
		}
		$sql .= "{$keySql}) VALUES {$valSql})";
		$return = $this->query($sql);
		return $return;
	}
	/**
	 * 修改簡訊
	 */
	public function setKotsmsMainData($data){
		if(empty($data['main_code']) && $data['main_code'] != '0'){
			return false;
		}
		$sql = "";
		foreach ($data as $key => $value) {
			if($key == 'main_code'){continue;}
			if(empty($sql)){
				$sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
			} else {
				$sql .= ",`{$key}` = '{$value}'";
			}
		}
		$sql .= "WHERE `main_code` = '{$data['main_code']}'";
		$return = $this->query($sql);
		return $return;
	}
	/**
	 * 刪除簡訊
	 */
	public function delKotsmsMainData($data){
		if(empty($data['main_code']) && $data['main_code'] != '0'){
			return false;
		}
		$sql = "DELETE FROM `{$this->tableName}` WHERE `main_code` = '{$data['main_code']}'";
		$return = $this->query($sql);
		return $return;
	}
}