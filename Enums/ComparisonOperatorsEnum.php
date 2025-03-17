<?php

namespace Enums;

enum ComparisonOperatorsEnum: int {
    case Equal = 1;
    case Grater = 2;
    case GraterOrEqual = 3;
    case Less = 4;
    case LessOrEqual = 5;
    case NotEqual = 6;
}
