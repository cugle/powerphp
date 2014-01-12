<?php
// +----------------------------------------------------------------------
// | CugleCms 后台管理系统
// +----------------------------------------------------------------------
// | provide by ：yangyongfu.com.cn
// 
// +----------------------------------------------------------------------
// | Author: 452275147@qq.com
// +----------------------------------------------------------------------

class NodeAction extends BaseAction
{
    public function index()
    {
	$Data = M('node'); // 实例化Data数据对象
    import('ORG.Util.Page');// 导入分页类
	$map=array();
    $count      = $Data->where($map)->count();// 查询满足要求的总记录数
    $Page       = new Page($count,C('PAGESIZE'));// 实例化分页类 传入总记录数
    // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    $nowPage = isset($_GET['p'])?$_GET['p']:1;
    $list = $Data->where($map)->page($nowPage.','.$Page->listRows)->select();
    $show       = $Page->show();// 分页显示输出
    $this->assign('page',$show);// 赋值分页输出
    $this->assign('list',$list);// 赋值数据集
    $this->display(); // 输出模板
    }
	function add(){
		if(!empty($_POST["name"])){
		
		$node = M('node'); // 实例化Data数据模型
		if($data=$node->create()){
			if(false!==$node->add()){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：addsection'.$node->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$node->getError().' )');
		}
		}else{
		$this->display('add');
		}
	}
	function edit(){
		if(empty($_POST["id"])){
		$data["id"]  = $_GET["id"];

			if(!empty($data)){
				$access=M(Node);
				$res=$access->where($data)->find();
				$this->assign('udate',$res);
				$this->display();
			}
		}else {
		$node=M('node');

		if($data=$node->create()){
			if(false!==$node->save()){
				$this->assign('jumpUrl',__URL__.'/index');
				$this->success('操作成功');
			}else{
				$this->error('操作失败：addsection'.$node->getDbError());
			}
		}else{
			$this->error('操作失败：数据验证( '.$node->getError().' )');
		}

				 
		}
	}
	function addaction(){
		$this->display('addmudel');
	}    
	
}
?>