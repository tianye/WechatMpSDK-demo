<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class MaterialController extends CommonController {
    
    //获取永久素材列表
    public function batchget()
    {
    	$WxApi = Api::factory('Material');

 		//$type 获取素材类型, $offset 偏移 ,$count 数量 不能大于20	
 		
		$ret = $WxApi->batchget($type='image', 0, 20);
		
		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
		echo '<pre>';
       	var_dump($ret);
    }

    //新增永久图文素材
    public function addNews()
	{
		$WxApi = Api::factory('Material');

		$data = array();
		$data[0]['title'] = '标题';
		$data[0]['thumb_media_id'] = 'b8lv6hmgqH9wcTS9VZ8wVPwjFlPXsLlgld8wUNd5uV8'; //图文消息的封面图片素材id（必须是永久mediaID）
		$data[0]['author'] = '作者';
		$data[0]['digest'] = '图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空';
		$data[0]['show_cover_pic'] = '1'; //是否显示封面，0为false，即不显示，1为true，即显示
		$data[0]['content'] = '<p>图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS</p>';
		$data[0]['content_source_url'] = 'http://www.baidu.com';
		
		$ret = $WxApi->addNews($data);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//新增其他永久素材 服务端 失效
    public function add()
	{
		$WxApi = Api::factory('Material');

		$file = 'Uploads/test.png';
		$type = 'image';

		//新增永久视频素材附加字段 (其他素材 此字段无效)
		$info = array('title' => '视频素材的标题', 'introduction' => '视频素材的描述');

		$ret = $WxApi->add($file, $type, $info);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
		echo '<pre>';
       	var_dump($ret);
	}


	//获取永久素材
	public function get()
	{
		$WxApi = Api::factory('Material');

		$media_id = 'ma2Rg8kmqPkObTlWWfxTX-mmAVOw0V51wBxTalWcmKg';

		$ret = $WxApi->get($media_id);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
		echo '<pre>';
       	var_dump($ret);
	}

	//删除永久素材
	public function del()
	{
		$WxApi = Api::factory('Material');

		$media_id = 'ma2Rg8kmqPkObTlWWfxTX-mmAVOw0V51wBxTalWcmKg';

		$ret = $WxApi->del($media_id);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//修改永久图文素材
	public function updateNews()
	{
		$WxApi = Api::factory('Material');

		$media_id = 'ma2Rg8kmqPkObTlWWfxTX9j_-BxI0tdyPrAhPMDDCAc';

		$articles = array();
		$articles['title'] = '标题-修改';
		$articles['thumb_media_id'] = 'b8lv6hmgqH9wcTS9VZ8wVPwjFlPXsLlgld8wUNd5uV8'; //图文消息的封面图片素材id（必须是永久mediaID）
		$articles['author'] = '作者';
		$articles['digest'] = '图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空';
		$articles['show_cover_pic'] = '1'; //是否显示封面，0为false，即不显示，1为true，即显示
		$articles['content'] = '<p>图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS</p>';
		$articles['content_source_url'] = 'http://www.baidu.com';

		$index = 0;

		$ret = $WxApi->updateNews($media_id, $articles, $index);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//获取素材总数
	public function getCount()
	{
		$WxApi = Api::factory('Material');
		$ret = $WxApi->getCount();

		if (!$ret) {
			$ret =$WxApi->getError();
		}

		//voice_count	语音总数量
		//video_count	视频总数量
		//image_count	图片总数量
		//news_count	图文总数量
		
		echo "<pre>";
		var_dump($ret);
	}

}
