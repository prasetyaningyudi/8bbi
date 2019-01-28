  <body class="nav-md full-width">
    <div class="container body">
      <div class="main_container">
	  
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
			<?php
				$app_name = '';
				$app_icon = '';
				if(!empty($app_data)){
					foreach($app_data as $value) {
						$app_name = $value->NAME;
						$app_icon = $value->ICON;
					}
				}
			?>
              <a href="<?php echo base_url(); ?>" class="site_title">
				<?php if ($app_icon != ''): ?>
					<?php echo '<i class="fa fa-'.$app_icon.'"></i>'; ?>
				<?php else: ?> 
					<i class="fa fa-home"></i> 
				<?php endif; ?>
				<?php if ($app_name != ''): ?>
					<span><?php echo $app_name; ?></span>  
				<?php else: ?> 
					<span>Reporting 1.0</span>
				<?php endif; ?>			  
			  </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
				<?php if($this->session->PHOTO != null or $this->session->PHOTO != ''): ?>
					<img src="<?php echo $this->session->PHOTO; ?>" alt="Photo profile" class="img-circle profile_img">
				<?php else: ?>
					<img src="<?php echo base_url(); ?>assets/images/avatar.png" alt="Photo profile" class="img-circle profile_img">
				<?php endif; ?>			  
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
				<?php if(isset($this->session->userdata['is_logged_in'])): ?>
					<h2><?php echo $this->session->USERNAME; ?></h2>
				<?php else: ?>
					<h2><?php echo 'User'; ?></h2>
				<?php endif; ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">			  
              <div class="menu_section">

              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <i class="fa fa-cog"></i>
              </a>
              <a href="#!" onclick="javascript:toggleFullScreen()" data-toggle="tooltip" data-placement="top" title="FullScreen">
                <i class="fa fa-arrows-alt"></i>
              </a>                            
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <i class="fa fa-lock"></i>
              </a>
			  <a data-toggle="tooltip" data-placement="top" title="Login" href="#">
				<i class="fas fa-sign-in-alt"></i>
			  </a>			  
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>