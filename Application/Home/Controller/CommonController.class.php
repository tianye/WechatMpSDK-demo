<?php
namespace Home\Controller;

use Think\Controller;
use Wechat\API;

class CommonController extends Controller
{
	final public function _initialize()
    {
		// 如果子类定义了前置方法 则执行;
        if (method_exists($this, '_int_before')) {
            $this->_int_before();
        }

        Api::init('服务号APP_ID', '服务号APP_SECRET', '服务号ORIGINAL_ID', '服务号回调TOKEN', '服务号回调encoding_aes_key');

        // 如果子类定义了后置方法 则执行;
        if (method_exists($this, '_int_after')) {
            $this->_int_after();
        }
    }
}