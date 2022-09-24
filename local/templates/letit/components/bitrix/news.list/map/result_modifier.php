<?php
\Bitrix\Main\Loader::includeModule('sale');

foreach ($arResult['ITEMS'] as $arItem) {
    if($arItem['PROPERTIES']['CITY']['VALUE']){
        $locationIDEs[$arItem['PROPERTIES']['CITY']['VALUE']] = $arItem['PROPERTIES']['CITY']['VALUE'];
        $arResult['NEW_ITEMS'][$arItem['PROPERTIES']['CITY']['VALUE']][$arItem['ID']] = $arItem;
    }

}
if($locationIDEs){
    $res = \Bitrix\Sale\Location\LocationTable::getList(array(
        'filter' => array('=ID' => $locationIDEs,'=NAME.LANGUAGE_ID' => LANGUAGE_ID),
        'select' => array('*', 'NAME_RU' => 'NAME.NAME')
    ));
    while ($item = $res->fetch()){
        $arResult['CITIES'][$item['ID']] = $item;
    }
}
