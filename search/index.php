<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?><?$APPLICATION->IncludeComponent("bitrix:catalog.search", "search", Array(
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
		"IBLOCK_ID" => "11",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"NO_WORD_LOGIC" => "N",	// Отключить обработку слов как логических операторов
		"OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGE_ELEMENT_COUNT" => "30",	// Количество элементов на странице
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"PROPERTY_CODE" => array(	// Свойства
			0 => "SUB_TITLE",
			1 => "MARK",
			2 => "ARTNUMBER",
			3 => "DOCUMENTS",
			4 => "POPULAR",
			5 => "RECOMEND",
			6 => "LINK",
			7 => "WEIGHT",
			8 => "TIME_OF_CONTINUES_WORK",
			9 => "GUARANTEE",
			10 => "MAX_PRESSURE",
			11 => "MATERIAL_BOILER",
			12 => "BOILER_POWER",
			13 => "IRON_POWER",
			14 => "VOLTAGE",
			15 => "BOILER_NOMINAL_VALUE",
			16 => "APPLICATION_AREA",
			17 => "PRODUCTION",
			18 => "OPERATIN_PRESSURE",
			19 => "SIZE_GENERATOR",
			20 => "LOCATION_TAN",
			21 => "BOILER_FACT_VALUE",
			22 => "",
		),
		"RESTART" => "N",	// Искать без учета морфологии (при отсутствии результата поиска)
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
		"USE_SEARCH_RESULT_ORDER" => "N",	// Использовать сортировку результатов по релевантности
		"USE_TITLE_RANK" => "N",	// При ранжировании результата учитывать заголовки
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>