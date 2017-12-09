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
     * @var Callable
     */
    public $n_calculator;


    /**
     * @var Callable
     */
    public $speed_calculator;


    /**
     * @param callable $developing_factory
     * @param callable $n_calculator
     * @param callable $speed_calculator
     */
    public function __construct( callable $developing_factory, callable $n_calculator, callable $speed_calculator )
    {
        $this->developing_factory = $developing_factory;
        $this->n_calculator = $n_calculator;
        $this->speed_calculator = $speed_calculator;
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

        $n_calculator     = $this->n_calculator;
        $speed_calculator = $this->speed_calculator;
        $factory          = $this->developing_factory;

        $developing = $factory($data['zones'], $data['densities'], $n_calculator, $speed_calculator);

        return $response->withJson( $developing );
    }
}
