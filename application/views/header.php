<div class="header row" id="navigation">
	<div class="container">
		<div class="row">  
			<div class="menu col-12">
				<nav class="navbar navbar-expand-lg" style="background-color:white;">
				  <!-- Brand -->
				  <a href="<?php echo base_url(); ?>" class="logo"><i class="icon fab fa-servicestack"></i> BBI Cargo</a>

				  <!-- Toggler/collapsibe Button -->
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<i class="fas fa-bars"></i>
				  </button>

				  <!-- Navbar links -->
				  <div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url().'aboutus'; ?>">About Us</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Services</a>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="<?php echo base_url().'services/air_freight'; ?>">Air Freight</a>
							  <a class="dropdown-item" href="<?php echo base_url().'services/ocean_freight'; ?>">Ocean & Freight</a>
							  <a class="dropdown-item" href="<?php echo base_url().'services/warehouse'; ?>">Warehouse</a>
							  <div class="dropdown-divider"></div>
							  <a class="dropdown-item" href="<?php echo base_url().'services/trucking'; ?>">Trucking</a>
							</div>								
						</li>			
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url().'network'; ?>">Network</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url().'client'; ?>">Clients</a>
						</li>							
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url().'testimonial'; ?>">Testimonials</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url().'contactus'; ?>">Contact Us</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url().'tracking'; ?>">Tracking</a>
						</li>						
						<li class="nav-item">
							<a class="nav-link" href="#">Inquiry</a>
						</li>				
					</ul>
				  </div>
				</nav>
				
			</div>
		</div>
	</div>
</div>