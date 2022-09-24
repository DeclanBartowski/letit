<?php
// сортировку берем из параметров компонента
$arSort = array(
    $arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
    $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
);
// выбрать нужно id элемента, его имя и ссылку. Можно добавить любые другие поля, например PREVIEW_PICTURE или PREVIEW_TEXT
$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PAGE_URL",
    'IBLOCK_ID'
);
// выбираем активные элементы из нужного инфоблока. Раскомментировав строку можно ограничить секцией
$arFilter = array (
    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y",
);
// выбирать будем по 1 соседу с каждой стороны от текущего
$arNavParams = array(
    "nPageSize" => 1,
    "nElementID" => $arResult["ID"],
);

$arItems = Array();
$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
$rsElement->SetUrlTemplates($arParams["DETAIL_URL"]);
while($obElement = $rsElement->GetNextElement())
    if($obElement){
        $arItems[] = $obElement->GetFields();
        if(count($arItems)==3):
            $arResult["TORIGHT"] = Array("NAME"=>$arItems[0]["NAME"], "URL"=>$arItems[0]["DETAIL_PAGE_URL"],['PROPERTIES'=>['NAME'=>$obElement->GetProperty('NAME'),'CITY'=>$obElement->GetProperty('CITY')]]);
            $arResult["TOLEFT"] = Array("NAME"=>$arItems[2]["NAME"], "URL"=>$arItems[2]["DETAIL_PAGE_URL"]);
        elseif(count($arItems)==2):
            if($arItems[0]["ID"]!=$arResult["ID"])
                $arResult["TORIGHT"] = Array("NAME"=>$arItems[0]["NAME"], "URL"=>$arItems[0]["DETAIL_PAGE_URL"],['PROPERTIES'=>['NAME'=>$obElement->GetProperty('NAME'),'CITY'=>$obElement->GetProperty('CITY')]]);
            else
                $arResult["TOLEFT"] = Array("NAME"=>$arItems[1]["NAME"], "URL"=>$arItems[1]["DETAIL_PAGE_URL"]);
        endif;
    }

