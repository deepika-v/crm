<?php 
if($this->session->userdata('logged_in')){
$user_role = $this->session->userdata['logged_in']['user_role']; ?>
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a class="navbar-brand" href="<?php echo base_url('Dashboard');?>"><img src="<?php echo base_url('assets/images/logo2.png');?>"  height="50" /></a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" class="img-circle" src="<?php echo base_url('assets/global/img/default.jpg');?>">
						<span class="username username-hide-mobile"><?php echo $this->session->userdata['logged_in']['username']; ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							
							<li>
								<a href="<?php echo base_url('Login/logout');?>">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div class="container">
			<!-- BEGIN HEADER SEARCH BOX -->
			
			
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?php echo base_url('Dashboard');?>">Dashboard</a>
					</li>
					<?php 
					if($user_role=="1"){?>
						<li class="menu-dropdown mega-menu-dropdown active">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Admin <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
						      <li>
													<a href="<?php echo base_url('Campaign');?>" class="iconify">
													Create Campaign </a>
												</li>
								</li>
								<li>
													<a href="<?php echo base_url('Displaycampaign');?>" class="iconify">
													Display Campaign </a>
												</li>
								</li>
								
							
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown active">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Super Agents <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
                                           <li>
													<a href="<?php echo base_url('Search_contact');?>" class="iconify">
													Search Contacts </a>
												</li>
										    <li>
													<a href="<?php echo base_url('Sendmail');?>" class="iconify">
													Send Email </a>
												</li>	

									<li>
													<a href="<?php echo base_url('Leadassignment');?>" class="iconify">
													Assign Leads </a>
												</li>					
								<li>
													<a href="<?php echo base_url('Leadcreation');?>" class="iconify">
													Create New Lead </a>
												</li>	
									<li>
													<a href="<?php echo base_url('Sendmail/display_grid');?>" class="iconify">
													Mail Status </a>
												</li>				
							    		
								
						
						</ul>
					</li>
					<li class="menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Agents <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
										
												<li>
													<a href="<?php echo base_url('Agent');?>" class="iconify">
													Lead Management </a>
												</li>
											
							
							
						</ul>
					</li>
					</ul>
					</li>

					<?php }
					elseif ($user_role=="2") {?>
						<li class="menu-dropdown mega-menu-dropdown active">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Super Agent <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
						<li>
													<a href="<?php echo base_url('Search_contact');?>" class="iconify">
													Search Contacts </a>
												</li>
						  <li>
													<a href="<?php echo base_url('Leadassignment');?>" class="iconify">
													Assign Leads </a>
												</li>
						    	<li>
													<a href="<?php echo base_url('Sendmail');?>" class="iconify">
													Send Email </a>
												</li>						
						    	<li>
													<a href="<?php echo base_url('Leadcreation');?>" class="iconify">
													Create New Lead </a>
												</li>
								<li>
													<a href="<?php echo base_url('Displaycampaign');?>" class="iconify">
													Display Campaign </a>
												</li>
								</li>	
								<li>
													<a href="<?php echo base_url('Sendmail/display_grid');?>" class="iconify">
													 Mail Status </a>
												</li>
								</li>			
																	
							  		
								 
																				
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown active">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Agents <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
						<li>
						<a href="<?php echo base_url('Agent');?>" class="iconify">
													Lead Management </a>
						</li>
						
						</ul>
					</li>
					</ul>
					</li>
					<?php }
					elseif ($user_role=="3") {?>
						<li class="menu-dropdown mega-menu-dropdown active">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Agent <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
								<li>
													<a href="<?php echo base_url('Agent');?>" class="iconify">
													Lead Management </a>
												</li>
						</ul>
					</li>
				
					</ul>
					</li>
					<?php }


					?>
					
					
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<?php }
?>