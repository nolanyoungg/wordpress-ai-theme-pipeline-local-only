







```php








<?php








/**








 * Template part for displaying services content on the homepage.








 *








 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/








 *








 * @package Nolan_Young_Showcase_Theme_X01








 */

















?>

















<section id="services" class="section">








    <div class="container">








        <h2 class="section-title">Our Services</h2>








        <p class="section-description">Discover the range of services we offer to capture your unique moments and bring your vision to life.</p>

















        <div class="service-cards">








            <?php








            // Define the services








            $services = [








                [








                    'title' => 'Portrait Sessions',








                    'description' => 'Capture timeless portraits that tell your story.',








                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2z"/></svg>',








                ],








                [








                    'title' => 'Weddings & Engagements',








                    'description' => 'Celebrate your special day with stunning editorial coverage.',








                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 5v14H7V5h10zm-8 6l4 4-4 4-4-4 4-4z"/></svg>',








                ],








                [








                    'title' => 'Events & Celebrations',








                    'description' => 'Capture every moment of your memorable events.',








                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V7h14v12z"/></svg>',








                ],








                [








                    'title' => 'Brand Photography',








                    'description' => 'Build your brand with professional and impactful visuals.',








                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6v14H5V6h14zm-8 12l4-4-4-4-4 4 4 4z"/></svg>',








                ],








                [








                    'title' => 'Product & Detail Photography',








                    'description' => 'Showcase your products in the best possible light.',








                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6v14H5V6h14zm-8 12l4-4-4-4-4 4 4 4z"/></svg>',








                ],








                [








                    'title' => 'Lifestyle & Family Sessions',








                    'description' => 'Create warm and candid family portraits.',








                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6v14H5V6h14zm-8 12l4-4-4-4-4 4 4 4z"/></svg>',








                ],








            ];

















            // Loop through the services








            foreach ($services as $service) {








                echo '<div class="service-card">';








                echo '<div class="service-icon">' . esc_html($service['icon']) . '</div>';








                echo '<h3 class="service-title">' . esc_html($service['title']) . '</h3>';








                echo '<p class="service-description">' . esc_html($service['description']) . '</p>';








                echo '<a href="/what-we-do/" class="btn btn-primary">Learn More</a>';








                echo '</div>';








            }








            ?>








        </div>








    </div>








</section>














