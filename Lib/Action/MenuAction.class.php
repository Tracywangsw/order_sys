<?php
Class MenuAction extends Action{
	Public function page($kind){
		$menu = M("order_sys.menu",null);
		//$list = $menu->limit('12')->select();
		//$this->assign('list',$list);
		//获取总页数
		if($kind == "all"){
			$count = $menu->count();
		}
		else{
			$count = $menu->where("kind = '" . $kind . "'")->count();
		}
		$page = intval(intval($count)/12)+1;
		$this->assign('page',$page);
		//获取当前页面
		$cur_page=intval($this->_get("p"));
		if(!$cur_page){
			$cur_page = 1;
		}
		if($cur_page > $page || $cur_page < 1){
			$this->redirect("all"); //返回上一页
		}
		if($page == 1){
			$pre_page = $next_page =1;
		}
		else{
			if($cur_page != $page && $cur_page != 1){
				$pre_page = $cur_page-1;
				$next_page = $cur_page+1;
			}
			else if($cur_page == 1){
				$pre_page=$cur_page;
				$next_page = $cur_page+1;
			}
			else{
				$pre_page = $cur_page-1;
				$next_page = $cur_page;
			
			}
		}
		$this->assign('pre_page',$pre_page);
		$this->assign('next_page',$next_page);
		$p = ($cur_page-1)*12;
		if($kind == "all"){
			$list = $menu->limit("$p,12")->select();
		}
		else{
			$list = $menu->where("kind = '" . $kind . "'")->limit("$p,12")->select();
		}
		$this->assign('list',$list);
		$this->assign('cur_page',$cur_page);
		$this->display('all');
	}
	Public function all(){
		$this->page("all");
	}
	Public function main(){
		/*$menu = M("order_sys.menu",null);
		$list = $menu->where("kind='main'")->limit('20')->select();
		$this->assign('list',$list);
		$this->display('all');*/
		$this->page("main");
		
	}
	Public function noddle(){
		/*$menu = M("order_sys.menu",null);
		$list = $menu->where("kind='noddle'")->limit('20')->select();
		$this->assign('list',$list);
		$this->display('all');*/
		$this->page("noddle");
	}
	Public function dessert(){
		/*$menu = M("order_sys.menu",null);
		$list = $menu->where("kind='dessert'")->limit('20')->select();
		$this->assign('list',$list);
		$this->display('all');*/
		$this->page("dessert");
	}
	Public function friute(){
		/*$menu = M("order_sys.menu",null);
		$list = $menu->where("kind='friute'")->limit('20')->select();
		$this->assign('list',$list);
		$this->display('all');*/
		$this->page("friute");
	}
	Public function drink(){
		/*$menu = M("order_sys.menu",null);
		$list = $menu->where("kind='drink'")->limit('20')->select();
		$this->assign('list',$list);
		$this->display('all');*/
		$this->page("drink");
	}
	Public function addList(){
		$name = $_POST["name"];
		$desk_id = intval($_POST["desk_id"]);
		$time = date("Y-m-d h:i:s");
		$user = $_COOKIE["username"];
		$bill = M("order_sys.list",null);
		if($name != "" && $desk_id != ""){
			$data["menu"] = $name;
			$data["time"] = $time;
			$data["desk_id"] = $desk_id;
			if($user) $data["user"] = $user;
			if($bill->data($data)->add()){
				echo "订单成功";
			}
			else{
				echo "插入数据库失败";
			}
		}
		else{
			echo "订单失败";
		}
	}
}
?>
