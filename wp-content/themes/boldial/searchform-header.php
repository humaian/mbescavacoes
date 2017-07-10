<form role="search" method="get" id="headersearchform" action="<?php echo esc_url( apply_filters( 'ishyoboy_searchform_url', home_url( '/' ) ) ); ?>">
    <label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" placeholder="<?php _e( 'Search ...', 'ishyoboy' ); ?>">
    </label>
</form>

<a href="#close" class="ish-ps-searchform_close ish-icon-cancel" title="<?php _e( 'Close Search (ESC)', 'ishyoboy' ); ?>"></a>