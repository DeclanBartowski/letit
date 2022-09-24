<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (method_exists($this, 'setFrameMode')) {
	$this->setFrameMode(true);
}
?>
<div class="footer__header">
    <div class="footer__header-logo">
        <img class="footer__logo" src="<?= SITE_TEMPLATE_PATH ?>/images/wtite-logo.svg" alt="LELIT">
    </div>
<?php

if ($arResult['ACTION']['status']=='error') {
	ShowError($arResult['ACTION']['message']);
} elseif ($arResult['ACTION']['status']=='ok') {
	ShowNote($arResult['ACTION']['message']);
}
?>
<form action="<?= POST_FORM_ACTION_URI?>" method="post" id="asd_subscribe_form" class="footer__form">
	<?= bitrix_sessid_post()?>
	<input type="hidden" name="asd_subscribe" value="Y" />
	<input type="hidden" name="charset" value="<?= SITE_CHARSET?>" />
	<input type="hidden" name="site_id" value="<?= SITE_ID?>" />
	<input type="hidden" name="asd_rubrics" value="<?= $arParams['RUBRICS_STR']?>" />
	<input type="hidden" name="asd_format" value="<?= $arParams['FORMAT']?>" />
	<input type="hidden" name="asd_show_rubrics" value="<?= $arParams['SHOW_RUBRICS']?>" />
	<input type="hidden" name="asd_not_confirm" value="<?= $arParams['NOT_CONFIRM']?>" />
	<input type="hidden" name="asd_key" value="<?= md5($arParams['JS_KEY'].$arParams['RUBRICS_STR'].$arParams['SHOW_RUBRICS'].$arParams['NOT_CONFIRM'])?>" />
    <div class="footer__search-content">
        <h3 class="footer__search__title">
            <?=GetMessage('TITLE_ASD')?>
        </h3>
        <div class="footer__search">
            <div id="asd_subscribe_res" style="display: none;"></div>
            <input class="footer__search-input" name="asd_email" placeholder="<?=GetMessage('EMAIL_ASD')?>" type="text">
            <button type="submit" name="asd_submit" id="asd_subscribe_submit" class="footer__search-btn"><?=GetMessage('ASD_SUBSCRIBEQUICK_PODPISATQSA')?></button>
        </div>
    </div>
    <div class="footer__form-checkbox">
        <input id="checkbox-footer" class="checkbox__form-checked-input" type="checkbox" checked readonly>
        <label for="checkbox-footer" class="checkbox__form-checked"></label>
        <p class="checkbox__form-personal"><?=GetMessage('ASD_RULES')?></p>
    </div>

	<?if (isset($arResult['RUBRICS'])):?>
		<br/>
		<?foreach($arResult['RUBRICS'] as $RID => $title):?>
		<input type="checkbox" name="asd_rub[]" id="rub<?= $RID?>" value="<?= $RID?>" />
		<label for="rub<?= $RID?>"><?= $title?></label><br/>
		<?endforeach;?>
	<?endif;?>
</form>
</div>
