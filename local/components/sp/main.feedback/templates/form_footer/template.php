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
<section class="form">
    <div class="container">
        <div class="form__header">
            <svg class="form__ico">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprite.svg#question"></use>
            </svg>
            <div class="form__header-content">
                <h2 class="form__title title"><?= GetMessage('TITLE_FORM') ?></h2>
                <p class="form__descr"><?= GetMessage('DESCRIPTION_FORM') ?></p>
            </div>
        </div>
        <form class="form__form" action="<?= POST_FORM_ACTION_URI ?>" method="POST">
            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">

            <div class="form__content">
                <div class="form__info">
                    <label class="form__label">
                        <input class="main-input" required type="text" placeholder="<?= GetMessage('MFT_NAME') ?>"
                               name="NAME">
                    </label>
                    <label class="form__label">
                        <input class="main-input" required type="tel" placeholder="<?= GetMessage('MFT_PHONE') ?>"
                               name="PHONE">
                    </label>
                    <label class="form__label">
                        <input class="main-input" required type="email" placeholder="<?= GetMessage('MFT_EMAIL') ?>"
                               name="EMAIL">
                    </label>
                </div>
                <div class="form__question">
                    <textarea class="form__textarea" name="TEXT" required placeholder="<?= GetMessage('MFT_MESSAGE') ?>"
                              cols="30"></textarea>
                </div>
            </div>

            <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
                <div class="mf-captcha">
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                         alt="CAPTCHA">
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="">
                </div>
            <? endif; ?>

            <div class="form__btns-box">
                <div class="form__ckeckbox">
                    <div class="form__ckeckbox-input">
                        <input id="checkbox" class="checkbox__form-checked-input" type="checkbox" required>
                        <label for="checkbox" class="checkbox__form-checked"></label>
                    </div>
                    <p class="checkbox__form-personal"><?= GetMessage('ACCEPT_RULES') ?></p>
                </div>
                <button class="form__btn" type="submit" name="submit" value="Y"><?= GetMessage('MFT_SUBMIT') ?>
                    <svg class="link-more__arrow" width="33" height="13" viewBox="0 0 33 13" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M26 0.5L32 6.5L26 12.5" stroke="#16171B"/>
                        <path d="M32 6.5H0" stroke="#16171B"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</section>
