<?php

namespace App\Enum;

enum GamePoints: int
{
    case Win = 3;
    case Lose = 0;
    case Draw = 1;
}
