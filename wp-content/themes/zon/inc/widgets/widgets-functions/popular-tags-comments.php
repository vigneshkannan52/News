<?php

/**
 * Display Popular, Tag and Comments 
 *
 * @package Theme Freesia
 * @subpackage Zon
 * @since Zon 1.0
 */

class Zon_tab_Widgets extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget-tab-box', 'description' => __( 'Displays popular posts, comments and tags', 'zon') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=__('TF: Popular Posts, Tags and Comments','zon'), $widget_ops, $control_ops );
	}


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$zon_popular_posts = ! empty( $instance['zon_popular_posts'] ) ? absint( $instance['zon_popular_posts'] ) : 5;
		$zon_comments = ! empty( $instance['zon_comments'] ) ? absint( $instance['zon_comments'] ) : 5; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'zon_popular_posts' ); ?>"><?php esc_html_e( 'Number of popular posts:', 'zon' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'zon_popular_posts' ); ?>" name="<?php echo $this->get_field_name( 'zon_popular_posts' ); ?>" type="text" value="<?php echo esc_attr( $zon_popular_posts ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'zon_comments' ); ?>"><?php esc_html_e( 'Number of comments:', 'zon' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'zon_comments' ); ?>" name="<?php echo $this->get_field_name( 'zon_comments' ); ?>" type="text" value="<?php echo esc_attr( $zon_comments ); ?>">
		</p>
		
		<?php 
	}



	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['zon_popular_posts'] = ( ! empty( $new_instance['zon_popular_posts'] ) ) ? absint( $new_instance['zon_popular_posts'] ) : '';
		$instance['zon_comments'] = ( ! empty( $new_instance['zon_comments'] ) ) ? absint( $new_instance['zon_comments'] ) : '';

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {
		$zon_settings = zon_get_theme_options();
		extract($args);
		$zon_popular_posts = ( ! empty( $instance['zon_popular_posts'] ) ) ? absint( $instance['zon_popular_posts'] ) : 5;
		$zon_comments = ( ! empty( $instance['zon_comments'] ) ) ? absint( $instance['zon_comments'] ) : 5;
		$entry_format_meta_blog = $zon_settings['zon_entry_meta_blog'];

		echo $before_widget; ?>
		<div class="tab-wrapper">
			<div class="tab-menu">
				<button class="active" type="button"><?php esc_html_e( 'Popular', 'zon' ); ?></button>
				<button type="button"><?php esc_html_e( 'Comments', 'zon' ); ?></button>
				<button type="button"><?php esc_html_e( 'Tags', 'zon' ); ?></button>
			</div>
			<div class="tabs-container">
				<div class="tab-content">
					<div class="mb-popular">
						<?php 
							$args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $zon_popular_posts, 'post_status' => 'publish', 'orderby' => 'comment_count', 'order' => 'desc' );
							$popular = new WP_Query( $args );

							if ( $popular->have_posts() ) :

							while( $popular-> have_posts() ) : $popular->the_post(); ?>
								<div <?php post_class('mb-post');?>>
									<?php if ( has_post_thumbnail() ) { ?>
										<figure class="mb-featured-image">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('zon-featured-image'); ?></a>
										</figure> <!-- end.post-featured-image -->
									<?php } ?>
									<div class="mb-content">
										<?php the_title( sprintf( '<h3 class="mb-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
										<div class="mb-entry-meta">
											<?php
												echo '<span class="author vcard"><a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" title="'.the_title_attribute('echo=0').'">' .esc_html(get_the_author()).'</a></span>';
												printf( '<span class="posted-on"><a href="%1$s" title="%2$s">%3$s</a></span>',
																esc_url(get_the_permalink()),
																esc_attr( get_the_time(get_option( 'date_format' )) ),
																esc_html( get_the_time(get_option( 'date_format' )) )
															);

											if ( comments_open() ) { ?>
													<span class="comments">
													<?php comments_popup_link( __( 'No Comments', 'zon' ), __( '1 Comment', 'zon' ), __( '% Comments', 'zon' ), '', __( 'Comments Off', 'zon' ) ); ?> </span>
											<?php } ?>
										</div> <!-- end .mb-entry-meta -->
									</div> <!-- end .mb-content -->
								</div><!-- end .mb-post -->
							<?php
							endwhile;
							wp_reset_postdata();
							endif;
						?>
					</div> <!-- end .mb-popular -->
				</div><!-- end .tab-content -->
				<div class="tab-content">
					<div class="mb-comments">
						<?php $avatar_size = 50;
						$args = array(
							'number'       => absint($zon_comments),
						);
						$comments_query = new WP_Comment_Query;
						$comments = $comments_query->query( $args );
						$d = "F j, Y @ g:i A";

						if ( $comments ) {
							foreach ( $comments as $comment ) { ?>
								<article class="mb-comment-body">
									<div class="mb-comment-content">
										<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
											<?php echo wp_trim_words( wp_kses_post( $comment->comment_content ), 5, '...' ); ?>
										</a>
									</div><!-- .comment-content -->
									<div class="mb-comment-meta">
										<div class="comment-author">
											<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
											<?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>     
										</a>     
											<span> <?php echo esc_html( get_comment_author( $comment->comment_ID ) ); ?> </span>		
										</div><!-- .comment-author -->
										<div class="comment-metadata">
											<time datetime="<?php echo esc_attr(get_comment_date( $d, $comment->comment_ID )); ?>"><?php echo esc_html(get_comment_date( $d, $comment->comment_ID )); ?></time>
										</div> <!-- .comment-metadata -->
									</div> <!-- end .mb-comment-meta -->
								</article> <!-- end .mb-comment-body -->
							<?php }
						} else {
							esc_html_e( 'No comments found.', 'zon' );
						}	?>
					</div> <!-- end .mb-comments -->
				</div><!-- end .tab-content -->
				<div class="tab-content">
					<div class="mb-tag-cloud">
						<div class="mb-tags">
							<?php        
								$tags = get_tags();             
								if($tags) {               
									foreach ( $tags as $tag ): ?>    
										<a href="<?php echo esc_url( get_term_link( $tag ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>      
										<?php     
									endforeach;       
								} else {          
									esc_html_e( 'No tags created.', 'zon');           
								}            
							?>
						</div>
					</div>
					<!-- end .widget_tag_cloud -->		
				</div><!-- end .tab-content -->
			</div><!-- end .tabs-container -->
		</div> <!-- end .tab-wrapper -->
		<?php echo $after_widget;

	}

}