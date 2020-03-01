<?php

if ( class_exists( 'CSF' ) ) {
	$prefix = 'divergent';

	CSF::createOptions( $prefix, array(
		// framework title
		'framework_title'    => 'Divergent Wordpress Theme <small><a href="https://dogukan.dev">by Doğukan Öksüz</a></small>',
		'framework_class'    => '',

		// menu settings
		'menu_title'         => 'Divergent Theme',
		'menu_slug'          => 'divergent',
		'menu_type'          => 'menu',
		'menu_capability'    => 'manage_options',
		'menu_icon'          => 'dashicons-visibility',
		'menu_position'      => 2,
		'menu_hidden'        => false,
		'menu_parent'        => '',

		// menu extras
		'show_bar_menu'      => true,
		'show_sub_menu'      => true,
		'show_network_menu'  => true,
		'show_in_customizer' => false,

		'show_search'             => true,
		'show_reset_all'          => true,
		'show_reset_section'      => true,
		'show_footer'             => true,
		'show_all_options'        => true,
		'show_form_warning'       => true,
		'sticky_header'           => true,
		'save_defaults'           => true,
		'ajax_save'               => true,

		// admin bar menu settings
		'admin_bar_menu_icon'     => '',
		'admin_bar_menu_priority' => 80,

		// footer
		'footer_text'             => 'Bu tema Doğukan Öksüz tarafından kendini geliştirmek isteyen herkese armağan edilmiştir. Hiçbir kod şifrelenmemiştir, gönlünüzce kullanabilirsiniz.',
		'footer_after'            => '',
		'footer_credit'           => '<a href="https://dogukan.dev">Doğukan Öksüz</a>',

		// database model
		'database'                => '', // options, transient, theme_mod, network
		'transient_time'          => 0,

		// contextual help
		'contextual_help'         => array(),
		'contextual_help_sidebar' => '',

		// typography options
		'enqueue_webfont'         => true,
		'async_webfont'           => false,

		// others
		'output_css'              => true,

		// theme and wrapper classname
		'theme'                   => 'dark',
		'class'                   => '',

		// external default values
		'defaults'                => array(),

	) );
	CSF::createSection( $prefix, array(
		'title'  => 'Tema ayarları',
		'fields' => array(
			// Tema rengi seçeneği
			array(
				'id'      => 'theme-color',
				'type'    => 'radio',
				'title'   => 'Tema rengi',
				'options' => array(
					'dark' => 'Karanlık',
					'grey' => 'Açık',
				),
				'default' => 'dark',
				'desc'    => 'Temanızın rengini seçebilirsiniz. Varsayılan renk karanlık temadır.'
			),

			// Logo yükleme
			array(
				'id'           => 'logo',
				'type'         => 'media',
				'title'        => 'Logonuz',
				'library'      => 'image',
				'placeholder'  => 'https://',
				'button_title' => 'Resim ekle',
				'remove_title' => 'Resmi sil',
				'default'      => array(
					'url' => get_template_directory_uri() . '/dist/img/logo.png',
				),
				'desc'         => 'Logonuzun 72 pikselden yüksek olmaması google pagespeed açısından daha iyi sonuç verecektir.'
			),

			// Breadcrumblar
			array(
				'id'         => 'breadcrumb',
				'type'       => 'switcher',
				'title'      => 'Breadcrumb',
				'text_on'    => 'Açık',
				'text_off'   => 'Kapalı',
				'text_width' => 80,
				'default'    => true,
				'desc'       => 'SEO uyumluluğu açısından breadcrumbların açık bırakılması tavsiye edilmektedir.'
			),

			// Copyright text
			array(
				'id'      => 'copyright-text',
				'type'    => 'text',
				'title'   => 'Footer metni',
				'default' => 'Copyright &copy; 2020'
			),

			// Custom header
			array(
				'id'       => 'head-tags',
				'type'     => 'code_editor',
				'title'    => 'İzleme kodları',
				'desc'     => 'Head kısmına eklemek istediğiniz ek kodları buraya koyabilirsiniz. bkz: Google Analytics',
				'settings' => array(
					'theme' => 'shadowfox',
					'mode'  => 'htmlmixed',
				),
			),

			// Tema yapımcısı bilgilendirmesi
			array(
				'id'         => 'credits',
				'type'       => 'switcher',
				'title'      => 'Tema yapımcısı bilgilendirmesi',
				'text_on'    => 'Açık',
				'text_off'   => 'Kapalı',
				'text_width' => 80,
				'default'    => true,
				'desc'       => 'Açık bırakırsanız sevinirim :)'
			),

			// Sosyal medya
			array(
				'id'     => 'social-media',
				'type'   => 'repeater',
				'title'  => 'Sosyal medya ikonları',
				'fields' => array(
					array(
						'id'           => 'icon',
						'type'         => 'icon',
						'title'        => 'İkon seçiniz',
						'button_title' => 'İkon seç',
						'remove_title' => 'İkonu kaldır',
					),
					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => 'URL giriniz'
					),
					array(
						'id'      => 'newtab',
						'type'    => 'checkbox',
						'title'   => 'Yeni sekmede açılsın mı?',
						'default' => false // or false
					),
				),
			),
		)
	) );
}
