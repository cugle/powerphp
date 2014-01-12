<?php if (!defined('THINK_PATH')) exit();?>
<h3 class="f14"><span class="switchs cu on" title="<?php echo ($lang["expand_or_contract"]); ?>"></span>节点管理</h3>
<ul>
    <li id="_MP{47}" class="sub_menu"><a href="javascript:_MP(47,'<?php echo u('Node/index');?>');" hidefocus="true" style="outline:none;">节点列表</a></li>
	
	<li id="_MP{48}" class="sub_menu"><a href="javascript:_MP(48,'<?php echo u('Node/add');?>');" hidefocus="true" style="outline:none;">新增节点</a></li>
	

</ul>
<h3 class="f14"><span class="switchs cu on" title="<?php echo ($lang["expand_or_contract"]); ?>"></span>权限管理</h3>
<ul>
    <li id="_MP{47}" class="sub_menu"><a href="javascript:_MP(47,'<?php echo u('Access/index');?>');" hidefocus="true" style="outline:none;">权限列表</a></li>
	
	<li id="_MP{48}" class="sub_menu"><a href="javascript:_MP(48,'<?php echo u('Access/add');?>');" hidefocus="true" style="outline:none;">新增权限</a></li>
		
</ul>
<h3 class="f14"><span class="switchs cu on" title="<?php echo ($lang["expand_or_contract"]); ?>"></span>用户管理</h3>
<ul>
    <li id="_MP{47}" class="sub_menu"><a href="javascript:_MP(47,'<?php echo u('User/index');?>');" hidefocus="true" style="outline:none;">用户列表列表</a></li>
	
	<li id="_MP{48}" class="sub_menu"><a href="javascript:_MP(48,'<?php echo u('User/add');?>');" hidefocus="true" style="outline:none;">新增用户</a></li>
		
</ul>
<h3 class="f14"><span class="switchs cu on" title="<?php echo ($lang["expand_or_contract"]); ?>"></span>分组管理</h3>
<ul>
    <li id="_MP{47}" class="sub_menu"><a href="javascript:_MP(47,'<?php echo u('Role/index');?>');" hidefocus="true" style="outline:none;">分组列表</a></li>
	
	<li id="_MP{48}" class="sub_menu"><a href="javascript:_MP(48,'<?php echo u('Role/add');?>');" hidefocus="true" style="outline:none;">新增分组</a></li>
		
</ul>
<h3 class="f14"><span class="switchs cu on" title="<?php echo ($lang["expand_or_contract"]); ?>"></span>用户分组管理</h3>
<ul>
    <li id="_MP{47}" class="sub_menu"><a href="javascript:_MP(47,'<?php echo u('Roleuser/index');?>');" hidefocus="true" style="outline:none;">用户分组列表</a></li>
	
	<li id="_MP{48}" class="sub_menu"><a href="javascript:_MP(48,'<?php echo u('Roleuser/add');?>');" hidefocus="true" style="outline:none;">新增用户分组</a></li>
		
</ul>

<script type="text/javascript">
$(".switchs").each(function(i){
	var ul = $(this).parent().next();
	$(this).click(
	function(){
		if(ul.is(':visible')){
			ul.hide();
			$(this).removeClass('on');
				}else{
			ul.show();
			$(this).addClass('on');
		}
	})
});
</script>