<?php 
if( $_POST['max-tags-button'] ){
	update_option( 'web589_tags_max', $_POST['max-tags'] );	
}
?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('input.edit').click(function(){
			$(this).parent().siblings('.toggle').children().toggle();
		});
	});
</script>

<style type="text/css">
	.display{display:inline;}
	.hidden{display:none;}
	.red{color:red;}
	#main{width:900px; border:1px solid #ccc; background-color:#F9F9F9; padding:10px; margin-top:20px;}
	
</style>


​<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 id="head-title">文章自动标签</h2>
	
	<div id="main">
	
		<form id="edit-tags" action="" method="post">	
			<table id="all-tags-list" width="900" cellpadding="10" cellspading="0">
			
				<tr>
					<td width="50"><strong>序列id</strong></td>
					<td width="100"><strong>描述</strong></td>
					<td><strong>自定义标签</strong></td>
					<td colspan="2"></td>
				</tr>
				
				
				<?php $tags=web589_get_tags_data(); foreach($tags as $tag):?>
				<tr>
					<td width="50"><?php echo $tag->at_key; ?><input type="hidden" name="at_key" value="<?php echo $tag->at_key; ?>" /></td>
					<td width="100" class='toggle'>
						<span class='display'><?php echo $tag->description; ?></span>
						<span class="hidden"><input type="text" name="description-<?php echo $tag->at_key; ?>" value="<?php echo $tag->description; ?>"></span>
					</td>
					<td class='toggle'>
						<span class='display'><?php echo $tag->tags; ?></span>
						<span class="hidden"><textarea name="tags-list-<?php echo $tag->at_key; ?>" cols="60" rows="5"><?php echo $tag->tags; ?></textarea></span>			
					</td>
					<td><input type="button" name="edit-<?php echo $tag->at_key; ?>" class="edit button-primary" value="编辑" /></td>
					<td class='toggle'>
						<span class='display'><input type="submit" name="delete-tags" class="delete button-secondary" value="删除<?php echo $tag->at_key; ?>" /></span>
						<span class='hidden'><input type="submit" name="update-tags" class="save button-primary" value="更新<?php echo $tag->at_key; ?>" /></span>
					</td>
				</tr>	
				<?php endforeach;?>
						
			</table>
		</form>
			
		
		<h3>新增tags</h3>
		<form id="insert-tags" action="" method="post">
		<table cellpadding="10">		
			<tr>
				<td>
					<label for="insert-description">描述：</label>
					<input type="text" name="description" id="insert-description" value="" size="80"/>
				</td>
			</tr>
			<tr>	
				<td>
					<label for="insert-tags">自定义标签：多个用英文逗号分隔，例如：苹果,iphone,手机</label><br />
					<textarea name="tags-list" id="insert-tags" cols="85" rows="6"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<?php submit_button('新增','primary','insert-tags',false)?>
				</td>
			</tr>
		</table>	
		</form>
		
		<h3>一键更新Tags</h3>
		<form id="one-key" action="" method="post">
		<table cellpadding="10">
			<tr><td colspan="3">文章多时可能会占用较多资源，请分批更新！例：从1到10，表示更新前10篇文章；从11到100，表示从第11篇开始更新到第100篇。</td></tr>
			<tr>
				<td>
					<label for="start" >从</label>
					<?php if($_POST['start']) $value=$_POST['start'];else $value='1';?>
					<input name="start" id="start" type="text" value="<?php echo $value; ?>" />
				</td>
				<td>
					<label for="start" >到</label>
					<?php if($_POST['end']) $value=$_POST['end'];else $value=web589_count_posts();?>
					<input name="end" id="end" type="text" value="<?php echo $value; ?>" />
				</td>		
				<td><?php submit_button('一键更新','primary','one-key',false);?></td>
			</tr>
			<tr><td colspan="3" class="red"><?php web589_one_key($_POST['start'],$_POST['end']);?></td></tr>
		</table>
		</form>
	
		<h3>参数选项</h3>
		<form action="" method="post">
			<label for="max-tags">插入标签的最大数量：</label>
			<input id="max-tags" name="max-tags" type="text" value="<?php echo get_option('web589_tags_max',1); ?>"/>
			<?php submit_button('更新','primary','max-tags-button','');?>
		</form>
	
	</div>

</div>

<div style="clear:both;"></div>

<?php do_action( 'DXAT_form_bottom' );?>