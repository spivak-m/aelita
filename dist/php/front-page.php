<?php
/**
 * Шаблон (front-page.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php get_header(); ?>

<?php get_template_part('fix-header'); ?>
<?php $page_main_search  = parse_url($_SERVER['REQUEST_URI']);
$array = explode('/', $page_main_search ['path']);
$lang = 'ru';
if ($array[1] == 'en') $lang = 'en'; ?>

<main>
	<!-- <section class="slider">
		<div class="slider__item slider__item--1">
			<div class="slider__wrapper">
				<b class="slider__item-title">
					Единственный
					<br> апарт-отель в городе</b>
				<p class="slider__item-content">
					Номера квартирного типа, оборудованные кухней.

				</p>
			</div>
		</div>
		<div class="slider__controls">
			<div class="slider__controls-wrapper">
				<button class="slider__controls-item slider__controls-item--active" type="button"></button>
				<button class="slider__controls-item" type="button"></button>
				<button class="slider__controls-item" type="button"></button>
			</div>
		</div>
	</section> -->
	<?php if (get_setting('слайды')) : ?>
	<section style="position: relative;">
		<div class="main-carousel">
			<?php foreach( get_setting( 'слайды' ) as $slide) : ?>
			<div class="carousel-cell slider__item slider__item--1" style="<?php echo getStyleSlider( $slide['картинка']['sizes']['large'] ); ?>">
				<div class="slider__wrapper">
					<b class="slider__item-title"><?php echo $slide['заголовок']; ?></b>
					<p class="slider__item-content"><?php echo $slide['описание']; ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="slider__controls">
			<div class="slider__controls-wrapper">
				<?php $first_flag = true; ?>
				<?php foreach( get_setting( 'слайды' ) as $slide) : ?>
					<?php 
					$active_class = '';
					if ($first_flag)
					{
						$first_flag = false;
						$active_class = 'slider__controls-item--active';
					}
					?>
					<button class="slider__controls-item <?php echo $active_class; ?>" type="button"></button>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php get_template_part('booking'); ?>
	<section class="rooms">
		<div class="rooms__wrapper">
			<div class="rooms__breakfast-promo">
				<p>
					<b><?php _e('[:ru]Завтрак включен[:en]Breakfast is'); ?>
						<br>
					</b><?php _e('[:ru]в стоимость проживания[:en]included in the price'); ?></p>
			</div>
			<?php $posts = get_posts(array('post_type' => 'apartments', 'numberposts' => -1)); ?>
			<?php if( count($posts) > 1): foreach($posts as $post): setup_postdata($post); ?>
				<article class="rooms__item">
					<div class="rooms__item-aside">
						<h2 class="rooms__item-title"><?php the_title(); ?></h2>
						<p class="rooms__item-price"><?php the_field( 'стоимость_одноместного_размещения', get_the_ID() ); ?></p>
						<p class="rooms__item-short-description"><?php the_field( 'appartament_desc', get_the_ID() ); ?></p>
						<div class="rooms__item-links">
							<a class="rooms__item-link rooms__item-link--border" href="<?php the_permalink(); ?>"><?php _e('[:ru]Подробнее[:en]More'); ?></a>
							<a class="rooms__item-link underline_room_link" href="<?php if ($lang === "en") {echo "/en";} ?>/booking/?room-type=<?php the_field( 'room-type', get_the_ID() ); ?>"><?php _e('[:ru]Забронировать[:en]Book'); ?></a>
						</div>
					</div>
					<a href="<?php the_permalink(); ?>" class="rooms__item-img" style="background-image: url(<?php echo get_field( 'главная_картинка', get_the_ID() )[ 'sizes' ][ 'large' ]; ?>)">
						
					</a>
				</article>
			<?php endforeach; endif; ?>
		</div>
	</section>
	<section class="contacts">
		<div class="contacts__wrapper">
			<div class="contacts__aside">
				<h2 class="contacts__title"><?php _e('[:ru]Контактная информация[:en]Contact Information'); ?></h2>
				<p class="contacts__addres"><?php print_setting( 'адрес_в_контактах' ); ?></p>
				<div class="contacts__tel-container">
					<a class="contacts__tel"><?php print_setting( 'site_phone_1' ); ?></a>
					<a class="contacts__tel"><?php print_setting( 'site_phone_2' ); ?></a>
				</div>
				<a class="contacts__email"><?php print_setting( 'site_e-mail' ); ?></a>
				<div class="contacts__links-container">
					<a class="contacts__link contacts__link--question js-modalFeedOpen" href="#modalFeed"><?php _e('[:ru]Задать вопрос[:en]Ask a Question'); ?></a>
					<a class="contacts__link contacts__link--road" href="contact/#google_map"><?php _e('[:ru]Как доехать[:en]How to get'); ?></a>
				</div>
			</div>
		</div>
		<!-- <div class="contacts__map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4062.550538671731!2d56.84227267719536!3d59.39511979899147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43edd3c0e3293591%3A0xf74cd562de96491c!2z0YPQuy4g0J_Rj9GC0LjQu9C10YLQutC4LCAxMTbQsCwg0JHQtdGA0LXQt9C90LjQutC4LCDQn9C10YDQvNGB0LrQuNC5INC60YDQsNC5LCA2MTg0MjY!5e0!3m2!1sru!2sru!4v1528104868629"
				width="auto" height="450" frameborder="0" style="border:0" allowfullscreen="allowfullscreen"></iframe>
		</div> -->
		<div class="contacts__map">
			<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A907d4972e0843312437a6d604b937ffc36b122a70f7bc5c1ec28442646fc172f&amp;width=100%25&amp;height=429&amp;lang=<?php if (get_bloginfo('language') != 'ru-RU'): ?>en_US<?php else: ?>ru_RU<?php endif;?>&amp;scroll=true"></script>
		</div>
	</section>
</main>

<?php get_footer(); ?>