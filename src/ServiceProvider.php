<?php
namespace FilmTools\HttpApi;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use FilmTools\Developing\JsonDeveloping;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $dic)
    {

        $dic['Developing.Factory'] = $dic->protect(
            function($zones, $densities, $n_calculator, $speed_calculator) {
                return new JsonDeveloping( $zones, $densities, $n_calculator, $speed_calculator );
            }
        );


        $dic['Developing.Controller'] = function( $dic )
        {
            $factory = $dic['Developing.Factory'];
            return new DevelopingController( $dic, $factory );
        };

    }
}
