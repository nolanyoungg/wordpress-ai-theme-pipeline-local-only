

<footer>


    <?php


    if (has_nav_menu('footer')) {


        wp_nav_menu(array(


            'theme_location' => 'footer',


            'container_class' => 'nolan-menu__list',


            'menu_class' => 'nolan-menu__list',


        ));


    }


    ?>


</footer>





<?php wp_footer(); ?>


</body>


</html>


