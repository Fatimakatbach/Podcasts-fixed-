<?php
namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimerExtension extends AbstractExtension
{
    const CONFIGURACION = [
        'formato' => 'Y/m/d'

    ];
    public function getFilters()
    {
        return[
            new  TwigFilter('timer', [$this, 'formatearTimer']),

        ];
    }
    public function formatearTimer($fecha, $configuracion = []) {
        $configuracion = array_merge(self::CONFIGURACION, $configuracion);
        $fechaActual = new \DateTime();
        $fechaFormateada = $fecha->format($configuracion['formato']);
        $diferenciaFechasSegundos = $fechaActual->getTimestamp() - $fecha->getTimestamp();
        if($diferenciaFechasSegundos < 60) {
            $fechaFormateada = 'creado ahora mismo';
        } elseif ($diferenciaFechasSegundos < 3600){
            $fechaFormateada = 'creado recientemente';
        } elseif ($diferenciaFechasSegundos < 14400)
        $fechaFormateada = 'creado hace unas horas';
        return $fechaFormateada;
    }

    
}