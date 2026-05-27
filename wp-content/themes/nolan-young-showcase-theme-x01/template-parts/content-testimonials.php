







```php








<?php








/**








 * Template part for displaying testimonials.








 *








 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/








 *








 * @package Nolan_Young_Showcase_Theme_X01








 */

















if ( ! have_posts() ) {








	return;








}








?>

















<section class="testimonials-section">








	<div class="container">








		<h2 class="section-title">What Our Clients Say</h2>








		<div class="testimonial-carousel" aria-label="Testimonial Carousel">








			<?php while ( have_posts() ) : the_post(); ?>








				<div class="testimonial-card">








					<blockquote class="testimonial-quote">








						<?php the_content(); ?>








					</blockquote>








					<footer class="testimonial-footer">








						<cite class="testimonial-cite"><?php the_title(); ?></cite>








						<span class="testimonial-role"><?php echo esc_html( get_post_meta( get_the_ID(), 'testimonial_role', true ) ); ?></span>








					</footer>








				</div>








			<?php endwhile; ?>








		</div>








		<button class="btn btn-primary testimonial-prev" aria-label="Previous Testimonial">Prev</button>








		<button class="btn btn-primary testimonial-next" aria-label="Next Testimonial">Next</button>








	</div>








</section>














