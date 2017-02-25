<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Busqueda para:', 'label', 'annysuper' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Busca en Supermercado Anny...', 'placeholder', 'store' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'store' ) ?>" />
	</label>
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>