( function( $, elementor ) {

	"use strict";

	var techguideElementorFrontend = {

		init: function() {
			elementor.hooks.addAction( 'frontend/element_ready/techguide-blog.default', techguideElementorFrontend.initBlog );
		},

		initBlog: function( $scope ){
			$scope.on( 'click.techguideElementorFrontend', '.posts-load-more-btn', { scope: $scope }, techguideElementorFrontend.handleBlogLoadMore );
		},

		handleBlogLoadMore: function( event ) {

			var $button       = $( this ),
				$buttonText   = $( '.posts-load-more-btn__text', $button ),
				$postsWrapper = $( '.posts-list', event.data.scope ),

				buttonTexts   = techguide.load_more_args.button_texts,
				currentPage   = parseInt( $postsWrapper.data( 'page' ), 10 ),
				maxPage       = parseInt( $postsWrapper.data( 'max-page' ), 10 ),

				data = {
					'action':                 'techguide_get_blog_listing_posts',
					'techguidePage':           currentPage,
					'techguidePerPage':        $postsWrapper.data( 'per-page' ),
					'techguideWidgetSettings': $postsWrapper.data( 'settings' ),
					'nonce':                  techguide.load_more_args.blog_ajax_nonce
				};

			if ( $button.hasClass( 'processing' ) ) {
				return !1;
			}

			$button.addClass( 'processing' );
			$postsWrapper.addClass( 'processing' );
			$buttonText.text( buttonTexts.loading );

			$.ajax( {
				url:      techguide.ajaxurl,
				data:     data,
				type:     'POST',
				dataType: 'json',

				error: function() {
					$button.removeClass( 'processing' );
					$postsWrapper.removeClass( 'processing' );

					$buttonText.text( buttonTexts.default );
				},
				success: function( response ) {

					$postsWrapper.append( response.data.posts );

					// initialize wp-mediaelement ( video, audio )
					if ( response.data.has_media && undefined !== window.wp.mediaelement ) {
						window.wp.mediaelement.initialize();
					}

					// initialize cherry-post-formats-api for gallery and image post formats
					var popupInitalize = false;

					if ( response.data.has_gallery_post ) {
						CherryJsCore.theme_script.post_formats_initalize( 'slider' );
						CherryJsCore.theme_script.post_formats_initalize( 'popup' );

						popupInitalize = true;
					}

					if ( response.data.has_image_post && !popupInitalize ) {
						CherryJsCore.theme_script.post_formats_initalize( 'popup' );
					}

					$button.removeClass( 'processing' );
					$postsWrapper.removeClass( 'processing' );
					$buttonText.text( buttonTexts.default );

					currentPage++;
					$postsWrapper.data( 'page', currentPage );

					if ( currentPage === maxPage ) {
						$button.attr( 'disabled', 'disabled' );
						$buttonText.text( buttonTexts.none );
					}
				}
			} );
		}
	};

	$( window ).on( 'elementor/frontend/init', techguideElementorFrontend.init );

}( jQuery, window.elementorFrontend ) );
