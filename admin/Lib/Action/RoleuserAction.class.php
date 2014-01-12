<?php
// +----------------------------------------------------------------------
// | CugleCms 后台管理系统
// +----------------------------------------------------------------------
// | provide by ：yangyongfu.com.cn
// 
// +----------------------------------------------------------------------
// | Author: 452275147@qq.com
// +----------------------------------------------------------------------

class RoleuserAction extends BaseAction
{
    public function index()
    {
	$Data = M('role_user'); // 实例化Data数据对象
    import('ORG.Util.Page');// 导入分页类
	$map=array();
    $count      = $Data->where($map)->count();// 查询满足要求的总记录数
    $Page       = new Page($count,5);// 实例化分页类 传入总记录数
    // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    $nowPage = isset($_GET['p'])?$_GET['p']:1;
    $list = $Data->where($map)->page($nowPage.','.$Page->listRows)->select();
    $show       = $Page->show();// 分页显示输出
    $this->assign('page',$show);// 赋值分页输出
    $this->assign('list',$list);// 赋值数据集
    $this->display(); // 输出模板
    }
	function add(){
		if(!empty($_POST["user_id"])){
		
		$data_mod = M('role_user'); // 实例化Data数据模型
		if($data=$data_mod->create()){
			if(false!==$data_mod->add()){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：addsection'.$data_mod->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$data_mod->getError().' )');
		}
		}else{
		$this->display('add');
		}
	}
	function edit(){
		if(empty($_POST["user_id"])){
		$data["user_id"]  = $_GET["user_id"];

			if(!empty($data)){
				$access=M(role_user);
				$res=$access->where($data)->find();
				$this->assign('udate',$res);
				$this->display();
			}
		}else {
		$role_user=M('role_user');

		if($data=$role_user->create()){
			$sql='update '.__PREFIX__.'role_user  set  role_id= '.$_POST["role_id"].' where user_id='.$_POST["user_id"] ; 
			if(false!==$role_user ->execute($sql)){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：addsection'.$role_user->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$role_user->getError().' )');
		}

				 
		}
	}
	
}
?>