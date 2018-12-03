<?php
namespace app\weixin\controller;

use think\Controller;

class Ajax extends Controller
{
    public function read()
    {
        if(!empty($_POST['name'])){
            $value = array("status"=>"1","msg"=>"保存成功");
            echo json_encode($value);
        }
        else {
            $value = array("status"=>"0","msg"=>"保存失败");
            echo json_encode($value);
        }
    }
}