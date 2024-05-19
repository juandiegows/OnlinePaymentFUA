<?php

namespace App\Actions\SaleStatus;

enum SaleStatusConstante: int
{
    case COMPLETADA = 3;
    case RECHAZADA = 2;
    case PENDIENTE = 1;
}