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
<section class="popular">
    <div class="container">
        <div class="swiper popular-swiper">
            <div class="popular__header">
                <h2 class="popular__title title">также Вам будет интересно</h2>
                <div class="popular__pagination">
                    <div class="swiper-button-prev">
                        <button class="popular__arrow-prev">
                            <svg class="popular__arrow-svg" width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27" transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                <path class="popular__arrow-path" d="M32 18.5L23 27.5L32 36.5"/>
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next">
                        <button class="popular__arrow-next">
                            <svg class="popular__arrow-svg" width="55" height="55"  fill="none" viewBox="0 0 55 55" xmlns="http://www.w3.org/2000/svg">
                                <rect class="popular__arrow-rect" x="-0.5" y="0.5" width="54" height="54" rx="27" transform="matrix(-1 0 0 1 54 0)" stroke="#16171B"/>
                                <path class="popular__arrow-path" d="M23 18.5L32 27.5L23 36.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="swiper-wrapper">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            if($arItem['PREVIEW_PICTURE']['ID']){
                $src = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],array("width" => 503, "height" => 405),BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
            }else{
                $src = '';
            }
            ?>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="swiper-slide news__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="news__item-img-box">
                    <?if($src){?>
                        <img class="news__item-img" src="<?=$src?>" alt="<?=$arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?:$arItem['NAME']?>">
                    <?}?>
                </div>
                <h4 class="news__item-title"><?=$arItem['NAME']?></h4>
                <p class="news__item-text"><?=$arItem['PREVIEW_TEXT']?></p>
                <time class="news__item-date" datatime="<?=$arItem['DISPLAY_ACTIVE_FROM']?>"><?=$arItem['DISPLAY_ACTIVE_FROM']?></time>
            </a>
        <?endforeach;?>

        </div>
        </div>
    </div>
</section>

