<?php

// 將此目錄除了common.php以外所有PHP檔案資料載入
$_lang_files = scandir(LANG_PATH . LANG_SET);
$_require_lang = array();
foreach ($_lang_files as $_lang_file) {
	if (strpos($_lang_file, ".php") && $_lang_file != "common.php") {
		$_require_lang[] = include LANG_PATH . LANG_SET . '/' . $_lang_file;
	}
}

// 組成語系陣列後返回
$_return_lang_arr = array();
foreach ($_require_lang as $_k => $_require_lang_data) {
	foreach ($_require_lang_data as $_key => $_value) {
		$_return_lang_arr[$_key] = $_value;
	}
}
unset($_require_lang);
return $_return_lang_arr;


