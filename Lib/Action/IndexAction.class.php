<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function insert(){
    	header("Content-Type:text/html; charset=utf-8");
		$this->redirect("Menu/all");
    }
}
