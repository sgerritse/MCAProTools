<?php
/* Template Name: Capture Page 1  */
get_header();
?>

<style type="text/css">

.layout-wide-mode #wrapper {
    width: 100%;
    max-width: none;
    height: 1080px !important;
}

#main {
    padding-top: 0px;
    padding-bottom: 0px;
    height: 1080px !important;
    background-color: #000;
}

.content-cp1-box {
    width: 45%;
		margin: 0 auto;
		background-color: #fff;
		padding: 40px;
		margin-top:40px
}


.cp1-page-title {
    font-size: 39px;
    font-weight: 700;
    text-align: center;
    margin-top: 0px;
    margin-bottom: 0px;
}

.cp1-page-subtitle {
    font-size: 20px;
    font-weight: 100;
    margin-top: 0px;
    margin-bottom: 15px;
    text-align: center;
}

input.cp1-email-field {
    padding: 24px;
    font-size: 16px;
}

.title-yellow-highlight {
	background-color: yellow;

}

.cp1-page-buy-button {
	margin-bottom: 0px;
}

.cp1-page-form {
    width: 100%;
}

.cp1-submit-button {
	display: block;
	width: 100%;
	margin-top: 15px;
	background-color: #ee2d36;
	border: none;
	color: #fff;
	font-weight: 600;
	font-size: 20px;
	white-space: nowrap;
	padding: 15px 0px;
	cursor: pointer;
	opacity: 1;
}

.cp1-page-security {
    text-align: center;
    margin-top: 15px;
    margin-bottom: 0px;
}


@media screen and (max-width: 480px) {

	.content-cp1-box {
	    width: 100%;
	    margin: 0 auto;
			background-color: #fff;
			padding: 40px;
			margin: 0 auto;
			margin-top:40px
	}

	.cp1-page-title {
    font-size: 25px;
    font-weight: 700;
    text-align: center;
    margin-top: 0px;
    margin-bottom: 0px;
}

.cp1-page-subtitle {
    font-size: 13px;
    font-weight: 100;
    margin-top: 0px;
    margin-bottom: 15px;
    text-align: center;
}

.cp1-page-security {
    text-align: center;
    margin-top: 15px;
    font-size: 12px;
    margin-bottom: 0px;
}

}


</style>


<div class="content-cp1-box">
		<?php if(have_posts()): the_post();?>

			<p class="cp1-page-title">This Is <span class="title-yellow-highlight">Easiest</span> Way Of Making $500 Per Day...</p>

			<p class="cp1-page-subtitle">Enter Your Details Below For Instant Access</p>

			<p class="cp1-page-form">
				<form method="post" class="af-form-wrapper" accept-charset="UTF-8" action="https://www.aweber.com/scripts/addlead.pl">

				<textarea name="listname" style="display:none;"><?php echo do_shortcode("[protool_mca_user meta_key='aweber_list' referrer_data='yes' referrer_key='ref' display_type='single_line']"); ?></textarea>

				<textarea style="display:none;" name="redirect" id="redirect_ec539077ddfbfd0ed6a1a4e4f7bb8862">https://mcaprotools.com/lp1/?ref=<?php echo do_shortcode('[protool_mca_user meta_key="referrer" referrer_key="ref"]'); ?></textarea>

				<input type="hidden" name="meta_required" value="email" />

				<input type="email" name="email" class="cp1-email-field" placeholder="Enter Your Email" required>

				<input type="submit" class="cp1-submit-button" value="Instant Access &#187;" />

				</form>

				<p class="cp1-page-security">
				 We're 100% Secure. We Never Share Your Email.
				</p>
			</p>



<?php endif; ?>

<?php get_footer(); ?>
