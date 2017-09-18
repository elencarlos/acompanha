<?php

namespace AppBundle\Entity;




class Setores
{
    const RECEPCAO = 1;
    const SALA_OPERATORIA = 2;
    const RPA = 4;
    const LEITO = 8;


    protected static $choices = [
        self::RECEPCAO    => 'Recepção',
        self::SALA_OPERATORIA => 'Sala Operatória',
        self::RPA          => 'Recuperação',
        self::LEITO    => 'Encaminhado ao Leito',
    ];

    /**
     * @return array
     */
    public static function getChoices()
    {
        return self::$choices;
    }
}
