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
<section class="banner">
    <div class="swiper banner-swiper">
        <div class="swiper-wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="swiper-slide">
                    <div class="slider__item"
                         style="background-image: url('<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>');">
                        <div class="slider__item-content container">
                            <h2 class="slider__item-title title"
                                id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><?= $arItem['NAME'] ?></h2>
                            <p class="slider__item-text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                            <a class="slider__item-link"
                               href="<?= $arItem['CODE'] ?>"><?= GetMessage('MAIN_BANNER_MORE') ?>
                                <svg width="34" height="13" viewBox="0 0 34 13" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.5 0.5L32.5 6.5L26.5 12.5" stroke="white"/>
                                    <path d="M32.5 6.5H0.5" stroke="white"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="banner-swiper-pagination container"></div>
    </div>
    <div class="banner__arrow-down">
        <svg width="55" height="88" viewBox="0 0 55 88" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect y="88" width="88" height="55" rx="27.5" transform="rotate(-90 0 88)" fill="#16171B"/>
            <path opacity="0.2" d="M21 62.25L27.5 68.75L34 62.25" stroke="white" stroke-width="2"/>
            <path opacity="0.5" d="M18.5 43.25L27.5 52.25L36.5 43.25" stroke="white" stroke-width="2"/>
            <path d="M14 19.25L27.5 33.25L41 19.25" stroke="white" stroke-width="2"/>
        </svg>
    </div>
</section>
