function gen_save_nsw_news(){  
  if(jQuery('#n_title').val()==''){
      alert('Please insert news title');
      jQuery('#n_title').focus();
      return false 
    }

   // alert(jQuery('#ndescription').val());
  /*
	 if(jQuery('#ndescription').val()==''){
        alert('Please insert news description');
        jQuery('#ndescription').focus();
        return false 
   }*/
   jQuery('#nsw_add_form').submit();
   return false 
}

function get_tinymce_content(){
    if (jQuery("#ndescription").hasClass("tmce-active")){
        return tinyMCE.activeEditor.getContent();
    }else{
        return jQuery('#html_text_area_id').val();
    }
}

function gen_nsw_edit_news(){
    if(jQuery('#n_title').val()==''){
        alert('Please insert news title');
        jQuery('#n_title').focus();
        return false 
     }
     /*
     if(jQuery('#ndescription').val()==''){
        alert('Please insert news description');
        jQuery('#ndescription').focus();
        return false 
   }*/
     
     /*
	 if(tinymce.editors['ndescription'].getContent()==''){
      alert('Please insert news description');
      tinymce.editors['ndescription'].focus();
      return false 
    }*/
   jQuery('#nsw_edit_form').submit();
   return false 
}