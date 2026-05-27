







```php








<?php








/**








 * Template part for displaying the resources preview section on the homepage.








 *








 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/








 *








 * @package Nolan_Young_Showcase_Theme_X01








 */

















if ( ! defined( 'ABSPATH' ) ) {








    exit; // Exit if accessed directly.








}








?>

















<section class="section resources-preview">








    <div class="container">








        <h2 class="section-title">Useful Resources</h2>








        <p class="section-description">Explore our curated list of helpful resources to enhance your photography journey.</p>

















        <div class="resource-cards">








            <?php








            // Example resource cards, replace with actual content or dynamic queries.








            $resources = [








                [








                    'tag' => 'Tips',








                    'title' => '10 Essential Photography Tips',








                    'excerpt' => 'Discover top tips to improve your photography skills.',








                    'link' => '/resources/photography-tips/'








                ],








                [








                    'tag' => 'Galleries',








                    'title' => 'Our Latest Photo Galleries',








                    'excerpt' => 'Browse our latest photo galleries for inspiration.',








                    'link' => '/resources/photo-galleries/'








                ],








                [








                    'tag' => 'Tools',








                    'title' => 'Best Photography Tools',








                    'excerpt' => 'Find out the best tools to enhance your photography.',








                    'link' => '/resources/best-tools/'








                ],








                [








                    'tag' => 'Tutorials',








                    'title' => 'Photography Tutorials',








                    'excerpt' => 'Follow our step-by-step tutorials for various photography techniques.',








                    'link' => '/resources/tutorials/'








                ]








            ];

















            foreach ( $resources as $resource ) {








                ?>








                <div class="resource-card">








                    <div class="resource-tag"><?php echo esc_html( $resource['tag'] ); ?></div>








                    <h3 class="resource-title"><a href="<?php echo esc_url( $resource['link'] ); ?>"><?php echo esc_html( $resource['title'] ); ?></a></h3>








                    <p class="resource-excerpt"><?php echo esc_html( $resource['excerpt'] ); ?></p>








                </div>








                <?php








            }








            ?>








        </div>

















        <div class="cta-container">








            <a href="/resources/" class="btn btn-primary">View All Resources</a>








        </div>








    </div>








</section>














