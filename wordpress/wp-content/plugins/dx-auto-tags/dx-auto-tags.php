<?php 
/*
Plugin Name: DX-auto-tags
Plugin URI: http://www.daxiawp.com/dx-auto-tags.html
Description: 自动搜索自定义的标签列表，如果文章内容包含该文本，则自动添加文章标签
Version: 1.2
Author: 大侠wp
Author URI: http://www.daxiawp.com/dx-auto-tags.html

daxiawp开发的原创插件，任何个人或团体不可擅自更改版权。

*/

//数据库表
register_activation_hook(__FILE__,'web589_create_table');
function web589_create_table(){
	global $wpdb;
	$tb_name=$wpdb->prefix.'web589_auto_tags';
	$query='create table '.$tb_name.' (at_key int not null auto_increment primary key,description varchar(255),tags longtext )type=myisam default charset utf8';
	$wpdb->query($query);
}

//子菜单
add_action('admin_menu','web589_submenu');
function web589_submenu(){
	add_menu_page('dx-auto-tags', 'DX-auto-tags', 'manage_options', 'dx-auto-tags', 'daxiawp_tags_list',plugins_url('icon.png',__FILE__));
}
function daxiawp_tags_list(){
	include_once('tags-list.php');
	web589_write_database();
}

//插入、更新、删除数据库记录
function web589_write_database(){
	global $wpdb;
	$tb_name=$wpdb->prefix.'web589_auto_tags';
	if($_POST['insert-tags']=='新增'){
		$data=array('description'=>$_POST['description'],'tags'=>$_POST['tags-list']);
		$wpdb->insert($tb_name,$data);
		echo '<script type="text/javascript">location.replace(location.href);</script>';
	}
 	if($_POST['update-tags']){
		$update_key=str_replace('更新','',$_POST['update-tags']);
		$data=array('description'=>$_POST['description-'.$update_key],'tags'=>$_POST['tags-list-'.$update_key]);
		$where=array('at_key'=>$update_key);
		$wpdb->update($tb_name,$data,$where);
		echo '<script type="text/javascript">location.replace(location.href);</script>';
	}
	if($_POST['delete-tags']){
		$delete_key=str_replace('删除','',$_POST['delete-tags']);
		$query='delete from '.$tb_name.' where at_key="'.$delete_key.'"';
		$wpdb->query($query);
		echo '<script type="text/javascript">location.replace(location.href);</script>';
	}
}


//插入tags
add_action('save_post','web589_set_tags');
function web589_set_tags($post_id){
	if( (get_post_type($post_id)=='post' && ($_POST['publish'] || $_POST['save']) ) || ($_POST['one-key']=='一键更新') ){
		$tags=web589_tags_matching($post_id);
		if($tags){
			$max=get_option('web589_tags_max',1);
			$count=count($tags);
			$num= ($count<=$max) ? $count : $max;
			$keys=array_rand($tags,$num);
			if(is_array($keys)){
				foreach($keys as $key){
					$tags_rand[]=$tags[$key];
				}
			}
			else $tags_rand=$tags[$keys];
			wp_set_post_tags($post_id,$tags_rand,true);
		}
	}
}

//获取tags-list对象数组
function web589_get_tags_data(){
	global $wpdb;
	$tb_name=$wpdb->prefix.'web589_auto_tags';
	$query='select * from '.$tb_name;
	$res=$wpdb->get_results($query);
	return $res;	
}

//生成tags-list数组
function web589_tags_array(){
	$datas=web589_get_tags_data();
	if($datas){
		foreach($datas as $data){
			$tags_str=$data->tags.','.$tags_str;
		}
	}
	$tags_a=explode(',',trim($tags_str,','));
	return $tags_a;
}

//自动匹配tags
function web589_tags_matching($post_id){
	$post=get_post($post_id);
	$content=$post->post_content;
	$tags=web589_tags_array();
	if($tags){
		foreach($tags as $tag){
			$preg="/$tag/";
			$match=preg_match($preg,$content);
			if($match) $preg_tags[]=$tag;
		}
	}
	return $preg_tags;
}

//一键更新
function web589_one_key($start,$end){
	if($_POST['one-key']=='一键更新'){
		$num=$end-$start+1;
		$offset=$start-1;
		query_posts(array('ignore_sticky_posts'=>true,'posts_per_page'=>$num,'offset'=>$offset));
		while(have_posts()){
			the_post();
			$post_id=get_the_ID();
			web589_set_tags($post_id);
		}
		echo '更新完成！';
	}
}

//检测是否草稿
function web589_is_draft($post_id){
	$post=get_post($post_id);
	$status=$post->post_status;
	if($status=='draft') return true;
	else return false;
}


//统计publish文章数量
function web589_count_posts(){
	global $wpdb;
	$count=$wpdb->get_var('select count(ID) from wp_posts where post_status="publish" and post_type="post" ');
	return $count;
}

//form bottom action
add_action( 'DXAT_form_bottom', 'DXAT_contact' );
function DXAT_contact(){
?>

<p>插件介绍：<a href="http://www.daxiawp.com/dx-auto-tags.html" target="_blank">http://www.daxiawp.com/dx-auto-tags.html</a></p>
<p>wordpress主题请访问<a href="http://www.daxiawp.com" target="_blank">daxiawp</a>，大量大侠wp制作的主题供选择。wordpress定制、仿站、插件开发请联系：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1683134075&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1683134075:44" alt="点击这里给我发消息" title="点击这里给我发消息">1683134075</a></p>

<?php
}

if( !function_exists('_daxiawp_theme_menu_page') ) include_once( 'theme.php' );