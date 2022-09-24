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
<div class="container">
    <?if($arResult['DETAIL_PICTURE']['SRC']){?>
    <div class="new__banner-box">
        <img class="new__banner" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']?:$arResult['NAME']?>">
    </div>
    <?}?>
    <article class="new__content">
        <h1 class="title new__title">
          <?=$arResult['NAME']?>
        </h1>
        <?if($arResult['PROPERTIES']['TEXTS']['~VALUE']){?>
            <?foreach ($arResult['PROPERTIES']['TEXTS']['~VALUE'] as $arValue){?>
                <p class="new__text"><?=$arValue['TEXT']?></p>
                <?}?>

        <?}?>
    </article>
    <?=$arResult['DETAIL_TEXT']?>
</div>

