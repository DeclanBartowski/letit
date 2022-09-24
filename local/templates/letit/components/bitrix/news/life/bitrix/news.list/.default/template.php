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
<?if($arResult['ITEMS']){?>
    <section class="life-page">
        <div class="min-container">
            <h1 class="life-page__title title">
                Жизнь c
                <img src="<?=SITE_TEMPLATE_PATH?>/images/ico/logo.svg" alt="LELIT" class="life-page__img">
            </h1>
            <p class="life-page__text">
                <?=$arResult['DESCRIPTION']?>
            </p>
            <!-- content -->
            <div class="life-page__content">
                <?foreach($arResult["ITEMS"] as $key => $arItem){?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <article class="life-page__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="life-page__item-content">
                            <div class="life-page__item-header">
                                <?if($arItem['PROPERTIES']['NAME']['VALUE']){?>
                                    <h2 class="life-page__item-name">
                                        <?=$arItem['PROPERTIES']['NAME']['VALUE']?>
                                    </h2>
                                <?}?>
                                <?if($arItem['PROPERTIES']['CITY']['VALUE']){?>
                                    <h4 class="life-page__item-city">
                                        <?=$arItem['PROPERTIES']['CITY']['VALUE']?>
                                    </h4>
                                <?}?>
                            </div>
                            <p class="life-page__item-text">
                                <?=$arItem['PREVIEW_TEXT']?>
                            </p>
                            <a class="life-page__item-link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                читать историю
                                <svg width="29" height="14" viewBox="0 0 29 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6.9928L27 6.9928M27 6.9928L22.275 1.5M27 6.9928L22.275 12.5" stroke="white" stroke-width="2"/>
                                </svg>
                            </a>
                        </div>
                        <div class="life-page__item-content life-page__item-content-img">
                            <div class="life-page__item-img-box">
                                <?if($arItem['PREVIEW_PICTURE']['SRC']){?>
                                    <picture>
                                        <!--<source srcset="images/life/1.webp" type="image/webp">-->
                                        <img class="life-page__item-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PROPERTIES']['NAME']['VALUE']?>">
                                    </picture>
                                <?}?>
                            </div>
                        </div>
                    </article>
                <?}?>
            </div>
        </div>
        <!-- logoline -->
        <div class="logo-line"></div>
    </section>
<?}?>