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
?>
<ul class="<?=$arParams['CLASS_UL']?>">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <li class="<?=$arParams['CLASS_LI']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$arItem['CODE']?>" target="_blank" class="<?=$arParams['CLASS_A']?>">
            <img src="<?=CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE'])?>" alt="<?=$arItem['NAME']?>">
        </a>
    </li>
<?endforeach;?>
</ul>
