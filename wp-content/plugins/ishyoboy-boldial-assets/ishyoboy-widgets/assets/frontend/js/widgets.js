/* *********************************************************************************************************************
 * Global namespace "ish"
 */
if (ish == null || typeof(ish) !== "object") { var ish = {} }

/* *********************************************************************************************************************
 * jQuery Ready - Activate everything
 */
jQuery(document).ready(function($) {

    // Widgets ---------------------------------------------------------------------------------------------------------
    ish.activate_widget_dribbble();
    ish.activate_widget_twitter();

});


/* *********************************************************************************************************************
 * function_exists() definition
 */
function function_exists( name ){
    return ( 'function' === eval( 'typeof ish.'  + name ) );
}


/* *********************************************************************************************************************
 * Widgets
 */

// Dribbble widget -----------------------------------------------------------------------------------------------------
if ( ! function_exists( 'activate_widget_dribbble' ) ) {
    ish.activate_widget_dribbble = function (){

        var bbb = jQuery('.dribbble-widget');
        if ( bbb.length > 0 ) {

            bbb.each( function() {
                var me = jQuery(this);

                jQuery.ajax({
                    url: php_array.admin_ajax,
                    method: "GET",
                    data: {
                        'action': 'ishyoboy_get_dribbble_shots',
                        'username': (me.attr('data-user-name') ? me.attr('data-user-name') : 'IshYoBoy'),
                        'count': ( me.attr('data-shots-count' ) ? me.attr('data-shots-count') : 9 )
                    },
                    dataType: "json"
                }).success( function( shots ){
                    var html = [];

                    if ( shots && shots.constructor === Array ){
                        shots.forEach(function(shot) {
                            html.push('<a href="' + shot.html_url + '" target="_blank">');
                            html.push('<img src="' + shot.images.normal + '" alt="' + shot.title + '">');
                            html.push('</a></li>');
                        });

                        me.hide();
                        me.html(html.join(''));
                        me.fadeIn(1000);
                    }
                });

            });
        }

    }
}


// Twitter widget ------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'activate_widget_twitter' ) ) {
    ish.activate_widget_twitter = function (){

        jQuery('div[class^="tweets-"]').each( function(){
            var me = jQuery(this);
            jQuery(this).tweetMachine( (me.attr('data-username') ? me.attr('data-username') : 'ishyoboydotcom'), {
                limit: parseInt(jQuery(this).attr('class').substr(7), 10),
                endpoint: 'ishyoboy_get_tweets',
                backendScript:  php_array.admin_ajax,
                autoRefresh: false,
                tweetFormat: "<div class='tweet'><div class='text'></div><div class='tweet-details'><a href='' class='time'></a></div></div>"
            });
        });

    }
}