<?php
namespace Home\Controller;
use Home\Controller\CommonController;

use Wechat\API;
use Wechat\Utils\Menu\MenuItem;

class MenuController extends CommonController {
    
    //设置菜单
    public function set()
	{
		$WxApi = Api::factory('Menu');

		$button = new MenuItem("菜单");

		$menus = array(
            new MenuItem("今日歌曲", 'click', 'V1001_TODAY_MUSIC'),
            $button->buttons(array(
                    new MenuItem('搜索', 'view', 'http://www.soso.com/'),
                    new MenuItem('视频', 'view', 'http://v.qq.com/'),
                    new MenuItem('赞一下我们', 'click', 'V1001_GOOD'),
                )),
        );

		$ret = $WxApi->set($menus);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

		var_dump($ret);
	}

	//循环设置菜单
	public function for_set()
	{
		$menus = I('post.menus'); // menus 是你自己后台管理中心表单post过来的一个数组

        $target = array();

        // 构建你的菜单
        foreach ($menus as $menu) {
            // 创建一个菜单项
            $item = new MenuItem($menu['name'], $menu['type'], $menu['key']);

            // 子菜单
            if (!empty($menu['buttons'])) {
                $buttons = array();
                foreach ($menu['buttons'] as $button) {
                    $buttons[] = new MenuItem($button['name'], $button['type'], $button['key']);
                }

                $item->buttons($buttons);
            }

            $target[] = $item;
        }

        $WxApi = Api::factory('Menu');
        
        $ret = $WxApi->set($menus);

        if (!$ret) {
            $ret =$WxApi->getError();
        }

		var_dump($ret);
	}


    //获取菜单
    public function get()
    {
        $WxApi = Api::factory('Menu');

        $ret = $WxApi->get();

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
    }

    //获取菜单【查询接口，能获取到任意方式设置的菜单】
    public function current()
    {
        $WxApi = Api::factory('Menu');

        $ret = $WxApi->current();

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
    }

    //删除菜单
    public function delete()
    {
        $WxApi = Api::factory('Menu');

        $ret = $WxApi->delete();

        if (!$ret) {
            $ret =$WxApi->getError();
        }

        var_dump($ret);
    }
}
