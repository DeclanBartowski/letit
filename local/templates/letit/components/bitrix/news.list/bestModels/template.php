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
<? if ($arResult['ITEMS']) { ?>
    <section class="relers">
        <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
            ?>
            <div class="relers__item-box">
                <article class="relers__item container">
                    <div class="relers__content">
                        <h3 class="relers__item-title title"><?= $arItem['NAME'] ?></h3>
                        <p class="relers__item-text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                    </div>
                    <div class="relers__content">
                        <div class="relers__img-box">
                            <? if ($arItem['PREVIEW_PICTURE']['SRC']) { ?>
                                <picture>
                                    <!--<source srcset="images/advantages/relers-1.webp" type="image/webp">-->
                                    <img class="relers__img" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                         alt="<?= $arItem['NAME'] ?>">
                                </picture>
                            <? } ?>
                        </div>
                    </div>
                </article>
            </div>
        <? } ?>
    </section>
<? } ?>