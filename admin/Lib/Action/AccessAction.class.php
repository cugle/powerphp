<?php
// +----------------------------------------------------------------------
// | CugleCms 后台管理系统
// +----------------------------------------------------------------------
// | provide by ：yangyongfu.com.cn
// 
// +----------------------------------------------------------------------
// | Author: 452275147@qq.com
// +----------------------------------------------------------------------

class AccessAction extends BaseAction
{
    public function index()
    {

		
		
		
	$Data = M('access'); // 实例化Data数据对象
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
		if(!empty($_POST["role_id"])){
		$access = M('access'); // 实例化Data数据模型
        $data["role_id"]  = $_POST["role_id"];
		$data["node_id"]  = $_POST["node_id"];
		$data["level"]  = $_POST["level"];
		$data["pid"]  = $_POST["pid"];
		$res=$access->add($data);
		//$this->assign('data',$data);
        //$this->display();
		}else{
		$this->display('add');
		}
	}
	function edit(){		
		
		if(empty($_POST["role_id"]) && empty($_POST["node_id"])){
		
			
			$data["role_id"]=$_GET['role_id'];
			$data["node_id"]  = $_GET["node_id"];

			if(!empty($data)){
				$access=M(access);
				$res=$access->where($data)->find();
				$this->assign('udate',$res);
				$this->display();
			}
		}else {
				$access=M(access);
 
					 
				$sql='update '.__PREFIX__.'access  set level='.$_POST["level"].' ,pid= '.$_POST["pid"].' where role_id='.$_POST["role_id"].' and node_id='.$_POST["node_id"] ; 
				if(false!==$access ->execute($sql)){
							$this->assign('jumpUrl',__URL__.'/index');
							$this->success('操作成功');
				}else{
							
							$this->error('操作失败：'.$access->getDbError());
				}

				 
		}
		
		
		
		
	}
	function addaction(){
		$this->display('addmudel');
	}    
	
}
?>