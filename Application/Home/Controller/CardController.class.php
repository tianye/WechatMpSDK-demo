<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;

class CardController extends CommonController {

	//上传卡券Logo
	public function cardUploadimg()
	{
		$WxApi = Api::factory('Media');

		$file = 'Uploads/test.png';

		$ret = $WxApi->cardUploadimg($file);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//获取卡券颜色
    public function getcolors()
	{
		$WxApi = Api::factory('Card');

		$ret = $WxApi->getcolors();

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//创建卡券
	/**
	 *code_type
	 *二维码/一维码显示code	CODE_TYPE_QRCODE/CODE_TYPE_BARCODE	适用于扫码/输码核销
	 *二维码不显示code	CODE_TYPE_ONLY_QRCODE	仅适用于扫码核销
	 *仅code类型	CODE_TYPE_TEXT	仅适用于输码核销
	 *无code类型	CODE_TYPE_NONE	仅适用于线上核销，开发者须自定义跳转链接跳转至H5页面，允许用户核销掉卡券，自定义cell的名称可以命名为“立即使用”。若开发者发现更新版本后出现两个使用按钮可以更新为这种code类型。
	*/
	public function create()
	{
		$type = 'groupon';
		
		$base_info = array();
		$base_info['logo_url']      = 'http://mmbiz.qpic.cn/mmbiz/2aJY6aCPatSeibYAyy7yct9zJXL9WsNVL4JdkTbBr184gNWS6nibcA75Hia9CqxicsqjYiaw2xuxYZiaibkmORS2oovdg/0';
       	$base_info['brand_name']    = '造梦空间';
        $base_info['code_type']     = 'CODE_TYPE_QRCODE';
        $base_info['title']         = '标题';
        $base_info['sub_title']     = '副标题';
        $base_info['color']         = 'Color010';
        $base_info['notice']        = '使用时请出示此券';
        $base_info['service_phone'] = '15311931577';
        $base_info['description']   = "不可与其他优惠同享\n如需团购券发票，请在消费时向商户提出\n店内均可使用，仅限堂食";
        
        $base_info['date_info']  = array();
        $base_info['date_info']['type'] = 'DATE_TYPE_FIX_TERM';
		$base_info['date_info']['fixed_term'] = 90; //表示自领取后多少天内有效，不支持填写0
        $base_info['date_info']['fixed_begin_term'] = 0; //表示自领取后多少天开始生效，领取后当天生效填写0。

        $base_info['sku'] = array();
        $base_info['sku']['quantity'] = '500000';

        $base_info['get_limit'] = 1;
       	$base_info['use_custom_code'] = false;
       	$base_info['bind_openid'] = false;
       	$base_info['can_share'] = true;
       	$base_info['can_give_friend'] = false;
       	$base_info['center_title'] = '顶部居中按钮';
       	$base_info['center_sub_title'] = '按钮下方的wording';
       	$base_info['center_url'] = 'http://www.qq.com';
      	$base_info['custom_url_name'] = '立即使用';
    	$base_info['custom_url'] = 'http://www.qq.com';
    	$base_info['custom_url_sub_title'] = '6个汉字tips';
    	$base_info['promotion_url_name'] = '更多优惠';
    	$base_info['promotion_url'] = 'http://www.qq.com';
    	$base_info['source'] = '造梦空间';

    	$especial = array();
    	$especial['deal_detail'] = "deal_detail";

    	$WxApi = Api::factory('Card');

		$ret = $WxApi->create($type, $base_info, $especial);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);

	}

	//创建二维码
	public function qrcode()
	{
		//领取单张卡券 
		$card = array();
		$card['action_name'] = 'QR_CARD';
		$card['expire_seconds'] = 1800;
		$card['action_info']['card']['card_id'] = 'pdkJ9uPc_5nsLrGRd91yeEVGBbK8';
		$card['action_info']['card']['is_unique_code'] = false;
		$card['action_info']['card']['outer_id'] = 1;

		//领取多张卡券
		$card_list = array();
		$card_list['action_name'] = 'QR_MULTIPLE_CARD';
		$card_list['action_info']['multiple_card']['card_list'] = array(
			array('card_id' => 'pdkJ9uM-cVqICfSEiuQxeW5vt_i4'),
			array('card_id' => 'pdkJ9uItT7iUpBp4GjZp8Cae0Vig'),
			array('card_id' => 'pdkJ9uFiwIfiNod7J6zqTI3zbiyU')
		);

		$WxApi = Api::factory('Card');

		$ret = $WxApi->qrcode($card_list);

		if (!$ret) {
			$ret =$WxApi->getError();
		}
		
       	var_dump($ret);

	}

	//ticket 换取二维码图片
	public function showqrcode()
	{
		$WxApi = Api::factory('Card');

		$ticket = 'gQGg8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL25VUEFYLS1sUi1vX1phcDVxV1N5AAIEFsJ3VgMEgDPhAQ==';

		$ret = $WxApi->showqrcode($ticket);

        if (!$ret) {
			$ret = $WxApi->getError();
		}

        //var_dump($ret['type']);
		//var_dump($ret['size']);
		header('Content-type: '.$ret['type']);
        echo $ret['content'];
	}

	//js-sdk 调用添加卡券接口 数组
	//http://mp.weixin.qq.com/wiki/5/f942979ef2f0d313d4d36e3a26766a3d.html
	//http://mp.weixin.qq.com/wiki/11/74ad127cc054f6b80759c40f77ec03db.html#.E6.89.B9.E9.87.8F.E6.B7.BB.E5.8A.A0.E5.8D.A1.E5.88.B8.E6.8E.A5.E5.8F.A3
	//http://mp.weixin.qq.com/wiki/11/74ad127cc054f6b80759c40f77ec03db.html#.E9.99.84.E5.BD.954-.E5.8D.A1.E5.88.B8.E6.89.A9.E5.B1.95.E5.AD.97.E6.AE.B5.E5.8F.8A.E7.AD.BE.E5.90.8D.E7.94.9F.E6.88.90.E7.AE.97.E6.B3.95
	//请注意查看以上文档
	public function wxCardPackage()
	{
		$WxApi = Api::factory('Card');

		$card_list = array(
			array('card_id' => 'pdkJ9uPc_5nsLrGRd91yeEVGBbK8', 'outer_id' => 2),
			array('card_id' => 'pdkJ9uJ37aU-tyRj4_grs8S45k1c', 'outer_id' => 3),
			array('card_id' => 'pdkJ9uFiwIfiNod7J6zqTI3zbiyU', 'outer_id' => 4)
		);

		$ret = $WxApi->wxCardPackage($card_list);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//创建货架接口
	public function landingpage()
	{
		$banner     = 'http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZJkmG8xXhiaHqkKSVMMWeN3hLut7X7hicFN';
		$page_title = '惠城优惠大派送';
		$can_share  = true;

		//SCENE_NEAR_BY 		 附近 
		//SCENE_MENU			 自定义菜单 
		//SCENE_QRCODE			 二维码 
		//SCENE_ARTICLE			 公众号文章 
		//SCENE_H5				 h5页面 
		//SCENE_IVR				 自动回复 
		//SCENE_CARD_CUSTOM_CELL 卡券自定义cell
		
		$scene      = 'SCENE_NEAR_BY';
		
		$card_list  = array(
			array('card_id' => 'pdkJ9uPc_5nsLrGRd91yeEVGBbK8', 'thumb_url' => 'http://test.digilinx.cn/wxApi/Uploads/test.png'),
			array('card_id' => 'pdkJ9uJ37aU-tyRj4_grs8S45k1c', 'thumb_url' => 'http://test.digilinx.cn/wxApi/Uploads/aa.jpg')
		);

		$WxApi = Api::factory('Card');

		$ret = $WxApi->landingpage($banner, $page_title, $can_share, $scene, $card_list);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);

	}

	//--投放--
	//导入code接口
	public function deposit()
	{
		$card_id = 'pdkJ9uGXSYqNHc8U_z1k8MiFNRq8';
		$code    = array('11111', '22222', '33333');

		$WxApi = Api::factory('Card');

		$ret = $WxApi->deposit($card_id, $code);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//查询导入code数目
	public function getdepositcount()
	{
		$card_id = 'pdkJ9uGXSYqNHc8U_z1k8MiFNRq8';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->getdepositcount($card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}
	//核查code接口
	public function checkcode()
	{
		$card_id = 'pdkJ9uGXSYqNHc8U_z1k8MiFNRq8';
		$code    = array('11111', '22222', '33333');

		$WxApi = Api::factory('Card');

		$ret = $WxApi->checkcode($card_id, $code);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//图文消息群发卡券
	// 注意审核元素 查看 ifram
	public function gethtml()
	{
		$card_id = 'pdkJ9uGXSYqNHc8U_z1k8MiFNRq8';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->gethtml($card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//预览接口 - 高级群发
	
	//设置测试白名单
	public function testwhitelist()
	{
		$openid   = array();
		$username = array('tianye0327');

		$WxApi = Api::factory('Card');

		$ret = $WxApi->testwhitelist($openid, $username);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//查询Code接口
	public function codeGet()
	{
		$code          = '358962893266';
		$check_consume = true;
		$card_id       = 'pdkJ9uM-cVqICfSEiuQxeW5vt_i4';
		

		$WxApi = Api::factory('Card');

		$ret = $WxApi->codeGet($code, $check_consume, $card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//核销Code接口
	public function consume()
	{
		$card_id       = 'pdkJ9uItT7iUpBp4GjZp8Cae0Vig';
		$code          = '495863637862';
		
		$WxApi = Api::factory('Card');

		$ret = $WxApi->consume($code, $card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}
	
	//Code解码接口
	public function decrypt()
	{
		$encrypt_code = 'XXIzTtMqCxwOaawoE91+VJdsFmv7b8g0VZIZkqf4GWA60Fzpc8ksZ/5ZZ0DVkXdE';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->decrypt($encrypt_code);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//获取用户已领取卡券接口
	public function getcardlist()
	{
		$openid  = 'odkJ9uJ9qhdvV3SVjC5-n2roAv_s';
		$card_id = ''; //卡券ID。不填写时默认查询当前appid下的卡券。
		
		$WxApi = Api::factory('Card');

		$ret = $WxApi->getcardlist($openid, $card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//查看卡券详情
	public function cardGet()
	{
		$card_id = 'pdkJ9uH1UAW4HDS4ZzNPXc9Phnww';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->cardGet($card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//批量查询卡列表
	public function batchget()
	{
		$offset      = 0;
		$count       = 10;
		$status_list = 'CARD_STATUS_VERIFY_OK';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->batchget($offset, $count, $status_list);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//更改卡券信息接口 and 设置跟随推荐接口
	public function update()
	{
		$card_id = 'pdkJ9uH1UAW4HDS4ZzNPXc9Phnww';

		$type = 'groupon';
		
		$base_info = array();
		$base_info['logo_url'] = 'http://mmbiz.qpic.cn/mmbiz/2aJY6aCPatSeibYAyy7yct9zJXL9WsNVL4JdkTbBr184gNWS6nibcA75Hia9CqxicsqjYiaw2xuxYZiaibkmORS2oovdg/0';
       	$base_info['center_title'] = '顶部居中按钮';
       	$base_info['center_sub_title'] = '按钮下方的wording';
       	$base_info['center_url'] = 'http://www.baidu.com';
      	$base_info['custom_url_name'] = '立即使用';
    	$base_info['custom_url'] = 'http://www.qq.com';
    	$base_info['custom_url_sub_title'] = '6个汉字tips';
    	$base_info['promotion_url_name'] = '更多优惠';
    	$base_info['promotion_url'] = 'http://www.qq.com';

    	$WxApi = Api::factory('Card');

		$ret = $WxApi->update($card_id, $type, $base_info);

		if (!$ret) {
			$ret = $WxApi->getError();
			if ($ret == '') {
				$ret = '修改通过 不需要重新审核';
			}
		} else {
			$ret = '修改通过 需要重新审核';
		}
		
       	var_dump($ret);

	}

	//设置微信买单接口
	public function paycellSet()
	{
		$card_id = 'pdkJ9uH1UAW4HDS4ZzNPXc9Phnww';
		$is_open = true;

		$WxApi = Api::factory('Card');

		$ret = $WxApi->paycellSet($card_id, $is_open);

		if (!$ret) {
			$ret = $WxApi->getError();
		}
		
       	var_dump($ret);
	}

	//修改库存接口
	public function modifystock()
	{
		$card_id = 'pdkJ9uH1UAW4HDS4ZzNPXc9Phnww';
		$stock   = 'increase'; //increase 增加   reduce 减少
		$value   = 100;

		$WxApi = Api::factory('Card');

		$ret = $WxApi->modifystock($card_id, $stock, $value);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}
	
	//更改Code接口
	//为确保转赠后的安全性，
	//微信允许自定义Code的商户对已下发的code进行更改。 
	//注：为避免用户疑惑，建议仅在发生转赠行为后（发生转赠后，微信会通过事件推送的方式告知商户被转赠的卡券Code）
	//对用户的Code进行更改。
	public function codeUpdate()
	{
		$code     = '801192810944';
		$new_code = '123456789101';
		//$card_id  = 'pFS7Fjg8kV1IdDz01r4SQwMkuCKc';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->codeUpdate($code, $new_code, $card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//删除卡券接口
	public function cardDelete()
	{
		$card_id = 'pdkJ9uGXSYqNHc8U_z1k8MiFNRq8';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->cardDelete($card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//设置卡券失效接口
	public function unavailable()
	{
		$code    = '358962893266';
		$card_id = '';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->unavailable($code, $card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//拉取卡券概况数据接口
	public function getcardbizuininfo()
	{
		$begin_date  = '2015-12-01';
		$end_date    = '2015-12-21';
		$cond_source = 1; //卡券来源，0为公众平台创建的卡券数据、1是API创建的卡券数据

		$WxApi = Api::factory('Card');

		$ret = $WxApi->getcardbizuininfo($begin_date, $end_date, $cond_source);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}
	
	//获取免费券数据接口
	public function getcardcardinfo()
	{
		$begin_date  = '2015-12-01';
		$end_date    = '2015-12-21';
		$cond_source = 1; //卡券来源，0为公众平台创建的卡券数据、1是API创建的卡券数据
		$card_id     = ''; 

		$WxApi = Api::factory('Card');

		$ret = $WxApi->getcardcardinfo($begin_date, $end_date, $cond_source, $card_id);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//---会员卡专属--

	//拉取会员卡数据接口
	public function getcardmembercardinfo()
	{
		$begin_date  = '2015-12-01';
		$end_date    = '2015-12-21';
		$cond_source = 1; //卡券来源，0为公众平台创建的卡券数据、1是API创建的卡券数据

		$WxApi = Api::factory('Card');

		$ret = $WxApi->getcardmembercardinfo($begin_date, $end_date, $cond_source);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//会员卡激活
	public function activate()
	{
		$activate = array(
			'membership_number'	  => '357898858',  //会员卡编号，由开发者填入，作为序列号显示在用户的卡包里。可与Code码保持等值。
			'code'				  => '1231123',	   //创建会员卡时获取的初始code。
			'activate_begin_time' => '1397577600', //激活后的有效起始时间。若不填写默认以创建时的 data_info 为准。Unix时间戳格式
			'activate_end_time'	  => '1422724261', //激活后的有效截至时间。若不填写默认以创建时的 data_info 为准。Unix时间戳格式。
			'init_bonus'		  => '持白金会员卡到店消费，可享8折优惠。', //初始积分，不填为0。
			'init_balance'		  => '持白金会员卡到店消费，可享8折优惠。', //初始余额，不填为0。
			'init_custom_field_value1'	=> '白银', //创建时字段custom_field1定义类型的初始值，限制为4个汉字，12字节。
			'init_custom_field_value2'	=> '9折',  //创建时字段custom_field2定义类型的初始值，限制为4个汉字，12字节。
			'init_custom_field_value3'	=> '200',  //创建时字段custom_field3定义类型的初始值，限制为4个汉字，12字节。
		);

		$WxApi = Api::factory('Card');

		$ret = $WxApi->activate($activate);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//设置开卡字段接口
	/**
	 * USER_FORM_INFO_FLAG_MOBILE	手机号
	 *	USER_FORM_INFO_FLAG_NAME	姓名
	 *	USER_FORM_INFO_FLAG_BIRTHDAY	生日
	 *	USER_FORM_INFO_FLAG_IDCARD	身份证
	 *	USER_FORM_INFO_FLAG_EMAIL	邮箱
	 *	USER_FORM_INFO_FLAG_DETAIL_LOCATION	详细地址
	 *	USER_FORM_INFO_FLAG_EDUCATION_BACKGROUND	教育背景
	 *	USER_FORM_INFO_FLAG_CAREER	职业
	 *	USER_FORM_INFO_FLAG_INDUSTRY	行业
	 *	USER_FORM_INFO_FLAG_INCOME	收入
	 *	USER_FORM_INFO_FLAG_HABIT	兴趣爱好
	 */
	public function activateuserform()
	{
		$card_id = 'pdkJ9uGXSYqNHc8U_z1k8MiFNRq8';

		$required_form = array();
		$required_form['required_form']['common_field_id_list'] = array(
			"USER_FORM_INFO_FLAG_MOBILE",
        	"USER_FORM_INFO_FLAG_LOCATION",
        	"USER_FORM_INFO_FLAG_BIRTHDAY"
        );
        $required_form['required_form']['custom_field_list'] = array('喜欢的食物');
        
        $optional_form = array();
        $optional_form['optional_form']['common_field_id_list'] = array(
        	'USER_FORM_INFO_FLAG_EMAIL'
        );
        $optional_form['optional_form']['custom_field_list']    = array('喜欢的电影');

        $WxApi = Api::factory('Card');

		$ret = $WxApi->activateuserform($card_id, $required_form, $optional_form);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//拉取会员信息接口
	public function membercardUserinfo()
	{
		$card_id = 'pbLatjtZ7v1BG_ZnTjbW85GYc_E8';
		$code    = '916679873278';

		$WxApi = Api::factory('Card');

		$ret = $WxApi->membercardUserinfo($card_id, $code);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	//更新会员信息
	public function membercardUpdateuser()
	{
		$updateuser = array(
			'code'	  	   => '916679873278',  //卡券Code码。
			'card_id'	   => 'pbLatjtZ7v1BG_ZnTjbW85GYc_E8',	   //卡券ID。
			'record_bonus' => '消费30元，获得3积分', //商家自定义积分消耗记录，不超过14个汉字。
			'bonus'	  	   => '100', //需要设置的积分全量值，传入的数值会直接显示，如果同时传入add_bonus和bonus,则前者无效。
			'balance'	   => '持白金会员卡到店消费，可享8折优惠。', //需要设置的余额全量值，传入的数值会直接显示，如果同时传入add_balance和balance,则前者无效。
			'record_balance'		=> '持白金会员卡到店消费，可享8折优惠。', //商家自定义金额消耗记录，不超过14个汉字。
			'custom_field_value1'	=> '100', //创建时字段custom_field1定义类型的最新数值，限制为4个汉字，12字节。
			'custom_field_value2'	=> '200', //创建时字段custom_field2定义类型的最新数值，限制为4个汉字，12字节。
			'custom_field_value3'	=> '300', //创建时字段custom_field3定义类型的最新数值，限制为4个汉字，12字节。
		);

		$WxApi = Api::factory('Card');

		$ret = $WxApi->membercardUpdateuser($updateuser);

		if (!$ret) {
			$ret = $WxApi->getError();
		}

		var_dump($ret);
	}

	
	//--开发者协助制券--
	//创建子商户接口
	//卡券开放类目查询接口
	//更新子商户接口
	//拉取单个子商户信息接口
	//批量拉取子商户信息接口
	//创建子商户卡券接口
	//
	//母商户资质申请接口
	//母商户资质审核查询接口
	//子商户资质申请接口
	//子商户资质审核查询接口
	//
	//--上传临时素材--图片上传media接口
}
