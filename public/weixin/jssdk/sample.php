<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxac1a892f14aebd83", "2d221040156ea6f45aac356199972ee6");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<script language="JavaScript" src="/static/jquery-3.3.1/jquery-3.3.1.js"></script>
<html lang="en">
<head>
    <title>Home</title>

    <!-- For-Mobile-Apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //For-Mobile-Apps -->

    <!-- Style --> <link rel="stylesheet" href="/static/moban/css/style.css" type="text/css" media="all" />

    <!-- Web-Fonts -->
    <link href='http://fonts.useso.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.useso.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.useso.com/css?family=Raleway:100,200' rel='stylesheet' type='text/css'>
    <link href='/static/moban/'>
    <!-- //Web-Fonts -->
</head>
<body onload="startTime()">
  	<!-- Heading -->
	<h1>小航天气</h1>
	<!-- //Headng -->



		<!-- Container -->
		<div class="container">

			<!-- City -->
			<div class="city">
				<div class="title">
					<h2><span id="city"></span></h2>
					<h3><span id="district"></span></h3>
				</div>
				<div class="date-time">
					<div class="dmy">
						<div id="txt"></div>
						<div class="date">
							<!-- Date-JavaScript -->
							<script type="text/javascript">
							var mydate=new Date()
							var year=mydate.getYear()
							if(year<1000)
							year+=1900
							var day=mydate.getDay()
							var month=mydate.getMonth()
							var daym=mydate.getDate()
							if(daym<10)
							daym="0"+daym
							var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
							var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
							document.write(""+dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"")
							</script>
							<!-- //Date-JavaScript -->
						</div>
					</div>
					<div class="temperature">
						<p><span id="min"></span><span>°C~</span><span id="max"></span><span>°C</span></p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<!-- //City -->



			<!-- Forecast -->
			<div class="forecast">
				<div class="forecast-icon">
					<!--<img src="/static/moban/images/forecast.png" alt="New York Weather Widget">-->
				</div>
				<div class="today-weather">
					<h3><span id="weather"></span></h3>
					<!--<ul>
						<li>Now <span> 20°C</span></li>
						<li>09:00 <span> 22°C</span></li>
						<li>12:00 <span> 24°C</span></li>
						<li>15:00 <span> 23°C</span></li>
						<li>18:00 <span> 20°C</span></li>
					</ul>-->
				</div>
			</div>
			<!-- //Forecast -->
			<div class="clear"></div>

		</div>
		<!-- //Container -->



	<!-- Footer -->
	<div class="footer">

		<!-- Copyright -->
		<div class="copyright">
			<!--<p>Copyright &copy; 2016.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>-->
		</div>
		<!-- //Copyright -->

	</div>
	<!-- //Footer -->

	<div>
            <span>NAME:</span><input type="text" id="name"/><br /><br/>
            <span>ADDRESS:</span><input type="text" name="address" onblur="change()" />
    </div>

  	<a href="javascript:;" onclick="openLocation()" class="weui_btn weui_btn_primary">调用地图</a>
	<a href="javascript:;" onclick="scanQRCode()" class="weui_btn weui_btn_primary">微信扫一扫</a>
</body>
		<script>
			function startTime() {
				var today = new Date();
				var h = today.getHours();
				var m = today.getMinutes();
				var s = today.getSeconds();
				m = checkTime(m);
				s = checkTime(s);
				document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s;
				var t = setTimeout(startTime, 500);
				}
				function checkTime(i) {
				if (i < 10) {i = "0" + i}; // add zero in front of numbers < 10
				return i;
			}
		</script>
		<!-- //Time-JavaScript -->

	<!-- //Custom-JavaScript-File-Links -->
		<script type="text/javascript">
            function change(item) {
                var txt1 = $("#name").val();
                var txt2 = $("input[name=address]").val();
                $.ajax({
                    type: 'post',
                    url: 'http://154.8.162.46/index.php/weixin/Ajax/read',
                    data: {name: txt1, address: txt2},
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                        } else {
                            alert(data.msg);
                          	
                        }
                    },
                    error: function () {
                        alert("程序异常");
                    }
                });
            }
        </script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
    	    'getLocation',
            'openLocation',
      		'scanQRCode',
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
      wx.getLocation({
        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
        success: function (res) {
          latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
          longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
          var speed = res.speed; // 速度，以米/每秒计
          var accuracy = res.accuracy; // 位置精度
          //alert("latitude:" + latitude + "longitude:" + longitude);
          $.ajax({
                    type: 'post',
                    url: 'http://154.8.162.46/index.php/weixin/Ajax/read',
                    data: {latitude: latitude, longitude: longitude},
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                        } else {
                            $("#city").text(data.city);
                            $("#district").text(data.district);
                            $("#min").text(data.min);
                            $("#max").text(data.max);
                            $("#weather").text(data.weather);
                        }
                    },
                    error: function () {
                        alert("程序异常");
                    }
                });
        }
      });
    
  });
  function openLocation() {
        wx.ready(function () {
            wx.openLocation({
                latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
                longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
                name: '', // 位置名
                address: '', // 地址详情说明
                scale: 15, // 地图缩放级别,整形值,范围从1~28。默认为最大
                infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
            });
        });
    }
      
      
  function scanQRCode() {
    wx.ready(function () {
      wx.scanQRCode({
        needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
          var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
        }
      });
    });
  }
</script>
</html>
