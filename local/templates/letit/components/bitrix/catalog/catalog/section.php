<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */
$this->setFrameMode(true);

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
}
$this->SetViewTarget('mainClass');
echo 'accessories-page steamgen';
$this->EndViewTarget();

$arSection = CIBlockSection::GetByID($arCurSection['ID'])->Fetch();

$arSort = [
    'popular' => [
        'field' => 'SHOW_COUNTER',
        'order' => 'desc'
    ],
    'alphabet' => [
        'field' => 'NAME',
        'order' => 'asc'
    ],
    'price' => [
        'field' => 'CATALOG_PRICE_1',
        'order' => 'asc'
    ],
];
if($_GET['sort']){
    if($arSort[$_GET['sort']]){
        $_SESSION['catalog_sort'] = $_GET['sort'];
    }else{
        $_SESSION['catalog_sort'] = 'popular';
    }

}else{
    if(!$_SESSION['catalog_sort']){
        $_SESSION['catalog_sort'] = 'popular';
    }
}
$arParams["ELEMENT_SORT_FIELD"] = $arSort[$_SESSION['catalog_sort']]['field'];
$arParams["ELEMENT_SORT_ORDER"] = $arSort[$_SESSION['catalog_sort']]['order'];

?>
<section class="steamgen">
	<div class="container">
		<h1 class="steamgen__title title"><?=$APPLICATION->ShowTitle(false)?></h1>
		<!-- фильтры -->
		<div class="filters">
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					//"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					//"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
					"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
					"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
					"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
					"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);?>
			<!-- category -->

			<!-- filters -->
			<div class="filters__main">
				<!-- btn open -->
				<div class="filters__main-btn filters__main-item">
					<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7.5 4H17.5" stroke="white"/>
						<circle cx="4.5" cy="4" r="3.5" stroke="white"/>
						<path d="M10.5 13L0.5 13" stroke="white"/>
						<circle r="3.5" transform="matrix(-1 0 0 1 13.5 13)" stroke="white"/>
					</svg>
					<div class="filters__main-item-title">Фильтры</div>
				</div>
				<!-- price filter -->
				<div class="filters__main-item">
					<div class="filters__main-select filters__select-t select-price">
						<div class="filters__main-select-title">Цена</div>
						<div class="filters__main-select-ico">
							<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
							</svg>
						</div>
					</div>

					<!-- price range -->
					<div class="filters__price-wrapper price-wrapper filters__main-checkboxes">
						<div class="filters__price-input">
							<div class="filters__price-field">
								<span>от</span>
								<input type="number" class="filters__price-input-min" value="0">
							</div>
							<div class="filters__price-field">
								<span>до</span>
								<input type="number" class="filters__price-input-max" max="35200" value="35200">
							</div>
							<div class="filters__price-currency">₽</div>
						</div>
						<div class="filters__price-slider">
							<div class="filters__price-progress"></div>
						</div>
						<div class="filters__price-range-input">
							<input type="range" class="filters__price-range-min" min="0" max="35200"  value="0" step="100">
							<input type="range" class="filters__price-range-max" min="0" max="35200"  value="35200" step="100">
						</div>
						<div class="filters__price-search">
							<span class="filters__price-search-close"></span>
							выбрано: от
							<span>3 198</span> ₽  до <span>35 200</span> ₽</div>
					</div>
				</div>
				<!-- power-i filter -->
				<div class="filters__main-item">
					<div class="filters__main-select filters__select-t select-power-i">
						<div class="filters__main-select-title">Мощность утюга</div>
						<div class="filters__main-select-ico">
							<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
							</svg>
						</div>
					</div>
					<!-- checkboxes Мощность утюга -->
					<div class="filters__main-checkboxes checkbox-power-i">
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">2 х 800 Вт</span>
								(<span class="filters__bar-quantity">1</span>)
							</p>
							<input id="check-1" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-1" class="checkbox__form-checked"></label>
						</div>
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">800 Вт</span>
								(<span class="filters__bar-quantity">14</span>)
							</p>
							<input id="check-2" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-2" class="checkbox__form-checked"></label>
						</div>
					</div>
				</div>
				<!-- power-b filter -->
				<div class="filters__main-item">
					<div class="filters__main-select filters__select-t select-power-b">
						<div class="filters__main-select-title">Мощность бойлера</div>
						<div class="filters__main-select-ico">
							<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
							</svg>
						</div>
					</div>
					<!-- checkboxes Мощность бойлера -->
					<div class="filters__main-checkboxes checkbox-power-b">
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">2 х 800 Вт</span>
								(<span class="filters__bar-quantity">1</span>)
							</p>
							<input id="check-3" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-3" class="checkbox__form-checked"></label>
						</div>
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">800 Вт</span>
								(<span class="filters__bar-quantity">14</span>)
							</p>
							<input id="check-4" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-4" class="checkbox__form-checked"></label>
						</div>
					</div>
				</div>
				<!-- pressure filter -->
				<div class="filters__main-item">
					<div class="filters__main-select filters__select-t select-pressure">
						<div class="filters__main-select-title">Рабочее давление</div>
						<div class="filters__main-select-ico">
							<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
							</svg>
						</div>
					</div>
					<!-- checkboxes Рабочее давление -->
					<div class="filters__main-checkboxes checkbox-pressure">
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">2 х 800 Вт</span>
								(<span class="filters__bar-quantity">1</span>)
							</p>
							<input id="check-5" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-5" class="checkbox__form-checked"></label>
						</div>
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">800 Вт</span>
								(<span class="filters__bar-quantity">14</span>)
							</p>
							<input id="check-6" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-6" class="checkbox__form-checked"></label>
						</div>
					</div>
				</div>
				<!--  -->
				<div class="filters__main-item">
					<div class="filters__main-select filters__select-t select-pressuremax">
						<div class="filters__main-select-title">Максимальное давление</div>
						<div class="filters__main-select-ico">
							<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
							</svg>
						</div>
					</div>
					<!-- checkboxes Максимальное давление -->
					<div class="filters__main-checkboxes checkbox-pressuremax">
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">2 х 800 Вт</span>
								(<span class="filters__bar-quantity">1</span>)
							</p>
							<input id="check-23" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-23" class="checkbox__form-checked"></label>
						</div>
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">800 Вт</span>
								(<span class="filters__bar-quantity">14</span>)
							</p>
							<input id="check-24" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-24" class="checkbox__form-checked"></label>
						</div>
					</div>
				</div>
				<div class="filters__main-item">
					<div class="filters__main-select filters__select-t select-voltage">
						<div class="filters__main-select-title">Напряжение</div>
						<div class="filters__main-select-ico">
							<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
							</svg>
						</div>
					</div>
					<!-- checkboxes Напряжение -->
					<div class="filters__main-checkboxes checkbox-voltage">
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">2 х 800 Вт</span>
								(<span class="filters__bar-quantity">1</span>)
							</p>
							<input id="check-31" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-31" class="checkbox__form-checked"></label>
						</div>
						<div class="filters__bar-checkbox">
							<p class="filters__bar-descr">
								<span class="filters__bar-text">800 Вт</span>
								(<span class="filters__bar-quantity">14</span>)
							</p>
							<input id="check-32" class="checkbox__form-checked-input" type="checkbox">
							<label for="check-32" class="checkbox__form-checked"></label>
						</div>
					</div>
				</div>
			</div>
			<!-- sort -->
			<div class="filters__sort">
				<div class="filters__sort-box">
					<div class="filters__sort-title">Сортировать по:</div>
					<div class="filters__sort-items-box">
						<div class="filters__sort-item<?=$_SESSION['catalog_sort'] == 'popular'?' filters__sort-active':''?>" onclick="location.href='?sort=popular'">популярности
							<svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path class="filters__sort-arrow" d="M14 8L7.5 1L1 8"/>
							</svg>
						</div>
						<div class="filters__sort-item<?=$_SESSION['catalog_sort'] == 'alphabet'?' filters__sort-active':''?>" onclick="location.href='?sort=alphabet'">алфавиту
							<svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path  class="filters__sort-arrow" d="M14 8L7.5 1L1 8"/>
							</svg>
						</div>
						<div class="filters__sort-item<?=$_SESSION['catalog_sort'] == 'price'?' filters__sort-active':''?>" onclick="location.href='?sort=price'">цене
							<svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path  class="filters__sort-arrow" d="M14 8L7.5 1L1 8"/>
							</svg>
						</div>
					</div>
				</div>
				<div class="filters__sort-total">
                    <?$APPLICATION->ShowViewContent('product_count');?>
				</div>
			</div>
			<!-- filter sidebar -->
			<div class="filters__bar">
				<form class="filters__bar-content">
					<div class="filters__closed-btn"></div>
					<h3 class="filters__bar-title">
						Фильтр по
						параметрам
					</h3>
					<div class="filters__bar-item filters__bar-price">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Цена</div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<!-- price range -->
						<div class="price-wrapper filters__bar-wrapper filters__bar-price-wrapper">
							<div class="filters__price-input">
								<div class="filters__price-field">
									<span>от</span>
									<input type="number" class="filters__price-input-min" value="0">
								</div>
								<div class="filters__price-field">
									<span>до</span>
									<input type="number" class="filters__price-input-max" max="35200" value="35200">
								</div>
								<div class="filters__price-currency">₽</div>
							</div>
							<div class="filters__price-slider">
								<div class="filters__price-progress progress-filterbar"></div>
							</div>
							<div class="filters__price-range-input">
								<input type="range" class="filters__price-range-min" min="0" max="35200"  value="0" step="100">
								<input type="range" class="filters__price-range-max" min="0" max="35200"  value="35200" step="100">
							</div>
							<div class="filters__price-search">выбрано: от
								<span>3 198</span> ₽  до <span>35 200</span> ₽</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Мощность утюга</div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2 х 800 Вт</span>
									(<span class="filters__bar-quantity">1</span>)
								</p>
								<input id="check-11" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-11" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">800 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-12" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-12" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Мощность бойлера</div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">1000 Вт</span>
									(<span class="filters__bar-quantity">10</span>)
								</p>
								<input id="check-13" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-13" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">1150 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-14" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-14" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">1400 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-15" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-15" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">1500 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-16" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-16" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2000 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-34" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-34" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">4000 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-35" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-35" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Рабочее давление</div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2 х 800 Вт</span>
									(<span class="filters__bar-quantity">1</span>)
								</p>
								<input id="check-38" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-38" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">800 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-37" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-37" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Максимальное давление </div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2 х 800 Вт</span>
									(<span class="filters__bar-quantity">1</span>)
								</p>
								<input id="check-40" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-40" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">800 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-41" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-41" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Напряжение </div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2 х 800 Вт</span>
									(<span class="filters__bar-quantity">1</span>)
								</p>
								<input id="check-17" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-17" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">800 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-18" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-18" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title-box">
								<div class="filters__bar-select-title">Рабочая мощность </div>
								<div class="filters__tip-btn">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="10" cy="10" r="9.5" stroke="#D6D6D6"/>
										<path d="M9.9162 5.18663C11.0056 5.18663 11.6425 5.7883 11.6425 6.8078C11.6425 8.81337 8.64246 9.73259 8.64246 10.9861C8.64246 11.4039 8.92737 11.6379 9.24581 11.7549L11.2235 9.94986C12.2291 9.01393 13 8.17827 13 6.62396C13 4.91922 11.8101 4 9.96648 4C8.27374 4 7.46927 4.55153 7 4.98607L7.87151 6.02228C8.24022 5.6546 8.7933 5.18663 9.9162 5.18663ZM8.92737 15.0139C8.92737 15.5655 9.36313 16 9.93296 16C10.5196 16 10.9553 15.5655 10.9553 15.0139C10.9553 14.4123 10.5196 13.9777 9.93296 13.9777C9.37989 13.9777 8.92737 14.429 8.92737 15.0139Z" fill="#7A7A7A"/>
									</svg>
								</div>
							</div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__tip">Это электрическая мощность, потребляемая бытовым прибором от электросети. </div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2 х 800 Вт</span>
									(<span class="filters__bar-quantity">1</span>)
								</p>
								<input id="check-21" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-21" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">800 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-22" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-22" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- item -->
					<div class="filters__bar-item">
						<div class="filters__main-select filters__bar-select">
							<div class="filters__bar-select-title">Вес </div>
							<div class="filters__main-select-ico">
								<svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1L7.5 8L1 0.999999" stroke="#16171B" stroke-opacity="0.5" stroke-width="1.5"/>
								</svg>
							</div>
						</div>
						<div class="filters__bar-wrapper">
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">2 х 800 Вт</span>
									(<span class="filters__bar-quantity">1</span>)
								</p>
								<input id="check-19" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-19" class="checkbox__form-checked"></label>
							</div>
							<div class="filters__bar-checkbox">
								<p class="filters__bar-descr">
									<span class="filters__bar-text">800 Вт</span>
									(<span class="filters__bar-quantity">14</span>)
								</p>
								<input id="check-20" class="checkbox__form-checked-input" type="checkbox">
								<label for="check-20" class="checkbox__form-checked"></label>
							</div>
						</div>
					</div>
					<!-- btns -->
					<div class="filters__bar-btns">
						<button class="filters__bar-reset" type="reset">
                    <span>
                        сбросить
                    </span>
						</button>
						<button class="filters__bar-send">Применить</button>
					</div>
					<div class="filters__mul"></div>
				</form>
				<div class="filters__products-found">
					<span class="filters__products-text">Найдено</span>
					<span class="filters__products-total">20</span>
					<span class="filters__products-text">товаров</span>
					<div class="filters__products-btn">Показать</div>
				</div>
			</div>

		</div>
		<!-- контент -->
		<?$intSectionID = $APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"catalog",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
				"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
				"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"MESSAGE_404" => $arParams["~MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["~PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"LAZY_LOAD" => $arParams["LAZY_LOAD"],
				"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
				"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

				"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
				'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
				'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
				'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
				'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
				'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
				'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
				'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
				'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
				'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
				'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
				'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
				'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
				'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
				'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
				'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
				'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
				'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
				'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

				'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
				'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
				'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"ADD_SECTIONS_CHAIN" => "N",
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'COMPARE_NAME' => $arParams['COMPARE_NAME'],
				'USE_COMPARE_LIST' => 'Y',
				'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
				'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
			),
			$component
		);?>
        <?if($arSection['DESCRIPTION']){?>
		<section class="reasons">
			<div class="min-container">
				<div class="reasons__logo">
					<img class="reasons__logo-ico" src="<?=SITE_TEMPLATE_PATH?>/images/mini-logo.svg" alt="LELIT">
				</div>
                <?=$arSection['DESCRIPTION']?>
			</div>
		</section>
        <?}?>

	</div>
	<div class="logo-line"></div>
</section>
