<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class MediaController extends CommonController {
    
    //上传临时媒体文件.
    public function upload()
	{
		$WxApi = Api::factory('Media');

		$file = 'Uploads/test.png';
		$type = 'image';

		$ret = $WxApi->upload($file, $type);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//根据mediaID获取媒体文件
    public function get()
	{
		$WxApi = Api::factory('Media');

		$media_id = 'zF-KBSQvLhAQJKiLp0_3d1mlN8VouFrDcJluQKadvOU_yrUwd77RT7n-wqFaWi0T';

		$ret = $WxApi->get($media_id);

		if (!$ret) {
			$ret =$WxApi->getError();
		}

		$type = str_replace("/", ".", $ret['type']);
		//var_dump($ret);
		// var_dump($ret['type']);
		// var_dump($ret['size']);
		header('Content-type: '.$ret['type']);
		header("Content-Disposition:attachment;filename=".$type); 
        echo $ret['content'];
	}

	//上传图文消息内的图片.
	public function uploadimg()
	{
		$WxApi = Api::factory('Media');

		$file = 'Uploads/test.png';

		$ret = $WxApi->uploadimg($file);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//上传图文消息内的视频.
	public function uploadvideo()
	{
		$WxApi = Api::factory('Media');

		$media_id    = 'rF4UdIMfYK3efUfyoddYRMU50zMiRmmt_l0kszupYh_SzrcW5Gaheq05p_lHuOTQ';
		$title       = '标题';
		$description = '描述';

		$ret = $WxApi->uploadvideo($media_id, $title, $description);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//上传图文消息素材【订阅号与服务号认证后均可用】
	public function uploadnews()
	{
		$articles = array(
			array(
				'thumb_media_id' => 'YExxzVuWVEeYwGSsQd2p9k4uA-RRmvKBpQVZcEZYGK3Urb_8xCnerM8vT-haWevH',
				'author'		 => '图文消息的作者',
				'title'			 => '图文消息的标题',
				'content_source_url'	=>	'www.qq.com',
				'content'		=>	'<p>图文消息页面的内容，支持HTML标签。</p> <a href="http://www.baidu.com">具备微信支付权限的公众号，可以使用a标签</a>',
				'digest'		=>	'图文消息的描述',
				'show_cover_pic'	=>	'1'
			),
			array(
				'thumb_media_id' => 'YExxzVuWVEeYwGSsQd2p9k4uA-RRmvKBpQVZcEZYGK3Urb_8xCnerM8vT-haWevH',
				'author'		 => '图文消息的作者',
				'title'			 => '图文消息的标题',
				'content_source_url'	=>	'www.qq.com',
				'content'		=>	'<p>图文消息页面的内容，支持HTML标签。</p> <a href="http://www.baidu.com">具备微信支付权限的公众号，可以使用a标签</a>',
				'digest'		=>	'图文消息的描述',
				'show_cover_pic'	=>	'0'
			)
		);

		$WxApi = Api::factory('Media');

		$ret = $WxApi->uploadnews($articles);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);

	}
}
