<?php
    global $sidebar_width, $ish_options;
?>
	            <?php if ( ishyoboy_use_footer_sidebar() ){?>
	                <!-- Footer part section -->
	                <section class="ish-part_footer" id="ish-part_footer">

		                <div class="ish-row ish-row-notfull">
			                <div class="ish-row_inner">

		                        <?php $sidebar_width = 12; // Used when displaying widgets ?>
				                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(ishyoboy_get_footer_sidebar())) : else : ?>

		                        <!-- NO WIDGETS -->

	                            <?php endif; ?>
				            </div>
	                    </div>

	                </section>
	                <!-- Footer part section END -->
	            <?php } ?>

	            <?php if ( ishyoboy_use_footer_legals() ){?>
	                <!-- Footer legals part section -->
	                <section class="ish-part_legals">

		                <div class="ish-row ish-row-notfull">
			                <div class="ish-row_inner">
		                        <?php echo do_shortcode($ish_options['footer_legals_area'] ); ?>
				            </div>
	                    </div>

	                </section>
	                <!-- Footer legals part section END -->
	            <?php } ?>



			</div>
			<!-- Wrap whole page - boxed / unboxed END -->


	        <a href="#top" class="ish-back_to_top ish-smooth_scroll ish-icon-up-open"></a>

		</div>
		<!-- ish-body END -->


        <!--[if lte IE 8]><script src="<?php echo get_template_directory_uri(); ?>/assets/frontend/js/ie8.js"></script><![endif]-->


        <?php if ( isset($ish_options['tracking_script']) && '' != $ish_options['tracking_script']): ?>
            <!-- TRACKING SCRIPT BEGIN -->
            <?php echo $ish_options['tracking_script']; ?>
            <!-- TRACKING SCRIPT END -->
        <?php endif; ?>

        <?php

        /*
         * Call wp footer
         */
        wp_footer();

        ?>

		<?php //echo "<div class='mq'></div>"; ?>

	</body>

</html>