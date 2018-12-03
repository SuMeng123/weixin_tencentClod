<?php
namespace app\weixin\controller;
 
use think\Controller;
 
class Weather extends Controller
{
    public function index()
    {
        $array['tem'] = '31';
        $this->assign($array);
    	return $this->fetch();
    }
}
