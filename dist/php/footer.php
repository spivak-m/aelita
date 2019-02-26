<?php
/**
 * Шаблон подвала (footer.php)
 * @package WordPress
 * @subpackage testtheme
 */
?>
<footer class="site-footer">
	<div class="site-footer__wrapper site-footer__top">
		<a href="/" class="site-footer__logo">
			<img src="<?php echo get_template_directory_uri(); ?>/media/img/site-logo-foo.png" alt="Аэлита логотип" />
		</a>
		<?php 
		wp_nav_menu( array(
			'theme_location' => 'main',
			'container'  => 'div',
			'container_class' => 'site-footer__menu', 
			'menu_class' => 'site-footer__menu-list',
		));
		?>
		<div class="site-footer__contacts">
			<div class="site-footer__contact-links">
				<div style="margin-bottom: 10px;" class="site-footer__contact-link site-footer__contact-link--email"> <?php print_setting( 'site_address' ); ?></div>
				<a class="site-footer__contact-link site-footer__contact-link--tel"><?php print_setting( 'site_phone_1' ); ?></a>
				<a class="site-footer__contact-link site-footer__contact-link--tel"><?php print_setting( 'site_phone_2' ); ?></a>
				<a href="mailto:<?php print_setting( 'site_e-mail' ); ?>"class="site-footer__contact-link site-footer__contact-link--email"><?php print_setting( 'site_e-mail' ); ?></a>
			</div>
			<div class="site-footer__social">
				<!-- <a class="site-footer__social-item site-footer__social-item--ta" href="https://www.tripadvisor.ru/Hotel_Review-g2375248-d12864509-Reviews-ApartHotel_Aelita-Berezniki_Perm_Krai_Volga_District.html">ta</a> -->
				<a class="site-footer__social-item site-footer__social-item--vk" href="https://vk.com/aelitahotel">vk</a>
				<a class="site-footer__social-item site-footer__social-item--ig instagram" href="https://www.instagram.com/aelitahotel/ ">insta</a>
				<!-- <a class="site-footer__social-item site-footer__social-item--fb" href="#">fb</a> -->
			</div>
		</div>
	</div>
	<div class="site-footer__bottom">
		<div class="site-footer__wrapper">
			<div class="site-footer__copyright">
				<?php print_setting( 'site_copyright' ); ?>
			</div>
			<div class="site-footer__developed-by">
				<p><?php _e('[:ru]Разработка сайта[:en]Designed by'); ?>
					<a style="text-decoration: underline;" href="https://prostordesign.ru" target="_blacnk">PROSTOR design</a>
				</p>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</footer>
<div class="modal-call js-modalCallOver">
	<div id="modalCall" class="modal-call__form js-modalCall">
		<h2 class="modal-call__title"><?php _e('[:ru]Заказать звонок[:en]Order a call'); ?></h2>
		<p class="modal-call__text"><?php _e('[:ru]Оставьте свой номер, и мы вам перезвоним.[:en]Leave your number and we\'ll call you back.'); ?></p>
		<?php echo qtrans_getLanguage() == 'en' ? 
			do_shortcode( '[contact-form-7 id="173" title="Modal Feedback (En)"]' ) :
			do_shortcode( '[contact-form-7 id="6" title="Modal Feedback (Rus)"]' )
		; ?>
		<button class="modal-call__close js-modalCallClose" type="button"></button>
	</div>
</div>
<div class="modal-offer js-modalOfferOver">
	<div id="modalOffer" class="modal-offer__container js-modalOffer">
		<div class="modal-offer__img" style="background-image: url(<?php echo get_setting( 'картинка_окна' )[ 'sizes' ][ 'large' ]; ?>)"></div>
		<div class="modal-offer__aside">
			<h2 class="modal-offer__title"><?php print_setting( 'заголовок_окна' ); ?></h2>
			<section class="page-content modal-conent-offer" style="border: none;">
				<div class="page-content__wrapper block" style="width: inherit; margin: 0; padding: 0;">
				<?php print_setting( 'содержимое_окна' ); ?>
				</div>
			</section>
			<div class="modal-offer__links"><a class="modal-offer__link modal-offer__link--bg" href="<?php print_setting( 'ссылка_на_пост' ); ?>"><?php _e('[:ru]Подробнее[:en]More'); ?></a><a class="modal-offer__link" href="<?php _e('[:ru]/[:en]/en/'); ?>booking"><?php _e('[:ru]Забронировать[:en]Book'); ?></a></div>
		</div>
		<div class="modal-offer__btn-close js-modalOfferClose"></div>
	</div>
</div>
<div class="modal-call js-modalFeedOver">
	<div id="modalFeed" class="modal-call__form js-modalFeed">
		<h2 class="modal-call__title"><?php _e('[:ru]Задать вопрос[:en]Ask a Question'); ?></h2>
		<p class="modal-call__text"></p>
		<?php echo qtrans_getLanguage() == 'en' ? 
			do_shortcode( '[contact-form-7 id="174" title="Page Feedback (En)"]' ) :
			do_shortcode( '[contact-form-7 id="171" title="Page Feedback (Rus)"]' )
		; ?>
		<button class="modal-call__close js-modalFeedClose" type="button"></button>
	</div>
</div>

</body>
</html>