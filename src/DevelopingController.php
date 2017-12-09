<?php
namespace FilmTools\HttpApi;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use FilmTools\NDeviation\NDeviation;
use Pimple\Container;

class DevelopingController
{

    /**
     * @var Container
     */
    public $dic;

    /**
     * @var Callable
     */
    public $developing_factory;


    /**
     * @param callable $developing_factory
     */
    public function __construct( Container $dic, callable $developing_factory )
    {
        $this->developing_factory = $developing_factory;
        $this->dic = $dic;
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

        $n_calculator     = new NDeviation( 8, 1.29);
        $speed_calculator = new NDeviation( 1.5, 0.17);

        $factory = $this->developing_factory;
        $developing = $factory($data['zones'], $data['densities'], $n_calculator, $speed_calculator);

        return $response->withJson( $developing );
    }
}
