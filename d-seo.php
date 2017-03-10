<?php
/**
 * Оптимизаторский файл. Подключать только include_once!!! Не забываем global $aSEOData, где нужно.
 *
 * if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/d-seo.php')) {
 *   include_once($_SERVER['DOCUMENT_ROOT'] . '/d-seo.php');
 * }
 *
 * Изменяемые параметры массива $aSEOData (квадратными скобками выделены неактивные)
 * title             - title страницы
 * descr             - meta descr
 * keywr             - meta keywords
 *
 */
 
 $sContent=str_replace('http://asteh.su/categories/?id=6','http://asteh.su/rashodnye-materialy/',$sContent);
 $sContent=str_replace('http://asteh.su/categories/?id=22','http://asteh.su/arenda-izmeritelnyh-priborov/',$sContent);

//Глобальные значения (по умолчанию)
  $aSEOData['title'] = '';
  $aSEOData['descr'] = '';
  $aSEOData['keywr'] = '';

  

//Определяем адрес (REQUEST_URI есть не всегда)
  $sSEOUrl = $_SERVER['REQUEST_URI'];
//Собственно вариации для страниц
  switch ($sSEOUrl) {
	 
	// case '/':
    //$aSEOData['descr'] = ' - фотогалерея';
    // break;
	
	
	
	case '/':
    $aSEOData['title'] = 'Аренда инструмента в Москве- услуги аренды электроинструментов';
	$aSEOData['descr'] = 'Аренда инструмента в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	
	case '/categories/?id=5':
    $aSEOData['title'] = 'Аренда отбойного молотка (отбойника)- прокат бетонолома, отбойного молотка электрического';
	$aSEOData['descr'] = 'Аренда отбойного молотка в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=4':
    $aSEOData['title'] = 'Аренда перфоратора в Москве- перфоратор напрокат';
	$aSEOData['descr'] = 'Аренда перфоратора в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=8':
    $aSEOData['title'] = 'Аренда строительного пылесоса в Москве- прокат пылесосов';
	$aSEOData['descr'] = 'Аренда пылесоса в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=7':
    $aSEOData['title'] = 'Аренда штробореза в Москве- штроборез с пылесосом напрокат';
	$aSEOData['descr'] = 'Аренда штробореза в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=23':
    $aSEOData['title'] = 'Толщиномер в аренду- прокат толщиномера в Москве';
	$aSEOData['descr'] = 'Аренда толщиномера в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=21':
    $aSEOData['title'] = 'Аренда сварочного аппарата- аренда сварки в Москве';
	$aSEOData['descr'] = 'Аренда сварочного аппарата в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=459':
    $aSEOData['title'] = 'Аренда расширительного инструмента Uponor- расширительный инструмент напрокат';
	$aSEOData['descr'] = 'Аренда расширительного инструмента Uponor в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=20':
    $aSEOData['title'] = 'Аренда инструмента Uponor- инструмент Упонор в аренду';
	$aSEOData['descr'] = 'Аренда инструмента Uponor в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=24':
    $aSEOData['title'] = 'Аренда болгарки в Москве- прокат болгарок (УШМ)';
	$aSEOData['descr'] = 'Прокат болгарки в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=25':
    $aSEOData['title'] = 'Аренда туры в Москве- прокат строительной вышки-туры';
	$aSEOData['descr'] = 'Аренда вышки-туры в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=26':
    $aSEOData['title'] = 'Аренда генератора в Москве- прокат бензогенераторов';
	$aSEOData['descr'] = 'Аренда генератора в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=27':
    $aSEOData['title'] = 'Аренда бензобура (мотобура) в Москве- прокат бензобуров (мотобуров)';
	$aSEOData['descr'] = 'Аренда бензобура (мотобура) в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=28':
    $aSEOData['title'] = 'Аренда виброплиты в Москве- прокат виброплит';
	$aSEOData['descr'] = 'Аренда виброплиты в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=31':
    $aSEOData['title'] = 'Аренда плиткореза в Москве- прокат электрических плиткорезов';
	$aSEOData['descr'] = 'Аренда электрического плиткореза в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=30':
    $aSEOData['title'] = 'Аренда бетономешалки в Москве- прокат бетономешалок';
	$aSEOData['descr'] = 'Аренда бетономешалки в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=32':
    $aSEOData['title'] = 'Аренда торцовочной пилы в Москве- прокат торцовочных пил';
	$aSEOData['descr'] = 'Аренда торцовочной пилы в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=33':
    $aSEOData['title'] = 'Аренда тепловых пушек в Москве- дизельные тепловые пушки в аренду';
	$aSEOData['descr'] = 'Аренда тепловых пушек в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=29':
    $aSEOData['title'] = 'Аренда глубинного вибратора для бетона в Москве- прокат вибраторов';
	$aSEOData['descr'] = 'Аренда глубинного вибратора для бетона в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=36':
    $aSEOData['title'] = 'Аренда виброрейки для бетона в Москве';
	$aSEOData['descr'] = 'Аренда виброрейки для бетона в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=34':
    $aSEOData['title'] = 'Аренда вибротрамбовки в Москве';
	$aSEOData['descr'] = 'Аренда вибротрамбовки в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=35':
    $aSEOData['title'] = 'Аренда затирочной машины по бетону в Москве';
	$aSEOData['descr'] = 'Аренда затирочной машины по бетону в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=37':
    $aSEOData['title'] = 'Аренда шлифовальной машины по бетону в Москве';
	$aSEOData['descr'] = 'Аренда шлифовальной машины по бетону в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=15':
	$aSEOData['descr'] = 'Расходные материалы для отбойных молотков от компании Астех.';
    break;
	
	case '/categories/?id=16':
	$aSEOData['descr'] = 'Расходные материалы SDS-Max от компании Астех.';
    break;
	
	case '/categories/?id=17':
	$aSEOData['descr'] = 'Расходные материалы SDS-Plus от компании Астех.';
    break;
	
	case '/categories/?id=18':
	$aSEOData['title'] = 'Расходные материалы для строительных пылесосов - компания Астех';
	$aSEOData['descr'] = 'Расходные материалы для строительных пылесосов от компании Астех.';
    break;
	
	case '/categories/?id=19':
	$aSEOData['title'] = 'Расходные материалы для болгарок и штроборезов - компания Астех';
	$aSEOData['descr'] = 'Расходные материалы для болгарок и штроборезов от компании Астех.';
    break;
	
	case '/categories/?id=38':
	$aSEOData['title'] = 'Аренда шлифовальной машины по дереву в Москве';
	$aSEOData['descr'] = 'Аренда шлифовальной машины по дереву в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/categories/?id=39':
	$aSEOData['title'] = 'Аренда нарезчика швов в Москве';
	$aSEOData['descr'] = 'Аренда нарезчика швов в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/kontakty/':
	$aSEOData['descr'] = 'Компания Астех - наши контакты в Москве.';
    break;
	
	case '/o-nas/':
	$aSEOData['descr'] = 'Компания Астех - информация о нас.';
    break;
	
	case '/product/?id=174':
	$aSEOData['descr'] = 'Перфоратор AEG PN 11 Е (с пикой или долотом)';
    break;
	
	case '/product/?id=177':
	$aSEOData['descr'] = 'Перфоратор Makita HR 5001 C (с пикой или долотом)';
    break;
	
	case '/product/?id=225':
	$aSEOData['descr'] = 'Перфоратор Bosch GBH 4-32 DFR (с пикой или долотом)';
    break;
	
	case '/product/?id=237':
	$aSEOData['descr'] = 'Отбойный молоток Makita HM 1810 (с пикой или долотом)';
    break;
	
	case '/product/?id=239':
	$aSEOData['descr'] = 'Отбойный молоток Bosch GSH 16-30 (с пикой или долотом)';
    break;
	
	case '/product/?id=241':
	$aSEOData['descr'] = 'Отбойный молоток Makita HM1317CB (с пикой или долотом)';
    break;
	
	case '/product/?id=281':
	$aSEOData['descr'] = 'Долото SDS-Мах 25х400 мм';
    break;
	
	case '/product/?id=282':
	$aSEOData['descr'] = 'Долото SDS-Мах 50х400 мм';
    break;
	
	case '/product/?id=284':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 20х540 мм';
    break;
	
	case '/product/?id=286':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 25х540 мм';
    break;
	
	case '/product/?id=291':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 40х920 мм';
    break;
	
	case '/product/?id=292':
	$aSEOData['descr'] = 'Пика SDS-Plus 250 мм';
    break;
	
	case '/product/?id=312':
	$aSEOData['descr'] = 'Фильтр-мешок трехслойный синтетический Filter PRO';
    break;
	
	case '/product/?id=320':
	$aSEOData['descr'] = 'Сварочный инвертор ТСС САИ-200';
    break;
	
	case '/product/?id=323':
	$aSEOData['descr'] = 'Пылесос KRAUSEN PRO SUPER';
    break;
	
	case '/product/?id=324':
	$aSEOData['descr'] = 'Пылесос Metabo ASR 50 L SC';
    break;
	
	case '/product/?id=327':
	$aSEOData['descr'] = 'Пылесос Makita VC3011L';
    break;
	
	case '/product/?id=330':
	$aSEOData['descr'] = 'Толщиномер Horstek TC 215 V3';
    break;
	
	case '/product/?id=332':
	$aSEOData['descr'] = 'Толщиномер Horstek TC 715';
    break;
	
	case '/product/?id=334':
	$aSEOData['descr'] = 'Штроборез Metabo MFE 65';
    break;
	
	case '/product/?id=336':
	$aSEOData['descr'] = 'Штроборез Makita SG-180';
    break;
	
	case '/product/?id=337':
	$aSEOData['descr'] = 'Штроборез Makita SG-150';
    break;
	
	case '/product/?id=338':
	$aSEOData['descr'] = 'Штроборез Bosch GNF 35 CA';
    break;
	
	case '/product/?id=353':
	$aSEOData['descr'] = 'Диск алмазный Энкор 150 мм';
    break;
	
	case '/product/?id=360':
	$aSEOData['descr'] = 'Диск отрезной абразивный Луга 230 мм';
    break;
	
	case '/categories/?id=6':
	$aSEOData['title'] = 'Расходные материалы для инструмента - компания Астех';
	$aSEOData['descr'] = 'Расходные материалы для инструмента от компании Астех.';
    break;
	
	case '/dostavka/':
	$aSEOData['descr'] = 'Компания Астех - информация о доставке.';
    break;
	
	case '/usloviya-arendy/':
	$aSEOData['descr'] = 'Компания Астех - условия аренды.';
    break;
	
	case '/categories/?id=22':
	$aSEOData['title'] = 'Аренда измерительных приборов в Москве';
	$aSEOData['descr'] = 'Аренда измерительных приборов по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=175':
	$aSEOData['descr'] = 'Перфоратор Makita HR 5211 C (с пикой или долотом)';
    break;
	
	case '/product/?id=176':
	$aSEOData['descr'] = 'Перфоратор Bosch GBH 12-52 DV (с пикой или долотом)';
    break;
	
	case '/product/?id=238':
	$aSEOData['descr'] = 'Отбойный молоток Hitachi H65SB2 (с пикой или долотом)';
    break;
	
	case '/product/?id=240':
	$aSEOData['descr'] = 'Отбойный молоток DeWALT D25961 (с пикой или долотом)';
    break;
	
	case '/product/?id=280':
	$aSEOData['descr'] = 'Пика SDS-Мах 400 мм';
    break;
	
	case '/product/?id=283':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 18х540 мм';
    break;
	
	case '/product/?id=285':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 22х540 мм';
    break;
	
	case '/product/?id=287':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 22х520 мм';
    break;
	
	case '/product/?id=288':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 25х520 мм';
    break;
	
	case '/product/?id=289':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 28х570 мм';
    break;
	
	case '/product/?id=290':
	$aSEOData['descr'] = 'Бур по бетону SDS-Мах 32х570 мм';
    break;
	
	case '/product/?id=293':
	$aSEOData['descr'] = 'Долото SDS-Plus 20х250 мм';
    break;
	
	case '/product/?id=294':
	$aSEOData['descr'] = 'Долото SDS-Plus 40х250 мм';
    break;
	
	case '/product/?id=295':
	$aSEOData['descr'] = 'Бур по бетону SDS-Plus 6х260 мм';
    break;
	
	case '/product/?id=296':
	$aSEOData['descr'] = 'Бур по бетону SDS-Plus 8х260 мм';
    break;
	
	case '/product/?id=297':
	$aSEOData['descr'] = 'Бур по бетону SDS-Plus 10х310 мм';
    break;
	
	case '/product/?id=298':
	$aSEOData['descr'] = 'Бур по бетону SDS-Plus 12х310 мм';
    break;
	
	case '/product/?id=299':
	$aSEOData['descr'] = 'Бур по бетону SDS-Plus 14х450 мм';
    break;
	
	case '/product/?id=300':
	$aSEOData['descr'] = 'Бур по бетону SDS-Plus 16х450 мм';
    break;
	
	case '/product/?id=302':
	$aSEOData['descr'] = 'Пика шестигранная 400 мм';
    break;
	
	case '/product/?id=305':
	$aSEOData['descr'] = 'Долото шестигранное 32х400 мм';
    break;
	
	case '/product/?id=307':
	$aSEOData['descr'] = 'Долото шестигранное 75х410 мм';
    break;
	
	case '/product/?id=321':
	$aSEOData['descr'] = 'Сварочный инвертор Сварог ARC 205B';
    break;
	
	case '/product/?id=322':
	$aSEOData['descr'] = 'Сварочный инвертор КЕДР ARC-200';
    break;
	
	case '/product/?id=325':
	$aSEOData['descr'] = 'Пылесос Metabo ASA 30 L PC Inox';
    break;
	
	case '/product/?id=326':
	$aSEOData['descr'] = 'Пылесос Bosch GAS 35 L SFC';
    break;
	
	case '/product/?id=329':
	$aSEOData['descr'] = 'Толщиномер Horstek TC 515';
    break;
	
	case '/product/?id=335':
	$aSEOData['descr'] = 'Штроборез Bosch GNF 65 A';
    break;
	
	case '/product/?id=343':
	$aSEOData['descr'] = 'Угловая шлифмашина Bosch GWS 22-230 LVI';
    break;
	
	case '/product/?id=344':
	$aSEOData['descr'] = 'Угловая шлифмашина Makita 9079 SF';
    break;
	
	case '/product/?id=345':
	$aSEOData['descr'] = 'Угловая шлифмашина Metabo WEV 15-125 Quick';
    break;
	
	case '/product/?id=346':
	$aSEOData['descr'] = 'Угловая шлифмашина Bosch GWS 15-125 CI';
    break;
	
	case '/product/?id=351':
	$aSEOData['descr'] = 'Диск алмазный Bosch 230 мм';
    break;
	
	case '/product/?id=352':
	$aSEOData['descr'] = 'Диск алмазный Bosch 150 мм';
    break;
	
	case '/product/?id=354':
	$aSEOData['descr'] = 'Диск алмазный Bosch 125 мм';
    break;
	
	case '/product/?id=355':
	$aSEOData['descr'] = 'Диск алмазный Metabo 125 мм';
    break;
	
	case '/product/?id=356':
	$aSEOData['descr'] = 'Диск алмазный Энкор 125 мм';
    break;
	
	case '/product/?id=361':
	$aSEOData['descr'] = 'Диск отрезной абразивный Луга 125 мм';
    break;
	
	case '/product/?id=393':
	$aSEOData['descr'] = 'Вышка тура ВСП 250-0.7х1.6, высота 2,7 м';
    break;
	
	case '/product/?id=394':
	$aSEOData['descr'] = 'Вышка тура ВСП 250-0.7х1.6, высота 3,9 м';
    break;
	
	case '/product/?id=395':
	$aSEOData['descr'] = 'Вышка тура ВСП 250-0.7х1.6, высота 5,1 м';
    break;
	
	case '/product/?id=396':
	$aSEOData['descr'] = 'Вышка тура ВСП 250-0.7х1.6, высота 6,3 м';
    break;
	
	case '/product/?id=397':
	$aSEOData['descr'] = 'Вышка тура ВСП 250-0.7х1.6, высота 7,5 м';
    break;
	
	case '/product/?id=406':
	$aSEOData['title'] = 'Аренда генератора 7 кВт в Москве- компания Астех';
	$aSEOData['descr'] = 'Аренда генератора мощностью 7 кВт в Москве по разумным ценам на любой срок от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=408':
	$aSEOData['title'] = 'Аренда генератора 5 кВт в Москве на сутки и дольше- компания Астех';
	$aSEOData['descr'] = 'Аренда генератора мощностью 5 кВт в Москве по разумным ценам на любой срок от суток и более от компании Астех. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=399':
	$aSEOData['descr'] = 'Пылесос Metabo ASR 50 L SC';
    break;
	
	case '/product/?id=402':
	$aSEOData['descr'] = 'Пылесос Bosch GAS 35 L SFC';
    break;
	
	case '/product/?id=403':
	$aSEOData['descr'] = 'Пылесос Metabo ASA 30 L PC Inox';
    break;
	
	case '/product/?id=413':
	$aSEOData['descr'] = 'Бензобур (мотобур) ADA GroundDrill-12 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=414':
	$aSEOData['descr'] = 'Бензобур (мотобур) ECHO EA-410 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=415':
	$aSEOData['descr'] = 'Виброплита бензиновая TSS-MS120-HTв аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=416':
	$aSEOData['descr'] = 'Виброплита бензиновая Сплитстоун VS-246 E12 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=418':
	$aSEOData['descr'] = 'Вибратор для бетона Wacker Neuson IEC 58/230/5/15 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=419':
	$aSEOData['descr'] = 'Вибратор для бетона Elmos EVR 18 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=420':
	$aSEOData['descr'] = 'Бетономешалка ZITREK ZBR 260 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=421':
	$aSEOData['descr'] = 'Бетономешалка ZITREK B 1510 FK в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=422':
	$aSEOData['descr'] = 'Плиткорез Husqvarna Construction TS 60 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=423':
	$aSEOData['descr'] = 'Плиткорез DeWALT D24000 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=424':
	$aSEOData['descr'] = 'Торцовочная пила Bosch GCM 12 GDL в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=426':
	$aSEOData['descr'] = 'Торцовочная пила Metabo KGS 254 I Plus в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=427':
	$aSEOData['descr'] = 'Штроборез Makita SG-150 в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	case '/product/?id=428':
	$aSEOData['descr'] = 'Штроборез Bosch GNF 35 CA в аренду. Звоните! Тел. +7 (495) 728-25-88';
    break;
	
	
  
  }  





















//Обработка
  function changeHeadBlock ($sContent, $sRegExp, $sBlock) {
    if (preg_match($sRegExp, $sContent)) {
      return preg_replace($sRegExp, $sBlock, $sContent);
    }
    else {
      return str_replace('<head>', '<head>' . $sBlock, $sContent);
    }
  }
  if (isset($aSEOData['title']) && !empty($aSEOData['title'])) {
    $aSEOData['title'] = htmlspecialchars($aSEOData['title']);
    $sContent = changeHeadBlock($sContent, '#<title>.*</title>#siU', '<title>' . $aSEOData['title'] . '</title>');
  }
  if (isset($aSEOData['descr']) && !empty($aSEOData['descr'])) {
    $aSEOData['descr'] = htmlspecialchars($aSEOData['descr']);
    $sContent = changeHeadBlock($sContent, '#<meta[^>]+name[^>]{1,7}description[^>]*>#siU', '<meta name="description" content="' . $aSEOData['descr'] . '" />');
  }
  if (isset($aSEOData['keywr']) && !empty($aSEOData['keywr'])) {
    $aSEOData['keywr'] = htmlspecialchars($aSEOData['keywr']);
    $sContent = changeHeadBlock($sContent, '#<meta[^>]+name[^>]{1,7}keywords[^>]*>#siU', '<meta name="keywords" content="' . $aSEOData['keywr'] . '" />');
  }

?>
