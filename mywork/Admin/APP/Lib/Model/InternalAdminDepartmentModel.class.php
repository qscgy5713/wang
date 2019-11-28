<?php 
/*
 * 後臺頁面分類
 */
class InternalAdminDepartmentModel extends CommonModel{
	protected $tableName = "internal_admin_department";

	/*
	 * 取得後台頁面
	 * 頁面管理 使用
	 */
	public function getAdminSubPagePowerData(){
		$sql = "SELECT * FROM `{$this->tableName}`;";
		$return = $this->query($sql);

		return $return;
	}

	/*
	 * 取得後台頁面
	 * 頁面管理 使用
	 */
	public function getAdminSubPagePowerMainData(){
		$sql = "SELECT power_main FROM `{$this->tableName}`;";
		$return = $this->query($sql);

		return $return;
	}

	/*
	 *新增後台頁面類別
	 */
	public function addAdminSubPagePowerData($data){
		$sql = "INSERT INTO `{$this->tableName}`";
		$keysql = "";
		$valuesql = "";

		foreach ($data as $key => $value){
			if(empty($keysql)){
				$keysql = "(`{$key}`";
			} else {
				$keysql .= ",`{$key}`";
			}
			if(empty($valuesql)){
				$valuesql = "('{$value}'";
			} else {
				$valuesql .= ",'{$value}'";
			}
		}

		$sql .= $keysql . ") VALUES " . $valuesql . ");";
		$return = $this->query($sql);

		return $return;
	}

	/*
	 * 修改 後台頁面 資料
	 * 使用後台頁面ID
	 */
	public function setAdminSubPagePowerData($data){
		if(empty($data['department_id']) && $data['department_id'] !== '0'){
			return false;
		}
		$sql = "";
		foreach ($data as $key => $value) {
			if($key == 'department_id'){continue;}
			if(empty($sql)){
				$sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
			} else {
				$sql .=",`{$key}` = '{$value}'";
			}
		}

		$sql .= "WHERE `department_id` = '{$data['department_id']}'";
		$return = $this->execute($sql);

		return $return;
	}

	/*
	 * 後台頁面 資料
	 * 使用後台頁面ID
	 */
	public function delAdminSubPagePowerData($data){
		if(empty($data['department_id']) && $data['department_id'] !== '0'){
			return false; 
		}

		$sql = "DELETE FROM `{$this->tableName}` WHERE `department_id` = '" . $data['department_id'] . "';";
		$return = $this->execute($sql);

		return $return;
	}
}