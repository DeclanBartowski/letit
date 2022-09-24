<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
if(!$arResult['SECTIONS'])return true;
?>
    <section class="catalog container">
        <div class="catalog__wrapper">
            <?if($arParams['TITLE']){?>
            <div class="catalog__header">
                <h2 class="catalog__title title"><?=$arParams['TITLE']?></h2>
            </div>
            <?}?>
            <?if($arParams['SHOW_CATALOG_LINK'] == 'Y'){?>
            <div class="life__more">
                <a class="link-more" href="/catalog/">Показать мир LELIT
                    <svg class="link-more__arrow" width="33" height="13" viewBox="0 0 33 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26 0.5L32 6.5L26 12.5" stroke="#16171B"/>
                        <path d="M32 6.5H0" stroke="#16171B"/>
                    </svg>
                </a>
            </div>
            <?}?>
            <div class="catalog__content">

<?foreach ($arResult['SECTIONS'] as $arSection)
{
$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
if($arSection['PICTURE']){
    $src = CFile::ResizeImageGet($arSection['PICTURE'],array("width" => 503, "height" => 516),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
}else{
    $src = '';
}
?>
    <article class="catalog__item" style="background-image: url(<?=$src?>);" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
        <h4 class="catalog__item-title"><?=$arSection['NAME']?></h4>
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="catalog__item-link">Подробнее
            <div class="catalog__item-link-ico">
                <svg  width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 0.5L7 6.5L1 12.5" stroke="white"/>
                </svg>
            </div>
        </a>
    </article>
<?}?>
            </div>
        </div>
    </section>
