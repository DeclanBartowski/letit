<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Grid\Declension;

$declension = new Declension('товар', 'товара', 'товаров');
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);


$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<section class="popular">
    <div class="container">
        <div class="swiper popular-swiper">
            <div class="popular__header">
                <h2 class="popular__title title"><?
                    if (empty($arParams['TITLE'])) {
                        echo GetMessage('TITLE');
                    } else {
                        echo $arParams['TITLE'];
                    }
                    ?></h2>
                <div class="popular__pagination">
                    <div class="swiper-button-prev">
                        <button class="popular__arrow-prev">
                            <svg class="popular__arrow-svg" width="55" height="55" viewBox="0 0 55 55" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27"
                                      transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                <path class="popular__arrow-path" d="M32 18.5L23 27.5L32 36.5"/>
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next">
                        <button class="popular__arrow-next">
                            <svg class="popular__arrow-svg" width="55" height="55" fill="none" viewBox="0 0 55 55"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27"
                                      transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                <path class="popular__arrow-path" d="M23 18.5L32 27.5L23 36.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="swiper-wrapper">
                <? foreach ($arResult['ITEMS'] as $arItem) {
                    $uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
                    $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
                    $this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
                    $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                    if ($arItem['PREVIEW_PICTURE']['ID']) {
                        $src = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],
                            array("width" => 348, "height" => 276), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                    } else {
                        $src = '';
                    }
                    if ($arItem['PROPERTIES']['HOVER_PICTURE']['VALUE']) {
                        $hoverSrc = CFile::ResizeImageGet($arItem['PROPERTIES']['HOVER_PICTURE']['VALUE'],
                            array("width" => 348, "height" => 276), BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
                    } else {
                        $hoverSrc = $src;
                    }
                    ?>
                    <article class="popular__item swiper-slide" id="<?= $areaIds[$arItem['ID']]; ?>">
                        <? if ($arItem['PROPERTIES']['MARK']['VALUE']) {
                            ?>
                            <span class="popular__plashka"><?= $arItem['PROPERTIES']['MARK']['VALUE'] ?></span>
                        <? } ?>
                        <div class="popular__img-box">
                            <? if ($src) {
                                ?>
                                <picture class="popular__img-box-default">
                                    <img class="popular__img" src="<?= $src ?>"
                                         alt="<?= $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT'] ?: $arItem['NAME'] ?>">
                                </picture>
                            <? } ?>
                            <? if ($hoverSrc) {
                                ?>
                                <picture class="popular__img-box-hover">
                                    <img class="popular__img" src="<?= $hoverSrc ?>"
                                         alt="<?= $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT'] ?: $arItem['NAME'] ?>">
                                </picture>
                            <? } ?>
                        </div>
                        <h6 class="popular__item-title"><?= $arItem['NAME'] ?></h6>
                        <? if ($arItem['PROPERTIES']['SUB_TITLE']['VALUE']) {
                            ?>
                            <h6 class="popular__item-subtitle"><?= $arItem['PROPERTIES']['SUB_TITLE']['VALUE'] ?></h6>
                        <?
                        }
                        if ($arItem['PREVIEW_TEXT']) {
                            ?>
                            <p class="popular__item-descr"><?= $arItem['PREVIEW_TEXT'] ?></p>
                        <? } ?>
                        <p class="popular__item-text"><?= $arItem['MIN_PRICE']['PRINT_VALUE'] ?></p>
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="popular__item-more">Подробнее</a>
                    </article>
                <? } ?>
            </div>
            <div class="popular__scroll-box">
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div>
</section>
