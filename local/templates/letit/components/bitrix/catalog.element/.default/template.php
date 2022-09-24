<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

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
$this->setFrameMode(true); ?>
<section class="product">
    <div class="container">
        <h1 class="product__title title hidden-title">
            <?= $arResult['NAME'] ?>
        </h1>
        <div class="product__gallery">
            <? if ($arResult['SLIDER']) { ?>
                <div class="gallery">
                    <div class="swiper gallery__swiper">
                        <div class="swiper-wrapper">
                            <? foreach ($arResult['SLIDER'] as $arItem) { ?>
                                <div class="swiper-slide">
                                    <article class="gallery__previev">
                                        <img class="gallery__img" src="<?= $arItem['SMALL'] ?>"
                                             alt="<?= $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'] ?: $arResult['NAME'] ?>"/>
                                    </article>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                    <div class="gallery__main-box">
                        <div class="swiper gallery__main-swiper">
                            <div class="swiper-wrapper">
                                <? foreach ($arResult['SLIDER'] as $arItem) { ?>
                                    <div class="swiper-slide">
                                        <article class="gallery__main-item">
                                            <img class="gallery__main-item-img" src="<?= $arItem['BIG'] ?>"
                                                 alt="<?= $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'] ?: $arResult['NAME'] ?>">
                                        </article>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="swiper-button-prev gallery__button-prev">
                                <svg class="popular__arrow-svg" width="55" height="55" viewBox="0 0 55 55" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27"
                                          transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                    <path class="popular__arrow-path" d="M32 18.5L23 27.5L32 36.5"/>
                                </svg>
                            </div>
                            <div class="swiper-button-next gallery__button-next">
                                <svg class="popular__arrow-svg" width="55" height="55" fill="none" viewBox="0 0 55 55"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27"
                                          transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                    <path class="popular__arrow-path" d="M23 18.5L32 27.5L23 36.5"/>
                                </svg>
                            </div>
                            <div class="swiper-scrollbar gallery__swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
        <article class="product__info">
            <? if (!empty($arResult['PROPERTIES']["ARTNUMBER"]['VALUE'])): ?>
                <div class="product__art">
                    <?= $arResult['PROPERTIES']["ARTNUMBER"]['NAME'] ?>:
                    <span class="product__art-number"><?= $arResult['PROPERTIES']["ARTNUMBER"]['VALUE'] ?></span>
                </div>
            <? endif; ?>
            <h1 class="product__title title">
                <?= $arResult['NAME'] ?>
            </h1>
            <div class="product__buy">
                <div class="product__price-item">
                    <span class="product__price"><?= $arResult['MIN_PRICE']['PRINT_VALUE'] ?></span>

                </div>
                <? if ($arResult['PROPERTIES']['LINK']['VALUE']) { ?>
                    <button class="product__buy-btn product__buy-btn-open"><?=GetMessage('BUY_TITLE')?></button>
                <? } ?>
            </div>
            <?if(!empty($arResult['MIN_CHARACTER'])):?>
            <h2 class="product__subtitle subtitle"><?=GetMessage('MAIN_CHARACTER')?></h2>
            <div class="product__list-descr">
                <ul class="product__list">
                    <?foreach ($arResult['MIN_CHARACTER'] as $item):?>
                        <li class="product__list-item"><?=$item['NAME']?></li>
                    <?endforeach;?>
                </ul>
                <ul class="product__list">
                    <?foreach ($arResult['MIN_CHARACTER'] as $item):?>
                        <li class="product__list-item"><?=$item['VALUE']?></li>
                    <?endforeach;?>
                </ul>
            </div>
            <?endif;?>
        </article>
    </div>
    <? if ($arResult['PROPERTIES']['LINK']['VALUE']) { ?>
        <section class="modal-product">
            <div class="modal-product__content">
                <div class="modal-product__close"></div>
                <div class="modal-product__img">
                    <svg width="98" height="81" viewBox="0 0 98 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="34.5949" cy="71.7668" r="7.0715" stroke="#CD1A24" stroke-width="4"/>
                        <circle cx="66.341" cy="71.7668" r="7.0715" stroke="#CD1A24" stroke-width="4"/>
                        <path d="M2.84375 4C1.73918 4 0.84375 4.89543 0.84375 6C0.84375 7.10457 1.73918 8 2.84375 8V4ZM13.8496 6L15.6728 5.17778L15.1416 4H13.8496V6ZM31.459 45.0469L33.1673 46.0869L33.7157 45.1861L33.2822 44.2247L31.459 45.0469ZM24.8555 55.8932L23.1472 54.8532C22.7713 55.4706 22.7578 56.2428 23.1119 56.873C23.466 57.5032 24.1326 57.8932 24.8555 57.8932V55.8932ZM77.6836 57.8932C78.7882 57.8932 79.6836 56.9978 79.6836 55.8932C79.6836 54.7887 78.7882 53.8932 77.6836 53.8932V57.8932ZM2.84375 8H13.8496V4H2.84375V8ZM12.0264 6.82222L29.6358 45.8691L33.2822 44.2247L15.6728 5.17778L12.0264 6.82222ZM29.7507 44.0068L23.1472 54.8532L26.5638 56.9333L33.1673 46.0869L29.7507 44.0068ZM24.8555 57.8932H77.6836V53.8932H24.8555V57.8932Z"
                              fill="#CD1A24"/>
                        <path d="M17.4531 14.3164H85.9997L79.5618 39.263L30.8921 44.5648" stroke="#CD1A24"
                              stroke-width="4" stroke-linejoin="round"/>
                        <circle cx="84.5" cy="13.5" r="13.5" fill="#16171B"/>
                        <path d="M79 12.5L83.5 17L90.5 10" stroke="white" stroke-width="3"/>
                    </svg>
                </div>
                <h2 class="modal-product__title title"><?=GetMessage('WARNING_TITLE')?></h2>
                <p class="modal-product__text"><?=GetMessage('TITLE_MODAL')?>
                    <a class="modal-product__link" target="_blank"
                       href="<?= $arResult['PROPERTIES']['LINK']['VALUE'] ?>"><?=GetMessage('SITE_TITLE')?></a>
                    <?=GetMessage('DESC_MODAL')?>
                </p>
                <div class="modal-product__link-box">
                    <a class="modal-product__btn" target="_blank"
                       href="<?= $arResult['PROPERTIES']['LINK']['VALUE'] ?>"><?=GetMessage('GO_TITLE')?></a>
                </div>
            </div>
        </section>
    <? } ?>
</section>
<!-- product-info -->
<section class="product-page__info-box">
    <div class="product-info__tabs">
        <div class="min-container">
            <? if ($arResult['DETAIL_TEXT']) { ?>
                <div class="product-info__tab-item"><a class="product-info__tab-link" href="#product-info"><?=GetMessage('DETAIL_TITLE')?></a>
                </div>
            <? } ?>
            <? if ($arResult['FULL_CHARACTER']): ?>
                <div class="product-info__tab-item"><a class="product-info__tab-link"
                                                       href="#specifications"><?=GetMessage('CHARACTER_TITLE')?></a></div>
            <? endif; ?>
            <? if ($arResult['DOCUMENTS']) { ?>
                <div class="product-info__tab-item"><a class="product-info__tab-link" href="#docs"><?=GetMessage('DOCUMENT_TITLE')?></a>
                </div>
            <? } ?>
        </div>
    </div>
    <? if ($arResult['DETAIL_TEXT']) { ?>
        <section id="product-info" class="product-info">
            <div class="min-container">
                <div class="product-info__tab"><?=GetMessage('DETAIL_TITLE')?>
                    <div class="product-info__tab-ico">
                        <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 0.75L8 7.25L14.5 0.75" stroke="black" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <? if ($arResult['DETAIL_TEXT']) { ?>
                    <article class="product-info__descr  tab-content">
                        <h3 class="product-info__title"><?=GetMessage('DETAIL_TITLE')?></h3>
                        <?= $arResult['DETAIL_TEXT'] ?>
                    </article>
                <? } ?>
            </div>
        </section>
    <? } ?>

    <? if (!empty($arResult['LINE_BANNERS'])): ?>
        <section class="relers">
            <? foreach ($arResult['LINE_BANNERS'] as $lineBanner): ?>
                <div class="relers__item-box">
                    <article class="relers__item">
                        <div class="relers__content">
                            <div class="relers__content-box">
                                <h2 class="relers__item-title title"><?= $lineBanner['NAME'] ?></h2>
                                <p class="relers__item-text"><?= $lineBanner['PREVIEW_TEXT'] ?></p>
                            </div>
                        </div>
                        <? if (!empty($lineBanner['PREVIEW_PICTURE'])): ?>
                            <div class="relers__content-img">
                                <div class="relers__img-box">
                                    <picture>
                                        <img class="relers__img" src="<?= $lineBanner['PREVIEW_PICTURE'] ?>"
                                             alt="<?= $lineBanner['NAME'] ?>">
                                    </picture>
                                </div>
                            </div>
                        <? endif; ?>
                    </article>
                </div>
            <? endforeach; ?>

        </section>
    <? endif; ?>

    <? if ($arResult['FULL_CHARACTER']): ?>
        <section id="specifications" class="specifications">
            <div class="min-container">
                <div class="product-info__tab"><?=GetMessage('CHARACTER_TITLE')?>
                    <div class="product-info__tab-ico">
                        <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 0.75L8 7.25L14.5 0.75" stroke="black" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <h3 class="specifications__subtitle subtitle"><?=GetMessage('CHARACTER_TITLE')?></h3>
                <div class="specifications__content  tab-content">
                    <h6 class="specifications__content-name"><?=$arResult["SECTION"]['NAME']?></h6>
                    <table class="specifications__table">
                        <? foreach ($arResult["DISPLAY_PROPERTIES"] as $prop): ?>
                            <?
                            if (empty($prop['VALUE'])) {
                                continue;
                            }
                            ?>
                            <tr class="specifications__tr">
                                <td class="specifications__td specifications__td-name"><?= $prop['NAME'] ?></td>
                                <td class="specifications__td"><?= $prop['VALUE'] ?></td>
                            </tr>
                        <? endforeach; ?>

                    </table>
                </div>
            </div>
        </section>
    <? endif; ?>


    <? if ($arResult['DOCUMENTS']) { ?>
        <section id="docs" class="docs">
            <div class="min-container">
                <div class="product-info__tab "><?=GetMessage('DOCUMENT_TITLE')?>
                    <div class="product-info__tab-ico">
                        <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 0.75L8 7.25L14.5 0.75" stroke="black" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <h3 class="docs__subtitle subtitle"><?=GetMessage('DOCUMENT_TITLE')?></h3>
                <div class="docs__content  tab-content">
                    <div class="docs__content-item">
                        <? foreach ($arResult['DOCUMENTS'] as $arItem) { ?>
                            <!-- download -->
                            <a class="docs__content-link" download href="<?= $arItem['SRC'] ?>">
                                <img class="docs__ico" src="<?= $arItem['ICON'] ?>" alt="Скачать файл">
                                <div class="docs__infobox">
                                    <h5 class="docs__name"><?= $arItem['NAME'] ?></h5>
                                    <div class="docs__size"><?= $arItem['SIZE'] ?></div>
                                    <div class="docs__btn">
                                        <?=GetMessage('DOWNLOAD_BTN')?>
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.15234 7V12.5C1.15234 13.6046 2.04777 14.5 3.15234 14.5H14.1523C15.2569 14.5 16.1523 13.6046 16.1523 12.5V7M4.65234 6.5L8.65234 9.5M8.65234 9.5L12.6523 6.5M8.65234 9.5V0.5"
                                                  stroke-width="2"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        <? } ?>
                    </div>
                </div>
            </div>
        </section>
    <? } ?>
</section>
