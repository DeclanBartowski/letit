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
<section class="life container">
    <!-- life header -->
    <div class="life__header">
        <h2 class="life__title title">
            <?=GetMessage('TITLE_LIFE')?>
            <img class="life__title-logo" src="<?=SITE_TEMPLATE_PATH?>/images/ico/logo.svg" alt="LELIT">
        </h2>
        <p class="life__descr"><?=$arResult['DESCRIPTION']?></p>
    </div>
    <div class="life__content">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <article class="life__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if(!empty($arItem['PREVIEW_PICTURE']['SRC'])):?>
            <picture>
                <img class="life__item-photo" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PROPERTIES']['NAME']['VALUE']?>">
            </picture>
        <?endif;?>
        <div class="life__item-content">
            <h4 class="life__item-name"><?=$arItem['PROPERTIES']['NAME']['VALUE']?></h4>
            <p class="life__item-text"><?=$arItem['PREVIEW_TEXT']?></p>
        </div>
    </article>

<?endforeach;?>
    </div>
    <div class="life__more">
        <div class="life__more-box">
            <a class="link-more" href="<?=$arResult['LIST_PAGE_URL']?>"><?=GetMessage('MORE_BTN_LIFE')?>
                <svg class="link-more__arrow" width="33" height="13" viewBox="0 0 33 13" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M26 0.5L32 6.5L26 12.5" stroke="#16171B"/>
                    <path d="M32 6.5H0" stroke="#16171B"/>
                </svg>
            </a>
        </div>
    </div>
</section>
