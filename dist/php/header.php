<?php
/**
 * Шаблон шапки (header.php)
 * @package WordPress
 * @subpackage testtheme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#16b7b7">
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="icon" type="image/x-icon"/>
	<link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <?php $page_main_search  = parse_url($_SERVER['REQUEST_URI']);
    $array = explode('/', $page_main_search ['path']);
    $lang = 'ru';
    if ($array[1] == 'en') $lang = 'en'; ?>
    <?php if ((strpos($page_main_search ['path'],"/booking") !== false)) : ?>
        <title>
            <?php if ($lang === "ru")
            {echo "Бронирование номеров в отеле Аэлита, Березники - официальный сайт";}
            else {echo "Online reservation Aelita Hotel, Berezniki - Official Site";} ?>
        </title>
    <?php endif; ?>
	<?php wp_head(); ?>

    <!-- start TL head script -->
    <script type="text/javascript">
        (function(w){
            var q=[
                ['setContext', 'TL-INT-aelita-hotel.new', '<?=$lang?>']
            ];
            var t=w.travelline=(w.travelline||{}),ti=t.integration=(t.integration||{});ti.__cq=ti.__cq?ti.__cq.concat(q):q;
            if (!ti.__loader){ti.__loader=true;var d=w.document,p=d.location.protocol,s=d.createElement('script');s.type='text/javascript';s.async=true;s.src=(p=='https:'?p:'http:')+'//ibe.tlintegration.com/integration/loader.js';(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(s);}
        })(window);
    </script>
    <!-- end TL head script -->
    <?php if ((strpos($page_main_search ['path'],"/booking") !== false)) : ?>
        <!-- start TL Booking form script -->
        <script type="text/javascript">
            (function(w){
                var q=[
                    ['setContext', 'TL-INT-aelita-hotel.new', '<?=$lang?>'],
                    ['embed', 'booking-form', {container: 'tl-booking-form'}]
                ];
                var t=w.travelline=(w.travelline||{}),ti=t.integration=(t.integration||{});ti.__cq=ti.__cq?ti.__cq.concat(q):q;
                if (!ti.__loader){ti.__loader=true;var d=w.document,p=d.location.protocol,s=d.createElement('script');s.type='text/javascript';s.async=true;s.src=(p=='https:'?p:'http:')+'//ibe.tlintegration.com/integration/loader.js';(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(s);}
            })(window);
        </script>
        <!-- end TL Booking form script -->
    <?php endif; ?>
    <?php if ((strpos($page_main_search ['path'],"/booking") === false)) : ?>
        <!-- start TL Search form script -->
        <script type="text/javascript">
            (function(w){
                var q=[
                    ['setContext', 'TL-INT-aelita-hotel.new', '<?=$lang?>'],
                    ['embed', 'search-form', {container: 'tl-search-form'}]
                ];
                var t=w.travelline=(w.travelline||{}),ti=t.integration=(t.integration||{});ti.__cq=ti.__cq?ti.__cq.concat(q):q;
                if (!ti.__loader){ti.__loader=true;var d=w.document,p=d.location.protocol,s=d.createElement('script');s.type='text/javascript';s.async=true;s.src=(p=='https:'?p:'http:')+'//ibe.tlintegration.com/integration/loader.js';(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(s);}
            })(window);
        </script>
        <!-- end TL Search form script -->
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/tl-style.css">
    <meta name="format-detection" content="telephone=no">
</head>
<body <?php body_class(); ?> <?php if ((strpos($page_main_search ['path'],"/booking") !== false)) : ?>id="booking-page"<?php endif; ?>>

<header class="site-header">
		<div class="site-header__wrapper site-header__top">
			<a href="/" class="site-header__logo">
				<img src="<?php echo get_template_directory_uri(); ?>/media/img/site-logo.png" alt="Аэлита логотип" />
			</a>
			<div class="site-header__contacts">
				<div class="site-header__contacts-block site-header__contacts-block--tel">
					<a class="site-header__contacts-link cl-setsel"><?php print_setting( 'site_phone_1' ); ?></a>
					<a class="site-header__contacts-link cl-unsel"><?php print_setting( 'site_phone_2' ); ?></a>
				</div>
				<!-- <div class="site-header__contacts-block site-header__contacts-block--addres">
					<a class="site-header__contacts-link"><?php print_setting( 'site_address' ); ?></a>
				</div> -->
				<div class="site-header__contacts-block site-header__contacts-block--feedback">
					<a class="site-header__contacts-feedback js-modalCallOpen" href="#modalCall"><?php _e('[:ru]Обратная связь[:en]Feedback'); ?></a>
				</div>
				<?php if (function_exists('qtranxf_getSortedLanguages')) : ?>
					<div class="site-header__lang-switcher select-lang">
					<?php //$langsel = get_bloginfo('language');
						$langsel = substr(get_bloginfo('language'), 0, 2);
						foreach ( qtranxf_getSortedLanguages() as $l){
							$sel = $langsel == $l ? ' site-header__lang-switcher-item--active' : '';
							echo '<a href="?lang='.$l.'" class="site-header__lang-switcher-item'.$sel.'">'.$l.'</a>';
						} ?>
					</div>
				<?php endif; ?>
			</div>

            <a href="#menu-popup" class="site-header__hamburger"></a>
		</div>
		<div class="site-header__bottom">
			<div class="site-header__wrapper">
				<div class="site-header__menu">
					<?php 
					wp_nav_menu( array(
						'theme_location' => 'main',
						'container'  => 'nav',
						'container_class' => 'menu', 
						'menu_class' => 'menu__list',
					));
					?>

                    <div class="site-header__contacts">
                      <div class="site-header__contacts-block site-header__contacts-block--tel">
                        <a class="site-header__contacts-link cl-setsel">+7 (342) 420-20-90</a>
                        <a class="site-header__contacts-link cl-unsel">+7 (902) 63 000 66</a>
                      </div>
                      <div class="site-header__contacts-block site-header__contacts-block--addres">
                        <a class="site-header__contacts-link">г. Березники, <br>ул. Пятилетки, 116а</a>
                      </div>
                      <div class="site-header__contacts-block site-header__contacts-block--feedback">
                        <a class="site-header__contacts-feedback js-modalCallOpen" href="#modalCall">Обратная связь</a>
                      </div>
                    </div>
				</div>
			</div>
		</div>
	</header>
