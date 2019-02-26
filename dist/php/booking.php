<?php $page_main_search  = parse_url($_SERVER['REQUEST_URI']);
$array = explode('/', $page_main_search ['path']);
$lang = 'ru';
if ($array[1] == 'en') $lang = 'en'; ?>
<?php if ((strpos($page_main_search ['path'],"/booking") === false)) : ?>
<section class="booking">
    <div class="booking__wrapper">
        <div class="booking__title">
            <b><?php _e('[:ru]Забронировать номер[:en]Book a room'); ?></b>
        </div>
        <form class="booking__form" action="#" method="get">
            <div id="block-search">
                <div id="tl-search-form" class="tl-container"><noindex><a href="http://www.travelline.ru/products/tl-hotel/" rel="nofollow">
                            <?php if ($lang === "ru") {echo "система онлайн-бронирования";} else {echo "online booking system";} ?>
                        </a></noindex></div>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>