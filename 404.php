<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package divergent_Wordpress_theme
 */

get_header();
?>

    <div id="Main">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>404 Sayfa Bulunamadı!</h1>
                    <br>
                    <img src="<?php echo get_template_directory_uri() ?>/dist/img/404.png" alt="404 Not Found" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
