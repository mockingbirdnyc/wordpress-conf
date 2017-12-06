<?php
/**
 * Template Name: PayPal Thank You!
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.0
 */
?>

<?php get_header(); ?>
<div class="page">
	<div class="title_blog_container">
		<div class="row">
			<!-- Breadcrumbs -->
			<?php if ( ot_get_option('wpl_breadcrumbs') != "off") { ?>

				<div class="columns small-12 medium-12 large-12">
					<ul class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</ul>
				</div>
			<?php } ?>
			
			<div class="columns small-12 medium-12 large-12">
				<h1 class="title_blog"><?php echo get_the_title(); ?></h1>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="columns small-12 medium-12 large-12">
			<?php get_template_part('content', 'page' ); ?>
		</div>

		<div class="columns small-12 medium-12 large-12">
			<?php

				include_once( get_template_directory() . '/inc/paypal/class/paypal.php' );
				include_once( get_template_directory() . '/inc/paypal/class/httprequest.php' );

				//Use this form for production server 
				$r = new PayPal(true);

				//Use this form for sandbox tests
				//$r = new PayPal();

				$final = $r->doPayment();

				if ($final['ACK'] == 'Success') {
					//echo 'Succeed!';
					$oToken = $r->getCheckoutDetails($final['TOKEN']);
					$txnID = $oToken['TOKEN'];
					$firstName = $oToken['FIRSTNAME'];
					$lastName = $oToken['LASTNAME'];
					$addressCountry = $oToken['COUNTRYCODE'];
					$payerEmail = $oToken['EMAIL'];


					$bani = explode("|", $oToken['CUSTOM']);
					$payment_gross = $bani[0];
					$valuta= $bani[1];
					$donCause= $bani[2];

					$my_post = array(
						'post_title' => $txnID,
						'post_status' => 'publish',
						'post_author' => 1,
						'comment_status' => 'closed',
						'ping_status' => 'closed',
						'post_type' => 'post_pledges'
					);
					$post_id = wp_insert_post( $my_post );
					
					add_post_meta($post_id, "wpl_pledge_ticket", $donCause);
					add_post_meta($post_id, "wpl_pledge_transaction_id", $txnID);
					add_post_meta($post_id, "wpl_pledge_first_name", $firstName);
					add_post_meta($post_id, "wpl_pledge_last_name", $lastName);
					add_post_meta($post_id, "wpl_pledge_country", $addressCountry);
					add_post_meta($post_id, "wpl_pledge_email", $payerEmail);
					add_post_meta($post_id, "wpl_pledge_payment_amount", $payment_gross);
					add_post_meta($post_id, "wpl_pledge_payment_source", 'paypal');
					add_post_meta($post_id, "wpl_pledge_payment_status", 'Completed');	
						
				} else {
					//print_r($final);
				}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>