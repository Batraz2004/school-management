<?php

namespace App\Enums;

enum EvaluationEnum: string
{
    case Two = '2';
    case TwoPointFive = '2.5';
    case Three = '3';
    case ThreePointFive = '3.5';
    case Four = '4';
    case FourPointFive = '4.5';
    case Five = '5';

    public function toFloat(): float
    {
        return (float) $this->value;
    }

    public static function floatValues(): array
    {
        $result = [];

        foreach(self::cases() as $case){
            $result[$case->value] = $case->toFloat();
        }

        return $result;
    }
}
