<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["NavPageCount"] > 1)
{
?>
    <div class="container">
    <div class="pagination">
    <div class="pagination__pages">
<?

	$bFirst = true;

	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination__page-item pagination__page-item-prev">
                <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.5 1L7.5 7.5L0.5 14" stroke="black"/>
                </svg>
            </a>
<?
		else:
			if ($arResult["NavPageNomer"] > 2):
?>
                <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination__page-item pagination__page-item-prev">
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.5 1L7.5 7.5L0.5 14" stroke="black"/>
                    </svg>
                </a>
<?
			else:
?>
                <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination__page-item pagination__page-item-prev">
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.5 1L7.5 7.5L0.5 14" stroke="black"/>
                    </svg>
                </a>
<?
			endif;

		endif;
?>

<?
		
		if ($arResult["nStartPage"] > 1):
			$bFirst = false;
			if($arResult["bSavePage"]):
?>
                <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" class="pagination__page-item">1</a>
<?
			else:
?>
                <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination__page-item">1</a>
<?
			endif;
?>

<?
			if ($arResult["nStartPage"] > 2):
?>
                <div class="pagination__page-item">...</div>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
            <div class="pagination__page-item pagination__page-item--active"><?=$arResult["nStartPage"]?></div>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
            <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination__page-item"><?=$arResult["nStartPage"]?></a>
<?
		else:
?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="pagination__page-item"><?=$arResult["nStartPage"]?></a>
<?
		endif;
?>
<?
		$arResult["nStartPage"]++;
		$bFirst = false;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
?>
                <div class="pagination__page-item">...</div>
<?
			endif;
?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" class="pagination__page-item"><?=$arResult["NavPageCount"]?></a>
<?
		endif;
?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagination__page-item pagination__page-item-next">
            <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.5 1L7.5 7.5L0.5 14" stroke="black"/>
            </svg>
        </a>
<?
	endif;
?>
    </div>
        <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]){?>
        <div class="pagination__btn-more">
            <button class="pagination__btn js-show-more" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7191 10.6423C20.7191 8.58411 20.0714 6.57813 18.8678 4.90859C17.6641 3.23906 15.9656 1.99065 14.0129 1.34027C12.0602 0.689888 9.95231 0.670526 7.98797 1.28492C6.02364 1.89932 4.30247 3.11632 3.06836 4.76346" stroke="#1E1E1E" stroke-width="1.5"/>
                    <path d="M2.77148 0.242188L2.77148 5.00194H7.82872" stroke="black" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M1.28086 10.3558C1.28086 12.4139 1.92858 14.4199 3.13222 16.0895C4.33586 17.759 6.03438 19.0074 7.9871 19.6578C9.93982 20.3082 12.0477 20.3275 14.012 19.7131C15.9764 19.0987 17.6975 17.8817 18.9316 16.2346" stroke="#1E1E1E" stroke-width="1.5"/>
                    <path d="M19.2324 20.7559L19.2324 15.9961H14.1752" stroke="black" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
                <span>Показать еще</span>
            </button>
        </div>
    <?}?>
    </div>

    </div>
<?
}
?>