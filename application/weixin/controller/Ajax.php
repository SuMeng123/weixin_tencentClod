<?php
namespace app\weixin\controller;

use think\Controller;

class Ajax extends Controller
{
    public function read(){
        if(!empty($_POST['name'])){
            $value = array("status"=>"1","msg"=>"保存成功");
            echo json_encode($value);
        }
      	elseif(!empty($_POST['latitude'])){
          	$latitude=$_POST['latitude'];
            $longitude=$_POST['longitude'];
          	$data = $this->location($latitude,$longitude);
          	$contentStr = "  省/直辖市：".$data->result->addressComponent->province."  城市：".$data->result->addressComponent->city."  区/县：".$data->result->addressComponent->district;
          	$city=$data->result->addressComponent->city;
          	$district=$data->result->addressComponent->district;
          	$city1=str_replace("市","",$city);
          	// 从数据库查找城市的天气信息
          	$good=db('crawler')->where('city', $city1)->find();
          	if(!empty($good)){
            	$weather=$good['weather'];
              	$wind=$good['wind'];
          		$max=$good['max'];
            	$min=$good['min'];
            }
          	
            //$value = array("status"=>"1","msg"=>"保存成功,经度：$latitude 纬度：$longitude ,城市详细信息 $contentStr, 城市：$city1 ,hgf $weather ,df $max,ddf $wind,dfff $min");
          	$value = array("status"=>"1","city"=>"$city","weather"=>"$weather","wind"=>"$wind","max"=>"$max","min"=>"$min","district"=>$district);   
            echo json_encode($value);
        }
        else {
            $value = array("status"=>"0","msg"=>"保存失败");
            echo json_encode($value);
        }
    }
  
    private function location($latitude,$longitude){
        if(!empty($latitude)){
            //$json=file_get_contents("http://api.map.baidu.com/geocoder/v2/?location=39,116&output=json&pois=1&ak=gYVBs0QRmbLV74WDBHjq0zbukkC0K6AC");
            $json=file_get_contents("http://api.map.baidu.com/geocoder/v2/?location=".$latitude.",".$longitude."&output=json&pois=1&ak=gYVBs0QRmbLV74WDBHjq0zbukkC0K6AC");
            return json_decode($json);
        } else {
          return null;
        }
    }
}