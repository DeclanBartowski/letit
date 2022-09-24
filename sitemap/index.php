<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>
    <section class="map">
    <div class="map__header">
        <div class="container">
            <h1 class="map__title title">
                <?=$APPLICATION->ShowTitle(false)?>
            </h1>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.map",
        "main",
        Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "COL_NUM" => "1",
            "LEVEL" => "2",
            "SET_TITLE" => "N",
            "SHOW_DESCRIPTION" => "N"
        )
    );?>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>