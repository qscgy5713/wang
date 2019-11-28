<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Clinical a Medical Category Responsive Web Template - Home</title>
  <link rel="stylesheet" href="assets/css/style-starter.css">
</head>
<body>
<!-- hero-header 11 -->
<section class="w3l-hero-headers-11 p-sticky-md">
	<div class="hero-header-11">
		<div class="hero-header-11-content">
			<div class="top-header">
				<div class="wrapper-full">
					<div class="d-grid grid-columns-top-3">
						<div class="accounts">
							<ul>
								<li><a href="#login.html"> Sign In</a></li>
								<li><a class="active-button" href="#signup.html"> Sign Up</a></li>
							</ul>
						</div>
						<div class="search">
							<form action="#search-results.html" method="get">
								<input id="search" name="search" type="text" placeholder="Search.." required="">
								<button type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
							</form>
						</div>
						<div class="menu-overlay-left">
							<!-- overlay-menuv-menu -->
							<div class="overlay-menuv-hny">
								<input type="checkbox" id="op"></input>
								<div class="side-menu-hny">
									<label for="op" class="menuopen">
										<i class="fa fa-bars" aria-hidden="true"></i></label>
								</div>
								<div class="overlay-menuv overlay-menuv-hugeinc">
									<label for="op" class="menuclose"><span class="fa fa-times" aria-hidden="true"></span></label>
									<div class="side-show-content text-left">
										<div class="quick-contact gap-top">
											<h3 class="side-title">Quick Search</h3>
											<div class="side-search">
												<form action="#search-results.html" method="get">
													<input id="search" name="search" type="text" placeholder="Search.." required="">
													<button type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
												</form>
											</div>
										</div>
										<div class="quick-contact gap-top">
											<h3 class="side-title">Quick Contact</h3>
											<ul>
												<li>
													<span class="fa fa-phone" aria-hidden="true"></span>
													<a href="tel:+45 123 456 78">+45 123 456 78 </a>
												</li>
												<li>
													<span class="fa fa-envelope-o" aria-hidden="true"></span>
													<a href="mailto:info@example.com">info@example.com</a></li>
												<li>
													<span class="fa fa-map-marker" aria-hidden="true"></span>
													<p>New york</p>
												</li>
											</ul>
										</div>
										<div class="follow-us gap-top">
											<h3 class="side-title">Follow Us</h3>
											<ul>
												<li><a class="facebook" href="#"><span class="fa fa-facebook" aria-hidden="true"></span></a>
												</li>
												<li><a class="twitter" href="#"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
												<li><a class="google" href="#"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
												</li>
												<li><a class="instagram" href="#"><span class="fa fa-instagram" aria-hidden="true"></span></a>
												</li>
											</ul>
										</div>
										<div class="quick-links-side gap-top">
											<h3 class="side-title">Quick Links</h3>
											<ul>
												<li><a href="index.html">Home</a></li>
												<li><a href="about.html">About Us</a></li>
												<li><a href="contact.html">Contact Us</a></li>
												<li><a href="services.html">Services</a></li>
											</ul>
										</div>
									</div>

								</div>
							</div>
							<!-- //overlay-menuv-menu -->
						</div>
					</div>
				</div>
			</div>
			<div class="main-header">
				<div class="wrapper-full">
					<div class="d-grid grid-columns-auto">
						<div class="right-grid align-left d-grid">
							<div class="quick-links">
								<ul>
									<li>
										<span class="fa fa-phone" aria-hidden="true"></span>
										<a href="tel:+45 123 456 78">+45 123 456 78 </a>
									</li>
									<li>
										<span class="fa fa-envelope-o" aria-hidden="true"></span>
										<a href="mailto:info@example.com">info@example.com</a></li>
									<li>
										<span class="fa fa-map-marker" aria-hidden="true"></span>
										<p>New york</p>
									</li>
								</ul>
							</div>
							<div class="button align-right">
								<a href="#appointment.html" class="actionbg">Make Appointment</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //hero-header 11 -->
<!-- Headers-4 block -->
<section class="w3l-header-4">
  <header id="headers4-block">
      <div class="wrapper-full">
          <div class="d-grid nav-mobile-block header-align">
              <div class="logo">
                  <a class="brand-logo" href="index.html">Clinical</a>
                  <!-- if logo is image enable this   
                          <a class="brand-logo" href="#index.html">
                              <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                          </a> -->
              </div>
              <input type="checkbox" id="nav" />
              <label class="nav" for="nav"></label>
              <nav>
                  <label for="drop" class="toggle nav-height">Menu 
                      <!-- <span class="fa fa-bars"aria-hidden="true"></span> -->
                  </label>
                  <input type="checkbox" id="drop">
                  <ul class="menu">
                      <li><a href="index.html">Home</a></li>
                      <li><a href="about.html">About</a></li>
                      <li><a href="services.html">Services</a></li>
                      <li><a href="contact.html">Contact</a></li>
                  </ul>
              </nav>

          </div>
      </div>
  </header>
</section>
<!-- Headers-4 block -->
<!-- hero-header 11 -->
<section class="w3l-hero-headers-11">
	<div class="hero-header-11">
		<div class="hero-header-11-content">
			<!-- banner -->
			<div id="homepage-slider" class="st-slider">
				<input type="radio" class="cs_anchor radio" name="slider" id="play1" checked="" />
				<input type="radio" class="cs_anchor radio" name="slider" id="slide1" />
				<input type="radio" class="cs_anchor radio" name="slider" id="slide2" />
				<input type="radio" class="cs_anchor radio" name="slider" id="slide3" />
				<div class="images">
					<div class="images-inner">
						<div class="image-slide">
							<div class="banner-w3ls-1">
								<div class="wrapper">
									<div class="slider-num d-grid grid-columns-auto">
										<h4>01<span>/03</span></h4>
										<p>Clinical</p>
									</div>
									<div class="d-grid grid-columns-auto-end">
										<div class="slider-text-w3ls">
											<span>Medical</span>
											<h4>Better health care</h4>
											<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur hic odio voluptatem tenetur consequatur.</p>
											<a href="#single.html" class="action"> Read More </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="image-slide">
							<div class="banner-w3ls-2">
								<div class="wrapper">
									<div class="slider-num d-grid grid-columns-auto">
										<h4>02<span>/03</span></h4>
										<p>Clinical</p>
									</div>
									<div class="d-grid grid-columns-auto-end">
										<div class="slider-text-w3ls">
											<span>Medical</span>
											<h4>Better health care</h4>
											<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur hic odio voluptatem tenetur consequatur.</p>
											<a href="#single.html" class="action"> Read More </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="image-slide">
							<div class="banner-w3ls-3">
								<div class="wrapper">
									<div class="slider-num d-grid grid-columns-auto">
										<h4>03<span>/03</span></h4>
										<p>Clinical</p>
									</div>
									<div class="d-grid grid-columns-auto-end">
										<div class="slider-text-w3ls">
											<span>Medical</span>
											<h4>Better health care</h4>
											<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur hic odio voluptatem tenetur consequatur.</p>
											<a href="#single.html" class="action"> Read More </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="labels">
					<div class="fake-radio">
						<label for="slide1" class="radio-btn"></label>
						<label for="slide2" class="radio-btn"></label>
						<label for="slide3" class="radio-btn"></label>
					</div>
				</div>
			</div>
			<!-- //banner -->
		</div>
	</div>
</section>
<!-- //hero-header 11 -->

 <!-- call-to-action-17 -->
 <section class="w3l-call-to-action-17_sur">
	<div class="call-to-action17_sur section-gap">
		<div class="wrapper">
			<div class="action-top_sur">
               <div class="action17-top-left_sur">
					<img src="assets/images/scope.jpg" class="img" alt="">
				</div>
                <div class="action17-top-right_sur">
					<input id="tab1" type="radio" name="tabs" checked>
					<label class="tabtle" for="tab1">Cardiology</label>
					<input id="tab2" type="radio" name="tabs">
					<label class="tabtle" for="tab2">Neurology</label>
					<input id="tab3" type="radio" name="tabs">
					<label class="tabtle" for="tab3">Dental care</label>
					<section id="content1" class="tab-content">
						<div class="call-action_17">
							<h3>A cardiac surgeon opens the chest and performs heart surgery</h3>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, assumenda. Suscipit, eveniet.</p>
							<a href="#single.html" class="diff-btn btn">Read More</a>
						</div>  
					</section>
					<section id="content2" class="tab-content">
						<div class="call-action_17">
							<h3>A doctor who specializes in neurology is called a neurologist</h3>
							<p>It is a long established fact that a reader will be distracted by the readable content of a page when its layout.</p>
							<a href="#single.html" class="diff-btn btn">Read More</a>
						</div>  
					</section>
					<section id="content3" class="tab-content">
						<div class="call-action_17">
							<h3>A dentist, also known as a dental surgeon, is a surgeon</h3>
							<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece.</p>
							<a href="#single.html" class="diff-btn btn">Read More</a>
						</div>  
					</section>
				</div>
			</div>
        </div>
	</div>
</section>
<!-- features-17 -->
<section class="w3l-features-17">
	<div class="features-17_sur section-gap">
		<div class="wrapper">
			<div class="section-title text-center">
				<h4>Why Choose us</h4>
				<p class="sub-paragraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum labore sed, veniam nisi
					sunt laboriosam ducimus, odio aspernatur fugiat minima blanditiis dignissimos.</p>
			</div>
			<div class="features-17-top_sur">
				<div class="features-17-left_sur">
					<h2>Your health is our priority</h2>
					<a href="#popup">Short video</a>

					<!-- /popup -->
					<div id="popup" class="pop-overlay">
						<div class="popup">
							<iframe src="https://www.youtube.com/embed/Z9-NFrckvHk" allowfullscreen></iframe>
							<a class="close" href="#portfolio">&times;</a>
						</div>
					</div>
					<!-- //Popup -->
				</div>
				<div class="features-17-right_sur">
					<div class="features-17-right-tp_sur">
						<h5><a href="#single.html">98% Success Rate</a></h5>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa id. Delectus doloremque cupiditate asperiores.</p>
					</div>
					<div class="features-17-right-tp_sur">
						<h5><a href="#single.html">Professional Staff</a></h5>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa id. Delectus doloremque cupiditate asperiores.</p>
					</div>
					<div class="features-17-right-tp_sur">
						<h5><a href="#single.html">Experienced Doctors</a></h5>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa id. Delectus doloremque cupiditate asperiores.</p>
					</div>
					<div class="features-17-right-tp_sur">
						<h5><a href="#single.html">24/7 Emergency Care</a></h5>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, culpa id. Delectus doloremque cupiditate asperiores.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /features-17 -->
<!-- features-4 -->
<section class="w3l-features-4">
    <div id="features4-block" class="section-gap">
        <div class="wrapper">
         <div class="section-title align-center text-center">
                <h4>Our Departments</h4>
                <p class="sub-paragraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum labore sed, veniam nisi sunt laboriosam ducimus, odio aspernatur fugiat minima blanditiis dignissimos.</p>
            </div>
            <div class="features4-grids text-center">
                <div class="features4-grid">
                    <div class="feature-icon">
                        <span class="fa fa-user-md" aria-hidden="true"></span>
                    </div>
                    <h5><a href="#portfolio-single.html">Body Surgery</a></h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut quidem soluta quas vel. Harum esse eligendi ducimus tempora placeat consectetur ab quasi tenetur aliquam. Quaerat cupiditate consectetur.</p>
                    <a href="#portfolio-single.html" class="gomore">Read More</a>
                </div>
                <div class="features4-grid">
                    <div class="feature-icon">
                        <span class="fa fa-heartbeat" aria-hidden="true"></span>
                    </div>
                    <h5><a href="#portfolio-single.html">Dental Care</a></h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut quidem soluta quas vel. Harum esse eligendi ducimus tempora placeat consectetur ab quasi tenetur aliquam. Quaerat cupiditate consectetur.</p>
                    <a href="#portfolio-single.html" class="gomore">Read More</a>
                </div>
                <div class="features4-grid">
                    <div class="feature-icon">
                        <span class="fa fa-plus-square" aria-hidden="true"></span>
                    </div>
                    <h5><a href="#portfolio-single.html">Eye Care</a></h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut quidem soluta quas vel. Harum esse eligendi ducimus tempora placeat consectetur ab quasi tenetur aliquam. Quaerat cupiditate consectetur.</p>
                    <a href="#portfolio-single.html" class="gomore">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- features-4 -->

<!-- teams 27 block -->
<section class="w3l-teams-27">
    <div class="teams27 section-gap">
        <div class="wrapper">
            <div class="section-title text-center">
                <h4>Meet our team</h4>
                <p class="sub-paragraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum labore sed, veniam nisi sunt laboriosam ducimus, odio aspernatur fugiat minima blanditiis dignissimos.</p>
            </div>
            <div class="d-grid grid-col-2 main-contteam-28">
                <div class="team-main-19">
                    <div class="column-19">
                        <a href="#team-single.html"><img class="image-fluid" src="assets/images/team1.jpg" alt=" "></a>
                    </div>
                    <div class="right-team-9">
                        <div class="teams-info">
                            <h6><a href="#team-single.html" class="title-team-28">Mark Hyman</a></h6>
                            <p class="sm-text-28">Cosmetic Surgeon</p>
                            <p class="sub-paragraph midd-para-team">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis omnis neque magnam illum ducimus blanditiis.</p>
                            <div class="buttons-teams">
                                <a href="#facebook" title="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
                                <a href="#instagram" title="instagram"><span class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#twitter" title="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-main-19">
                    <div class="column-19">
                        <a href="#team-single.html"><img class="image-fluid" src="assets/images/team3.jpg" alt=" "></a>
                    </div>
                    <div class="right-team-9">
                        <div class="teams-info">
                            <h6><a href="#team-single.html" class="title-team-28">Leana Wen</a></h6>
                            <p class="sm-text-28">Dental Surgeon</p>
                            <p class="sub-paragraph midd-para-team">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis omnis neque magnam illum ducimus blanditiis.</p>
                            <div class="buttons-teams">
                                <a href="#facebook" title="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
                                <a href="#twitter" title="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-main-19">
                    <div class="column-19">
                        <a href="#team-single.html"><img class="image-fluid" src="assets/images/team4.jpg" alt=" "></a>
                    </div>
                    <div class="right-team-9">
                        <div class="teams-info">
                            <h6><a href="#team-single.html" class="title-team-28">Maria Santos</a></h6>
                            <p class="sm-text-28">Cardiologist</p>
                            <p class="sub-paragraph midd-para-team">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis omnis neque magnam illum ducimus blanditiis.</p>
                            <div class="buttons-teams">
                                    <a href="#facebook" title="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
                                    <a href="#instagram" title="instagram"><span class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#twitter" title="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-main-19">
                    <div class="column-19">
                        <a href="#team-single.html"><img class="image-fluid" src="assets/images/team2.jpg" alt=" "></a>
                    </div>
                    <div class="right-team-9">
                        <div class="teams-info">
                            <h6><a href="#team-single.html" class="title-team-28">Paul P.Smith</a></h6>
                            <p class="sm-text-28">Neurology</p>
                            <p class="sub-paragraph midd-para-team">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis omnis neque magnam illum ducimus blanditiis.</p>
                            <div class="buttons-teams">
                                <a href="#facebook" title="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
                                <a href="#twitter" title="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
    <!-- //teams 27 block -->
<!-- customers4 block -->
<section class="w3l-customers-4">
  <div id="customers4-block" class="section-gap">
    <div class="wrapper">
        <div class="section-title align-center text-center">
            <h4>Testimonials</h4>
            <p class="sub-paragraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum labore sed, veniam nisi sunt laboriosam ducimus, odio aspernatur fugiat minima blanditiis dignissimos.</p>
        </div>
      <div id="mixedSlider">
        <div class="MS-content">
          <div class="item">
            <div class="imgTitle">
              <img src="assets/images/patient1.jpg" alt="" />
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eius culpa dicta asperiores odit, reiciendis commodi id a hic suscipit odio voluptatem ullam? Sit ut eos quae! Quidem, nisi nesciunt.</p>
            <h6>Abigail</h6>
            <span>Lead Designer</span>
          </div>
          <div class="item">
            <div class="imgTitle">
              <img src="assets/images/patient2.jpg" alt="" />
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eius culpa dicta asperiores odit, reiciendis commodi id a hic suscipit odio voluptatem ullam? Sit ut eos quae! Quidem, nisi nesciunt.</p>
            <h6>Charlotte</h6>
            <span>Head of Support</span>
          </div>
          <div class="item">
            <div class="imgTitle">
              <img src="assets/images/patient3.jpg" alt="" />
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eius culpa dicta asperiores odit, reiciendis commodi id a hic suscipit odio voluptatem ullam? Sit ut eos quae! Quidem, nisi nesciunt.</p>
            <h6>Benjamin Jin</h6>
            <span>Founder, CEO</span>
          </div>
          <div class="item">
            <div class="imgTitle">
              <img src="assets/images/patient4.jpg" alt="" />
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eius culpa dicta asperiores odit, reiciendis commodi id a hic suscipit odio voluptatem ullam? Sit ut eos quae! Quidem, nisi nesciunt.</p>
            <h6>Edward</h6>
            <span>Team Leader</span>
          </div>
          <div class="item">
            <div class="imgTitle">
              <img src="assets/images/patient5.jpg" alt="" />
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, eius culpa dicta asperiores odit, reiciendis commodi id a hic suscipit odio voluptatem ullam? Sit ut eos quae! Quidem, nisi nesciunt.</p>
            <h6>Christoper</h6>
            <span>Asst. Manager</span>
          </div>

        </div>
        <div class="MS-controls">
          <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
          <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

 <div class="w3l-grids-block-5">
 <!-- grids block 5 -->
 <section id="grids5-block" class="section-gap">
	<div class="wrapper">		
			<div class="section-title align-center text-center">
					<h4>Recent News</h4>
					<p class="sub-paragraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum labore sed, veniam nisi sunt laboriosam ducimus, odio aspernatur fugiat minima blanditiis dignissimos.</p>
			</div>
			<div class="d-grid">
				<div class="grids5-info">
					<a href="#blog-single.html"><img src="assets/images/news1.jpg" alt="" /></a>
					<h5>Medical</h5>
					<ul class="info">
						<li><span class="fa fa-calendar-o" aria-hidden="true"></span>3rd Oct 2019</li>
						<li><span class="fa fa-user-o" aria-hidden="true"></span>Admin</li>
				</ul>
					<h4><a href="#blog-single.html">News post title</a></h4>
					<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint commodi cumque nulla deleniti voluptas tempore optio quasi. Exercitationem doloremque nobis, pariatur amet libero optio quo...</p>
					<a href="#blog-single.html" class="gomore">Read More</a>
				</div>
				<div class="grids5-info">
					<a href="#blog-single.html"><img src="assets/images/news2.jpg" alt="" /></a>
					<h5>Medical</h5>
					<ul class="info">
						<li><span class="fa fa-calendar-o" aria-hidden="true"></span>3rd Oct 2019</li>
						<li><span class="fa fa-user-o" aria-hidden="true"></span>Admin</li>
				</ul>
					<h4><a href="#blog-single.html">News post title</a></h4>
					<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint commodi cumque nulla deleniti voluptas tempore optio quasi. Exercitationem doloremque nobis, pariatur amet libero optio quo...</p>
					<a href="#blog-single.html" class="gomore">Read More</a>
				</div>
				<div class="grids5-info">
					<a href="#blog-single.html"><img src="assets/images/news3.jpg" alt="" /></a>
					<h5>Medical</h5>
					<ul class="info">
						<li><span class="fa fa-calendar-o" aria-hidden="true"></span>3rd Oct 2019</li>
						<li><span class="fa fa-user-o" aria-hidden="true"></span>Admin</li>
				</ul>
					<h4><a href="#blog-single.html">News post title</a></h4>
					<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint commodi cumque nulla deleniti voluptas tempore optio quasi. Exercitationem doloremque nobis, pariatur amet libero optio quo...</p>
					<a href="#blog-single.html" class="gomore">Read More</a>
				</div>
			</div>
		</div>
	</div>
<!-- // grids block 5 -->



<section class="w3l-form-25">
       <!-- /form-25-section -->
         <div class="form-25-mian section-gap">
			<div class="wrapper">
			<div class="form-inner-cont">
					<div class="forms-25-info">
						<h5>Lets Stay In Touch</h5>
                        <h3>Join us for FREE to get instant email updates!</h3>
                        <p>Enter your email below to stay updated on our site updates and news</p>
                    </div>
					<div class="form-right-inf">						
							<form action="#" method="post" class="signin-form">	
							 <div class="forms-gds">
								<div  class="form-input">
									<input type="text" name="" placeholder="Name" />
								</div>
								<div  class="form-input">
									<input type="email" name="" placeholder="Email" required />
								</div>
								<div  class="form-input"><button class="btn">Submit</button></div>
							</div>
								<p class="action-link">Subscribe to our free weekly newsletter for new update releases (no spam)</p>
								
							</form>
						
                    </div>
                </div>
            </div>
		    </div>
		</section>
      <!-- //form-25-section -->
 	

<footer>
  <!-- footer-28 block -->
  <section class="w3l-footer-28-main">
    <div class="footer-28 section-gap">
      <div class="wrapper">
        <div class="d-grid grid-col-4 footer-top-28">
          <div class="footer-list-28">
            <h6 class="footer-title-28">Menu Links</h6>
            <ul>
              <li><a href="about.html">About</a></li>
              <li><a href="services.html">Services</a></li>
              <li><a href="#portfolio.html">Portfolio</a></li>
              <li><a href="#team.html">Team</a></li>
            </ul>
          </div>
          <div class="footer-list-28">
            <ul>
              <h6 class="footer-title-28">Website Links</h6>
              <li><a href="#blog.html">Blog</a></li>
              <li><a href="#blog-single.html">Blog Details</a></li>
              <li><a href="#email-template.html">Email Template</a></li>
              <li><a href="#timeline.html">Timeline</a></li>
              <li><a href="#error.html">404</a></li>
              <li><a href="#coming-soon.html">Coming Soon</a></li>
            </ul>
          </div>
          <div class="footer-list-28">
            <ul>
              <h6 class="footer-title-28">Shopping</h6>
              <li><a href="#ecommerce.html">Ecommerce</a></li>
              <li><a href="#ecommerce-single.html">Ecommerce Single</a></li>
              <li><a href="#ecommerce-cart.html">Ecommerce Cart</a></li>
            </ul>
          </div>
          <div class="footer-list-28">
            <ul>
              <h6 class="footer-title-28">Account</h6>
              <li><a href="contact.html">Contact Us</a></li>
              <li><a href="#appointment.html">Book Appointment</a></li>
              <li><a href="#login.html">Login</a></li>
              <li><a href="#signup.html">Register</a></li>
            </ul>
          </div>
        </div>
        <div class="midd-footer-28 align-center">
          <div class="main-social-footer-28">
            <a class="facebook" href="#facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
            <a class="twitter" href="#twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
            <a class="instagram" href="#instagram"><span class="fa fa-instagram" aria-hidden="true"></span></a>
            <a class="google" href="#google"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
            <a class="pinterest" href="#pinterest"><span class="fa fa-pinterest-p" aria-hidden="true"></span></a>
          </div>
          <p class="copy-footer-28">&copy; 2019 Clinical. All rights reserved. Design by <a
              href="https://w3layouts.com">W3layouts</a></p>
        </div>
      </div>
    </div>
    <!-- //footer-28 block -->
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
      <span class="fa fa-arrow-up" aria-hidden="true"></span>
    </button>
    <script>
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function () {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("movetop").style.display = "block";
        } else {
          document.getElementById("movetop").style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <!-- /move top -->

  </section>
</footer>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/multislider.js"></script>
<script>
  $('#basicSlider').multislider({
    continuous: true,
    duration: 2000
  });
  $('#mixedSlider').multislider({
    duration: 800,
    interval: 3000
  });
</script>
</body>

</html>