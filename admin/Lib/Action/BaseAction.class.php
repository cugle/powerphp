<?php
// 本类由系统自动生成，仅供测试用途
class BaseAction extends Action {
	function _initialize(){

		import('ORG.Util.RBAC');
       // 检查认证
        if(RBAC::checkAccess()) { 
            //检查认证识别号
            if(!$_SESSION[C('USER_AUTH_KEY')]) { 
                //跳转到认证网关
                redirect(PHP_FILE.C('USER_AUTH_GATEWAY')); 
            } 
            // 检查权限
            if(!RBAC::AccessDecision()) { 

                 $this->error('没有权限！'); 

            } 
       
	 	}

				// 顶部菜单
		$model	=	M("node");
		$top_menu	=$model->field('id,title')->where('status=1 and level=1')->order('sort ASC')->select();
		$this->assign('top_menu',$top_menu);

		//获取网站配置信息
		$setting_mod = M('setting');
		$setting = $setting_mod->select();
		foreach ( $setting as $val ) {
			$set[$val['name']] = stripslashes($val['data']);
		}
		$this->setting = $set;   
		
		$this->assign('show_header', true);
		$this->assign('const',get_defined_constants());

		$this->assign('iframe',$_REQUEST['iframe']);
		$def=array(
			'request'=>$_REQUEST
		);	
		$this->assign('def',json_encode($def));
	}
}