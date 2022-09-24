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
      class="smartfilter filters__main">
    <div class="filters__main-btn filters__main-item">
        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5 4H17.5" stroke="white"/>
            <circle cx="4.5" cy="4" r="3.5" stroke="white"/>
            <path d="M10.5 13L0.5 13" stroke="white"/>
            <circle r="3.5" transform="matrix(-1 0 0 1 13.5 13)" stroke="white"/>
        </svg>
        <div class="filters__main-item-title">Фильтры</div>
    </div>

    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>_horizontal"
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

            <div class="filters__main-item">
                <div class="filters__main-select filters__select-t select-price">
                    <div class="filters__main-select-title">Цена</div>
                    <div class="filters__main-select-ico">
                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
                        </svg>
                    </div>
                </div>

                <!-- price range -->
                <div class="filters__price-wrapper price-wrapper filters__main-checkboxes">
                    <div class="filters__price-input">
                        <div class="filters__price-field">
                            <span>от</span>
                            <input type="number" class="filters__price-input-min"

                                   min="<?= $arItem["VALUES"]['MIN']['VALUE'] ?>"
                                   name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                   id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>_horizontal"
                                   value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                   size="5"
                                   onkeyup="smartFilterHorizontal.keyup(this)"
                            >
                        </div>
                        <div class="filters__price-field">
                            <span>до</span>
                            <input type="number" class="filters__price-input-max"

                                   max="<?= $arItem["VALUES"]["MAX"]['VALUE'] ?>"
                                   name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                   id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>_horizontal"
                                   value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                   size="5"
                                   onkeyup="smartFilterHorizontal.keyup(this)"
                            >
                        </div>
                        <div class="filters__price-currency">₽</div>
                    </div>
                    <div class="filters__price-slider">
                        <div class="filters__price-progress"></div>
                    </div>
                    <div class="filters__price-range-input">
                        <input type="range" class="filters__price-range-min" min="<?= $arItem["VALUES"]['MIN']['VALUE'] ?>" max="<?= $arItem["VALUES"]["MAX"]['VALUE'] ?>" value="0" step="<?=$currentMin?>">
                        <input type="range" class="filters__price-range-max" min="<?= $arItem["VALUES"]['MIN']['VALUE'] ?>" max="<?= $arItem["VALUES"]["MAX"]['VALUE'] ?>" value="<?=$currentMax?>" step="100">
                    </div>
                    <div class="filters__price-search">
                        <span class="filters__price-search-close"></span>
                        выбрано: от
                        <span><?=$currentMin?></span> ₽  до <span><?=$currentMax?></span> ₽</div>
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

        <div class="filters__main-item">
            <span class="bx-filter-container-modef"></span>
            <div class="filters__main-select filters__select-t select-power-i">
                <div class="filters__main-select-title"><?= $arItem['NAME'] ?></div>
                <div class="filters__main-select-ico">
                    <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
                    </svg>
                </div>
            </div>



            <div class="filters__main-checkboxes checkbox-power-i"
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
                                (<span class="filters__bar-quantity" data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)
                            </p>
                            <input
                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                    id="<? echo $ar["CONTROL_ID"] ?>_horizontal"
                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    onclick="smartFilterHorizontal.click(this)"
                                    class="checkbox__form-checked-input" type="checkbox">
                            <label for="<? echo $ar["CONTROL_ID"] ?>_horizontal" class="checkbox__form-checked  <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"></label>
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


        <button
                style="display: none"
                type="submit"
                id="del_filterHorizontal"
                name="del_filter"
        >
                    <span>
                        сбросить
                    </span>
        </button>
        <button
                style="display: none"
                type="submit"
                id="set_filterHorizontal"
                name="set_filter"
                >Применить
        </button>

    <div class="filters__mul"></div>


</form>
<div class="filters__products-found bx-filter-popup-result" id="modefHorizontal" style="display: none">
    <span class="filters__products-text">Найдено</span>
    <span class="filters__products-total" id="modef_numHorizontal">20</span>
    <span class="filters__products-text">товаров</span>
    <a href="<? echo $arResult["FILTER_URL"] ?>" class="filters__products-btn">Показать</a>
</div>
<script type="text/javascript">
    var smartFilterHorizontal = new JCSmartFilterHorizontal('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
