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
if(!$arResult['SECTIONS'] )return true;
?>

    <div class="filters__category">

<?foreach ($arResult['SECTIONS'] as $arSection)
{
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    if($arSection['PICTURE']){
        $src = CFile::ResizeImageGet($arSection['PICTURE'],array("width" => 45, "height" => 45),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
    }else{
        $src = '';
    }
    ?>
    <div onclick="location.href='<?=$arSection['SECTION_PAGE_URL']?>'" class="filters__category-item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
            <img class="filters__category-img" src="<?=$src?>" alt="<?=$arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT']?:$arSection['NAME']?>">
        <span class="filters__category-title"><?=$arSection['NAME']?></span>
    </div>
<?}?>
    </div>
