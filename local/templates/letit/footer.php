<?

/**
 * @global $APPLICATION
 */
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?if($APPLICATION->GetProperty('show_logoline') == 'Y'){?>
    <div class="main-page__logoline">
        <div class="logo-line"></div>
    </div>
<?}?>
</main>
<?if(HIDE_FORM !='Y'){?>
    <? $APPLICATION->IncludeComponent(
        "sp:main.feedback",
        "form_footer",
        array(
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "EMAIL_TO" => "",
            "EVENT_MESSAGE_ID" => array(
                0 => "51",
            ),
            "INFOBLOCKADD" => "Y",
            "INFOBLOCKID" => 5,
            "LINK" => "",
            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
            "REQUIRED_FIELDS" => array(
                0 => "NONE",
            ),
            "USE_CAPTCHA" => "N",
            "COMPONENT_TEMPLATE" => "form_footer"
        ),
        false
    ); ?>
<?}?>
<? if (ERROR_404 != 'Y' && $page != '404.php') { ?>

    <? $APPLICATION->IncludeComponent(
        "sp:main.feedback",
        "modal",
        array(
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "EMAIL_TO" => "",
            "EVENT_MESSAGE_ID" => array(
                0 => "51",
            ),
            "INFOBLOCKADD" => "Y",
            "INFOBLOCKID" => 5,
            "LINK" => "",
            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
            "REQUIRED_FIELDS" => array(
                0 => "NONE",
            ),
            "USE_CAPTCHA" => "N",
            "COMPONENT_TEMPLATE" => "modal"
        ),
        false
    ); ?>

  
    <footer class="footer">
        <div class="footer__content container">
            <div class="footer__header">
                <div class="footer__header-logo">
                    <img class="footer__logo" src="<?= SITE_TEMPLATE_PATH ?>/images/wtite-logo.svg" alt="LELIT">
                </div>
                <form class="footer__form">
                    <div class="footer__search-content">
                        <h3 class="footer__search__title">
                            Подпишитесь на наши новинки
                        </h3>
                        <div class="footer__search">
                            <input class="footer__search-input" placeholder="Введите email" type="text">
                            <button class="footer__search-btn">Подписаться</button>
                        </div>
                    </div>
                    <div class="footer__form-checkbox">
                        <input id="checkbox-footer" class="checkbox__form-checked-input" type="checkbox">
                        <label for="checkbox-footer" class="checkbox__form-checked"></label>
                        <p class="checkbox__form-personal">Я соглашаюсь на обработку персональных данных.</p>
                    </div>
                </form>
            </div>
            <div class="footer__nav">
                <div class="footer__info">
                    <div class="footer__info-mail">
                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.619141" y="0.5" width="20.76" height="15" rx="0.884083" stroke="white"/>
                            <path d="M1.08203 1.07764L9.71048 7.93355C10.4667 8.53442 11.5374 8.53441 12.2936 7.93355L20.922 1.07764"
                                  stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                            "AREA_FILE_SHOW" => "file",
                            "PATH" =>   SITE_TEMPLATE_PATH .  "/include/mail_footer.php",
                            "EDIT_TEMPLATE" => ""
                        ], false, []);
                        ?>

                    </div>
                    <div class="footer__question open-question">
                        <svg class="footer__arrow" width="20" height="20" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.2271 10.2458C9.2271 9.85221 9.30922 9.48546 9.47347 9.14555C9.63772 8.80564 9.83655 8.51493 10.07 8.27341C10.3034 8.0319 10.5368 7.8038 10.7702 7.58912C11.0036 7.36549 11.2024 7.12398 11.3667 6.86457C11.5309 6.59622 11.6131 6.31445 11.6131 6.01927C11.6131 5.57202 11.4618 5.23211 11.1592 4.99954C10.8653 4.75802 10.4806 4.63727 10.0051 4.63727C9.0542 4.63727 8.44474 5.0711 8.17675 5.93876L7.15234 5.34839C7.36846 4.72224 7.73587 4.24816 8.25456 3.92614C8.77324 3.59517 9.36109 3.42969 10.0181 3.42969C10.7875 3.42969 11.4445 3.65331 11.9891 4.10056C12.5424 4.54781 12.819 5.16949 12.819 5.9656C12.819 6.34129 12.7369 6.69462 12.5726 7.02558C12.4084 7.35655 12.2096 7.64279 11.9761 7.88431C11.7427 8.12582 11.5093 8.36286 11.2759 8.59543C11.0425 8.81906 10.8437 9.07399 10.6794 9.36023C10.5152 9.63753 10.433 9.93271 10.433 10.2458H9.2271ZM9.82359 13.144C9.59018 13.144 9.39135 13.059 9.2271 12.889C9.06284 12.7191 8.98072 12.5134 8.98072 12.2718C8.98072 12.0303 9.06284 11.8246 9.2271 11.6546C9.39135 11.4847 9.59018 11.3997 9.82359 11.3997C10.0656 11.3997 10.2645 11.4847 10.4201 11.6546C10.5843 11.8246 10.6665 12.0303 10.6665 12.2718C10.6665 12.5134 10.5843 12.7191 10.4201 12.889C10.2645 13.059 10.0656 13.144 9.82359 13.144Z"
                                  fill="white"/>
                            <path d="M1.48828 3V18L4.06937 15.4189H16.5117C17.6163 15.4189 18.5117 14.5235 18.5117 13.4189V3C18.5117 1.89543 17.6163 1 16.5117 1H3.48828C2.38371 1 1.48828 1.89543 1.48828 3Z"
                                  stroke="white"/>
                        </svg>
                        Задать вопрос
                    </div>
                </div>
                <div class="footer__sitemap">
                    <div class="footer__sitemap-item">
                        <h5 class="footer__sitemap-title"><a class="footer__sitemap-link" href="#">Каталог</a></h5>
                        <ul class="footer__sitemap-list">
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Парогенераторы</a>
                            </li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Гладильные
                                    доски</a></li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link"
                                                                     href="#">Аксессуары</a></li>
                        </ul>
                    </div>
                    <div class="footer__sitemap-item">
                        <h5 class="footer__sitemap-title"><a class="footer__sitemap-link" href="#">Компания</a></h5>
                        <ul class="footer__sitemap-list">
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">О
                                    компании</a></li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Новости</a>
                            </li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Жизнь с
                                    Lelit</a></li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Магазины</a>
                            </li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Сервисные
                                    центры</a></li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Контакты</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer__sitemap-item">
                        <h5 class="footer__sitemap-title"><a class="footer__sitemap-link" href="#">Документы</a></h5>
                        <ul class="footer__sitemap-list">
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Пользовательское
                                    соглашение</a></li>
                            <li class="footer__sitemap-list-item"><a class="footer__sitemap-link" href="#">Политика
                                    конфиденциальности</a></li>
                        </ul>
                        <h5 class="footer__sitemap-title footer__sitemap-title-map"><a class="footer__sitemap-link"
                                                                                       href="#">карта сайта</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__logoline">
            <div class="logo-line"></div>
        </div>
        <div class="footer__description container">
            <div class="footer__license">
                <?
                $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                    "AREA_FILE_SHOW" => "file",
                    "PATH" =>   SITE_TEMPLATE_PATH .  "/include/copyright.php",
                    "EDIT_TEMPLATE" => ""
                ], false, []);
                ?>
            </div>
            <div class="footer__social-box">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "social",
                    Array(
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
                        "FIELD_CODE" => array(0=>"",1=>"",),
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
                        "PROPERTY_CODE" => array(0=>"",1=>"SVG",2=>"",),
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
                        'CLASS_UL' => 'footer__social-list',
                        'CLASS_LI' => 'footer__social-item',
                        'CLASS_A' => 'footer__social-link',
                    )
                );?>
            </div>
            <div class="footer__dev">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/footer/webmedia.svg" alt="WEBMEDIA">
            </div>
        </div>
        <div class="footer__logoline--mobile">
            <div class="logo-line"></div>
        </div>
    </footer>
<? } ?>
</body>
</html>
