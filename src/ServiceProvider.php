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


        $dic['NDeviation.Zone'] = function($dic) {
            return 8;
        };

        $dic['NDeviation.Density'] = function($dic) {
            return 1.29;
        };

        $dic['NDeviation.Calculator'] = function($dic) {
            $zone = $dic['NDeviation.Zone'];
            $density = $dic['NDeviation.Density'];
            return new NDeviation( $zone, $density );
        };



        $dic['SpeedOffset.Zone'] = function($dic) {
            return 1.5;
        };

        $dic['SpeedOffset.Density'] = function($dic) {
            return 0.17;
        };

        $dic['SpeedOffset.Calculator'] = function($dic) {
            $zone = $dic['SpeedOffset.Zone'];
            $density = $dic['SpeedOffset.Density'];
            return new NDeviation( $zone, $density );
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
