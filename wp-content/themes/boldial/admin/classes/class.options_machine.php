<?php 
/**
 * SMOF Options Machine Class
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.0.0
 * @author      Syamil MJ
 */

class Options_Machine {

	/**
	 * PHP5 contructor
	 *
	 * @since 1.0.0
	 */
	function __construct($options) {
		
		// Added by IshYoBoy - Do not generate back-end if AJAX
		if ( is_admin() && current_user_can('edit_theme_options') ){
			$return = $this->optionsframework_machine($options);

			$this->Inputs = $return[0];
			$this->Menu = $return[1];
			$this->Defaults = $return[2];
		}
		
	}


	/**
	 * Process options data and build option fields
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function optionsframework_machine($options) {

	    //$data = of_get_options();
	    //$ish_options = of_get_options();
        global $ish_options;
		
		$defaults = array();   
	    $counter = 0;
		$menu = '';
		$output = '';

        $output .= ishyoboy_get_google_fonts_js();

		
		foreach ($options as $value) {
		
			$counter++;
			$val = '';
			
			//create array of defaults		
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}
			
			//Start Heading
			 if ( $value['type'] != "heading" )
			 {
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				
				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {

                    //*****************
                    //Added by IshYoBoy
                    if (  substr( $value['fold'], 0 , 4) == 'off_' ){
                        $temp_id = substr($value['fold'], 4);

                        if ($ish_options[$temp_id]) {
                            $fold="f_".$value['fold']." temphide ";
                        } else {
                            $fold="f_".$value['fold']." ";
                        }
                    }else{
                        if ($ish_options[$value['fold']]) {
                            $fold="f_".$value['fold']." ";
                        } else {
                            $fold="f_".$value['fold']." temphide ";
                        }
                    }
				}

				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";

				//only show header if 'name' value exists
				if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
	
			 } 
			 //End Heading
			
			//switch statement to handle various options type
			switch ( $value['type'] ) {

				//text input
				case 'text':
					$t_value = '';

                    // Updated by IshYoBoy
                    $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
                    $t_value = stripslashes($def);
					
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;
				
				//select option
				case 'select':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_ID => $option) {
						//$output .= '<option id="' . $select_ID . '" value="'.$option.'" ' . selected($ish_options[$value['id']], $option, false) . ' />'.$option.'</option>';

                        // IshYoBoy modification:   always use the array key as value not the text of the option.
                        //                          You must always provide an assoc array Array('key', 'Value name');
                        $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
                        $output .= '<option id="' . $select_ID . '" value="'.$select_ID.'" ' . selected($def, $select_ID, false) . ' />'.$option.'</option>';
					 }
					$output .= '</select></div>';
				break;
				
				//textarea option
				case 'textarea':	
					$cols = '8';
					$ta_value = '';
					
					if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
							$cols = $ta_options['cols'];
							} 
						}

                        // Updated by IshYoBoy
                        $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
						$ta_value = stripslashes($def);
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';		
				break;
				
				//radiobox option
				case 'radio':

                    foreach($value['options'] as $option => $name) {
                        // Updated by IshYoBoy
                        $checked = (isset($ish_options[$value['id']])) ? $ish_options[$value['id']] : $defaults[$value['id']];
                        $output .= '<span class="of-radio-line"><input class="of-input of-radio" name="'.$value['id'].'" id="'.$value['id'].'_'.$option .'" type="radio" value="'.$option.'" ' . checked($checked, $option, false) . ' /><label class="radio" for="'.$value['id'].'_'.$option .'">'.$name.'</label></span>';
                    }
				break;
				
				//checkbox option
				case 'checkbox':
					if (!isset($ish_options[$value['id']])) {
						$ish_options[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($ish_options[$value['id']], 1, false) .' />';
				break;
				
				//multiple checkbox option
				case 'multicheck': 			
					(isset($ish_options[$value['id']]))? $multi_stored = $ish_options[$value['id']] : $multi_stored="";
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';								
					}			 
				break;

				// Uploader 3.5
				case 'upload':
				case 'media':

					if ( ! isset( $value['mod'] ) ) $value['mod'] = '';

				    $def = ( isset( $ish_options[ $value['id'] ] ) ) ? $ish_options[ $value['id'] ] : $defaults[ $value['id'] ];

					$u_val = '';
					if( $def ){
						$u_val = stripslashes( $def );
					}

					$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);

				break;
				
				//colorpicker option
				case 'color':
                    // Updated by IshYoBoy
                    $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
                    $output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$def.'"></div></div>';
					$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $def .'" />';
				break;

                //colorpicker SET option
                case 'color_set':

                    // Updated by IshYoBoy
                    $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];

                    //var_dump( $def );

                    if ( is_array( $def ) ){

                        foreach ( $def as $key => $color ){

                            $output .= '<div class="color_set_item">';
                            switch ($key){
                                case 'bg' :
                                    $output .= '<p>' . __( 'Background', 'ishyoboy' ) . ':' . '</p>';
                                    break;
                                case 'text' :
                                    $output .= '<p>' . __( 'Text', 'ishyoboy' ) . ':' . '</p>';
                                    break;
                                case 'bg_active' :
                                    $output .= '<p>' . __( 'Active Background', 'ishyoboy' ) . ':' . '</p>';
                                    break;
                                case 'text_active' :
                                    $output .= '<p>' . __( 'Active Text', 'ishyoboy' ) . ':' . '</p>';
                                    break;
                                case 'border' :
                                    $output .= '<p>' . __( 'Border', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'headline_1' :
                                    $output .= '<p>' . __( 'Headline 1', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'headline_2' :
                                    $output .= '<p>' . __( 'Headline 2', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'link' :
                                    $output .= '<p>' . __( 'Link', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'link1' :
                                    $output .= '<p>' . __( 'Link 1', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'link2' :
                                    $output .= '<p>' . __( 'Link 2', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'link_active' :
                                    $output .= '<p>' . __( 'Active Link', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'block_bg' :
                                    $output .= '<p>' . __( 'Block Elements BG', 'ishyoboy' ) . ':' . '</p>';
                                    break;
	                            case 'block_text' :
                                    $output .= '<p>' . __( 'Block Elements Text', 'ishyoboy' ) . ':' . '</p>';
                                    break;
                                default :
                                    $output .= '<p>' . __( 'Color', 'ishyoboy' ) . ':' . '</p>';

                            }

                            $output .= '<div id="' . $value['id'] . '_' .$key . '" class="colorSelector"><div style="background-color: ' . $color . '"></div></div>';
                            $output .= '<input class="of-color" name="'.$value['id'].'[' . $key . ']" id="'. $value['id']. '_' .$key .'" type="text" value="'. $color .'" />';
                            $output .= '</div>';
                        }

                    }
                    else{
                        $output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$def.'"></div></div>';
                        $output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $def .'" />';
                    }
                    break;
				
				//typography option	
				case 'typography':
				
					$typography_stored = isset($ish_options[$value['id']]) ? $ish_options[$value['id']] : $value['std'];
					
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 20; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
						$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							for ($i = 20; $i < 38; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						
						$faces = array('arial'=>'Arial',
										'verdana'=>'Verdana, Geneva',
										'trebuchet'=>'Trebuchet',
										'georgia' =>'Georgia',
										'times'=>'Times New Roman',
										'tahoma'=>'Tahoma, Geneva',
										'palatino'=>'Palatino',
										'helvetica'=>'Helvetica' );
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
						$styles = array('normal'=>'Normal',
										'italic'=>'Italic',
										'bold'=>'Bold',
										'bold italic'=>'Bold Italic');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
					
					}

				break;

                //typography option
                case 'typography_ishyoboy':

                    $typography_stored = isset($ish_options[$value['id']]) ? $ish_options[$value['id']] : $value['std'];

                    /* Font Size */

                    if(isset($typography_stored['size'])) {
                        $output .= '<div class="select_wrapper typography-size" original-title="Font size">';
                        $output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
                        for ($i = 9; $i < 20; $i++){
                            $test = $i.'px';
                            $output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>';
                        }

                        $output .= '</select></div>';

                    }

                    /* Font Face */
                    if(isset($typography_stored['face'])) {

                        $output .= '<div class="select_wrapper typography-face" original-title="Font family">';
                        $output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';



                        $g_faces = json_decode(ishyoboy_get_google_fonts());
                        $r_faces = ishyoboy_get_regular_fonts();

                        if ( isset( $ish_options[$value['id'].'-type'] ) && 'regular' == $ish_options[$value['id'].'-type'] ){
                            foreach ($r_faces as $i=>$face) {
                                $output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
                            }
                        }else{
                            foreach ($g_faces as $i=>$face) {
                                $output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $i .'</option>';
                            }
                        }



                        $output .= '</select></div>';

                    }

                    /* Font Weight */
                    if(isset($typography_stored['style'])) {

                        $output .= '<div class="select_wrapper typography-style" original-title="Font style">';
                        $output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';

                        $g_font_variants = json_decode(ishyoboy_get_google_fonts(), true);
                        $r_font_variants = array('normal'=>'Normal',
                            'italic'=>'Italic',
                            'bold'=>'Bold',
                            'bold italic'=>'Bold Italic');

                        if ( isset( $ish_options[$value['id'].'-type'] ) && 'regular' == $ish_options[$value['id'].'-type'] ){
                            // Regular Font
                            foreach ($r_font_variants as $i=>$style){
                                $output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';
                            }
                        }else{
                            // Google Font
                            foreach ($g_font_variants[$typography_stored['face']]['variants'] as $style){
                                $output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $style, false) . '>'. $style .'</option>';
                            }

                        }



                        $output .= '</select></div>';

                    }

                    /* Font Color */
                    if(isset($typography_stored['color'])) {

                        $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
                        $output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';

                    }

                    /* Line Height */
                    if(isset($typography_stored['height'])) {

                        $output .= '<div class="select_wrapper typography-height" original-title="Line height">';
                        $output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
                        for ($i = 20; $i < 38; $i++){
                            $test = $i.'px';
                            $output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>';
                        }

                        $output .= '</select></div>';

                    }

                    //var_dump($typography_stored);
                    break;
				
				//border option
				case 'border':
						
					/* Border Width */
                    // Updated by IshYoBoy
                    $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
                    $border_stored = $def;
					
					$output .= '<div class="select_wrapper border-width">';
					$output .= '<select class="of-border of-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 21; $i++){ 
						$output .= '<option value="'. $i .'" ' . selected($border_stored['width'], $i, false) . '>'. $i .'</option>';				 }
					$output .= '</select></div>';
					
					/* Border Style */
					$output .= '<div class="select_wrapper border-style">';
					$output .= '<select class="of-border of-border-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
					
					$styles = array('none'=>'None',
									'solid'=>'Solid',
									'dashed'=>'Dashed',
									'dotted'=>'Dotted');
									
					foreach ($styles as $i=>$style){
						$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>'. $style .'</option>';		
					}
					
					$output .= '</select></div>';
					
					/* Border Color */		
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
					$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $border_stored['color'] .'" />';
					
				break;
				
				//images checkbox - use image as checkboxes
				case 'images':

					$i = 0;
					
					$select_value = (isset($ish_options[$value['id']])) ? $ish_options[$value['id']] : ( ( isset( $value['std'] ) ) ? $value['std'] : '');
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $key, false)) {
							$checked = checked($select_value, $key, false);
							$selected = 'of-radio-img-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-img-label">'. $key .'</div>';
						$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
						$output .= '</span>';				
					}
					
				break;
				
				//info (for small intro box etc)
				case "info":
					$info_text = $value['std'];
					$output .= '<div class="of-info">'.$info_text.'</div>';
				break;

                //info (for small intro box etc)
                case "twitter-info":
                    $info_text = $value['std'];
                    $output .= __( 'To be able to use the Twitter Widget you need to create an application under your
                    twitter account which will allow your widget to communicate with twitter servers and receive your latest posts. Please follow each of the steps below:', 'ishyoboy' );
                    $output .= '<br><br><ol>';
                    $output .= '<li>' . __( 'Add a new Twitter application by visiting:', 'ishyoboy' ) . ' <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>' . '</li>';
                    $output .= '<li>' . __( 'Log in with your twitter account', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'Click on the "Create a new application" button or use an already existing one.', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'Fill in all fields and Callback URL (Website and URLs should start with "http://").', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'Agree to the rules, fill out the captcha, and submit your application.', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'After successful creation, create an access token by clicking the "Create my access token." button', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'Wait for a few seconds for the server to reflect the changes and refresh the page.', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'Copy all the keys into the fields below. Make sure not to copy the URLs but the random strings.', 'ishyoboy' ) . '</li>';
                    $output .= '<li>' . __( 'Save all changes. You can now create your Twitter Widget in "Appearance -> Widgets".', 'ishyoboy' ) . '</li>';
                    $output .= '</ol>';

                    $output .= $info_text;
                    break;

                //info (for small intro box etc)
                case "ish-acc-section":
                    $output .= '';
                break;

				//display a single image
				case "image":
					$src = $value['std'];
					$output .= '<img src="'.$src.'">';
				break;
				
				//tab heading
				case 'heading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}
					$header_class = str_replace(' ','',strtolower($value['name']));
					$custom_class = ( isset( $value['class'] ) ) ? ' ' . $value['class'] : '';
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . $jquery_click_hook;
					// Updated by IshYoBoy
                    if ( isset($value['ish-updates']) && ('1' == $value['ish-updates']) && Options_Machine::ishyoboy_updates_available() ){
                        $menu .= '<li class="'. $header_class . $custom_class . '"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'" class="ish-updates"><span class="title">'.  $value['name'] .'</span><span class="update-plugins count-1"><span class="update-count">1</span></span></a></li>';
                    }else{
                        $menu .= '<li class="'. $header_class . $custom_class . '"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
                    }
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;
				
				//drag & drop slide manager
				case 'slider':
					$output .= '<div class="slider"><ul id="'.$value['id'].'">';
					// Updated by IshYoBoy
					$def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
					$slides = $def;
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
						}
					}
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';

					break;
				
				//drag & drop block manager
				case 'sorter':
				
					$sortlists = isset($ish_options[$value['id']]) && !empty($ish_options[$value['id']]) ? $ish_options[$value['id']] : $value['std'];
					
					$output .= '<div id="'.$value['id'].'" class="sorter">';
					
					
					if ($sortlists) {
					
						foreach ($sortlists as $group=>$sortlist) {
						
							$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
							$output .= '<h3>'.$group.'</h3>';
							
							foreach ($sortlist as $key => $list) {
							
								$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';
									
								if ($key != "placebo") {
								
									$output .= '<li id="'.$key.'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
									$output .= $list;
									$output .= '</li>';
									
								}
								
							}
							
							$output .= '</ul>';
						}
					}
					
					$output .= '</div>';
				break;
				
				//background images option
				case 'tiles':
					
					$i = 0;
					$select_value = isset($ish_options[$value['id']]) && !empty($ish_options[$value['id']]) ? $ish_options[$value['id']] : '';
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if( NULL != checked($select_value, $key, false) ) {
							$checked = checked($select_value, $key, false);
							$selected = 'of-radio-tile-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'. $key .'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
						$output .= '</span>';				
					}
					
				break;
				
				//backup and restore options data
				case 'backup':
				
					$instructions = $value['desc'];
					$backup = get_option(BACKUPS);
					
					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __( 'Last Backup : ', 'ishyoboy' ) . '<span class="backup-log">'.$log.'</span></strong></p></div>' . "\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				
				break;
				
				//export or import data between different installs
				case 'transfer':
				
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($ish_options)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
				
				break;
				
				// google font field
				case 'select_google_font':
					$output .= '<div class="select_wrapper">';
					$output .= '<select class="select of-input google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_key => $option) {
						$output .= '<option value="'.$select_key.'" ' . selected((isset($ish_options[$value['id']]))? $ish_options[$value['id']] : "", $option, false) . ' />'.$option.'</option>';
					} 
					$output .= '</select></div>';
					
					if(isset($value['preview']['text'])){
						$g_text = $value['preview']['text'];
					} else {
						$g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
					}
					if(isset($value['preview']['size'])) {
						$g_size = 'style="font-size: '. $value['preview']['size'] .';"';
					} else { 
						$g_size = '';
					}
					
					$output .= '<p class="'.$value['id'].'_ggf_previewer google_font_preview" '. $g_size .'>'. $g_text .'</p>';
				break;
				
				//JQuery UI Slider
				case 'sliderui':
					$s_val = $s_min = $s_max = $s_step = $s_edit = '';//no errors, please

                    // Updated by IshYoBoy
                    $def = ( isset($ish_options[$value['id']]) ) ? $ish_options[$value['id']] : $defaults[$value['id']];
                    $s_val  = stripslashes($def);
					
					if(!isset($value['min'])){ $s_min  = '0'; }else{ $s_min = $value['min']; }
					if(!isset($value['max'])){ $s_max  = $s_min + 1; }else{ $s_max = $value['max']; }
					if(!isset($value['step'])){ $s_step  = '1'; }else{ $s_step = $value['step']; }
					
					if(!isset($value['edit'])){ 
						$s_edit  = ' readonly="readonly"'; 
					}
					else
					{
						$s_edit  = '';
					}
					
					if ($s_val == '') $s_val = $s_min;
					
					//values
					$s_data = 'data-id="'.$value['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';
					
					//html output
					$output .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'. $s_val .'" class="mini" '. $s_edit .' />';
					$output .= '<div id="'.$value['id'].'-slider" class="smof_sliderui" style="margin-left: 7px;" '. $s_data .'></div>';
					
				break;
				
				
				//Switch option
				case 'switch':

					if (!isset($ish_options[$value['id']])) {
						$ish_options[$value['id']] = ( isset( $value['std'] ) ? $value['std'] : 0);
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="s_fld ";
					
					$cb_enabled = $cb_disabled = '';//no errors, please
					
					//Get selected
					if ($ish_options[$value['id']] == 1){
						$cb_enabled = ' selected';
						$cb_disabled = '';
					}else{
						$cb_enabled = '';
						$cb_disabled = ' selected';
					}
					
					//Label ON
					if(!isset($value['on'])){
						$on = "On";
					}else{
						$on = $value['on'];
					}
					
					//Label OFF
					if(!isset($value['off'])){
						$off = "Off";
					}else{
						$off = $value['off'];
					}
					
					$output .= '<p class="switch-options">';
						$output .= '<label class="'.$fold.'cb-enable'. $cb_enabled .'" data-id="'.$value['id'].'"><span>'. $on .'</span></label>';
						$output .= '<label class="'.$fold.'cb-disable'. $cb_disabled .'" data-id="'.$value['id'].'"><span>'. $off .'</span></label>';
						
						$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
						$output .= '<input type="checkbox" id="'.$value['id'].'" class="'.$fold.'checkbox of-input main_checkbox" name="'.$value['id'].'"  value="1" '. checked($ish_options[$value['id']], 1, false) .' />';
						
					$output .= '</p>';
					
				break;

                // Added by IshYoBoy
                // Theme Update Checker
                case 'theme_update':

					$xml = Options_Machine::ishyoboy_get_updates();
                    $my_theme = wp_get_theme(THEME_SLUG);

                    $output .= '<div class="update-box">';
                    $output .= '<div class="instructions">' . "\n";

                    $my_version = ( '' != $my_theme->Version ) ? $my_theme->Version : '1.0';

                    if ( isset($xml->latest) && version_compare( $my_version, $xml->latest ) == -1 ){

                        /* THEMEFOREST
                        $output .= '<div class="ish-update">';
                        $output .= '<p><strong>' . __('New version available!', 'ishyoboy') . '</strong><br />' . __('Please go to your ThemeForest account, download the latest theme update and follow the update instructions within the documentation.', 'ishyoboy') . '</p>';
                        $output .= '<a href="http://themeforest.net/downloads?ref=IshYoBoy" class="button-primary" target="_blank">' . __('Download from ThemeForest', 'ishyoboy') . '</a><br /></div><br /><br />';
                        $output .= '</div>';*/

	                    /* OTHER MARKETPLACES */
	                    $output .= '<div class="ish-update">';
                        $output .= '<p><strong>' . __('New version available!', 'ishyoboy') . '</strong><br />' . __('Please download again the theme from the site you have purchased it from and follow the update instructions in the documentation.', 'ishyoboy') . '</p>';
                        //$output .= '<a href="http://themeforest.net/downloads?ref=IshYoBoy" class="button-primary" target="_blank">' . __('Download from ThemeForest', 'ishyoboy') . '</a><br /></div><br /><br />';
                        $output .= '</div><br /><br />';
                        $output .= '</div>';

                    }
                    else{
                        $output .= '<div class="ish-no-update"><p><strong>' . __('You have the latest theme version! Well done!', 'ishyoboy') . '</strong></p></div></div><br />';
                    }


                    if ( isset($xml->changelog) ){
                        $output .= '<div class="update-log">';
                        $output .= '<h4>' . __( 'Changelog:', 'ishyoboy' ) . '</h4>';

                        $changelogs = $xml->changelog;
                        $older_versions_printed = false;
                        foreach ($changelogs as $changelog) {
                            $atts = $changelog->attributes();

                            if ( isset($atts['version']) &&  ( version_compare( $my_version, $atts['version']) == -1 ) ){
                                $output .= $changelog;
                            }
                            else{
                                if (!$older_versions_printed){
                                    $older_versions_printed = true;
                                    $output .= '<p><a href="#" class="button" onclick="jQuery(\'.ish-older-versions\').show(); return false;">' . __('View older versions', 'ishyoboy') . '</a></p>';
                                    $output .= '<div class="ish-older-versions">';
                                }
                                $output .= $changelog;
                            }
                        }

                        if ($older_versions_printed){
                            $output .= '</div>';
                        }

                        $output .= '</div>';
                    }
                    $output .= '</div>';
                    break;

				// Added by IshYoBoy
                // Theme Update Checker
                case 'demo_import':

				$xml = Options_Machine::ishyoboy_get_updates();
				$my_theme = wp_get_theme(THEME_SLUG);

				$nonce	 = 	wp_create_nonce ('ishyoboy_demo_import_nonce');

				$output .= '<div class="import-box">';
				$output .= '<input type="hidden" name="ishyoboy-demo-import-nonce" value="' . $nonce . '" />';
				$output .= '<p>' . __( 'Import the demo content as seen on the live page, containing all Pages, Posts, Widgets, Menus, etc.. Starting the import process more than once is not recommended. You should use the standard WordPress Importer instead.', 'ishyoboy') . '</p><br>';
				$output .= '<h3 class="heading">' . __( 'Before the import', 'ishyoboy') . '</h3>';
				$output .= '<p>' . __( 'Make sure all necessary plugins are installed and active otherwise their data will not be imported!', 'ishyoboy') . '</p>';

				$active = is_plugin_active('ishyoboy-' . THEME_SLUG . '-assets/ishyoboy-' . THEME_SLUG . '-assets.php');
				$plugin_status = ( $active ) ? '<span class="ish-active">' . __( 'Active', 'ishyoboy' ) . '</span>' : '<span class="ish-inactive">' . __( 'Inactive', 'ishyoboy' ) . '</span>';
				$output .= '<p>1. ' . $plugin_status . ' - ';
				$output .= 'IshYoBoy ' . ucfirst(THEME_SLUG) . ' Assets' . ' - ' . __( ' imports Protfolio', 'ishyoboy' );
				if ( ! $active ){
					$output .=	' ' . '(';
					$output .='<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '">' . __( 'Install', 'ishyoboy' ) . '</a>';
					$output .= '/';
					$output .='<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '">' . __( 'Activate', 'ishyoboy' ) . '</a>';
					$output .= ')';
				}
				$output .= '</p>';

				$active = is_plugin_active('contact-form-7/wp-contact-form-7.php');
				$plugin_status = ( $active ) ? '<span class="ish-active">' . __( 'Active', 'ishyoboy' ) . '</span>' : '<span class="ish-inactive">' . __( 'Inactive', 'ishyoboy' ) . '</span>';
				$output .= '<p>2. ' . $plugin_status . ' - ' . __( 'Contact Form 7', 'ishyoboy') . ' - ' . __( ' imports Contact Forms', 'ishyoboy' );
				if ( ! $active ){
					$output .=	' ' . '(';
					$output .='<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '">' . __( 'Install', 'ishyoboy' ) . '</a>';
					$output .= '/';
					$output .='<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '">' . __( 'Activate', 'ishyoboy' ) . '</a>';
					$output .= ')';
				}
				$output .= '</p>';

				$active = is_plugin_active('woocommerce/woocommerce.php');
				$plugin_status = ( $active ) ? '<span class="ish-active">' . __( 'Active', 'ishyoboy' ) . '</span>' : '<span class="ish-inactive">' . __( 'Inactive', 'ishyoboy' ) . '</span>';
				$output .= '<p>3. ' . $plugin_status . ' - ' . __( 'WooCommerce (optional)', 'ishyoboy') . ' - ' . __( ' imports Products', 'ishyoboy' );
				if ( ! $active ){
					$output .=	' ' . '(';
					$output .='<a href="' . admin_url( 'plugin-install.php?tab=search&s=woocommerce&plugin-search-input=Search+Pluginss' ) . '">' . __( 'Install', 'ishyoboy' ) . '</a>';
					$output .= '/';
					$output .='<a href="' . admin_url( 'plugins.php' ) . '">' . __( 'Activate', 'ishyoboy' ) . '</a>';
					$output .= ')';
				}
				$output .= '</p>';
				$output .= '<br>';

				$output .= '<div class="import-cta-holder"><a href="#" id="run_import" class="button-primary">Import Demo Content</a></div>';
				$output .= '<div class="import-started-message">' .
					'<h3 class="heading">' . __( 'Import started...') . '</h3>' .
					'<div class="ish-preloader-holder"><span class="ish-preloader"></span></div>' .
					'<p>' . __( 'The import might take up to few minutes. Please, be patient and do not reload the page. You will be notified once the import has finished.', 'ishyoboy' ) . '</p>' .
					'</div>';
				$output .= '<div class="import-error-holder">' .
					'<h3 class="heading">' . __( 'Import Error!') . '</h3>' .
					'<p>' . __( 'An error occurred during the import process.', 'ishyoboy' ) . '</p>' .
					'<div class="import-error-message"></div>' .
					'</div>';
				$output .= '<div class="import-success-holder">' .
					'<h3 class="heading">' . __( 'All Done. Have Fun!', 'ishyoboy' ) . '</h3>' .
					'<p>' . __( 'Remember to update the passwords and roles of imported users.', 'ishyoboy' ) . '</p>' .
					'<div class="import-success-message"></div>' .
					'</div>';
				$output .= '</div>';
				break;


			}


			
			//description of each option
			if ( $value['type'] != 'heading') { 
				if(!isset($value['desc'])){ $explain_value = ''; } else{ 
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
				} 
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
				}
		   
		}
		
	    $output .= '</div>';
	    
	    return array($output,$menu,$defaults);
	    
	}


	/**
	 * Ajax image uploader - supports various types of image types
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_uploader_function($id,$std,$mod){

	    //$data = of_get_options();
	    //$ish_options = of_get_options();
        global $ish_options;
		
		$uploader = '';
	    $upload = ( isset( $ish_options[$id] ) ? $ish_options[$id] : '' );
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
	    $uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload)){
			$uploader .= '<div class="screenshot">';
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';
			$uploader .= '</div>';
			}
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
	
	}


	/**
	 * Native media library uploader
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$mod){

		global $ish_options;

		$uploader = '';
		$upload = isset( $ish_options[$id] ) ? $ish_options[$id] : '';
		$hide = '';

		if ($mod == "min") {$hide ='hide';}

		if ( $upload != "") { $val = $upload; } else {$val = $std;}

		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';

		//Upload controls DIV
		$uploader .= '<div class="upload_button_div">';
		//If the user has WP3.5+ show upload/remove button
		if ( function_exists( 'wp_enqueue_media' ) ) {
			$uploader .= '<span class="button media_upload_button" id="'.$id.'">Upload</span>';

			if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
			$uploader .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		}
		else
		{
			$uploader .= '<p class="upload-notice"><i>Upgrade your version of WordPress for full media support.</i></p>';
		}

		$uploader .='</div>' . "\n";

		//Preview
		$uploader .= '<div class="screenshot">';
		if(!empty($upload)){
			$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
			$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
			$uploader .= '</a>';
		}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n";

		return $uploader;

	}

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order){

		//$data = of_get_options();
		//$ish_options = of_get_options();
		global $ish_options;

		$slider = '';
		$slide = array();
		$slide = ( isset($ish_options[$id]) ) ? $ish_options[$id] : '';

		if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}

		//initialize all vars
		$slidevars = array('title','url','link','description');

		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}

		//begin slider interface
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>Slide '.$order.'</strong>';
		}

		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';

		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

		$slider .= '<div class="slide_body">';

		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';

		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="upload slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';

		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'">Upload</span>';

		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){

			$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
			$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
			$slider .= '</a>';

		}
		$slider .= '</div>';
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';

		$slider .= '<label>Description (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';

		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
		$slider .= '<div class="clear"></div>' . "\n";

		$slider .= '</div>';
		$slider .= '</li>';

		return $slider;

	}

    /**
	 * Theme updates - xml downloader
	 *
	 * @access public
	 * @since 1.4.4
	 *
	 * @return string
	 */
    public static function ishyoboy_get_updates() {

        $trans_key = 'ishyoboy_latest_theme_version_' . THEME_SLUG;

        if ( false === ( $cached_xml = get_transient( $trans_key ) ) ){

            $my_theme = wp_get_theme(THEME_SLUG);
            $my_version = ( '' != $my_theme->Version ) ? $my_theme->Version : '1.0';
            $changelog_url = PATH_ISHYOBOY_URL . '/' . THEME_SLUG . '/wp/_stuff/changelog.xml?' . 'version=' . $my_version . '&' . 'wpversion=' . get_bloginfo('version') . '&' . 'r=' . mt_rand() ;

            $xml = wp_remote_get( $changelog_url, array('timeout' => 300) );

			if ( is_array( $xml ) && isset($xml['body']) ){
				$xml = $xml['body'];
			} else{
				$xml = '';
			}

            // Either the loading was successful or not set the cache to avoid slow dashboard loading
            set_transient( $trans_key, $xml, 3600 * 3 ); // Cache for 3 hours
        } else {
            $xml = $cached_xml;
        }

        if(substr($xml, 0, 8) == "<!--?xml") {
            return @simplexml_load_string($xml);
        } else {
            return '';
        }
    }

    /**
     * Theme updates checker
     *
     * @access public
     * @since 1.4.4
     *
     * @return string
     */
    public static function ishyoboy_updates_available() {

		if ( $xml = Options_Machine::ishyoboy_get_updates() ){

            $my_theme = wp_get_theme(THEME_SLUG);
            $my_version = ( '' != $my_theme->Version ) ? $my_theme->Version : '1.0';

            if( version_compare( $my_version, $xml->latest ) == -1 ){
                return true;
            }
        }

        return false;
    }
	
}//end Options Machine class
?>