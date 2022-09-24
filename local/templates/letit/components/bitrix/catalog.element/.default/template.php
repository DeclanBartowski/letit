<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$this->setFrameMode(true);?>
<section class="product">
    <div class="container">
        <h1 class="product__title title hidden-title">
            <?=$arResult['NAME']?>
        </h1>
        <div class="product__gallery">
            <?if($arResult['SLIDER']){?>
            <div class="gallery">
                <div class="swiper gallery__swiper">
                    <div class="swiper-wrapper">
                        <?foreach ($arResult['SLIDER'] as $arItem){?>
                        <div class="swiper-slide">
                            <article class="gallery__previev">
                                    <img class="gallery__img" src="<?=$arItem['SMALL']?>" alt="<?=$arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']?:$arResult['NAME']?>"/>
                            </article>
                        </div>
                        <?}?>
                    </div>
                </div>
                <div class="gallery__main-box">
                    <div class="swiper gallery__main-swiper">
                        <div class="swiper-wrapper">
                            <?foreach ($arResult['SLIDER'] as $arItem){?>
                                <div class="swiper-slide">
                                    <article class="gallery__main-item">
                                        <img class="gallery__main-item-img" src="<?=$arItem['BIG']?>" alt="<?=$arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']?:$arResult['NAME']?>">
                                    </article>
                                </div>
                            <?}?>
                        </div>
                        <div class="swiper-button-prev gallery__button-prev">
                            <svg class="popular__arrow-svg" width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27" transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                <path class="popular__arrow-path" d="M32 18.5L23 27.5L32 36.5"/>
                            </svg>
                        </div>
                        <div class="swiper-button-next gallery__button-next">
                            <svg class="popular__arrow-svg" width="55" height="55"  fill="none" viewBox="0 0 55 55" xmlns="http://www.w3.org/2000/svg">
                                <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27" transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                <path class="popular__arrow-path" d="M23 18.5L32 27.5L23 36.5"/>
                            </svg>
                        </div>
                        <div class="swiper-scrollbar gallery__swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
            <?}?>
        </div>
        <article class="product__info">
            <div class="product__art">
                артикул:
                <span class="product__art-number">Lelit PS-11N</span>
            </div>
            <h1 class="product__title title">
               <?=$arResult['NAME']?>
            </h1>
            <div class="product__buy">
                <div class="product__price-item">
                    <span class="product__price"><?=$arResult['MIN_PRICE']['PRINT_VALUE']?></span>

                </div>
                <?if($arResult['PROPERTIES']['LINK']['VALUE']){?>
                <button class="product__buy-btn product__buy-btn-open">купить</button>
                <?}?>
            </div>
            <h2 class="product__subtitle subtitle">Основные характеристики</h2>
            <div class="product__list-descr">
                <ul class="product__list">
                    <li class="product__list-item">Мощность утюга</li>
                    <li class="product__list-item">Мощность бойлера</li>
                    <li class="product__list-item">Рабочее давление</li>
                    <li class="product__list-item">Максимальное давление</li>
                    <li class="product__list-item">Напряжение</li>
                </ul>
                <ul class="product__list">
                    <li class="product__list-item">800 Вт.</li>
                    <li class="product__list-item">1150 Вт.</li>
                    <li class="product__list-item">2,5 бар</li>
                    <li class="product__list-item">5,5 бар</li>
                    <li class="product__list-item">230V-50Hz(120V-60Hz)</li>
                </ul>
            </div>
        </article>
    </div>
    <?if($arResult['PROPERTIES']['LINK']['VALUE']){?>
    <section class="modal-product">
        <div class="modal-product__content">
            <div class="modal-product__close"></div>
            <div class="modal-product__img">
                <svg width="98" height="81" viewBox="0 0 98 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="34.5949" cy="71.7668" r="7.0715" stroke="#CD1A24" stroke-width="4"/>
                    <circle cx="66.341" cy="71.7668" r="7.0715" stroke="#CD1A24" stroke-width="4"/>
                    <path d="M2.84375 4C1.73918 4 0.84375 4.89543 0.84375 6C0.84375 7.10457 1.73918 8 2.84375 8V4ZM13.8496 6L15.6728 5.17778L15.1416 4H13.8496V6ZM31.459 45.0469L33.1673 46.0869L33.7157 45.1861L33.2822 44.2247L31.459 45.0469ZM24.8555 55.8932L23.1472 54.8532C22.7713 55.4706 22.7578 56.2428 23.1119 56.873C23.466 57.5032 24.1326 57.8932 24.8555 57.8932V55.8932ZM77.6836 57.8932C78.7882 57.8932 79.6836 56.9978 79.6836 55.8932C79.6836 54.7887 78.7882 53.8932 77.6836 53.8932V57.8932ZM2.84375 8H13.8496V4H2.84375V8ZM12.0264 6.82222L29.6358 45.8691L33.2822 44.2247L15.6728 5.17778L12.0264 6.82222ZM29.7507 44.0068L23.1472 54.8532L26.5638 56.9333L33.1673 46.0869L29.7507 44.0068ZM24.8555 57.8932H77.6836V53.8932H24.8555V57.8932Z" fill="#CD1A24"/>
                    <path d="M17.4531 14.3164H85.9997L79.5618 39.263L30.8921 44.5648" stroke="#CD1A24" stroke-width="4" stroke-linejoin="round"/>
                    <circle cx="84.5" cy="13.5" r="13.5" fill="#16171B"/>
                    <path d="M79 12.5L83.5 17L90.5 10" stroke="white" stroke-width="3"/>
                </svg>
            </div>
            <h2 class="modal-product__title title">Внимание!</h2>
            <p class="modal-product__text">Вы переходите на другой сайт
                <a class="modal-product__link" target="_blank" href="<?=$arResult['PROPERTIES']['LINK']['VALUE']?>">steaming.ru</a>
                где будет осуществлятся ваша покупка
            </p>
            <div class="modal-product__link-box">
                <a class="modal-product__btn" target="_blank" href="<?=$arResult['PROPERTIES']['LINK']['VALUE']?>">перейти</a>
            </div>
        </div>
    </section>
    <?}?>
</section>
<!-- product-info -->
<section class="product-page__info-box">
    <div class="product-info__tabs">
        <div class="min-container">
            <?if($arResult['DETAIL_TEXT']){?>
            <div class="product-info__tab-item"><a class="product-info__tab-link" href="#product-info">Описание</a></div>
            <?}?>
            <div class="product-info__tab-item"><a class="product-info__tab-link" href="#specifications">характеристики</a></div>
            <?if($arResult['DOCUMENTS']){?>
            <div class="product-info__tab-item"><a class="product-info__tab-link" href="#docs">Документация</a></div>
            <?}?>
        </div>
    </div>
    <?if($arResult['DETAIL_TEXT']){?>
    <section id="product-info" class="product-info">
        <div class="min-container">
            <div class="product-info__tab">Описание
                <div class="product-info__tab-ico">
                    <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 0.75L8 7.25L14.5 0.75" stroke="black" stroke-width="2"/>
                    </svg>
                </div>
            </div>
            <?if($arResult['DETAIL_TEXT']){?>
            <article class="product-info__descr  tab-content">
                <h3 class="product-info__title">Описание</h3>
                <?=$arResult['DETAIL_TEXT']?>
            </article>
            <?}?>
        </div>
    </section>
    <?}?>
    <!-- relers -->
    <section class="relers">
        <!-- item 1 -->
        <div class="relers__item-box">
            <article class="relers__item">
                <div class="relers__content">
                    <div class="relers__content-box">
                        <h2 class="relers__item-title title">Линия expert</h2>
                        <p  class="relers__item-text">Lelit - лучшее гладильное оборудование, которое поможет вам экономить время.
                            Мы производим наши продукты для тех, кто хочет получить результат, не затрачивая при этом много времени.
                            Женщины всегда обращают внимание на детали. Даже если он сильно заняты, они всегда хотят показать себя в наилучшем виде, одеваясь в безупречно отглаженную одежду. Чтобы отвечать требованиям самых занятых женщин, компания Lelit объединила быстроту и качество глажения.
                        </p>
                    </div>
                </div>
                <div class="relers__content-img">
                    <div class="relers__img-box">
                        <picture>
                            <source srcset="images/relers/1.webp" type="image/webp">
                            <img class="relers__img" src="images/relers/1.jpg" alt="Линия expert">
                        </picture>
                    </div>
                </div>
            </article>
        </div>
        <!-- item 2 -->
        <div class="relers__item-box">
            <article class="relers__item">
                <div class="relers__content">
                    <div class="relers__content-box">
                        <h3 class="relers__item-title title">Линия Pro</h3>
                        <p  class="relers__item-text">Lelit- выбор профессионалов.
                            Мы с максимальной заботой относимся к творениям модельеров. Каждый портной и стилист знают, что утюг - его первый лучший друг, на которого он может положиться.
                            Производство одежды становится гораздо проще с использованием профессиональной гладильной техники. Для портного утюжка швов или фиксация складок на одежде, имеют решающее значение для получения наилучшего результата.
                            С оборудованием Lelit вы сможете позаботиться о сложных элементах одежды, а процесс финишной обработки станет более простым.
                        </p>
                    </div>
                </div>
                <div class="relers__content-img">
                    <div class="relers__img-box">
                        <picture>
                            <source srcset="images/relers/2.webp" type="image/webp">
                            <img class="relers__img" src="images/relers/2.jpg" alt="Линия Pro">
                        </picture>
                    </div>
                </div>
            </article>
        </div>
        <!-- item 3 -->
        <div class="relers__item-box">
            <article class="relers__item">
                <div class="relers__content">
                    <div class="relers__content-box">
                        <h3 class="relers__item-title title">Линия industry</h3>
                        <p  class="relers__item-text">Lelit - гарантированная быстрота и долгий срок службы.
                            Мы поставляем наше оборудование в наиболее важные секторы финишной обработки, гарантируя качество и скорость глажения больших объемов.
                            Прачечные работают с объемами. Мы хотим облегчить вам жизнь, производя оборудование, которое превращает глажение в комфортное занятие.
                            Скорость глажения достигается благодаря легкому скольжению утюга п о ткани, сухому и мощному пару, быстрому процессу нагрева бойлера и пополнения водой.
                        </p>
                    </div>
                </div>
                <div class="relers__content-img">
                    <div class="relers__img-box">
                        <picture>
                            <source srcset="images/relers/3.webp" type="image/webp">
                            <img class="relers__img" src="images/relers/3.jpg" alt="Линия industry">
                        </picture>
                    </div>
                </div>
            </article>
        </div>
        <!-- item 4 -->
        <div class="relers__item-box">
            <article class="relers__item">
                <div class="relers__content">
                    <div class="relers__content-box">
                        <h3 class="relers__item-title title">Линия экологической уборки</h3>
                        <p  class="relers__item-text">Lelit - уборка без усилий.
                            Благодаря нашим парогенераторам, вам больше не потребуются чистящие средства, что благотворно повлияет на экологию планеты и сбережет ваши деньги. Пар быстро удаляет жир, очищает, дезинфицирует поверхности.
                        </p>
                    </div>
                </div>
                <div class="relers__content-img">
                    <div class="relers__img-box">
                        <picture>
                            <source srcset="images/relers/4.webp" type="image/webp">
                            <img class="relers__img" src="images/relers/4.jpg" alt="Линия экологической уборки">
                        </picture>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <!-- specifications -->
    <section id="specifications" class="specifications">
        <div class="min-container">
            <div class="product-info__tab">характеристики
                <div class="product-info__tab-ico">
                    <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 0.75L8 7.25L14.5 0.75" stroke="black" stroke-width="2"/>
                    </svg>
                </div>
            </div>
            <h3 class="specifications__subtitle subtitle">характеристики</h3>
            <div class="specifications__content  tab-content">
                <h6 class="specifications__content-name">Парогенератор</h6>
                <table class="specifications__table">
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Мощность утюга</td>
                        <td class="specifications__td">800 Вт.</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Мощность бойлера</td>
                        <td class="specifications__td">1150 Вт.</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Рабочее давление</td>
                        <td class="specifications__td">2,5 бар</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Максимальное давление</td>
                        <td class="specifications__td">5,5 бар</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Напряжение</td>
                        <td class="specifications__td">230V-50Hz(120V-60Hz)</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Номинальный объем бойлера</td>
                        <td class="specifications__td">1,2 л</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Фактический объем бойлера</td>
                        <td class="specifications__td">1 л</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Время непрерывной работы</td>
                        <td class="specifications__td">до 1,5 ч</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Материал бойлера</td>
                        <td class="specifications__td">нержавеющая сталь</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Расположение ТЭНа</td>
                        <td class="specifications__td">внешннее</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Область применения</td>
                        <td class="specifications__td">бытовое</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Размеры парогенератопа (ДхШхВ)</td>
                        <td class="specifications__td">23х31х30 см.</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Вес</td>
                        <td class="specifications__td">6 кг.</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Производство</td>
                        <td class="specifications__td">Италия</td>
                    </tr>
                    <tr class="specifications__tr">
                        <td class="specifications__td specifications__td-name">Гарантия</td>
                        <td class="specifications__td">12 месяцев</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <!-- docs -->
    <!-- docs -->
    <?if($arResult['DOCUMENTS']){?>
    <section id="docs" class="docs">
        <div class="min-container">
            <div class="product-info__tab ">Документация
                <div class="product-info__tab-ico">
                    <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 0.75L8 7.25L14.5 0.75" stroke="black" stroke-width="2"/>
                    </svg>
                </div>
            </div>
            <h3 class="docs__subtitle subtitle">Документация</h3>
            <div class="docs__content  tab-content">
                <div class="docs__content-item">
                    <?foreach ($arResult['DOCUMENTS'] as $arItem){?>
                    <!-- download -->
                    <a class="docs__content-link" download href="<?=$arItem['SRC']?>">
                        <img class="docs__ico" src="<?=$arItem['ICON']?>" alt="Скачать файл">
                        <div class="docs__infobox">
                            <h5 class="docs__name"><?=$arItem['NAME']?></h5>
                            <div class="docs__size"><?=$arItem['SIZE']?></div>
                            <div class="docs__btn">
                                Скачать
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.15234 7V12.5C1.15234 13.6046 2.04777 14.5 3.15234 14.5H14.1523C15.2569 14.5 16.1523 13.6046 16.1523 12.5V7M4.65234 6.5L8.65234 9.5M8.65234 9.5L12.6523 6.5M8.65234 9.5V0.5" stroke-width="2"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <?}?>
                </div>
            </div>
        </div>
    </section>
    <?}?>
</section>
