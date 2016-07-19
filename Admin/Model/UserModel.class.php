<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
	public function isValidUser($username,$password){
		return true;
	}
}