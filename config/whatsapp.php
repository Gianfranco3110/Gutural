<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WhatsApp Number
    |--------------------------------------------------------------------------
    |
    | Número de WhatsApp del administrador para recibir pedidos.
    | Formato: código de país + número sin espacios ni símbolos
    | Ejemplo: 573001234567 (Colombia)
    |
    */
    'number' => env('WHATSAPP_NUMBER', ''),
];
