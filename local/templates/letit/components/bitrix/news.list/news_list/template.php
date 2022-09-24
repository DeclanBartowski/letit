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
<section class="news container">
    <div class="news__header">
        <h2 class="news__title title"><?= $arResult['NAME'] ?></h2>
    </div>
    <div class="life__more">
        <a class="link-more" href="<?= $arResult["LIST_PAGE_URL"] ?>"><?= GetMessage('ALL_NEWS') ?>
            <svg class="link-more__arrow" width="33" height="13" viewBox="0 0 33 13" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M26 0.5L32 6.5L26 12.5" stroke="#16171B"/>
                <path d="M32 6.5H0" stroke="#16171B"/>
            </svg>
        </a>
    </div>
    <div class="news__content">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news__item"
               id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                    <div class="news__item-img-box">
                        <picture>
                            <img class="news__item-img" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                 alt="<?= $arItem['PREVIEW_PICUTRE']['ALT'] ?>">
                        </picture>
                    </div>
                <? endif; ?>
                <h4 class="news__item-title"><?= $arItem['NAME'] ?></h4>
                <p class="news__item-text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                <? if (!empty($arItem["DISPLAY_ACTIVE_FROM"])): ?>
                    <time class="news__item-date" datetime="<?= date('Y-m-d',
                        strtotime($arItem["DISPLAY_ACTIVE_FROM"])) ?>"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></time>
                <? endif; ?>
            </a>
        <? endforeach; ?>

    </div>
</section>
