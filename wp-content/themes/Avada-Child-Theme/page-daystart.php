<?php
/* Template Name: Day Start Page */
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
$mcapushct4= get_user_meta( $user_id, pushstartsystemwcountdown4min, true );
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

	$content_css = '';
	$sidebar_css = '';
	$sidebar_exists = true;
	$sidebar_left = '';
	$double_sidebars = false;

	$sidebar_1 = get_post_meta( $post->ID, 'sbg_selected_sidebar_replacement', true );

	$sidebar_2 = get_post_meta( $post->ID, 'sbg_selected_sidebar_2_replacement', true );

	if( $smof_data['pages_global_sidebar']  || ( class_exists( 'TribeEvents' ) &&  is_events_archive() ) ) {
		if( $smof_data['pages_sidebar'] != 'None' ) {
			$sidebar_1 = array( $smof_data['pages_sidebar'] );
		} else {
			$sidebar_1 = '';
		}
		if( $smof_data['pages_sidebar_2'] != 'None' ) {
			$sidebar_2 = array( $smof_data['pages_sidebar_2'] );
		} else {
			$sidebar_2 = '';
		}
	}
	if( ( is_array( $sidebar_1 ) && ( $sidebar_1[0] || $sidebar_1[0] === '0' ) ) && ( is_array( $sidebar_2 ) && ( $sidebar_2[0] || $sidebar_2[0] === '0' ) ) ) {
		$double_sidebars = true;
	}
	if( is_array( $sidebar_1 ) &&
		( $sidebar_1[0] || $sidebar_1[0] === '0' )
	) {
		$sidebar_exists = true;
	} else {
		$sidebar_exists = false;
	}
	if( ! $sidebar_exists ) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
		$sidebar_left = 1;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default' || ! metadata_exists( 'post', $post->ID, 'pyre_sidebar_position' )) {
		if($smof_data['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
			$sidebar_left = 1;
		} elseif($smof_data['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
			$sidebar_left = 2;
		}
	}
	if(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$sidebar_left = 2;
	}
	if( $smof_data['pages_global_sidebar']  || ( class_exists( 'TribeEvents' ) &&  is_events_archive() ) ) {
		if( $smof_data['pages_sidebar'] != 'None' ) {
			$sidebar_1 = $smof_data['pages_sidebar'];
			if( $smof_data['default_sidebar_pos'] == 'Right' ) {
				$content_css = 'float:left;';
				$sidebar_css = 'float:right;';
				$sidebar_left = 2;
			} else {
				$content_css = 'float:right;';
				$sidebar_css = 'float:left;';
				$sidebar_left = 1;
			}
		}
		if( $smof_data['pages_sidebar_2'] != 'None' ) {
			$sidebar_2 = $smof_data['pages_sidebar_2'];
		}
		if( $smof_data['pages_sidebar'] != 'None' && $smof_data['pages_sidebar_2'] != 'None' ) {
			$double_sidebars = true;
		}
	} else {
		$sidebar_1 = '0';
		$sidebar_2 = '0';
	}
	if($double_sidebars == true) {
		$content_css = 'float:left;';
		$sidebar_css = 'float:left;';
		$sidebar_2_css = 'float:left;';
	} else {
		$sidebar_left = 1;
	}
	if(class_exists('Woocommerce')) {
		if(is_cart() || is_checkout() || is_account_page() || (get_option('woocommerce_thanks_page_id') && is_page(get_option('woocommerce_thanks_page_id')))) {
			$content_css = 'width:100%';
			$sidebar_css = 'display:none';
			$sidebar_exists = false;
		}
	}
	?>



  <style type="text/css">

  .content-daystart-box {
    background-color: #fff;
    padding: 40px;
    margin: 0 auto;
    width: 80%;
  }

  .daystart-page-title {
    font-size: 36px;
    font-weight: 700;
    margin-top: 0px;
    margin-bottom: 0px;
  }

  .daystart-page-subtitle {
    font-size: 28px;
    font-weight: 700;
    margin-top: 0px;
    margin-bottom: 0px;
  }

  .daystart-page-buy-button {
    margin-bottom: 0px;
  }


  .videoWrapper {
  	position: relative;
  	padding-bottom: 56.25%; /* 16:9 */
  	padding-top: 25px;
  	height: 0;
  }

  .videoWrapper iframe {
  	position: absolute;
  	top: 0;
  	left: 0;
  	width: 100%;
  	height: 100%;
  }

    .landing-page-buy-button {
      margin-bottom: 0px;
    }

    .video-container {
      position: relative;
      padding-bottom: 52%;
      padding-top: 30px;
      height: 0;
      overflow: hidden;
  }

  .video-container iframe,
  .video-container object,
  .video-container embed {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  }

  @media screen and (max-width: 700px){

    .content-daystart-box {
      background-color: #fff;
      padding: 20px;
      margin: 0 auto;
      width: 100%;
    }

    .daystart-page-title {
      font-size: 29px;
      font-weight: 700;
      line-height: 35px;
      margin-top: 0px;
      margin-bottom: 15px;
  }

  .daystart-page-subtitle {
  font-size: 24px;
  font-weight: 700;
  margin-top: 0px;
  margin-bottom: 0px;
}

    .video-container {
      position: relative;
      padding-bottom: 47%;
      padding-top: 30px;
      height: 0;
      overflow: hidden;
  }
  }

  </style>




	<div id="content" style="<?php echo $content_css; ?>">
		<?php if(have_posts()): the_post();?>

      <div class="content-daystart-box">
          <center>
            <p class="daystart-page-title">The Simplest Way To <span style="color: red !important;">Earn $500+ Per Day</span></p>

            <p class="daystart-page-subtitle"><span style="background-color: yellow;">Watch This Video To See How You Can Too!</span></p>

            <div class="videoWrapper">
              <?php if(empty($mcapushct4)){?>
                  <iframe src="https://player.vimeo.com/video/228026830" width="720" height="405" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <?php }else{?>
                <?php echo $mcapushct4;?>
                <?php }?>
            </div>

            <p class="daystart-page-buy-button">
              <a target="_blank" href="https://www.tvcmatrix.com/secure/cart/addItem.aspx?qty=1&itID=9135&PromoID=83&uid=<?php echo $user->mca_member; ?>" class="myBtn su-button su-button-style-default sales-btn">
                <img src="https://mcaprotools.com/wp-content/uploads/2017/04/sign-me-up.png" alt="let-me-in" width="640" height="158">
              </a>
            </p>
          </center>
      </div>


</div>
</div>
</div>

<?php endif; ?>

</div>

	<?php if( $sidebar_exists == true ): ?>

	<?php wp_reset_query(); ?>

	<div id="sidebar" class="sidebar" style="<?php echo $sidebar_css; ?>">

		<?php

		if($sidebar_left == 1) {

			generated_dynamic_sidebar($sidebar_1);

		}

		if($sidebar_left == 2) {

			generated_dynamic_sidebar_2($sidebar_2);

		}

		?>

	</div>

	<?php if( $double_sidebars == true ): ?>

	<div id="sidebar-2" class="sidebar" style="<?php echo $sidebar_2_css; ?>">

		<?php

		if($sidebar_left == 1) {

			generated_dynamic_sidebar_2($sidebar_2);

		}

		if($sidebar_left == 2) {

			generated_dynamic_sidebar($sidebar_1);

		}

		?>

	</div>

	<?php endif; ?>

	<?php endif; ?>




<?php get_footer(); ?>
