<?

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (! is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1) {
    return;
}

$arRootNode = [];
foreach ($arResult["arMap"] as $index => $arItem) {
    if ($arItem["LEVEL"] == 0) {
        $arRootNode[] = $index;
    }
}

$allNum = count($arRootNode);
$colNum = ceil($allNum / $arParams["COL_NUM"]);
?>
<div class="map__content">
    <div class="container">
        <?
        $previousLevel = -1;
        $counter = 0;
        $column = 1;
        foreach ($arResult["arMap"] as $index => $arItem):
        $arItem["FULL_PATH"] = htmlspecialcharsbx($arItem["FULL_PATH"], ENT_COMPAT, false);
        $arItem["NAME"] = htmlspecialcharsbx($arItem["NAME"], ENT_COMPAT, false);
        $arItem["DESCRIPTION"] = htmlspecialcharsbx($arItem["DESCRIPTION"], ENT_COMPAT, false);
        ?>
        <? if ($arItem["LEVEL"] < $previousLevel): ?>
            <?= str_repeat("</ul></div>", ($previousLevel - $arItem["LEVEL"])); ?>
        <? endif ?>


        <? /*if ($counter >= $colNum && $arItem["LEVEL"] == 0):
                $allNum = $allNum-$counter;
                $colNum = ceil(($allNum) / ($arParams["COL_NUM"] > 1 ? ($arParams["COL_NUM"]-$column) : 1));
                $counter = 0;
                $column++;
        */
        ?><!--
            </ul></td><td><ul class="map-level-0">
        --><? /*endif*/
        ?>

        <? if (array_key_exists($index + 1,
            $arResult["arMap"]) && $arItem["LEVEL"] < $arResult["arMap"][$index + 1]["LEVEL"]): ?>
        <div class="map__content-item">
            <h4 class="map__content-title">
                <a class="map__list-link-title" href="<?= $arItem["FULL_PATH"] ?>"><?= $arItem["NAME"] ?></a>
            </h4>
            <ul class="map__list">
                <? else: ?>
                    <? if ($arItem['LEVEL'] == '0') { ?>
                        <div class="map__content-item">
                            <h4 class="map__content-title">
                                <a class="map__list-link-title" href="<?= $arItem["FULL_PATH"] ?>"><?= $arItem["NAME"] ?></a>
                            </h4>
                        </div>
                    <? } else { ?>
                        <li class="map__list-item">
                            <a class="map__list-link" href="<?= $arItem["FULL_PATH"] ?>"><?= $arItem["NAME"] ?></a>
                        </li>
                    <? } ?>


                <? endif ?>


                <?
                $previousLevel = $arItem["LEVEL"];
                if ($arItem["LEVEL"] == 0) {
                    $counter++;
                }
                ?>

                <? endforeach ?>

                <? if ($previousLevel > 1)://close last item tags?>
                    <?= str_repeat("</ul></div>", ($previousLevel - 1)); ?>
                <? endif ?>
        </div>
    </div>
    <div class="logo-line"></div>