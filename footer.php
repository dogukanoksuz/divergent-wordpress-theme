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
$divergent_options = get_option('divergent');
?>

<footer id="Footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php echo $divergent_options['copyright-text']; ?>
            </div>
            <div class="<?php echo $divergent_options['credits'] ? 'col-sm-4 text-center' : 'col-sm-8 textAlignRight'; ?>" style="font-size: 20px">
                <?php foreach($divergent_options['social-media'] as $icon): ?>
                <a href="<?php echo $icon["url"]; ?>" <?php echo $icon["newtab"] ? "target='_blank'" : ''; ?>><i class="<?php echo $icon["icon"]; ?>"></i></a>&nbsp;
                <?php endforeach; ?>
            </div>
            <?php if($divergent_options['credits'] == true) : ?>
            <div class="col-sm-4 textAlignRight">
				<?php
				printf( esc_html__( 'Theme %1$s by %2$s.', 'divergent <i class="fas fa-heart"></i>' ), 'divergent <i class="fas fa-heart"></i>', '<a href="https://dogukan.dev">Doğukan Öksüz</a>' );
				?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
