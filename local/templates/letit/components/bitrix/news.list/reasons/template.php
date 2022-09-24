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
<section class="about">
    <h1 class="about__title title"><?=$arResult['NAME']?></h1>
    <div class="about__content">
        <? foreach ($arResult["ITEMS"] as $arItem) { ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
            ?>
            <article class="about__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? if ($arItem['PROPERTIES']['ICON']['VALUE']) { ?>
                    <svg class="about__ico <?= $arItem['PROPERTIES']['ICON']['VALUE'] ?>">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprite.svg#<?= $arItem['PROPERTIES']['ICON']['VALUE'] ?>"></use>
                    </svg>
                <? } ?>
                <h6 class="about__title-item"><?= $arItem['NAME'] ?></h6>
                <? if ($arItem['PREVIEW_TEXT']) { ?>
                    <h6 class="about__subtitle-item"><?= $arItem['PREVIEW_TEXT'] ?></h6>
                <? } ?>
                <? if ($arItem['~DETAIL_TEXT']) { ?>
                    <p class="about__text"><?= $arItem['~DETAIL_TEXT'] ?></p>
                <? } ?>
            </article>
        <? } ?>
    </div>
</section>