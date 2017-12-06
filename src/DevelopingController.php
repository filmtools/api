<?php
namespace FilmTools\HttpApi;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use FilmTools\NDeviation\NDeviation;

class DevelopingController
{

    /**
     * @var Callable
     */
    public $developing_factory;


    /**
     * @param callable $developing_factory
     */
    public function __construct( callable $developing_factory )
    {
        $this->developing_factory = $developing_factory;
    }


    /**
     * @param  Request  $request
     * @param  Response $response
     * @param  array    $args
     * @return Response
     */
    public function __invoke( Request $request, Response $response, array $args )
    {
        $data = $request->getParsedBody();

        $n_calculator = new NDeviation( 8, 1.29);
        $N = $n_calculator( $data['zones'], $data['densities'] );

        $speed_calculator = new NDeviation( 1.5, 0.17);
        $offset = $speed_calculator( $data['zones'], $data['densities'] );

        $factory = $this->developing_factory;
        $developing = $factory();

        $developing->setOffset( $offset );
        $developing->setN( $N );
        $developing->setZones( $data['zones'] );
        $developing->setDensities( $data['densities'] );

        return $response->withJson( $developing );
    }
}
