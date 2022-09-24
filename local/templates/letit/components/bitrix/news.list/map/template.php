<? if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
<? if ($arParams['IS_AJAX'] != 'Y') { ?>
    <div id="map" class="shops__map" style="width: 100%; height: 400px"></div>
    <div class="min-container" data-container>
    <? $APPLICATION->IncludeComponent(
        "bitrix:sale.location.selector.search",
        "custom",
        [
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CODE" => "",
            "FILTER_BY_SITE" => "N",
            "ID" => "",
            "INITIALIZE_BY_GLOBAL_EVENT" => "",
            "INPUT_NAME" => "LOCATION",
            "JS_CALLBACK" => "",
            "JS_CONTROL_GLOBAL_ID" => "",
            "PROVIDE_LINK_BY" => "id",
            "SHOW_DEFAULT_LOCATIONS" => "N",
            "SUPPRESS_ERRORS" => "N"
        ]
    ); ?>
<? } ?>
<?if($arResult['NEW_ITEMS']){?>
    <? foreach ($arResult['NEW_ITEMS'] as $key => $section) { ?>
        <div class="shops__address">
            <h2 class="shops__address-subtitle subtitle"><?= $arResult['CITIES'][$key]['NAME_RU'] ?> </h2>
            <? foreach ($section as $itemKey => $arItem) { ?>
                <article class="shops__address-item">
                    <div class="shops__address-item-content">
                        <h3 class="shops__address-name"><?= $arItem['NAME'] ?></h3>
                        <? if ($arItem['PROPERTIES']['MAP']['VALUE']) {
                            $map = explode(',', $arItem['PROPERTIES']['MAP']['VALUE']); ?>
                            <? if ($map) { ?>
                                <a href="#map" class="shops__address-link-box center-point"
                                   data-latitude="<?= $map[0] ?>" data-longitude="<?= $map[1] ?>">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/shops/map-ico.svg"
                                         alt="<?= $arItem['NAME'] ?>" class="shops__address-ico">
                                    <p class="shops__address-text-link">Показать на карте</p>
                                </a>
                            <? } ?>
                        <? } ?>
                    </div>
                    <div class="shops__address-item-content">
                        <address>
                            <? if ($arItem['PROPERTIES']['ADRESS']['VALUE']) { ?>
                                <p class="shops__address-text"> <?= $arItem['PROPERTIES']['ADRESS']['VALUE'] ?></p>
                            <? } ?>
                            <? if ($arItem['PROPERTIES']['PHONE']['VALUE']) { ?>
                                <p class="shops__address-text">Телефон:
                                    <a href="tel: +<?= normalizePhone($arItem['PROPERTIES']['PHONE']['VALUE']) ?>"><?= $arItem['PROPERTIES']['PHONE']['VALUE'] ?></a>
                                </p>
                            <? } ?>
                            <? if ($arItem['PROPERTIES']['WORK_TIME']['VALUE']) { ?>
                                <p class="shops__address-text">Время
                                    работы: <?= $arItem['PROPERTIES']['WORK_TIME']['VALUE'] ?></p>
                            <? } ?>
                            <? if ($arItem['PROPERTIES']['METRO']['VALUE']) { ?>
                                <p class="shops__address-text"><?= $arItem['PROPERTIES']['METRO']['VALUE'] ?></p>
                            <? } ?>
                        </address>
                    </div>
                </article>
            <? } ?>

        </div>
    <? } ?>
<?} else {?>
    <div class="shops__address">
        <section class="negative">
            <img class="negative__ico" src="<?=SITE_TEMPLATE_PATH?>/images/search-big-ico.svg" alt="По вашему запросу ничего не найдено">
            <p class="negative__text subtitle">По вашему запросу ничего не найдено</p>
        </section>
    </div>
<?}?>
<? if ($arParams['IS_AJAX'] != 'Y') { ?>
    </div>
<? } ?>