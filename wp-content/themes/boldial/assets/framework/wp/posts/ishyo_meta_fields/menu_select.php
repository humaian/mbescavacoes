<select name="<?php echo $id?>" id="<?php echo $id?>">
	<option <?php selected( $value, '' )?> value=""><?php echo __( 'Default setting', 'ishyoboy'); ?></option>
	<?php
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false, 'taxonomy' => 'tax_nav_menu' ) );
		foreach ( $menus as $menu ) {
		?>
			<option <?php selected( $value, $menu->term_id )?> value="<?php echo $menu->term_id; ?>"><?php echo $menu->name; ?></option>
		<?php }	?>
</select>
