<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$titleMenu =  array_shift($arResult);
?>

<?if(!empty($titleMenu)):?>
    <h5 class="footer__sitemap-title <?=$arParams['CLASS_TITLE']?>"><a class="footer__sitemap-link" href="<?=$titleMenu['LINK']?>"><?=$titleMenu['TEXT']?></a></h5>
<?endif;?>

<?if(!empty($arResult)):?>
    <ul class="footer__sitemap-list">
<?foreach ($arResult as $key =>  $arItem):?>
        <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="<?=$arItem["LINK"];?>"><?=$arItem["TEXT"];?></a></li>
<?endforeach;?>
    </ul>
<?endif;?>
