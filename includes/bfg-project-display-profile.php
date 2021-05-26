<?php
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Filtramos los post que mostramos en Talks por cada usuario
 */
function bfg_proyectos_posts() {
	global $post;
	$count = 0;
	$user_id = bp_displayed_user_id();

	$authorId = get_the_author_meta( 'ID' );
	$profileUserID = bp_displayed_user_id();
	$current_user = wp_get_current_user();	
	$existMember = false;

	
	$userData = get_userdata($user_id);
	$args = array(
		'post_type' => 'proyectos',
		'posts_per_page' => -1,
		'orderbyby' => 'DESC',
	);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) {
		?>
		<div class="wrapper-post-profile flex bfg-flex-grap"">
		<?
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$terms = get_the_terms( $post->ID, 'ods' );
			?>
				<?
					$thumbID = get_post_thumbnail_id( $post->ID );
					$imgDestacada = wp_get_attachment_url( $thumbID );
					$miembros = get_post_meta( get_the_ID(), 'miembros', true);

					?>
				<? if($miembros): ?>
					<? if(false !== array_search($profileUserID, $miembros)): 
						?>
						<? $existMember = true; ?>

						<div class="bfg-item-proyectos">
							<a class="no-color" href="<?php the_permalink(); ?>">
								<div class="bfg-header-cover-sesiones bfg-has-avatar item-profile flex" style="background-image:url(<?php echo $imgDestacada; ?>)">
								</div>
								<div class="bfg-avatar-proyecto" style="background-image: url(<? echo the_field('logo_proyecto'); ?>)">
								</div>
								<hgroup class="bfg-content-inprofile resumen-proyecto">
									<div class=" ">
										<?php
											$title = get_the_title();
											$short_title = wp_trim_words( $title, 12, '...' );
										?>
										<h2 class="title-bit"><? echo $short_title; ?></h2>
									</div>
									<div class="group-description">
										<? echo the_excerpt(); ?>
									</div>
								</hgroup>
								<div class="bfg-miembros-proyecto flex bfg-flex-grap">
										<?
										// $user_id = get_the_author_meta( 'ID' );
										foreach($miembros as $userID){
											$userName = xprofile_get_field_data('1', $userID);
											$args = array( 
												'item_id' => $userID
											); 
											echo bp_core_fetch_avatar($args); 
										}
									?>
								</div>
								<div class="bfg-ods-proyecto">
									<ul class="bfg-list flex">
										<?if ($terms):?>
											<?php foreach($terms as $term): ?>
												<li class="<?php echo $term->slug; ?>">
													<img src="<? echo get_stylesheet_directory_uri() . '/assets/images/' . $term->slug . '.png';  ?>" alt="">
												</li>
											<?php endforeach; ?>
										<?php endif;?>
									</ul>
								</div>
							</a>
						</div>
					<? else: ?>
				<? endif; ?>
						
				<? endif; ?>
				<?
				if((($count + 1) == $the_query->found_posts) && !$existMember){
					?>
						<aside class="bp-feedback bp-messages info">
								<span class="bp-icon" aria-hidden="true"></span>
								<p>
									<? echo xprofile_get_field_data('1', $profileUserID)?> aún no tienes proyectos.
								</p>
						</aside>
							<?
					}
					$count ++;
					?>
			<?
		}
		?>
		</div>
		<?
		wp_reset_postdata();
	}
}
add_shortcode('proyectos-posts', 'bfg_proyectos_posts');