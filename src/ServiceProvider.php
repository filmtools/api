<?php
namespace FilmTools\HttpApi;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $dic)
    {

        $dic['NDeviation.Developing'] = function( $dic )
        {
            $factory = new JsonDevelopingFactory;
            return new DevelopingController( $factory );
        };

    }
}
