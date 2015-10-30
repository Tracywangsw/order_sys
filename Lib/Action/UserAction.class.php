<?php
Class UserAction extends Action{
	Public function register(){
		$user = M("order_sys.user",null);
		if($_POST["pwd"] != "" && $_POST["username"] != ""){
			$same = $user->where("username = '" . $_POST["username"] . "'")->select();
			if(!$same){
				$data['username'] = $_POST["username"];
				$data['pwd'] = md5($_POST["pwd"]);
				$data['email'] = $_POST["email"];
				//$data["reg_time"] = time();
				if($user->data($data)->add()){
					$reg_note = "注册成功";
				}
				else{
					$reg_note = "插入数据库失败";
				}
			}
			else{
				$reg_note = "此用户名已被注册，换一个吧～";
			}
		}
		$this->assign("reg_note",$reg_note);
		$this->display('register');
	}
	Public function login(){
		$user = M("order_sys.user",null);
		$username = $_POST["username"];
		$pwd = md5($_POST["pwd"]);
		if($pwd != "" && $username != ""){
			$result = $user->where("username = '" . $username . "' AND pwd = '" . $pwd . "'")->select();
			if($result){
				setcookie("username","$username",time()+3600*12,WEB_PATH);
				redirect(WEB_PATH . "/Menu/all");
			}
			else{
				$login_error = "登录失败,用户名密码错误～";
			}
		}
		$this->assign("login_error",$login_error);
		$this->display('login');
	}
	Public function mylist(){
		$username = $_COOKIE["username"];
		if(!$username){
			redirect(WEB_PATH . "/Menu/all");
		}
		$list = M("order_sys.list",null);
		$menuList = $list->where("user = '" . $username . "'")->order('time desc')->select();
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		$sum_count = $sum_price = 0;
		foreach($menuList AS $menu){
			$sum_count += $menu["amount"];
			$sum_price += $menu["price"];
		}
		$this->assign("sum_count",$sum_count);
		$this->assign("sum_price",$sum_price);
		$this->assign("p",$p);
		$this->display('mylist');
	}
	Public function todaylist(){
		$username = $_COOKIE["username"];
		if(!$username){
			redirect(WEB_PATH . "/Menu/all");
		}
		$list = M("order_sys.list",null);
		//if($_POST["time"]){
		$t = mktime(0,0,0,date("m"),date("d"),date("Y"));
		$today = date("Y-m-d",$t);
			$menuList = $list->where("user = '" . $username . "' AND time = '" . $today . "'")->select();
		//}
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		$sum_count = $sum_price = 0;
		foreach($menuList AS $menu){
			$sum_count += $menu["amount"];
			$sum_price += $menu["price"];
		}
		$this->assign("sum_count",$sum_count);
		$this->assign("sum_price",$sum_price);
		$this->assign("p",$p);
		$this->display('mylist');
	}
	Public function quit(){
		setcookie("username","",time()-3600,WEB_PATH);
		redirect(WEB_PATH . "/Menu/all");
	}
	Public function back(){
		$id = intval($_POST["id"]);
		$list = M("order_sys.list",null);
		$result = $list->where("id = $id")->select();
		if($result->state != "not ready"){
			$list->where("id = $id")->delete();
			echo "退订成功";
		}
		else{
			echo "只能退订未作订单";
		}
	}
	
	
	Public function mangelist(){
		$username = $_COOKIE["username"];
		if(!$username || $username != "admin"){
			redirect(WEB_PATH . "/Menu/all");
		}
		$list = M("order_sys.list",null);
		$t = mktime(0,0,0,date("m"),date("d"),date("Y"));
		$today = date("Y-m-d",$t);
		$menuList = $list->where("time = '" . $today . "'")->select();
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		$sum_count = $sum_price = 0;
		foreach($menuList AS $menu){
			$sum_count += $menu["amount"];
			$sum_price += $menu["price"];
		}
		$this->assign("sum_count",$sum_count);
		$this->assign("sum_price",$sum_price);
		$this->assign("p",$p);
		$this->display('mangelist');
	}
	Public function totalist(){
		$username = $_COOKIE["username"];
		if(!$username || $username != "admin"){
			redirect(WEB_PATH . "/Menu/all");
		}
		$list = M("order_sys.list",null);
		$menuList = $list->select();
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		$sum_count = $sum_price = 0;
		foreach($menuList AS $menu){
			$sum_count += $menu["amount"];
			$sum_price += $menu["price"];
		}
		$this->assign("sum_count",$sum_count);
		$this->assign("sum_price",$sum_price);
		$this->assign("p",$p);
		$this->display('mangelist');
	}
	Public function selectlist(){
		$r = 1;
		$this->assign("r",$r);
		$this->display('mangelist');
	}
	Public function selecthandler(){
		$desk_id = $_POST["desk_id"];
		$state = $_POST["state"];
		if($_POST["menu"] == "请输入菜名"){
			$menu == "";
		}
		else{
			$menu = $_POST["menu"];
		}
		if($desk_id && $menu && $state){
			$select_str = "desk_id = " . $desk_id . " AND menu ='" . $menu . "' AND state ='" . $state ."'";
		}
		else if(!$desk_id && $menu && $state){
			$select_str = "menu ='" . $menu . "' AND state ='" . $state ."'";
		}
		else if($desk_id && !$menu && $state){
			$select_str = "desk_id = " . $desk_id . " AND state ='" . $state ."'";
		}
		else if($desk_id && $menu && !$state){
			$select_str = "desk_id = " . $desk_id . " AND menu ='" . $menu . "'";
		}
		else if(!$desk_id && !$menu && $state){
			$select_str = "state ='" . $state ."'";
		}
		else if(!$desk_id && $menu && !$state){
			$select_str = "menu ='" . $menu . "'";
		}
		else if($desk_id && !$menu && !$state){
			$select_str = "desk_id = " . $desk_id;
		}
		$list = M("order_sys.list",null);
		$menuList = $list->where($select_str)->select();
		if($menuList){
			$p = "1";
			$this->assign("menuList",$menuList);
		}
		else $p = "2";
		$r = 1;
		$this->assign("r",$r);
		$this->assign("p",$p);
		$this->display('mangelist');
	}
	Public function changestate(){
		$change_state = $_POST["change_state"];
		$changeList = $_POST["changeList"];
		$list = M("order_sys.list",null);
		foreach($changeList AS $id){
			$data["state"] = $change_state;
			$result = $list->where("id = " . $id)->save($data);
		}
		if($result){
			echo "修改成功";
		}
	}
}
?>
