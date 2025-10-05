<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
$APPLICATION->SetTitle("Новости");

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    echo '<div class="catalog-list-empty">Модуль iblock недоступен.</div>';
    require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
    return;
}

$iblockId = 1;
$iblockRes = CIBlock::GetList([], [
    'TYPE' => 'News',
    'CODE' => 'news_code',
]);
if ($iblock = $iblockRes->Fetch()) {
    $iblockId = (int)$iblock['ID'];
}

if ($iblockId <= 0) {
    echo '<div class="catalog-list-empty">Инфоблок «Новости» ещё не создан. Запустите скрипт local/scripts/setup_news_iblock.php.</div>';
} else {
    $APPLICATION->IncludeComponent(
        'bitrix:news',
        'news',
        [
            'IBLOCK_TYPE' => 'News',
            'IBLOCK_ID' => $iblockId,
            'NEWS_COUNT' => 0,
            'SORT_BY1' => 'ACTIVE_FROM',
            'SORT_ORDER1' => 'DESC',
            'SORT_BY2' => 'ID',
            'SORT_ORDER2' => 'DESC',
            'SEF_MODE' => 'Y',
            'SEF_FOLDER' => '/news/',
            'CHECK_DATES' => 'Y',
            'SET_TITLE' => 'Y',
            'SET_STATUS_404' => 'Y',
            'ADD_SECTIONS_CHAIN' => 'N',
            'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
            'ADD_ELEMENT_CHAIN' => 'Y',
            'LIST_FIELD_CODE' => ['NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'],
            'LIST_PROPERTY_CODE' => ['SOURCE'],
            'DETAIL_FIELD_CODE' => ['NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'DATE_ACTIVE_FROM'],
            'DETAIL_PROPERTY_CODE' => ['SOURCE'],
            'LIST_ACTIVE_DATE_FORMAT' => 'd.m.Y',
            'DETAIL_SET_CANONICAL_URL' => 'N',
            'DETAIL_DISPLAY_TOP_PAGER' => 'N',
            'DETAIL_DISPLAY_BOTTOM_PAGER' => 'N',
            'CACHE_TYPE' => 'A',
            'CACHE_TIME' => 3600000,
            'CACHE_FILTER' => 'N',
            'CACHE_GROUPS' => 'Y',
            'STRICT_SECTION_CHECK' => 'N',
            'USE_FILTER' => 'N',
            'USE_REVIEW' => 'N',
            'USE_SEARCH' => 'N',
            'USE_RSS' => 'N',
            'USE_RATING' => 'N',
            'USE_SHARE' => 'N',
            'PAGER_SHOW_ALL' => 'N',
            'PAGER_SHOW_ALWAYS' => 'N',
            'PAGER_TEMPLATE' => '',
            'PAGER_TITLE' => 'Новости',
            'SEF_URL_TEMPLATES' => [
                'news' => '',
                'section' => '',
                'detail' => '#ELEMENT_ID#/',
            ],
        ],
        false
    );
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
