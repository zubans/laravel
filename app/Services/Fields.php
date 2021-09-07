<?php

namespace App\Services;

interface Fields
{
    const
        END_TAGS = "</Товары>
	</Каталог>
</КоммерческаяИнформация>"
    ;

    const
        CATALOG = 'Каталог',
        TOVARS = 'Товары',
        TOVAR = 'Товар',
        COD = 'Код',
        CLASSOFICATOR = 'Классификатор',
        NAMING = 'Наименование',
        OFFERS = 'Предложения',
        OFFER = 'Предложение',
        PRICE = 'Цена',
        COUNT = 'Пересчет',
        ALT_COUNT = 'Количество',
        RECALCULATION = 'Пересчет',
        PIECE = 'Единица',
        WES = 'Вес',
        ALTERNATIVES = 'Взаимозаменяемости',
        ALTERNATIVE = 'Взаимозаменяемость',
        MARK = 'Марка',
        MODEL = 'Модель',
        CATEGORY = 'КатегорияТС'
    ;

    //Cities
    const
        MOSCOW = 'Москва',
        ST_PETERSBURG = 'Санкт-Петербург',
        SAMARA = 'Самара',
        CHELYABINSK = 'Челябинск'
    ;
}
