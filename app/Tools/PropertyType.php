<?php

namespace App\Tools;

abstract class PropertyType
{
    const TEXT = 'text';
    const NUMBER = 'number';
    const SELECT = 'select';
    const MULTIPLE = 'multiple_choice';

    const LIST = [self::TEXT, self::NUMBER, self::SELECT, self::MULTIPLE];
}
