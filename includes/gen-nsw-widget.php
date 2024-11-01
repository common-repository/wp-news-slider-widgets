<?php if ( ! defined( 'ABSPATH' ) ) exit; 

class Gen_Nsw_Widget extends WP_Widget {
  public function __construct() {
      // widget actual processes
      parent::__construct('gen_nsw_widget','News Slider', array('description' => 'Wordpress Custom News Slider Widget'));
  }

 	public function form( $instance ) {
	// outputs the options form on admin
    if ( isset( $instance[ 'title' ] ) ) {
      $title = sanitize_text_field($instance[ 'title' ]);
    }else {
      $title = __( 'New title', 'text_domain' );
    }
    if(isset($instance['nsw_title_position'])){
      $nsw_title_position = sanitize_text_field($instance['nsw_title_position']);
    }else{
      $nsw_title_position = 'left';
    }
    
    if(isset($instance['nsw_title_color'])){
      $nsw_title_color = sanitize_text_field($instance['nsw_title_color']);
    }else{
      $nsw_title_color = '#FFFFFF';
    }
    if(isset($instance['nsw_news_title_color'])){
      $nsw_news_title_color = sanitize_text_field($instance['nsw_news_title_color']);
    }else{
      $nsw_news_title_color = '#000000';
    }
    if(isset($instance['nsw_news_des_color'])){
      $nsw_news_des_color = sanitize_text_field($instance['nsw_news_des_color']);
    }else{
      $nsw_news_des_color = '#000000';
    }
    if(isset($instance['nsw_bg_color'])){
      $nsw_bg_color = sanitize_text_field($instance['nsw_bg_color']);
    }else{
      $nsw_bg_color = '#FFFFFF';
    }
	
    $trans_opt = sanitize_text_field($instance['trans_opt']);
    if(isset($instance['scn_speed'])){
      $scn_speed = sanitize_text_field($instance['scn_speed']);
    }else{
      $scn_speed = 2000;
    }

    if(isset($instance['img_width'])){
      $img_width = sanitize_text_field($instance['img_width']);
    }else{
      $img_width = 260;
    }
    
    if(isset($instance['img_height'])){
      $img_height = sanitize_text_field($instance['img_height']);
    }else{
      $img_height = 80;
    }
    
    if(isset($instance['scn_timeout'])){
      $scn_timeout = sanitize_text_field($instance['scn_timeout']);
    }else{
      $scn_timeout = 1500;
    }
    $theme_opt = sanitize_text_field($instance['theme_opt']);
    if(isset($instance['scn_height'])){
      $scn_height = sanitize_text_field($instance['scn_height']);
    }else{
      $scn_height = 240;
    }
    
    if(isset($instance['nsw_pager'])){
      $nsw_pager = sanitize_text_field($instance['nsw_pager']);
    }else{
      $nsw_pager = 'hide';
    }
    
    if(isset($instance['nsw_pager_color'])){
      $nsw_pager_color = sanitize_text_field($instance['nsw_pager_color']);
    }else{
      $nsw_pager_color = '#000000';
    }
    
    if(isset($instance['nsw_pager_color_active'])){
      $nsw_pager_color_active = sanitize_text_field($instance['nsw_pager_color_active']);
    }else{
      $nsw_pager_color_active = '#F48353';
    }
    ?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_title_position' )); ?>"><?php _e( 'Title Position:' ); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id( 'nsw_title_position' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_title_position' )); ?>" >
        <option value="center" <?php if($nsw_title_position=='center') echo 'selected="selected"'; ?> >Center</option>
        <option value="left" <?php if($nsw_title_position=='left') echo 'selected="selected"'; ?> >Left</option>
        <option value="right" <?php if($nsw_title_position=='right') echo 'selected="selected"'; ?> >Right</option>        
      </select>
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            jQuery('.color-picker').on('focus', function(){
                var parent = jQuery(this).parent();
                jQuery(this).wpColorPicker()
                parent.find('.wp-color-result').click();
            }); 
        });
	  </script>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_title_color' )); ?>"><?php _e( 'Title Color:' ); ?></label>      
      <input class="widefat color-picker" id="<?php echo esc_attr($this->get_field_id( 'nsw_title_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_title_color' )); ?>" type="text" value="<?php echo esc_attr($nsw_title_color);?>" />

    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_news_title_color' )); ?>"><?php _e( 'News Title Color:' ); ?></label>      
      <input class="widefat color-picker" id="<?php echo esc_attr($this->get_field_id( 'nsw_news_title_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_news_title_color' )); ?>" type="text" value="<?php echo esc_attr($nsw_news_title_color);?>" />
			
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_news_des_color' )); ?>"><?php _e( 'News Description Color:' ); ?></label>      
      <input class="widefat color-picker" id="<?php echo esc_attr($this->get_field_id( 'nsw_news_des_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_news_des_color' )); ?>" type="text" value="<?php echo esc_attr($nsw_news_des_color);?>" />			
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_bg_color' )); ?>"><?php _e( 'Background Color:' ); ?></label>      
      <input class="widefat color-picker" id="<?php echo esc_attr($this->get_field_id( 'nsw_bg_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_bg_color' )); ?>" type="text" value="<?php echo esc_attr($nsw_bg_color);?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'trans_opt' )); ?>"><?php _e( 'Slider Effect:' ); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id( 'trans_opt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'trans_opt' )); ?>" >        
        <option value="scrollLeft" <?php if($trans_opt=='scrollLeft') echo 'selected="selected"'; ?> >Scroll Left</option>
        <option value="scrollRight" <?php if($trans_opt=='scrollRight') echo 'selected="selected"'; ?> >Scroll Right</option>        
        <option value="none" <?php if($trans_opt=='none') echo 'selected="selected"'; ?> >none</option>
      </select>
    </p>
    <p>
     <label for="<?php echo esc_attr($this->get_field_id( 'scn_speed' )); ?>"><?php _e( 'Speed:' ); ?></label> 
		 <input id="<?php echo esc_attr($this->get_field_id( 'scn_speed' )); ?>" style="width: 60px;" name="<?php echo esc_attr($this->get_field_name( 'scn_speed' )); ?>" type="text" value="<?php echo  esc_attr($scn_speed) ; ?>" /> ms
    </p>
    <p>
     <label for="<?php echo esc_attr($this->get_field_id( 'scn_timeout' )); ?>"><?php _e( 'Timeout:' ); ?></label> 
		 <input id="<?php echo esc_attr($this->get_field_id( 'scn_timeout' )); ?>" style="width: 60px;" name="<?php echo esc_attr($this->get_field_name( 'scn_timeout' )); ?>" type="text" value="<?php echo  esc_attr($scn_timeout) ; ?>" /> ms
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'theme_opt' )); ?>"><?php _e( 'Theme:' ); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id( 'theme_opt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'theme_opt' )); ?>" >
        <option value="apple_gray" <?php if($theme_opt=='apple_gray') echo 'selected="selected"'; ?>>Gray</option>
        <option value="apple_pink" <?php if($theme_opt=='apple_pink') echo 'selected="selected"'; ?>>Solid Pink</option>
        <option value="none" <?php if($theme_opt=='none') echo 'selected="selected"'; ?> >None</option>
      </select>
    </p>
    
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_pager' )); ?>"><?php _e( 'Pager:' ); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id( 'nsw_pager' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_pager' )); ?>" >
        <option value="show" <?php if($nsw_pager=='show') echo 'selected="selected"'; ?> >Show</option>
        <option value="hide" <?php if($nsw_pager=='hide') echo 'selected="selected"'; ?> >Hide</option>        
      </select>
    </p>
    
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_pager_color' )); ?>"><?php _e( 'Pager Color:' ); ?></label>      
      <input class="widefat color-picker" id="<?php echo esc_attr($this->get_field_id( 'nsw_pager_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_pager_color' )); ?>" type="text" value="<?php echo esc_attr($nsw_pager_color);?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id( 'nsw_pager_color_active' )); ?>"><?php _e( 'Pager Color(Active):' ); ?></label>      
      <input class="widefat color-picker" id="<?php echo esc_attr($this->get_field_id( 'nsw_pager_color_active' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsw_pager_color_active' )); ?>" type="text" value="<?php echo esc_attr($nsw_pager_color_active);?>" />			
    </p>    
    
    <p>
    <label for="<?php echo esc_attr($this->get_field_id( 'scn_height' )); ?>"><?php _e( 'Height:' ); ?></label> 
		<input id="<?php echo esc_attr($this->get_field_id( 'scn_height' )); ?>" style="width: 60px;" name="<?php echo esc_attr($this->get_field_name( 'scn_height' )); ?>" type="text" value="<?php echo  esc_attr($scn_height) ; ?>" /> px
		</p>    
    <p>
    <label for="<?php echo esc_attr($this->get_field_id( 'img_width' )); ?>"><?php _e( 'Image Width:' ); ?></label> 
		<input id="<?php echo esc_attr($this->get_field_id( 'img_width' )); ?>" style="width: 60px;" name="<?php echo esc_attr($this->get_field_name( 'img_width' )); ?>" type="text" value="<?php echo  esc_attr($img_width) ; ?>" /> px
		</p>    
    <p>
    <label for="<?php echo esc_attr($this->get_field_id( 'img_height' )); ?>"><?php _e( 'Image Height:' ); ?></label> 
		<input id="<?php echo esc_attr($this->get_field_id( 'img_height' )); ?>" style="width: 60px;" name="<?php echo esc_attr($this->get_field_name( 'img_height' )); ?>" type="text" value="<?php echo  esc_attr($img_height) ; ?>" /> px
		</p>    
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
    $instance = array();
	$instance['title'] = strip_tags( $new_instance['title'] );
    $instance['nsw_title_position'] = strip_tags( $new_instance['nsw_title_position']);
    $instance['nsw_title_color'] = strip_tags( $new_instance['nsw_title_color']);
    $instance['nsw_news_title_color'] = strip_tags( $new_instance['nsw_news_title_color']);
    $instance['nsw_news_des_color'] = strip_tags( $new_instance['nsw_news_des_color']);
    $instance['nsw_bg_color'] = strip_tags( $new_instance['nsw_bg_color']);
    $instance['trans_opt'] = strip_tags( $new_instance['trans_opt']);
	$instance['scn_speed'] = strip_tags( $new_instance['scn_speed']);
	$instance['scn_timeout'] = strip_tags( $new_instance['scn_timeout']);
    $instance['theme_opt'] = strip_tags( $new_instance['theme_opt']);
    $instance['nsw_pager'] = strip_tags( $new_instance['nsw_pager']);
    $instance['nsw_pager_color'] = strip_tags( $new_instance['nsw_pager_color']);
    $instance['nsw_pager_color_active'] = strip_tags( $new_instance['nsw_pager_color_active']);    
    $instance['scn_height'] = $new_instance['scn_height'];
    $instance['img_width'] = $new_instance['img_width'];
    $instance['img_height'] = $new_instance['img_height'];
		return $instance;
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
            extract( $args );
            $title = apply_filters( 'widget_title', $instance['title'] );
            $front_data = array(
                'nsw_title_position' => $instance['nsw_title_position'] ,
                'nsw_title_color' => $instance['nsw_title_color'] ,
                'nsw_news_title_color' => $instance['nsw_news_title_color'] ,
                'nsw_news_des_color' => $instance['nsw_news_des_color'] ,
                'nsw_bg_color' => $instance['nsw_bg_color'] ,
                'trans_opt' => $instance['trans_opt'] ,
                'scn_speed'=> $instance['scn_speed'] ,
                'scn_timeout'=> $instance['scn_timeout'] ,
                'theme_opt' => $instance['theme_opt'],
                'nsw_pager' => $instance['nsw_pager'],
                'nsw_pager_color' => $instance['nsw_pager_color'],
                'nsw_pager_color_active' => $instance['nsw_pager_color_active'],                
                'scn_height' => $instance['scn_height'],
                'img_width' => $instance['img_width'],
                'img_height' => $instance['img_height']
                );
            echo $before_widget;
            if ( ! empty( $title ) ){
                echo $before_title . $title . $after_title;
            }
            $this->gen_nsw_widget($front_data);
            echo $after_widget;
	}
 
  public function gen_nsw_widget($front_data){
   ?>    
    <style type="text/css">
    .widget_gen_nsw_widget h3.widget-title, .widget_gen_nsw_widget h2.widget-title{      
    <?php
          if(isset($front_data['nsw_title_color'])){
            echo 'color:'.$front_data['nsw_title_color'].';';
          }else{echo 'color:#FFFFFF;';}          
          
          if(isset($front_data['nsw_title_position'])){
            echo 'text-align:'.$front_data['nsw_title_position'].';';
          }else{echo 'text-align:center;';}
    ?>      
    }
    .nsw_title_view{
       <?php
          if(isset($front_data['nsw_news_title_color'])){
            echo 'color:'.$front_data['nsw_news_title_color'].';';
          }else{echo 'color:#000000;';}
       ?>
    }
    .nsw_des_view{
      <?php
          if(isset($front_data['nsw_news_des_color'])){
            echo 'color:'.$front_data['nsw_news_des_color'].';';
          }else{echo 'color:#000000;';}
       ?>     
    }
    .widget_gen_nsw_widget .cycle-slideshow{
      <?php
          if(isset($front_data['nsw_bg_color'])){
            echo 'background:'.$front_data['nsw_bg_color'].'!important;';
          }else{echo 'background:#FFFFFF;';}
       ?>      
    }  
    .widget_gen_nsw_widget .cycle-slideshow div{
      <?php
          if(isset($front_data['nsw_bg_color'])){
            echo 'background:'.$front_data['nsw_bg_color'].';!important';
          }else{echo 'background:#FFFFFF;';}
       ?>
    }
    
    #custom-pager span{
      <?php
          if(isset($front_data['nsw_pager_color'])){
            echo 'color:'.$front_data['nsw_pager_color'].';!important';
          }else{echo 'color:#000000;';}
       ?>    
    }
    #custom-pager span.cycle-pager-active{
      <?php
          if(isset($front_data['nsw_pager_color_active'])){
            echo 'color:'.$front_data['nsw_pager_color_active'].';!important';
          }else{echo 'color:#F48353;';}
       ?>
    }
    

    </style>
    <?php
    global $wpdb;      
      $tablename=$wpdb->prefix."gen_news_slider_widgets";
      $tdata_ps=$wpdb->get_results("SELECT * FROM ".$tablename." WHERE status='1'");      
	  //echo '=====================>';
	  //die($front_data['theme_opt']);
    ?>
      <link rel='stylesheet'  href='<?php echo esc_url(GEN_USTS_NSW_BASE_URL.'/css/theme_'.$front_data['theme_opt'].'.css'); ?>' type='text/css' />
      <link rel='stylesheet'  href='<?php echo esc_url(GEN_USTS_NSW_BASE_URL.'/css/gen_nsw_view.css'); ?>' type='text/css' />      
      <?php
        wp_enqueue_script( 'jquery-cycle2-js', esc_url(GEN_USTS_NSW_BASE_URL.'/js/jquery.cycle2.min.js'));    
        
    
    $pager='';    
    if($front_data['nsw_pager']=='show'){
      $pager='data-cycle-pager="#custom-pager"';
    }    
    //die('=====>'.$front_data['trans_opt']);    
    echo '<div class="cycle-slideshow" style="height:'.($front_data['scn_height']).'px; padding:5px; top=120px; overflow:hidden;"
    data-cycle-fx="'.$front_data['trans_opt'].'"
    data-cycle-speed="'.$front_data['scn_speed'].'"  
    data-cycle-timeout="'.$front_data['scn_timeout'].'"    
    '.$pager.'
    data-cycle-slides=">div"
    >';   
    
	
    foreach($tdata_ps as $tda){
      if(count($tdata_ps)==1){
        echo '<div class="slide2" style="height:'.$front_data['scn_height'].'px; width:100%;">';
      }else{
        echo '<div class="slide2" style="height:'.$front_data['scn_height'].'px; width:100%; display:none;">';
      }
      if(!empty($tda->image_url)){
        echo '<div style="margin-top:5px; text-align:center;">
          <img src="'.$tda->image_url.'" alt="'.$tda->title.'" height="'.$front_data['img_height'].'" width="'.$front_data['img_width'].'">
            </div>';
      }
      echo '<div class="nsw_title_view">'.$tda->title.'</div>';      
      echo '<div class="nsw_des_view">'.html_entity_decode($tda->description).'</div>';
      echo '</div>';
      
    }
        
    echo '</div>';    
    echo '<div id="custom-pager" class="center" style="text-align:center;"></div>';
  }
}

wp_enqueue_style( 'wp-color-picker' );        
wp_enqueue_script( 'wp-color-picker' ); 
?>