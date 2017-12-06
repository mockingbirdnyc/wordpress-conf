<?php
/**
 * The default Search Form Template
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
	<div>
		<input type="text" value="<?php _e('Search for...', 'conference-wpl'); ?>" name="s" id="s" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
	</div>
</form>
