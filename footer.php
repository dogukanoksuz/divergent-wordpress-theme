<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package divergent_Wordpress_theme
 */

?>

<footer id="Footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                Copyright &copy; 2020 <b><?php bloginfo('name'); ?></b>
            </div>
            <div class="col-sm-4 text-center" style="font-size: 20px">
                <a href="#"><i class="fab fa-facebook-f"></i></a>&nbsp;
                <a href="#"><i class="fab fa-twitter"></i></a>&nbsp;
                <a href="#"><i class="fab fa-instagram"></i></a>&nbsp;
                <a href="#"><i class="fab fa-steam-symbol"></i></a>&nbsp;
                <a href="#"><i class="fab fa-linkedin-in"></i></a>&nbsp;
                <a href="#"><i class="fab fa-github"></i></a>&nbsp;
                <a href="#"><i class="fas fa-envelope"></i></a>
            </div>
            <div class="col-sm-4 textAlignRight">
                <?php
                printf(esc_html__('Theme %1$s by %2$s.', 'divergent <i class="fas fa-heart"></i>'), 'divergent <i class="fas fa-heart"></i>', '<a href="https://dogukan.dev">Doğukan Öksüz</a>');
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
