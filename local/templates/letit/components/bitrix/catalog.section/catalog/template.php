<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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
<div class="steamgen__content" data-list>
<?foreach ($arResult['ITEMS'] as $arItem)
{
    $uniqueId = $arItem['ID'].'_'.md5($this->randString().$component->getAction());
    $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
    $this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
    $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
    if($arItem['PREVIEW_PICTURE']['ID']){
        $src = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],array("width" => 348, "height" => 276),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
    }else{
        $src = '';
    }
    if($arItem['PROPERTIES']['HOVER_PICTURE']['VALUE']){
        $hoverSrc = CFile::ResizeImageGet($arItem['PROPERTIES']['HOVER_PICTURE']['VALUE'],array("width" => 348, "height" => 276),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
    }else{
        $hoverSrc = $src;
    }
?>
    <article class="popular__item" id="<?=$areaIds[$arItem['ID']];?>">
        <?if($arItem['PROPERTIES']['MARK']['VALUE']){?>
        <span class="popular__plashka"><?=$arItem['PROPERTIES']['MARK']['VALUE']?></span>
        <?}?>
        <div class="popular__img-box">
            <?if($src){?>
            <picture class="popular__img-box-default">
                <img class="popular__img" src="<?=$src?>" alt="<?=$arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?:$arItem['NAME']?>">
            </picture>
            <?}?>
            <?if($hoverSrc){?>
            <picture class="popular__img-box-hover">
                <img class="popular__img" src="<?=$hoverSrc?>" alt="<?=$arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?:$arItem['NAME']?>">
            </picture>
            <?}?>
        </div>
        <h6 class="popular__item-title"><?=$arItem['NAME']?></h6>
        <?if($arItem['PROPERTIES']['SUB_TITLE']['VALUE']){?>
        <h6 class="popular__item-subtitle"><?=$arItem['PROPERTIES']['SUB_TITLE']['VALUE']?></h6>
        <?}
        if($arItem['PREVIEW_TEXT']){?>
        <p class="popular__item-descr"><?=$arItem['PREVIEW_TEXT']?></p>
        <?}?>
        <p class="popular__item-text"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></p>
        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="popular__item-more">Подробнее</a>
    </article>
<?}?>
</div>
<?$this->SetViewTarget('product_count');
   echo sprintf('Найдено: <span class="filters__sort-search-count">%s</span> %s',$arResult['NAV_RESULT']->NavRecordCount,$declension->get($arResult['NAV_RESULT']->NavRecordCount));
    $this->EndViewTarget();?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
