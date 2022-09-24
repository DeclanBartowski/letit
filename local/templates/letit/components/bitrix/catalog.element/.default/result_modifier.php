<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 * @var array $arResult
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
if($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']){
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $id){
        $arResult['SLIDER'][] = [
            'BIG'=> CFile::ResizeImageGet($id,array("width" => 639, "height" => 620),BX_RESIZE_IMAGE_PROPORTIONAL)['src'],
            'SMALL'=> CFile::ResizeImageGet($id,array("width" => 85, "height" => 85),BX_RESIZE_IMAGE_PROPORTIONAL)['src'],
        ];

    }
}
if($arResult['PROPERTIES']['DOCUMENTS']['VALUE']){

    $arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_FILE","PROPERTY_ICON");
        $arFilter = ['IBLOCK_ID'=>$arResult['PROPERTIES']['DOCUMENTS']['LINK_IBLOCK_ID'],'ID'=>$arResult['PROPERTIES']['DOCUMENTS']['VALUE']];
        $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
         while($ob = $res->Fetch()){
             $arFile = CFile::GetFileArray($ob['PROPERTY_FILE_VALUE']);
           $arResult['DOCUMENTS'][] = [
               'SRC'=>$arFile['SRC'],
               'ICON'=>$ob['PROPERTY_ICON_VALUE']?CFile::GetPath($ob['PROPERTY_ICON_VALUE']):sprintf('%s/images/doc-ico.svg',SITE_TEMPLATE_PATH),
               'NAME'=>$ob['NAME'],
               'SIZE'=> CFile::FormatSize($arFile['FILE_SIZE'],0)
           ];
        }
}