<?php 
/* Template Name: Live Hangout */
get_header(); 
if($_GET['ref'] != '' || $_GET['s1'] != '') {
                if($_GET['ref'] != '') $username = $_GET['ref'];
                else $username = $_GET['s1'];
                $user = get_user_by( 'login', $username );
                $user_id = $user->ID;
                $avatar_img = get_avatar( $user_id, 400 );
            }
            else {
                $args  = array(
                    'role' => 'vip_user'
                );

                $users = get_users( $args );
                $rand_key = array_rand($users, 1);
                $user = $users[$rand_key];
                $username = $user->user_login;
                $user = get_user_by( 'login', $username );
                $user_id = $user->ID;
                $avatar_img = get_avatar( $user_id, 400 );
            }
$mcauser= get_user_meta( $user_id, mca_member, true );
$mcalive= get_user_meta( $user_id, mcalive, true );
?>


<style type="text/css">


#header-sticky .avada-row, #header .avada-row, #main .avada-row, .footer-area .avada-row, #slidingbar-area .avada-row, #footer .avada-row, .page-title, .header-social .avada-row, #small-nav .avada-row, .tfs-slider .slide-content-container .slide-content {
    max-width: 100% !important;
}

#main {
    padding:0px !important;
    background: #fff;
    clear: both;
}
	
	
	
.videoWrapperresp, .videoWrapperwistia, .videoWrapperhangout {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 0px !important;
    height: 0;
}	

</style>



<div id="content" class="full-width" style="background-attachment:scroll;background-image: url(https://mcaprotools.s3-us-west-2.amazonaws.com/wp-content/uploads/2015/04/hangout-bg.png);background-position:center center;background-repeat:no-repeat;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;border-color:#eae9e9;border-bottom-width: 0px;border-top-width: 0px;border-bottom-style: solid;border-top-style: solid;padding-bottom:0px;padding-left:0px;padding-right:0px;padding-top:0px;">
   
				
				
					
						<div id="lp" class="lp-hangout">
							<h1 class="hangout-title" style="margin: 0 auto; width: 80%; text-align: center;">
							<strong>EXPLODE YOUR MCA BUSINESS...</strong>
							</h1>
							<div class="su-row hangout-video">
								<div class="su-column su-column-size-1-1 hangout-video-inner">
									<div class="su-column-inner su-clearfix">
										
										
										<div class="videoWrapperhangout">
										 <?php if(empty($mcalive)){?>
										
										<iframe width="780" height="420" src="https://s3-us-west-2.amazonaws.com/mcaprotools/MCA+Short+Presentation.mp4" frameborder="0" allowfullscreen=""></iframe>
									<?php }else{echo $mcalive;}?>			    
											
											
										</div>
									</div>
								</div>
							</div>
							<div class="su-row hangout-coverage">
								<div class="hangout-comments">
									<div class="col-md-6">
										<div class="su-button-center hangout-coverage-btn"><a href="https://mcaprotools.com/invite/?ref=<?php echo $user->user_login; ?>" target="_blank">GET MCA PRO TOOLS!</a></div>
									</div>
									<div class="col-md-6">
										<div class="su-button-center hangout-question-btn"><a href="https://mcaprotools.com/store/?add-to-cart=3287" target="_blank">GET 6 FIG FORMULA!</a></div>
									</div>
									<div class="clearfix"></div>
									<hr class="mca-hr" style="margin-top: 50px !important;">
									<h2 style="text-align: center; font-size: 24px; margin-top: 50px;">LEAVE YOUR COMMENTS BELOW!</h2>
									<!-- Facebook Comments Plugin for WordPress: https://peadig.com/wordpress-plugins/facebook-comments/ -->
									<div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" data-href="https://mcaprotools.com/hangout/" data-numposts="5" data-width="100%" data-colorscheme="light" fb-xfbml-state="rendered">
										<span style="height: 638px;">
											<iframe id="fa017e31b0cbf4" name="f1b23ce81db1258" scrolling="no" title="Facebook Social Plugin" class="fb_ltr fb_iframe_widget_lift" src="https://www.facebook.com/plugins/comments.php?api_key=1426723247632845&amp;channel_url=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FSh-3BhStODe.js%3Fversion%3D42%23cb%3Df3fc19f010282e4%26domain%3Dmcaprotools.com%26origin%3Dhttps%253A%252F%252Fmcaprotools.com%252Ff441bb2b0d3e18%26relation%3Dparent.parent&amp;colorscheme=light&amp;href=https%3A%2F%2Fmcaprotools.com%2Fhangout%2F&amp;locale=en_US&amp;numposts=5&amp;sdk=joey&amp;skin=light&amp;version=v2.3&amp;width=100%25" style="border: none; overflow: hidden; height: 638px; width: 100%;"></iframe>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
</div>

<?php get_footer(); ?>