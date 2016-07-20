<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
	protected $realTableName = "cms_admin";
	
	public function isValidUser($username,$password){
		$data=null;
		if(empty(trim($username))){
			$msg = "用户名不能为空";
			$status = 1;	
		}else if(empty(trim($password))){
			$msg = "密码不能为空";
			$status = 2;
		}else{
			$username = trim($username);
			$password = trim($password);
			$info = $this->getAdminByUserName($username);
			if($info==null){
				$msg="用户名不正确";
				$status = 3;
			}else{
				if(lock_md5($password)!=$info["password"]){
					$msg="密码不正确";
					$status=4;
				}else{
					$msg="登录成功";
					$status=0;
					$data=$info;
				}
			}
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 通过用户名获取个人中心信息
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function getAdminByUserName($username){
		$condition["username"]=$username;
		return $this->where($condition)->find();
	}

	/**
	 * 通过用户ID获取用户真实姓名
	 * @param  [type] $userId [description]
	 * @return [type]         [description]
	 */
	public function getRealNameByUserId($userId){
		$condition["admin_id"]=$userId;
		if(FALSE !== ($realname = $this->where($condition)->getField("realname"))){
			return $realname;
		}else{
			return $this->getError();
		}
	}
}