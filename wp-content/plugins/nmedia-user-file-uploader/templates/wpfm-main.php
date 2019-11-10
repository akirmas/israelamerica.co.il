<?php
/**
 * File Manager Main Template to Render Frontend
 * */
 if( ! defined("ABSPATH") ) die("Not Allowed");
?>
<div class="wpfm-wrapper">
	<div id="wpfm-main-wrapper">
		
		<?php
		$terms = get_terms( 'file_groups');
		$is_group_filter_enabled = wpfm_get_option('_file_groups');
		/**
		 * before upload form
		 **/
		 do_action( 'wpfm_before_wrapper' );
		 ?>
			<div class="navbar navbar-default">
				<div class="container-fluid">
			        <form class="navbar-form navbar-right hidden-xs" role="search">
			        	<input type="text" class="form-control" placeholder="Search Files" name="srch-term" id="search_files">
			        </form>
					<ul class="nav navbar-nav navbar-left">
						<?php 
							$wpfm_menu = wpfm_get_top_menu();
							foreach ($wpfm_menu as $menu) { 
								
								?>
								<li class=""><a href="<?php echo esc_url($menu['link']);?>">
									<span class="glyphicon <?php echo esc_attr($menu['icon']);?>"></span> <?php echo $menu['label']; ?></a>
								</li>
								
							<?php }
						 ?>
					</ul>
				</div>
			</div>
		

	<div class="wpfm-body-area">
		<?php $is_disabled_breadcrumbs =  wpfm_get_option('_disable_breadcrumbs'); 
		if ($is_disabled_breadcrumbs != 'yes') { ?>
			
			<ol class="breadcrumb pull-left" id="wpfm-bc">
				<li id="home_bc"><?php _e( "Home", "wpfm"); ?></li>
			</ol>
		<?php } ?>

		<div class="toolbar pull-right">
			<div class="form-inline pull-right hidden-sm hidden-xs" style="margin-left:10px;" >
				<?php if ( $is_group_filter_enabled == 'yes' ) { ?>
					
					<label><?php _e( "Filter by grouped :", "wpfm"); ?></label>
					<select class="form-control" id="group-filter">
						<option value="all"><?php _e( "All","wpfm"); ?></option>
					<?php
						if ( !empty($terms) ) {
							foreach ($terms as $term) { ?>
								<option value="<?php echo $term->slug; ?>"><?php _e( $term->name, "wpfm"); ?></option>
							
					<?php 	}
						}
					 ?>
					</select>
				<?php } ?>
				<label><?php _e( "Sorted by", "wpfm"); ?></label>
				<select class="form-control" id="wpfm_sorted_by">
					<option value="title"><?php _e( "Name","wpfm"); ?></option>
					<option value="fiel_type"><?php _e( "Type", "wpfm"); ?></option>
				</select>
				<div class="radio">
					<label>
						<input type="radio" name="wpfm_sortorder" checked="" value="asc">
						<?php _e( "Ascending", "wpfm"); ?>
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="wpfm_sortorder" value="desc">
						<?php _e( "Descending", "wpfm"); ?> &nbsp;
					</label>
				</div>
			</div>

		</div>

		<!-- Breadcrumbs Area Ends -->
		<div class="clearfix"></div>
		
		<?php
		 if( wpfm_is_upload_form_visible() ):
		?>
		<!-- Upload Area -->
		<div class="wpfm_upload_files_wrapper">
			
			<!-- it will contain all file data input generated by JS -->
			<div id="wpfm_file_loading_wrapper">
			
			</div>
			
			
			<div class="col-sm-12 text-center wpfm_upload_button" id="upload_files_btn_area">
				
				<div class="btn btn-success wpfm-new-select-wrapper" >
					<label for="filechooser" class="filechooser_lebel">
						<?php 
						$select_file_label = wpfm_get_option ( '_button_title' );
					    $select_file_label	= (!$select_file_label == '') ? $select_file_label : 'Select Files';
						printf(__('%s', 'wpfm'), $select_file_label);
						?>
						<input type="file" id="filechooser" multiple accept="<?php echo wpfm_get_file_types(); ?>" />
					</label>
				</div>
				
				<?php if( wpfm_can_user_create_directory() ): ?>
					<button class="btn btn-warning" id="wpfm-create-dir-option-btn"><?php _e( "Create Directory", "wpfm"); ?></button>
				<?php endif; ?>
				
				<?php
				  /**
				   * form nonce 
				   * */
				   wp_nonce_field('wpfm_saving_file','wpfm_save_nonce');
				?>
				<?php if ( isset( $group_ids ) ): ?>
					<input id="shortcode_groups" type="hidden" name="shortcode_groups" value="<?php _e($group_ids, 'wpfm'); ?>">
				<?php endif ?> 
				
				<button class="btn btn-success" id="wpfm-save-file-btn">
						<?php $upload_file_label = wpfm_get_option ( '_upload_title' );
					    $upload_file_label	= (!$upload_file_label == '') ? $upload_file_label : 'Save File';
						printf(__('%s', 'wpfm'), $upload_file_label); ?>
					
				</button>
							
				<div class="form-horizontal wpfm-dir-create-wrapper">
					<div class="form-group">
						<label class="col-sm-offset-3 col-sm-2 control-label" for="wpfm-dirname"><?php _e( "Directory Name", "wpfm" ); ?></label>
						<div class="col-sm-4">
							<input type="text" class="form-control " id="wpfm-dirname">
						</div>
					</div>
					<div class="form-group">

						<label class="col-sm-offset-3 col-sm-2 control-label" for="wpfm-description"><?php _e( "Description", "wpfm" ); ?></label>
						<div class="col-sm-4">
						<input type="text" class="form-control " id="wpfm-description">
						</div>
					</div>
					<div class="form-group">
						
						<button class="btn btn-success " disabled="disabled" id="wpfm-dir-created-btn"><?php _e( "Create", "wpfm" ); ?></button>
						<button class="btn btn-danger wpfm-cancle-btn"><?php _e( "Cancel", "wpfm" ); ?></button>
						
					</div>
				</div>
			</div>
			
		</div>
		<div class="clearfix"></div>
		<?php
		endif;
		?>
		<?php if (wpfm_is_files_area_visible()) { ?>
			
		<!-- here rendered all euser files with jquery -->
		<div id="wpfm-files-wrapper">

		</div>
		<?php  } ?>
		
	</div>
	<style type="text/css">
		td img {
			width : 100px !important;
			height : 100px !important;
		}
		td.first_td, .first_td_nested{
			position: relative;
			text-align: center;
		}
	table.wpfm-files-table tr td.first_td:before ,
	table.wpfm-files-table-nested tr td.first_td_nested:before {
	    top: 9px;
	    left: 4px;
	    height: 14px;
	    width: 14px;
	    display: block;
	    position: absolute;
	    color: white;
	    border: 2px solid white;
	    border-radius: 14px;
	    box-shadow: 0 0 3px #444;
	    box-sizing: content-box;
	    text-align: center;
	    text-indent: 0 !important;
	    font-family: 'Courier New', Courier, monospace;
	    line-height: 14px;
	    content: '+';
	    background-color: #31b131;
	}
	table.wpfm-files-table tr.shown td.first_td:before ,
	table.wpfm-files-table table tr.shown td.first_td_nested:before { 
	    top: 9px;
	    left: 4px;
	    height: 14px;
	    width: 14px;
	    display: block;
	    position: absolute;
	    color: white;
	    border: 2px solid white;
	    border-radius: 14px;
	    box-shadow: 0 0 3px #444;
	    box-sizing: content-box;
	    text-align: center;
	    text-indent: 0 !important;
	    font-family: 'Courier New', Courier, monospace;
	    line-height: 14px;
	    content: '-';
	    background-color: #d33333;
	}
	</style>

	</div> <!-- wpfm-main-wrapper-->
		<?php
		/**
		 * before upload form
		 **/
		 do_action( 'wpfm_after_wrapper' );
		 ?>
	<br><br>

</div>