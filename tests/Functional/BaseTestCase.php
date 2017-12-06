<?php

namespace Tests\Functional;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase as PHPUnitFrameworkTestCase;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends PHPUnitFrameworkTestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string            $requestMethod The request method (e.g. GET, POST, etc.)
     * @param string            $requestUri    The request URI
     * @param array|object|null $requestData   The deserialized body data,
     *                                         typically an array or object
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        # $settings = require __DIR__ . '/../../src/settings.php';

        // Instantiate the application
        #$app = new App($settings);
        $app = new App;

        // Set up dependencies
        $dic = $app->getContainer();
        $dic->register( new \FilmTools\HttpApi\ServiceProvider );

        // Register middleware
        #if ($this->withMiddleware) {
        #    require __DIR__ . '/../../src/middleware.php';
        #}

        // Register routes
        new \FilmTools\HttpApi\Router( $app );

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
