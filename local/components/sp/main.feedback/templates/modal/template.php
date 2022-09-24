<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<? if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v) {
        ShowError($v);
    }
}
if (strlen($arResult["OK_MESSAGE"]) > 0) {

    ?>
    <script>
        alert('form_send');
    </script>

    <?
}
?>

<section class="modal-question">
    <div class="modal-question__content">
        <div class="modal-question__close"></div>
        <h2 class="modal-question__title title"><?=GetMessage('TITLE_FORM')?></h2>
        <p class="modal-question__text"><?=GetMessage('DESCRIPTION_FORM')?></p>
        <form class="modal-question__form" action="<?= POST_FORM_ACTION_URI ?>" method="POST">
            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
            <label class="form__label">
                <input class="main-input input__name" type="text" placeholder="<?=GetMessage('MFT_NAME')?>" name="NAME">
                <span class="input-error"></span>
            </label>
            <label class="form__label">
                <input class="main-input input__tel " type="tel" placeholder="<?=GetMessage('MFT_PHONE')?>" name="PHONE">
                <span class="input-error"></span>
            </label>
            <label class="form__label">
                <input class="main-input input__email"  type="email" placeholder="<?= GetMessage('MFT_EMAIL') ?>" name="EMAIL">
                <span class="input-error"></span>
            </label>
            <div class="form__question form__label">
                <textarea class="form__textarea input__textarea" name="TEXT"  placeholder="<?= GetMessage('MFT_MESSAGE') ?>" cols="30"></textarea>
                <span class="input-error"></span>
            </div>

            <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
                <div class="mf-captcha">
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                         alt="CAPTCHA">
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="">
                </div>
            <? endif; ?>

            <button disabled class="form__btn form__disabled-btn"  type="submit" name="submit" value="Y"><?=GetMessage('MFT_SUBMIT')?></button>
            <div class="form__ckeckbox">
                <input id="checkbox-q" class="checkbox__form-checked-input" type="checkbox" required>
                <label for="checkbox-q" class="checkbox__form-checked"></label>
                <p class="checkbox__form-personal"><?=GetMessage('ACCEPT_RULES')?></p>
            </div>
        </form>
    </div>
</section>
