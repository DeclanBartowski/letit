<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<div class="menu__content">
    <button class="menu__closed-btn"></button>
    <nav class="menu__nav">
        <ul class="menu__list">
            <? foreach ($arResult as $key => $arItem): ?>
                <li class="menu__item">
                    <a href="<?= $arItem["LINK"]; ?>" class="menu__link"><?= $arItem["TEXT"]; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
    </nav>
</div>
