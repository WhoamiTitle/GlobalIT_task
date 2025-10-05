<?php
/**
 * Создание инфоблока «Новости» с тестовыми данными.
 * Запустить один раз из корня проекта: php -f local/scripts/setup_news_iblock.php
 */

use Bitrix\Main\Loader;
use Bitrix\Main\Application;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (!Loader::includeModule('iblock')) {
    echo "Модуль iblock недоступен" . PHP_EOL;
    return;
}

$typeId = 'news';
$typeLang = [
    'ru' => [
        'NAME' => 'Новости сайта',
        'SECTION_NAME' => 'Разделы',
        'ELEMENT_NAME' => 'Элементы',
    ],
];

$type = CIBlockType::GetByID($typeId)->Fetch();
if (!$type) {
    $ibType = new CIBlockType();
    $typeData = [
        'ID' => $typeId,
        'SECTIONS' => 'Y',
        'IN_RSS' => 'N',
        'SORT' => 500,
        'LANG' => [],
    ];
    foreach ($typeLang as $lid => $lang) {
        $typeData['LANG'][$lid] = array_merge([
            'NAME' => $lang['NAME'],
            'SECTION_NAME' => $lang['SECTION_NAME'],
            'ELEMENT_NAME' => $lang['ELEMENT_NAME'],
        ]);
    }

    if ($ibType->Add($typeData)) {
        echo "Тип инфоблока {$typeId} создан" . PHP_EOL;
    } else {
        echo "Ошибка создания типа: {$ibType->LAST_ERROR}" . PHP_EOL;
        return;
    }
} else {
    echo "Тип инфоблока {$typeId} уже существует" . PHP_EOL;
}

$iblockCode = 'news_code';
$iblockName = 'News';
$siteId = SITE_ID ?: 's1';
$iblock = CIBlock::GetList([], ['TYPE' => $typeId, 'CODE' => $iblockCode])->Fetch();
if ($iblock) {
    $iblockId = (int)$iblock['ID'];
    echo "Инфоблок {$iblockName} (ID {$iblockId}) уже существует" . PHP_EOL;
} else {
    $ib = new CIBlock();
    $iblockId = (int)$ib->Add([
        'ACTIVE' => 'Y',
        'NAME' => $iblockName,
        'CODE' => $iblockCode,
        'TYPE' => $typeId,
        'SITE_ID' => [$siteId],
        'GROUP_ID' => [
            '1' => 'X',
            '2' => 'R',
        ],
        'LIST_PAGE_URL' => '#SITE_DIR#/news/',
        'SECTION_PAGE_URL' => '#SITE_DIR#/news/#SECTION_CODE#/',
        'DETAIL_PAGE_URL' => '#SITE_DIR#/news/#ID#/',
        'VERSION' => 2,
    ]);

    if ($iblockId > 0) {
        echo "Инфоблок {$iblockName} создан (ID {$iblockId})" . PHP_EOL;
    } else {
        echo "Ошибка создания инфоблока: {$ib->LAST_ERROR}" . PHP_EOL;
        return;
    }
}

$propertyCode = 'SOURCE';
$properties = CIBlockProperty::GetList([], [
    'IBLOCK_ID' => $iblockId,
    'CODE' => $propertyCode,
]);
if (!$properties->Fetch()) {
    $property = new CIBlockProperty();
    if ($property->Add([
        'NAME' => 'Источник',
        'CODE' => $propertyCode,
        'PROPERTY_TYPE' => 'S',
        'IBLOCK_ID' => $iblockId,
        'IS_REQUIRED' => 'N',
    ])) {
        echo "Свойство {$propertyCode} добавлено" . PHP_EOL;
    }
}

$elements = [
    [
        'NAME' => 'Новый ассортимент мебели',
        'PREVIEW_TEXT' => 'Компания расширила линейку мебели и представила новые коллекции.',
        'DETAIL_TEXT' => 'Компания «Мебельная фабрика» представила сразу три новые коллекции мебели. В ассортименте появились современные модели кресел, диванов и систем хранения. Особое внимание уделено экологичности материалов и повышенному комфорту. В ближайшие недели новинки поступят во все розничные салоны сети.',
        'PROPERTY_VALUES' => ['SOURCE' => 'internal'],
    ],
    [
        'NAME' => 'Открытие шоу-рума в центре города',
        'PREVIEW_TEXT' => 'Запущен новый шоу-рум с интерактивной зоной для покупателей.',
        'DETAIL_TEXT' => 'В столице открылся новый фирменный шоу-рум компании. На площади более 500 м² представлены лучшие дизайнерские решения для гостиных, кухонь и кабинетов. Для посетителей доступна интерактивная зона, где можно собрать комплект мебели под конкретный интерьер и сразу оформить заказ.',
        'PROPERTY_VALUES' => ['SOURCE' => 'press'],
    ],
    [
        'NAME' => 'Сезонная распродажа',
        'PREVIEW_TEXT' => 'На популярные модели действует скидка до 40%.',
        'DETAIL_TEXT' => 'До конца месяца в салонах и интернет-магазине действует сезонная распродажа. Скидки до 40% распространяются на наиболее востребованные модели мягкой мебели и офисных кресел. Количество товара ограничено, поэтому компания советует клиентам заранее оформить бронь.',
        'PROPERTY_VALUES' => ['SOURCE' => 'promo'],
    ],
    [
        'NAME' => 'Собственная служба доставки',
        'PREVIEW_TEXT' => 'Компания запустила службу доставки с монтажом по городу и области.',
        'DETAIL_TEXT' => 'Теперь клиенты могут воспользоваться собственной службой доставки и сборки мебели. Курьеры доставляют заказ в удобное время, а монтажная бригада выполняет сборку и расстановку мебели на месте. Услуга доступна для заказов от 15 000 рублей.',
        'PROPERTY_VALUES' => ['SOURCE' => 'service'],
    ],
    [
        'NAME' => 'Благотворительный проект',
        'PREVIEW_TEXT' => 'Часть прибыли от продаж направляется на обустройство детских комнат в социальных учреждениях.',
        'DETAIL_TEXT' => 'Компания запустила благотворительный проект: часть прибыли от продажи мебели направляется на обустройство игровых и учебных зон в детских домах и социальных центрах. Первый этап проекта реализован в Подмосковье, где уже оборудованы две детские комнаты.',
        'PROPERTY_VALUES' => ['SOURCE' => 'charity'],
    ],
];

$element = new CIBlockElement();
foreach ($elements as $index => $item) {
    $code = 'news_' . ($index + 1);
    $exists = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        false,
        ['ID']
    )->Fetch();

    if ($exists) {
        echo "Элемент {$code} уже существует" . PHP_EOL;
        continue;
    }

    $item['IBLOCK_ID'] = $iblockId;
    $item['CODE'] = $code;
    $item['ACTIVE'] = 'Y';
    $item['PREVIEW_TEXT_TYPE'] = 'text';
    $item['DETAIL_TEXT_TYPE'] = 'text';

    $id = $element->Add($item);
    if ($id) {
        echo "Добавлен элемент {$code} (ID {$id})" . PHP_EOL;
    } else {
        echo "Ошибка добавления элемента {$code}: {$element->LAST_ERROR}" . PHP_EOL;
    }
}

echo "Готово." . PHP_EOL;
