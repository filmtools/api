<?php

namespace Tests\Functional;

class DevelopingTest extends BaseTestCase
{
    /**
     * @dataProvider provideZonesAndDensities
     */
    public function testNDeviation($zones, $densities)
    {
        $response = $this->runApp('POST', '/developing', [
            'zones'     => $zones,
            'densities' => $densities
        ]);

        // Check HTTP Status Code
        $this->assertEquals(200, $response->getStatusCode());

        // Check if JSON response
        $mime = $response->getHeaderLine('Content-Type');
        $this->assertContains('application/json', $mime);

        // Check returned data
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('N', $data);
        $this->assertArrayHasKey('developing', $data);
        $this->assertArrayHasKey('zones', $data);
        $this->assertArrayHasKey('densities', $data);
        $this->assertArrayHasKey('offset', $data);
        $this->assertArrayHasKey('gamma', $data);
        $this->assertArrayHasKey('beta', $data);

        #echo $response->getBody();
    }


    public function provideZonesAndDensities()
    {
        $zones = [ 0.00, 1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00, 9.00, 10.00 ];
        $densities = [ 0.02, 0.08, 0.17, 0.29, 0.44, 0.63, 0.86, 1.03, 1.16, 1.22, 1.34 ];

        return array(
            [ $zones, $densities ]
        );
    }
}
