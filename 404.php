<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddViewContent('mainClass','notfound-page');
?>
    <section class="notfound">
        <div class="container">
            <div class="notfound__logo-box">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/ico/logo.svg" alt="LELIT" class="notfound__logo">
            </div>
            <div class="notfound__img-box">
                <picture>
                    <source srcset="<?=SITE_TEMPLATE_PATH?>/images/notfound/notfound.webp" type="image/webp">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/notfound/notfound.jpg" alt="ошибка" class="notfound__img">
                </picture>
            </div>
            <h1 class="notfound__title">ошибка</h1>
            <p class="notfound__text">Извините, такой страницы нет</p>
            <div class="notfound__link-box">
                <a href="<?=SITE_DIR?>" class="notfound__link">
                    Перейти на главную
                    <svg class="link-more__arrow" width="33" height="13" viewBox="0 0 33 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26 0.5L32 6.5L26 12.5" stroke="#16171B"/>
                        <path d="M32 6.5H0" stroke="#16171B"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>