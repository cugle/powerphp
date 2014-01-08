<?php
// +----------------------------------------------------------------------
// | CugleCms 后台管理系统
// +----------------------------------------------------------------------
// | provide by ：yangyongfu.com.cn
// 
// +----------------------------------------------------------------------
// | Author: 452275147@qq.com
// +----------------------------------------------------------------------

class PublicAction extends Action
{
 
	public function login()
	{
		//unset($_SESSION);
		//$admin_mod=M('User');
		if ($_POST) {
			$username = $_POST['username'] && trim($_POST['username']) ? trim($_POST['username']) : '';
			$password = $_POST['password'] && trim($_POST['password']) ? trim($_POST['password']) : '';
			if (!$username || !$password) {
				redirect(u('Public/login'));
			}
			if($this->setting['check_code']==1){
				if ($_SESSION['verify'] != md5($_POST['verify']))
				{
					$this->error(L('verify_error'));
				}
			}
			//生成认证条件
			$map  = array();
			// 支持使用绑定帐号登录
			$map['username']	= $username;
			$map['password']	= md5($password);
			$map["active"]	=	1;			
			//$admin_info=$admin_mod->where("user_name='$username'")->find();
			import('ORG.Util.RBAC');
			$authInfo = RBAC::authenticate($map);
				if(false == $authInfo) {  
				$this->error('登录失败，请检查用户名和密码是否有误！');  
				}else {  
				// 设置认证识别号  
				$_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];  
				$_SESSION['admin_info']=$authInfo;
				//获取并保存用户访问权限列表  
				
				RBAC::saveAccessList();  

				if($authInfo['username']=='admin') { 
			
			   		// 管理员不受权限控制影响
			
			 	 	 $_SESSION['administrator']        =    true; 
			
				}


				$this->success('登录成功！',u('Index/index'));
				exit;
			}
		}
		$this->assign('set',$this->setting);
		$this->display();
	}
	//退出登录
	public function logout()
	{
		if(isset($_SESSION['admin_info'])) {
			unset($_SESSION['admin_info']);			
			$this->success('退出登录成功！',u('Public/login'));
		}else {
			$this->error('已经退出登录！');
		}
	}
 	//验证码
    public function verify(){
    	import("ORG.Util.Image");
        Image::buildImageVerify(4,1,'gif','50','24');
    }
 
	// 菜单页面
	public function menu(){
		//显示菜单项
		$id	=	intval($_REQUEST['tag'])==0?1:intval($_REQUEST['tag']);
		$menu  = array();
		
		$role_id = D('role_user')->where('user_id='.$_SESSION['admin_info']['id'])->getField('role_id');
		
		$node_ids_res = D("access")->where("role_id=".$role_id)->field("node_id")->select();
		
		$node_ids = array();
		foreach ($node_ids_res as $row) {
			array_push($node_ids,$row['node_id']);
		}
		//读取数据库模块列表生成菜单项
		$node    =   M("node");
		//$where = "auth_type<>2 AND status=1 AND is_show=0 AND group_id=".$id;		 
		//$list	=$node->where($where)->field('id,action,action_name,module,module_name,data')->order('sort DESC')->select();
		
		
		//SELECT * FROM `thinkphp_node` as A inner join `thinkphp_access` as B on A.id=B.node_id WHERE A.auth_type<>2 AND A.status=1 AND A.is_show=0 AND A.group_id=1 AND B.role_id=2
		//$model=new Model();
       // $members=$model->table('bm_member m,bm_company c')
             // ->where('m.cid=c.id')
              //->field('m.* ,c.work')
              //->order('m.id')
              //->select();
		$where = " A.status=1 AND A.level=2 AND A.pid=".$id." AND  B.role_id=".$role_id;	
		//echo $where; 
		$sql = "select A.id,A.title,A.name from think_node A right join think_access B ON a.id = b.node_id where ".$where;
		
		$list = $node->query($sql);
		//$list	=$node->table('thinkphp_node A,thinkphp_access B')->where($where)->field('A.id,A.action,A.action_name,A.module,A.module_name,A.data')->order('A.sort DESC')->select();
		
		foreach($list as $key=>$action) {

			$menu[$action['name']]['name']	= $action['title'];
			$menu[$action['id']]['id']	= $action['id'];
		}
		import('ORG.Util.RBAC');
		$authInfo = RBAC::getModuleAccessList($_SESSION[C('USER_AUTH_KEY')],1);
		print_r($authInfo);
		$this->assign('menu',$menu);
		$this->display('left');
	}
	/**	 
	 * 后台主页
	 */
	public function main()
	{
		$security_info=array();
		if(is_dir(ROOT_PATH."/install")){
			$security_info[]="强烈建议删除安装文件夹,点击<a href='".u('Public/delete_install')."'>【删除】</a>";
		}
		if(APP_DEBUG==true){
			$security_info[]="强烈建议您网站上线后，建议关闭 DEBUG （前台错误提示）";
		}	
		if(count($security_info)<=0){
			$this->assign('no_security_info',0);
		}
		else{
			$this->assign('no_security_info',1);
		}	
		$this->assign('security_info',$security_info);
        $disk_space = @disk_free_space(".")/pow(1024,2);
		$server_info = array(
		    '程序版本'=>NOW_VERSION.'[<a href="http://wwww.yangyongfu.com.cn" target="_blank">查看最新版本</a>]',		
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],	
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',		
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round($disk_space < 1024 ? $disk_space:$disk_space/1024 ,2).($disk_space<1024?'M':'G'),
		);
        $this->assign('set',$this->setting);
		$this->assign('server_info',$server_info);	
		$this->display();
	}
}
?>