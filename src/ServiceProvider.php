<?php
namespace FilmTools\HttpApi;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use FilmTools\Developing\JsonDeveloping;
use FilmTools\NDeviation\NDeviation;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $dic)
    {

        $dic['NDeviation.Calculator'] = function($dic) {
            return new NDeviation( 8, 1.29 );
        };

        $dic['SpeedOffset.Calculator'] = function($dic) {
            return new NDeviation( 1.5, 0.17 );
        };

        $dic['Developing.Factory'] = $dic->protect(
            function($zones, $densities, $n_calculator, $speed_calculator) {
                return new JsonDeveloping( $zones, $densities, $n_calculator, $speed_calculator );
            }
        );


        $dic['Developing.Controller'] = function( $dic )
        {
            $factory          = $dic['Developing.Factory'];
            $n_calculator     = $dic['NDeviation.Calculator'];
            $speed_calculator = $dic['SpeedOffset.Calculator'];

            return new DevelopingController( $factory, $n_calculator, $speed_calculator );
        };

    }
}
