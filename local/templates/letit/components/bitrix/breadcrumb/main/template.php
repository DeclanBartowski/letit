<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<div class="breadcrumbs"><div class="container"><ul class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" class="breadcrumbs__link">'.$title.'</a><meta itemprop="position" content="'.($index + 1).'" /></li>';
	}
	else
	{
		$strReturn .= '<li class="breadcrumbs__item"><a href="javascript:void(0)" class="breadcrumbs__link">'.$title.'</a></li>';
	}
}

$strReturn .= '</ul></div></div>';

return $strReturn;