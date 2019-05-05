<?php
namespace app\api\controller;

class Index extends Base
{
	//banner
    public function banner(){
		$banner_img = db('banner_img');
    	$banner_img_info = $banner_img->where(array('state'=>1,'banner_type'=>20))->order('sort_order asc,id desc')->field('id,path,www')->select();
		if(!$banner_img_info) {
			return format_result(true,'暂无图片');
		} else {
			return format_result(true,'查询成功',$banner_img_info);
		}
    }
	//直播首页展示
	public function home_live(){
	    $zhibo = M('zhibo');
	    $collect_zhibo = M('collect_zhibo');
	    $page = I('post.page','');
	    $pagesize = I('post.pagesize','');
	    $uid = I('post.uid','');
	    $first = ($page-1) * $pagesize;
	    $last = $pagesize;
	    //$time=time();
	   // $map['status']  = array('neq',3);
	    // $map['status']  = array('neq',2);
	
	           $or_wherenew['z.status'] = array('in','1,0');
	
	           $count=$zhibo->alias('z')->where($or_wherenew)->count(); 
	          
	            $sheng=$last-$count;
	            if($count >=$pagesize){
	
	                  $zhibo_info = $zhibo->alias('z')->field('z.id,z.zhibo_title,z.zhibo_desc,z.is_teacher,z.room_id,z.zhibo_thumb,z.zhibo_number,z.start_time, z.flv,z.teacher_flv,z.tribe_id,z.teacher_id,z.status,z.key,z.end_time,u.avatar as avatar')->join("left join ecs_users as u on u.user_id = z.teachers_id ")->where($or_wherenew)->order('z.status  desc,z.start_time asc')->limit($first,$last)->select();
	
	            }else{ 
	                      $zhibo_info1= $zhibo->alias('z')->field('z.id,z.zhibo_title,z.zhibo_desc,z.is_teacher,z.room_id,z.zhibo_thumb,z.zhibo_number,z.start_time, z.flv,z.teacher_flv,z.tribe_id,z.teacher_id,z.status,z.key,z.end_time,u.avatar as avatar')->join("left join ecs_users as u on u.user_id = z.teachers_id ")->where($or_wherenew)->order('z.status  desc,z.start_time asc')->limit($first,$last)->select();
	
	                      $zhibo_info2 = $zhibo->alias('z')->field('z.id,z.zhibo_title,u.nickname as zhibo_teacher,z.zhibo_desc,z.is_teacher,z.room_id,z.zhibo_thumb,z.zhibo_number,z.start_time,z.end_time,z.flv,z.teacher_flv,z.tribe_id,z.teacher_id,z.status,z.key,u.avatar as avatar')->join("left join ecs_users as u on u.user_id = z.teachers_id ")->where(array('z.status'=>2))->order('z.start_time desc')->limit($first,$sheng)->select();  
	
	                          if(empty($zhibo_info1)){
	
	                              $zhibo_info=array_merge($zhibo_info2);
	                          }else{
	
	                             $zhibo_info=array_merge($zhibo_info1,$zhibo_info2);
	
	                          }
	                         
	                          
	            }
	
	     
	       foreach($zhibo_info as $k=>$v){
	                   $zhibo_id= $zhibo_info[$k]['id'];
	                    if(empty($uid)){
	
	                       $zhibo_info[$k]['collect_zhibo']="0";
	                    }else if($uid==1){
	
	                         $zhibo_info[$k]['collect_zhibo']="0";
	                    }else{
	
	                    $collect_zhibo_info = $collect_zhibo->where(array('user_id'=>$uid,'zhibo_id'=>$zhibo_id))->find();
	                     if(empty($collect_zhibo_info)){ 
	                       $zhibo_info[$k]['collect_zhibo']="0";
	                     }else{
	                     $zhibo_info[$k]['collect_zhibo']="1";
	
	                     }
	
	                    }
	
	  
	          }
	
	 
	
	    if(empty($zhibo_info)){
	        
	
	         $jsonData['status'] = false;
	        $jsonData['code'] =3;
	         
	        echo json_encode($jsonData, JSON_UNESCAPED_UNICODE);
	     }else{ 
	        $jsonData['status'] = true;
	        $jsonData['code'] =2;
	        $jsonData['body'] = $zhibo_info;
	        echo json_encode($jsonData, JSON_UNESCAPED_UNICODE);
	    }
	}
	
}
