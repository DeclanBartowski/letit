<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<section class="history__header">
    <div class="min-container">
        <div class="history__header-titles">
            <?if($arResult['PROPERTIES']['NAME']['VALUE']){?>
                <h3 class="history__header__item-name">
                    <?=$arResult['PROPERTIES']['NAME']['VALUE']?>
                </h3>
            <?}?>
            <?if($arResult['PROPERTIES']['CITY']['VALUE']){?>
                <h3 class="history__header__item-city">
                    <?=$arResult['PROPERTIES']['CITY']['VALUE']?>
                </h3>
            <?}?>
        </div>
        <h1 class="history__header-title title">
            Жизнь c
            <img src="<?=SITE_TEMPLATE_PATH?>/images/ico/logo-red.svg" alt="LELIT" class="life-page__img">
        </h1>
        <p class="history__header-text">
            <?=$arResult['IBLOCK']['~DESCRIPTION']?>
        </p>
        <div class="history__header-img-box">
            <?if($arResult['PREVIEW_PICTURE']['SRC']){?>
                <picture>
                    <!--<source srcset="images/life/1.webp" type="image/webp">-->
                    <img class="history__header-img" src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arResult['PROPERTIES']['NAME']['VALUE']?>">
                </picture>
            <?}?>
        </div>
    </div>
</section>
<section class="history__content">
    <div class="min-container">
        <h1 class="history__title title">
            <?=$arResult['NAME']?>
        </h1>
        <?=$arResult['~DETAIL_TEXT']?>
    </div>
</section>
<?if($arResult["TORIGHT"]){?>
    <section class="history__info">
        <a href="<?=$arResult["TORIGHT"]["URL"]?>" class="history__info-link">
            <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L11.5 11.5L1 22" stroke="white" stroke-width="2" stroke-linejoin="round"/>
            </svg>
        </a>
        <p class="history__info-text">Прочитайте следующую историю</p>
        <div class="history__footer-titles">
            <?if($arResult["TORIGHT"]["PROPERTIES"]['NAME']['VALUE']){?>
                <h3 class="history__header__item-name">
                    <?=$arResult["TORIGHT"]["PROPERTIES"]['NAME']['VALUE']?>
                </h3>
            <?}?>
            <?if($arResult["TORIGHT"]["PROPERTIES"]['CITY']['VALUE']){?>
                <h3 class="history__header__item-city">
                    <?=$arResult["TORIGHT"]["PROPERTIES"]['CITY']['VALUE']?>
                </h3>
            <?}?>
        </div>
    </section>
<?}?>
<div class="logo-line"></div>