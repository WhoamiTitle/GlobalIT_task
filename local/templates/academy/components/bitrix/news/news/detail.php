<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->IncludeComponent(
    'bitrix:news.detail',
    'news_detail',
    [
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'] ?? null,
        'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'] ?? null,
        'CHECK_DATES' => $arParams['CHECK_DATES'],
        'FIELD_CODE' => $arParams['DETAIL_FIELD_CODE'],
        'PROPERTY_CODE' => $arParams['DETAIL_PROPERTY_CODE'],
        'DETAIL_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['detail'],
        'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
        'IBLOCK_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['news'],
        'SET_TITLE' => $arParams['SET_TITLE'],
        'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'] ?? 'N',
        'SET_BROWSER_TITLE' => $arParams['SET_BROWSER_TITLE'] ?? 'Y',
        'SET_META_KEYWORDS' => $arParams['SET_META_KEYWORDS'] ?? 'Y',
        'SET_META_DESCRIPTION' => $arParams['SET_META_DESCRIPTION'] ?? 'Y',
        'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'] ?? 'N',
        'INCLUDE_IBLOCK_INTO_CHAIN' => $arParams['INCLUDE_IBLOCK_INTO_CHAIN'],
        'ADD_SECTIONS_CHAIN' => $arParams['ADD_SECTIONS_CHAIN'],
        'ADD_ELEMENT_CHAIN' => $arParams['ADD_ELEMENT_CHAIN'],
        'ACTIVE_DATE_FORMAT' => $arParams['DETAIL_ACTIVE_DATE_FORMAT'] ?? 'd.m.Y',
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'SET_STATUS_404' => $arParams['SET_STATUS_404'],
        'SHOW_404' => $arParams['SHOW_404'],
        'MESSAGE_404' => $arParams['MESSAGE_404'] ?? '',
    ],
    $component
);
