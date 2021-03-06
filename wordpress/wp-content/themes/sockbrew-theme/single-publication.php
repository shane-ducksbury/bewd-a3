<?php
/**
 * The template for displaying publications
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sockbrew_Theme
 */

get_header();
?>

	<main id="primary" class="site-main publication-main container">
		

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			
			<div class="publication-info-container">
				<!-- Could be refactored into a loop -->
				<?php the_title('<h1 class="pub-title">', '</h1>') ?>
				<div class="publication-header">
					<div class="publication-details">
						<h3>Authors: <?php the_field('authors') ?></h3>

						<h3>Categories:</h3>
						<?php
							$post_categories = get_field('category');
							if ($post_categories) :
								foreach ($post_categories as $post_category) : ?>
									<span class="uk-label"><?= $post_category->name ?></span>
							<?php endforeach;
							endif; ?>
						<?php if(get_field('published_year')): ?>
							<h3>Year: <?= the_field('published_year');?></h3>
						<?php endif;?>
						
					</div>

					<div class="publication-action-container">
						<!-- Need to set a max width for this. -->
						<img src="<?php the_field('publication_image')?>">
						<a class="uk-button uk-button-primary" href=<?php the_field('link_to_publication')?>>View Publication</a>
						<a class="uk-button uk-button-secondary" target="_blank" href="<?php echo generate_linkedin_url($_SERVER['REQUEST_URI'], get_the_title())?>">Share on LinkedIn</a>
					</div>

				</div>
					<?php if(get_field('abstract')): ?>
						<h3>Abstract:</h3> 
						<p><?= the_field('abstract');?></p>
					<?php endif;?>

					<h3>Citation Details: <?= the_field('citation');?></h3>
					<p class="citation-details"><?php
						$title = get_the_title();
						$authors = get_field('authors');
						$year = get_field('published_year');
						$url = get_field('link_to_publication');

						if(!$year):
							$year = "N.d";
						endif;
						
						echo "${authors} (${year}) <em class='citation-em'>${title}</em> retrieved from ${url}";

					?></p>
				
			</div>

			
			<?php endwhile; ?>
	</main>
<?php
get_footer();
