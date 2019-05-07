<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ServiceGiphy;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ServiceGifTest extends TestCase
{
    private $service;

    public function setUp():void
    {
        parent::setUp();
        $this->service = new ServiceGiphy();
    }
    /**
     * Testing send random gif request to Giphy API.
     * @group external_service
     * @return void
     */
    public function testSendRequestGif()
    {
        $response = $this->service->sendRequest(ServiceGiphy::RANDOM_PATH.'?'.$this->service->getKeyParam());
        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * Testing send search gifs request to Giphy API.
     * @group external_service
     * @return void
     */
    public function testSendRequestSearchGif()
    {
        $response = $this->service->sendRequest(ServiceGiphy::SEARCH_PATH.'?q=banana&'.$this->service->getKeyParam());
        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * Testing get random gif from the service
     * @group external_service
     * @return void
     */
    public function testGifRandom()
    {
        $gif = $this->service->random();
        $this->assertNotNull($gif);
        $this->assertNotEmpty($gif->title);
        $this->assertNotEmpty($gif->url);
    }

    /**
     * Testing search gifs on the service
     * @group external_service
     * @return void
     */
    public function testSearchGif()
    {
        $gifs = $this->service->search('banana', 25);
        $this->assertTrue($gifs->isNotEmpty());
    }
}
