<?php
class AdminSubPagePowerAction extends AdminAction{
	//TODO: 公私部門管理 首頁
	public function index(){
		$request = $this->getRequest();
		//讀取 頁面資料
		$InternalAdminDepartment = D("InternalAdminDepartment");

		//InternalAdminDepartment getAdminSubPagePowerData取得頁面類別資料
		$return = $InternalAdminDepartment->getAdminSubPagePowerData();
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}



		$showArray = array();
		$showPageArray = $this->getPageArray($request);//取得頁面資訊

	    // var_dump($showPageArray);

		if($showPageArray === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//使用欄位轉換 資料庫欄位
		$FieldChange = array(
			'department_id' => 'id',
			'department_name' => 'name',
			'power_main' => 'powerMain',
		);

		$showStr= "";
		$showEnable= "";
		foreach ($return as $key => $value) {
			foreach ($FieldChange as $key1 => $value1) {
                 $showStr = $value[$key1];
                 //欄位特別處理
                switch ($key1){
                    case 'power_main': //權限
                        // var_dump($value[$key1]);die;
                        $powerArray = explode(",",$value[$key1]);
                        foreach($showPageArray as $classKey => $classValue){
                            foreach($classValue as $pageKey => $pageValue){
                                $showEnable['power'] = 0;
                                if (in_array($pageValue['id'], $powerArray)) {
									$showEnable = $pageValue;
                                    $showEnable['power'] = 1;
									$showStrArray[$classKey][$pageKey] = $showEnable;
                                }
                            }
                        }
                        break;

                    default: //未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                if($key1 == 'power_main'){
                    $showArray[$key][$value1] = $showStrArray;
                } else {
                    $showArray[$key][$value1] = $showStr;
                }
                $showStrArray="";
			}
		}
		$this->assign("showArray", $showArray);
		$this->assign("showPageArray", $showPageArray);
		$this->assign("pagePowerEmpty", "<tr><td colspan='4' align='center'>無權限資料</td></tr>");
		$this->display();

	}

	//TODO: 新增後台頁面類別
	public function formAddAdminSubPagePower(){
		//使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
		$request = $this->getRequest();

		//檢查是否有 addShowName 傳入 並且不為空
		if(!isset($request['addShowName']) || empty($request['addShowName'])){
			//類別顯示名稱為空，請重新輸入
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//讀取 頁面資料
		$InternalAdminDepartment = D("InternalAdminDepartment");
		$strPower = "";

		$strPower = implode(',' , $request['addPowerMain']);

		$data = array(
			"department_name" => $request['addShowName'],
			"power_main" => $strPower,
		);

		$return = $InternalAdminDepartment->addAdminSubPagePowerData($data);

		if($return === false){
			//否，顯示錯誤
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
		}

		//是，顯示成功訊息
		$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
	}

	//TODO: 修改後台頁面類別
	public function formSetAdminSubPagePower(){

		//使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
		$request = $this->getRequest();

		//檢查是否有 setId 傳入 並且不為空
		if(!isset($request['setId']) || empty($request['setId'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		if(!isset($request['setShowName']) || empty($request['setShowName'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//讀取 頁面資料
		$InternalAdminDepartment = D("InternalAdminDepartment");

		$strPower = "";

		$strPower = implode(',' , $request['setPowerMain']);

		$data = array(
			"department_id" => $request['setId'],
			"department_name" => $request['setShowName'],
			'power_main' => $strPower,
		);

		$return = $InternalAdminDepartment->setAdminSubPagePowerData($data);

		//否，顯示錯誤
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
		}

		//是，引響筆數為1，顯示成功訊息
		if($return === 1){
			$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
			return;
		}
		//操作錯誤，請重新登入。
		$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
	}

	//TODO: 刪除後台頁面
	public function formDelAdminSubPagePower(){
		//使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
		$request = $this->getRequest();

		//檢查是否有 delId 傳入 並且不為空
		if(!isset($request['delId']) || empty($request['delId']) && $request['delId'] !== 0){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		$InternalAdminDepartment = D('InternalAdminDepartment');

		$data = array(
			"department_id" => $request['delId'],
		);

		$return = $InternalAdminDepartment->delAdminSubPagePowerData($data);

		//否，顯示錯誤
		if($return === false){
			$this->error(L(strtoupper('ERROE_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
		}

		//是，影響比數為1，顯示成功訊息
		if($return === 1){
			$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//操作錯誤，請重新登入。
		$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
	}
}