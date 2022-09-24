<?

use \Bitrix\Main\Page\Asset;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$page = $APPLICATION->GetCurPage();
CJSCore::Init('jquery');
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <?
    Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">');
    Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1/?apikey=3f591581-d039-451c-9188-c2b55c58bc0e&lang=ru_RU" type="text/javascript"></script>');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/costume.css");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/swiper-bundle.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/app.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/costume.js");
    ?>
    <? $APPLICATION->ShowHead(); ?>

</head>

<body>
<? if (ERROR_404 != 'Y' && $page != '404.php') { ?>
    <header class="header">
        <div class="container">

            <div class="header__logo">
                <img class="header__logo-img" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/logo.svg" alt="LELIT">
            </div>
            <div class="header__search">
                <div class="header__search-navigate hidden">
                    <div class="header__logo">
                        <img class="header__logo-img" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/logo.svg" alt="LELIT">
                    </div>
                    <div class="header__search-close"></div>
                </div>
                <form class="header__form-search" action="">
                    <label class="header__search-label">
                        <div class="header__search-ico-box">
                            <img class="header__search-ico" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/search.svg"
                                 alt="Поиск">
                        </div>
                        <input class="header__search-input search-input" placeholder="Я ищу..." type="text">
                        <div class="header__search-search">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.69268 14.1396C11.252 14.1396 14.1373 11.2542 14.1373 7.69494C14.1373 4.13566 11.252 1.25031 7.69268 1.25031C4.13341 1.25031 1.24805 4.13566 1.24805 7.69494C1.24805 11.2542 4.13341 14.1396 7.69268 14.1396Z"
                                      stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.7504 15.7497L12.2461 12.2454" stroke="white" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="search__tips">
                            <ul class="search__tips-list">
                                <li class="search__tip">
                                    <a href="#" class="search__tips-link" title="Утюг с парогенеротором">Утюг с
                                        парогенеротором</a>
                                </li>
                                <li class="search__tip">
                                    <a href="#" class="search__tips-link"
                                       title="Утюг с парогенеротором, мощным парогенератором">Утюг с парогенеротором,
                                        мощным
                                        парогенератором</a>
                                </li>
                                <li class="search__tip">
                                    <a href="#" class="search__tips-link"
                                       title="Утюг с парогенеротором, мощным парогенератором Lelit PS-11N">Утюг с
                                        парогенеротором, мощным парогенератором Lelit PS-11N</a>
                                </li>
                            </ul>
                        </div>
                    </label>
                    <button class="header__search-btn" type="reset"></button>
                </form>
                <div class="header__search-key-word hidden">
                    <div class="header__search-key">Парогенераторы</div>
                    <div class="header__search-key">Гладильные доски</div>
                    <div class="header__search-key">Аксессуары</div>
                    <div class="header__search-key">Чехлы</div>
                </div>
                <div class="header__search-often hidden">
                    <h3 class="header__search-often-title">Часто ищут</h3>
                    <ul class="header__search-often-list">
                        <li class="header__search-often-item">Парогенераторы</li>
                        <li class="header__search-often-item">Утюги</li>
                        <li class="header__search-often-item">Для экологической уборки</li>
                    </ul>
                </div>
            </div>
            <div class="header__info">
                <div class="header__question open-question">
                    <img class="header__question-img" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/header/question.svg"
                         alt="Задать вопрос">
                    <p class="header__question-text">Задать вопрос</p>
                </div>
                <div class="header__mail">
                    <img class="header__mail-img" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/header/mail.svg"
                         alt="Почта">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/header_mail.php",
                        "EDIT_TEMPLATE" => ""
                    ], false, []);
                    ?>

                </div>
            </div>
            <div class="header__menu">
                <button class="header__menu-btn">
                    <span class="header__menu-text">меню</span>
                    <img class="header__menu-ico" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/header/menu.svg" alt="Меню">
                </button>
                <div class="header__menu-opened">
                    <div class="menu">
                        <div class="menu__content">
                            <button class="menu__closed-btn"></button>
                            <nav class="menu__nav">
                                <ul class="menu__list">
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">Парогенераторы</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">Гладильные доски</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">Аксессуары</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">О компании</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">новости</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">Жизнь с lelit</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">Магазины-партнеры Lelit</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">сервисные центры</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="#" class="menu__link">Контакты</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header__mail">
                            <img class="header__mail-img" src="<?= SITE_TEMPLATE_PATH ?>/images/ico/header/mail.svg"
                                 alt="Почта">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/header_mail.php",
                                "EDIT_TEMPLATE" => ""
                            ], false, []);
                            ?>
                        </div>
                        <div class="header__question open-question">
                            <img class="header__question-img"
                                 src="<?= SITE_TEMPLATE_PATH ?>/images/ico/header/question.svg" alt="Задать вопрос">
                            <p class="header__question-text">Задать вопрос</p>
                        </div>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "social",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(0 => "", 1 => "",),
                                "FILTER_NAME" => "",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => "13",
                                "IBLOCK_TYPE" => "content",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "20",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(0 => "", 1 => "SVG", 2 => "",),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "SORT",
                                "SORT_BY2" => "ID",
                                "SORT_ORDER1" => "ASC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                'CLASS_UL' => 'menu__social-list',
                                'CLASS_LI' => 'menu__social-item',
                                'CLASS_A' => 'menu__social-link',
                            )
                        ); ?>
                        <div class="logo-line"></div>
                    </div>
                </div>
            </div>
        </div>
        <? $APPLICATION->ShowPanel(); ?>

    </header>
<? } ?>
<main class="<?= $APPLICATION->ShowViewContent('mainClass') ?>">

    <? if ($page != '/'): ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "main",
            [
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            ]
        ); ?>
    <? endif; ?>
