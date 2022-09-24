<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
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

<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter filters__bar-content">
    <div class="filters__closed-btn"></div>
    <h3 class="filters__bar-title">
        Фильтр по
        параметрам
    </h3>
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
               value="<? echo $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
    <? foreach ($arResult["ITEMS"] as $key => $arItem)//prices
    {
        $key = $arItem["ENCODED_ID"];
        if (isset($arItem["PRICE"])):
            if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                continue;
            }

            $step_num = 4;
            $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
            $prices = array();
            if (Bitrix\Main\Loader::includeModule("currency")) {
                for ($i = 0; $i < $step_num; $i++) {
                    $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i,
                        $arItem["VALUES"]["MIN"]["CURRENCY"], false);
                }
                $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"],
                    $arItem["VALUES"]["MAX"]["CURRENCY"], false);
            } else {
                $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                for ($i = 0; $i < $step_num; $i++) {
                    $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $precision, ".", "");
                }
                $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
            }



            $currentMin = $arItem["VALUES"]['MIN']['VALUE'];
            $currentMax = $arItem["VALUES"]['MAX']['VALUE'];

            if(!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]))
            {
                $currentMin = $arItem["VALUES"]["MIN"]["HTML_VALUE"];
            }
            if(!empty($arItem["VALUES"]["MAX"]["HTML_VALUE"]))
            {
                $currentMax = $arItem["VALUES"]["MAX"]["HTML_VALUE"];
            }

            ?>

            <div class="filters__bar-item filters__bar-price">
                <div class="filters__main-select filters__bar-select">
                    <div class="filters__bar-select-title">Цена</div>
                    <div class="filters__main-select-ico">
                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
                        </svg>
                    </div>
                </div>
                <!-- price range -->
                <div class="price-wrapper filters__bar-wrapper filters__bar-price-wrapper">
                    <div class="filters__price-input">
                        <div class="filters__price-field">
                            <span>от</span>
                            <input
                                    class="min-price filters__price-input-min"
                                    type="text"
                                    min="<?= $arItem["VALUES"]['MIN']['VALUE'] ?>"
                                    name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                    id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                    value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                            />
                        </div>
                        <div class="filters__price-field">
                            <span>до</span>
                            <input
                                    class="max-price filters__price-input-max"
                                    type="text"
                                    max="<?= $arItem["VALUES"]["MAX"]['VALUE'] ?>"
                                    name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                    id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                    value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                            />
                        </div>
                        <div class="filters__price-currency">₽</div>
                    </div>
                    <div class="filters__price-slider">
                        <div class="filters__price-progress progress-filterbar"></div>
                    </div>
                    <div class="filters__price-range-input">
                        <input type="range" class="filters__price-range-min" min="<?= $arItem["VALUES"]['MIN']['VALUE'] ?>" max="<?= $arItem["VALUES"]["MAX"]['VALUE'] ?>" value="0" step="<?=$currentMin?>">
                        <input type="range" class="filters__price-range-max" min="<?= $arItem["VALUES"]['MIN']['VALUE'] ?>" max="<?= $arItem["VALUES"]["MAX"]['VALUE'] ?>" value="<?=$currentMax?>"
                               step="100">
                    </div>
                    <div class="filters__price-search">выбрано: от
                        <span><?=$currentMin?></span> ₽ до <span><?=$currentMax?></span> ₽
                    </div>
                </div>
            </div>

        <?endif;
    }

    //not prices
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        if (
            empty($arItem["VALUES"])
            || isset($arItem["PRICE"])
        ) {
            continue;
        }

        if (
            $arItem["DISPLAY_TYPE"] == "A"
            && (
                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
            )
        ) {
            continue;
        }
        ?>
        <div class="filters__bar-item">
            <span class="bx-filter-container-modef"></span>
            <div class="filters__main-select filters__bar-select">
                <? if (!empty($arItem['FILTER_HINT'])): ?>
                    <div class="filters__bar-select-title-box">
                        <div class="filters__bar-select-title"><?= $arItem['NAME'] ?></div>
                        <div class="filters__tip-btn">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="9.5" stroke="#D6D6D6"></circle>
                                <path d="M9.9162 5.18663C11.0056 5.18663 11.6425 5.7883 11.6425 6.8078C11.6425 8.81337 8.64246 9.73259 8.64246 10.9861C8.64246 11.4039 8.92737 11.6379 9.24581 11.7549L11.2235 9.94986C12.2291 9.01393 13 8.17827 13 6.62396C13 4.91922 11.8101 4 9.96648 4C8.27374 4 7.46927 4.55153 7 4.98607L7.87151 6.02228C8.24022 5.6546 8.7933 5.18663 9.9162 5.18663ZM8.92737 15.0139C8.92737 15.5655 9.36313 16 9.93296 16C10.5196 16 10.9553 15.5655 10.9553 15.0139C10.9553 14.4123 10.5196 13.9777 9.93296 13.9777C9.37989 13.9777 8.92737 14.429 8.92737 15.0139Z"
                                      fill="#7A7A7A"></path>
                            </svg>
                        </div>
                    </div>
                <? else: ?>
                    <div class="filters__bar-select-title"><?= $arItem['NAME'] ?></div>
                <?endif; ?>

                <div class="filters__main-select-ico <? if ($arItem["DISPLAY_EXPANDED"] == 'Y'): ?> active-ico-filtersbar <? endif; ?>">
                    <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
                    </svg>
                </div>
            </div>

            <? if (!empty($arItem['FILTER_HINT'])): ?>
                <div class="filters__tip "><?= $arItem['FILTER_HINT'] ?></div>
            <? endif; ?>
            <div class="filters__bar-wrapper <? if ($arItem["DISPLAY_EXPANDED"] == 'Y'): ?> show-box <? endif; ?>"
                 data-role="bx_filter_block">
                <?
                $arCur = current($arItem["VALUES"]);
                switch ($arItem["DISPLAY_TYPE"]) {
                    case "A"://NUMBERS_WITH_SLIDER
                        ?>

                        <?
                        break;
                    case "B"://NUMBERS
                        ?>

                        <?
                        break;
                    case "G"://CHECKBOXES_WITH_PICTURES
                        ?>
                        <?
                        break;
                    case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                        ?>
                        <?
                        break;
                    case "P"://DROPDOWN
                        $checkedItemExist = false;
                        ?>
                        <?
                        break;
                    case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                        ?>
                        <?
                        break;
                    case "K"://RADIO_BUTTONS
                        ?>
                        <?
                        break;
                    case "U"://CALENDAR
                        ?>
                        <?
                        break;
                    default://CHECKBOXES
                        ?>


                        <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                        <div class="filters__bar-checkbox">
                            <p class="filters__bar-descr">
                                <span class="filters__bar-text"><?= $ar["VALUE"]; ?></span>
                                (<span class="filters__bar-quantity"
                                       data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)
                            </p>
                            <input
                                    type="checkbox"
                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    onclick="smartFilter.click(this)"
                                    class="checkbox__form-checked-input">
                            <label

                                    data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                    for="<? echo $ar["CONTROL_ID"] ?>"
                                    class="checkbox__form-checked <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"></label>
                        </div>
                    <? endforeach; ?>
                    <?
                }
                ?>
            </div>
        </div>
        <?
    }
    ?>


    <div class="filters__bar-btns">
        <button class="filters__bar-reset"

                type="submit"
                id="del_filter"
                name="del_filter"
        >
                    <span>
                        сбросить
                    </span>
        </button>
        <button
                type="submit"
                id="set_filter"
                name="set_filter"
                class="filters__bar-send">Применить
        </button>
    </div>

    <div class="filters__mul"></div>


</form>
<div class="filters__products-found bx-filter-popup-result" id="modef" style="display: none">
    <span class="filters__products-text">Найдено</span>
    <span class="filters__products-total" id="modef_num">20</span>
    <span class="filters__products-text">товаров</span>
    <a href="<? echo $arResult["FILTER_URL"] ?>" class="filters__products-btn">Показать</a>
</div>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
