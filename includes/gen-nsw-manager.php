<?php if ( ! defined( 'ABSPATH' ) ) exit; 

function gen_nsw_view_news(){
  if(isset($_GET['act']) && $_GET['act']=='nsw_edit'){  
		echo '<div class="wrap">';
		echo '<div class="icon32 nws_icon"><br></div><h2>News</h2><br />';
		gen_nsw_edit();
		echo '</div>';
	}else if(isset($_GET['act']) && $_GET['act']=='nsw_edit_data'){
		   
		echo '<div class="wrap">';
		echo '<div class="icon32 nws_icon"><br></div><h2>News</h2><br />';
		$title=sanitize_text_field($_POST['n_title']);
		$description=sanitize_text_field($_POST['n_description']);
		$status=sanitize_text_field($_POST['status']);
		$nid=sanitize_text_field($_POST['nids']);
		
		gen_nsw_edit_data($title,$description,$status,$nid);
		echo '</div>';
	}else if(isset($_GET['act']) && $_GET['act']=='nsw_delete'){     
		echo '<div class="wrap">';
		echo '<div class="icon32 nws_icon"><br></div><h2>News</h2><br />';
		$nid=sanitize_text_field($_POST['news_id']);
		gen_delete_nsw_data($nid);
		echo '</div>';
	}
	else{
		echo '<div class="wrap">';
		echo '<div class="icon32 nws_icon"><br></div><h2>News</h2><br />';
		gen_select_all_nsw_data();
		echo '</div>';
	}
}

function gen_select_all_nsw_data($msgs=''){
	echo $msgs;
	global $table_prefix, $wpdb;
  
    $tablename=$wpdb->prefix."gen_news_slider_widgets";
	$tdata_ps=$wpdb->get_results("SELECT * FROM ".$tablename."");
	
	echo '<table cellspacing="0" class="widefat fixed">';
	echo '<thead><tr>';
	echo '<th class="manage-column" width="50">SL</th>';
	echo '<th class="manage-column" width="200">Title</th>';
	echo '<th class="manage-column" width="400">Description</th>';
    echo '<th class="manage-column" width="100">Image</th>';
	echo '<th class="manage-column" width="100">Status</th>';
	echo '<th class="manage-column"></th>';
	echo '<th class="manage-column"></th>';
	echo '</tr></thead>';
	echo '<tfoot><tr><th colspan="7"></th></tr></tfoot>';
	
	$i=1;
	foreach($tdata_ps as $tda){
		echo '<tr>';
		echo '<td width="50">'.$i++.'</td>';
		echo '<td width="200">'.esc_attr($tda->title).'</td>';
    if(strlen($tda->description)>100){
      
     echo '<td width="400">'.substr(htmlentities($tda->description), 0, 100 ) .'...</td>';
    }else{
      echo '<td width="400">'.esc_attr($tda->description).'</td>';
    }
    echo '<td width="100">';
      if(($tda->image_url)!=''){
        echo '<img src="'.esc_url($tda->image_url).'" alt="Smiley face" height="40" width="60">';
      }
    echo '</td>';
		echo '<td width="100">';
		if(($tda->status)==1){
			echo 'Active';
		}
		else{ echo 'Deactive';}
		echo '</td>';
		echo '<td>';
		?><form method="post" action="admin.php?page=wp-news-slider-widgets/includes/gen-nsw-init.php&act=nsw_edit" ><?php
		echo '<input type="hidden" name="news_id" id="news_id" value="'.esc_attr($tda->id).'" />';
		echo '<input type="submit" value="Edit" class="edit_btn" />';
		?></form><?php
		echo '</td>';
		echo '<td >';
		?><form method="post" action="admin.php?page=wp-news-slider-widgets/includes/gen-nsw-init.php&act=nsw_delete" ><?php
		wp_nonce_field( 'nswdeletedata_123321');
		echo '<input type="hidden" name="news_id" id="news_id" value="'.esc_attr($tda->id).'" />';
		echo '<input type="submit" value="Delete" class="delete_btn" />';
		?></form><?php
		echo '</td>';
		echo '</tr>';
	}	
	echo '</table>';
}

function gen_nsw_edit_data($title,$description,$status,$nid){
	global $wpdb;
	if(check_admin_referer( 'nsweditdata_'.$nid )){
		if( current_user_can( 'administrator' ) ){
			$tablename=$wpdb->prefix."gen_news_slider_widgets";
			$result=$wpdb->get_row("SELECT * FROM ".$tablename." WHERE id=".$nid."");	
		  
				if($_FILES['n_image']['error']==0){
						if (($_FILES['n_image']['type']=="image/jpg") || ($_FILES['n_image']['type']=="image/jpeg") || ($_FILES['n_image']['type']=="image/gif") || ($_FILES['n_image']['type']=="image/png")){						
									if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
									$uploadedfile = $_FILES['n_image'];                          
									$upload_overrides = array( 'test_form' => false );
									$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );              							
									$img_name=basename($_FILES['n_image']['name']);
									$img_url=$movefile['url'];
						}
						else{
									echo '<div id="message" class="updated">';
									echo '<strong style="line-height:2; color: #FF0000;">Invalid file format.Only files ending in jpg, jpeg, gif, png.</strong>';
									echo '</div>';	
					  return false;
						}
					}
		   
		  $description=stripslashes($description);
		  if(isset($img_name) && $img_name!=''){
			$data=array('title' => $title, 'description' => $description, 'status' => $status, 'image_name' => $img_name, 'image_url' => $img_url);
			  if($result->image_url!=''){
				  $uploads = wp_upload_dir();
				  $url=explode('uploads',$result->image_url);
				  $url = $uploads['basedir'].str_replace('\\','/', $url[1]); 
				  unlink($url);
			  }
		  }else{
				$data=array('title' => $title, 'description' => $description, 'status' => $status);
		  }
		  $where = array('id'=>$nid);
		  $wpdb->update($tablename,$data,$where);    
		  $msgs='<div class="updated" id="message"><p>News edited successfully</p></div>';
		  gen_select_all_nsw_data($msgs);
	   }
	   else{
			echo '<div id="message" class="updated fade"><p>Your Have to be Adminiastrator to Change!</p></div>';	
	   }
   }
	
}

function gen_delete_nsw_data($nid){
  global $wpdb;
  if(check_admin_referer( 'nswdeletedata_123321')){
	  if( current_user_can( 'administrator' ) ){	
		  $tablename=$wpdb->prefix."gen_news_slider_widgets";
		  $result=$wpdb->get_row("SELECT * FROM ".$tablename." WHERE id=".$nid."");	
		  
		  if($result->image_url!=''){
			  $uploads = wp_upload_dir();
			  $url=explode('uploads',$result->image_url);
			  $url = $uploads['basedir'].str_replace('\\','/', $url[1]); 
			  unlink($url);
		  }
			
		  $wpdb->query("DELETE FROM ".$tablename." WHERE id = '".$nid."'");	
			$msgs='<div class="updated" id="message"><p>News deleted successfully</p></div>';
			
			gen_select_all_nsw_data($msgs);
	  }
	  else{
		echo '<div id="message" class="updated fade"><p>Your Have to be Adminiastrator to Delete!</p></div>';
	  }
  }  
		
}

function gen_nsw_edit(){
	global $wpdb;
	
	$ids=sanitize_text_field($_POST['news_id']);
    $tablename=$wpdb->prefix."gen_news_slider_widgets";
	$result=$wpdb->get_row("SELECT * FROM ".$tablename." WHERE id=".$ids."");	
	if($result->status==1){ $active='selected="selected"';}else{ $active='';}
	if($result->status==0){ $nactive='selected="selected"';}else{ $nactive='';}
    $img='';
    if(($result->image_url)!=''){
      $img= '<img src="'.esc_url($result->image_url).'" alt="Smiley face" height="40" width="60">';
    }
	?>
	<form name="nsw_edit_form" id="nsw_edit_form" method="post" enctype="multipart/form-data" action="admin.php?page=wp-news-slider-widgets/includes/gen-nsw-init.php&act=nsw_edit_data">
	<input type="hidden" name="nids" id="nids" value="<?php echo esc_attr($result->id);?>" />
	<?php
	wp_nonce_field( 'nsweditdata_'.$result->id );
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar">';
	echo '<div id="post-body"><div id="post-body-content"><div id="namediv2" class="stuffbox">';
	echo '<h3>Edit News</h3>';
	echo '<div class="inside">';
	echo '<table><tr>';
	echo '<td width="200"><label>Title</label></td>';
	echo '<td><input type="text" name="n_title" id="n_title" value="'.esc_attr($result->title).'" /></td></tr>';
	echo '<tr><td valign="top"><label>Description</label></td>';
  echo '<td>';
    //wp_editor("$result->description",'ndescription', array('textarea_rows'=>1,'textarea_name'=> 'n_description')); 
    wp_editor(html_entity_decode($result->description),'ndescription', array('textarea_rows'=>6,'textarea_name'=> 'n_description'));
    
  echo '</td>';
  echo '<tr><td valign="top"><label>Upload Image:</label></td>';
	echo '<td><input type="file" name="n_image" id="n_image" />'.esc_attr($img).'</td></tr>';
	echo '<tr><td><label>Status</label></td>';
	echo '<td><select name="status"><option value="1" '.esc_attr($active).'>Active</option><option value="0" '.esc_attr($nactive).'>Deactive</option></select></td></tr>';	
	echo '<tr><td colspan="2" align="right"><input type="button" value="Save" onclick="javascript:gen_nsw_edit_news();" class="button-primary" style="width:100px; border:none;" /></td></tr>';
	echo '</table>';
	?></form><?php
	echo '</div>';
	echo '</div></div></div>';
	echo '</div>';
}

function gen_nsw_add_news(){	
  wp_enqueue_script('tiny_mce');
	global $wpdb;
	gen_nsw_init_new();	
  if(isset($_GET['act']) && $_GET['act']=='newsslider_submit'){ 
			gen_insert_nsw_data();
			gen_nsw_view_news();
		
		
	}	else{
		echo '<div class="wrap">';
		echo '<div class="icon32 nws_icon"><br></div><h2>Add News</h2><br />';
		echo '<div id="poststuff" class="metabox-holder has-right-sidebar">';
		echo '<div id="post-body"><div id="post-body-content"><div id="namediv2" class="stuffbox">';
		echo '<h3>Add News</h3>';
		echo '<div class="inside">';
		?><form name="nsw_add_form" id="nsw_add_form" method="post" enctype="multipart/form-data" action="admin.php?page=add-news&act=newsslider_submit"><?php
		wp_nonce_field( 'addnswdata_32123' );
		echo '<table><tr>';
		echo '<td width="200"><label>Tittle *</label></td>';
		echo '<td><input type="text" name="n_title" id="n_title" /></td></tr>';
    
		echo '<tr><td><label>Description *</label></td>';
    echo '<td><div>';
    wp_editor("",'ndescription', array('textarea_rows'=>6,'textarea_name'=> 'n_description'));    
    echo '</div></td></tr>';
    echo '<tr><td><label>Upload Image:</label></td>';
		echo '<td><input type="file" name="n_image" id="n_image" /></td></tr>';
		echo '<tr><td><label>Status&emsp;</label></td>';
		echo '<td><select name="status"><option value="1">Active</option><option value="0">Deactive</option></select></td></tr>';		
		echo '<tr><td colspan="2" align="right"><input type="button" onclick="javascript:gen_save_nsw_news();" value="Save" class="button-primary" style="width:100px; border:none;" /></td></tr>';
		echo '</table>';
		?></form><?php
		echo '</div>';
		echo '</div></div></div>';
		echo '</div>';
		echo '</div>';
	}
}

function gen_insert_nsw_data(){
    global $wpdb;
	if(check_admin_referer( 'addnswdata_32123')){
		if( current_user_can( 'administrator' ) ){
			$tablename=$wpdb->prefix."gen_news_slider_widgets"; 
			if(isset($_GET['act']) && $_GET['act']=='newsslider_submit'){      
			  if($_FILES['n_image']['error']==0){
						if (($_FILES['n_image']['type']=="image/jpg") || ($_FILES['n_image']['type']=="image/jpeg") || ($_FILES['n_image']['type']=="image/gif") || ($_FILES['n_image']['type']=="image/png")){						
									if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
									$uploadedfile = $_FILES['n_image'];              
									$upload_overrides = array( 'test_form' => false );
									$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );              							
									$img_name=basename($_FILES['n_image']['name']);
									$img_url_img=$movefile['url'];
						}else{
									echo '<div id="message" class="updated">';
									echo '<strong style="line-height:2; color: #FF0000;">Invalid file format.Only files ending in jpg, jpeg, gif, png.</strong>';
									echo '</div>';
					  return false;
						}
					}
			  
			  $_POST['n_description']=stripslashes(sanitize_text_field($_POST['n_description']));      
				if(isset($img_name) && $img_name!=''){
					$data=array(
					'title' => (sanitize_text_field($_POST['n_title'])!='' ? sanitize_text_field($_POST['n_title']):''),
					'description' => (sanitize_text_field($_POST['n_description'])!='' ? sanitize_text_field($_POST['n_description']):''),
					'status' => (sanitize_text_field($_POST['status'])!='' ? sanitize_text_field($_POST['status']):''),
					'image_name' => $img_name,
					'image_url' => $img_url_img    
					);
				}else{
					  $data=array(
						'title' => (sanitize_text_field($_POST['n_title'])!='' ? sanitize_text_field($_POST['n_title']):''),
						'description' => (sanitize_text_field($_POST['n_description'])!='' ? sanitize_text_field($_POST['n_description']):''),
						'status' => (sanitize_text_field($_POST['status'])!='' ? sanitize_text_field($_POST['status']):'')
					  );              
				} 
				$wpdb->insert($tablename, $data);
				echo '<div class="updated" id="message"><p>News added successfully</p></div>';     
			}
		}
		else{
			echo '<div id="message" class="updated fade"><p>Your Have to be Adminiastrator to Add!</p></div>';
		}
	}	
}

?>