<?php
/**
 * The default template for displaying Blog Content
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */

?>
<?php if( is_single()) { ?>
	<?php 
		$pid = $post->ID;
		$share_buttons_global = ot_get_option( 'wpl_post_sharing_buttons' );
		$share_buttons_global = ( $share_buttons_global == 'off' ? false : true );
		$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
		$display_share = false;

		if( $share_buttons == 'off' ) {
			$display_share = false;
		} elseif( $share_buttons == 'on' || $share_buttons_global ) {
			$display_share = true;
		}
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
		<div class="entry-meta">
			<!-- Date -->
			<?php if ( ot_get_option('wpl_date_single_post') != "off" ) { ?>
				<span class="date"><?php wplook_get_date_time(); ?></span>
			<?php } ?>
			
			<!-- Category -->
			<?php if ( ot_get_option('wpl_category_single_post') != "off" ) { ?>
				<span class="entry-category"><i class="icon-folder"></i> <?php the_category(', ') ?></span>
			<?php } ?>

			<!-- Author -->
			<?php if ( ot_get_option('wpl_author_single_post') != "off" ) { ?>
				<span class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"> <?php echo get_the_author(); ?></a></span>
			<?php } ?>
		</div>

		<!-- Post Thumbnail -->
		<?php if ( has_post_thumbnail() && ot_get_option('wpl_featured_image_post') != "off" ) { ?>
			<div class="entry-featured-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-thumb', array('class' => 'round')); ?></a>
			</div>
		<?php } ?>

		<!-- Entry Content -->
		<div class="entry-content">
			<?php // The content ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'conference-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>

		<!-- Tag List -->
		<?php if ( get_the_tag_list( '', ', ' ) ) { ?>
			<div class="entry-tag"> 
				<b><?php _e('Tags: ', 'conference-wpl'); ?></b><?php echo get_the_tag_list('',' ',''); ?>
			</div>
		<?php } ?>
		<div class="clear"></div>

		<!-- Share Buttons -->
		<?php if( $display_share ) { ?>
			<div class="entry-share">
				<b><?php _e('Share:', 'conference-wpl'); ?></b>
				<?php wplook_get_share_buttons(); ?>
			</div>
		<?php } ?>	
	</article>

	<?php comments_template( '', true ); ?>
	
<?php } else { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
		<div class="entry-meta">
			<!-- Date -->
			<?php if ( ot_get_option('wpl_date_blog_post') != "off" ) { ?>
				<span class="date"><?php wplook_get_date_time(); ?></span>
			<?php } ?>
			
			<!-- Category -->
			<?php if ( ot_get_option('wpl_category_blog_post') != "off" ) { ?>
				<span class="entry-category"><i class="icon-folder"></i> <?php the_category(', ') ?></span>
			<?php } ?>
			
			<!-- Author -->
			<?php if ( ot_get_option('wpl_author_blog_post') != "off" ) { ?>
				<span class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"> <?php echo get_the_author(); ?></a></span>
			<?php } ?>
		</div>

		<!-- Title -->
		<h1 class="entry-title">
			<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>

		<!-- Post Thumbnail -->
		<?php if ( has_post_thumbnail() ) {?>
			<div class="entry-featured-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-thumb', array('class' => 'round')); ?></a>
			</div>
		<?php } ?>

		<!-- The content -->
		<div class="entry-content">
			<p><?php echo wplook_short_excerpt(ot_get_option('wpl_blog_excerpt_limit'));?></p>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'conference-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>

		<!-- Read more button -->
		<div class="entry-more">
			<a href="<?php the_permalink(); ?>" class="btn-default btn-post-more"><?php _e('Read more', 'conference-wpl'); ?></a>
		</div>
	</article>
<?php } ?>
