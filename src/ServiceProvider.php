<?php
namespace FilmTools\HttpApi;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use FilmTools\Developing\JsonDeveloping;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $dic)
    {

        $dic['NDeviation.Developing.Factory'] = $dic->protect(
            function($zones, $densities, $n_calculator, $speed_calculator) {
                return new JsonDeveloping( $zones, $densities, $n_calculator, $speed_calculator );
            }
        );


        $dic['NDeviation.Developing.Controller'] = function( $dic )
        {
            $factory = $dic['NDeviation.Developing.Factory'];
            return new DevelopingController( $factory );
        };

    }
}
