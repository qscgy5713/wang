<?php
/**
 * 簡訊預設
 */
class NewsletterPresetAction extends AdminAction
{
	protected $NewsletterPreset = 5; // 分頁筆數
	protected $pageMoreNumber = 10; // 一頁最多幾筆
	//首頁
	public function index()
	{
		$request = $this->getRequest();

		//分頁製作
		if(empty($request['pageNumber'])){
			$pageNumber = 1;
		} else {
			$pageNumber = $request['pageNumber'];
		}

		$KotsmsMain = D('KotsmsMain');
		$return = $KotsmsMain->getKotsmsMainNumData();
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}
		$totalNumber = $return['totalNumber']; //總筆數
		$totalPage = ceil($totalNumber / $this->NewsletterPreset); //分頁筆數
		$pageArray = getPageArray($pageNumber, $totalPage, $this->pageMoreNumber); //分頁陣列

		$data = array(
			'page' =>array(
				'number' => $this->NewsletterPreset,
				'pageNumber' => $pageNumber,
			)
		);
		$return = $KotsmsMain->getKotsmsMainPageData($data);
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
		}
		$showStr = "";
		$FiedlChange = array(
			'main_code' => 'mainCode',
			'main_text' => 'mainText',
		);
		$showArray = array();
		foreach ($return as $key => $value) {
			foreach ($FiedlChange as $key1 => $value1) {
				switch ($key1) {
					default:
						$showStr = $value[$key1];
						break;
				}
				$showArray[$key][$value1] = $showStr;
			}
		}

		// var_dump($showArray);die;
		$this->assign('showArray', $showArray);
		$this->assign('pageNumber', $pageNumber); //目前分頁
		$this->assign('totalPage', $totalPage); //總頁數
		$this->assign('pageArray', $pageArray); //分頁陣列
		$this->display();
	}
	//新增預設簡訊
	public function addFormNewsletterData(){
		$request = $this->getRequest();
		if(empty($request['addMainCode']) && $data['addMainCode'] != 0){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //未填入簡訊碼
		}
		if(empty($request['addMainCode']) && $data['addMainText'] != 0){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'))); //未填入簡訊內容
		}
		$data = array(
			'main_code' =>$request['addMainCode'],
			'main_text' =>$request['addMainText']
		);

		$KotsmsMain = D('KotsmsMain');
		$return = $KotsmsMain->addKotsmsMainData($data);
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03'))); //新增失敗
		}
			$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //新增成功
	}
	//修改簡訊預設
	public function setFormNewsletterData(){
		$request = $this->getRequest();
		if(empty($request['setMainCode']) && $data['setMainCode'] != 0){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //未填入簡訊碼
		}
		if(empty($request['setMainText']) && $data['setMainText'] != 0){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'))); //未填入簡訊內容
		}

		$data = array(
			'main_code' =>$request['setMainCode'],
			'main_text' =>$request['setMainText']
		);
		$KotsmsMain = D('KotsmsMain');
		$return = $KotsmsMain->setKotsmsMainData($data);
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03'))); //新增失敗
		}
			$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //新增成功
	}
	//刪除簡訊預設
	public function delFormNewsletterData(){
		$request = $this->getRequest();
		if(empty($request['delMainCode']) && $data['delMainCode'] != 0){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //未填入簡訊碼
		}
		$data = array(
			'main_code' =>$request['delMainCode'],
		);

		$KotsmsMain = D('KotsmsMain');
		$return = $KotsmsMain->delKotsmsMainData($data);

		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'))); //新增失敗
		}
			$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); //新增成功
	}
}