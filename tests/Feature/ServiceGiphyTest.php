<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ServiceGiphyTest extends TestCase
{
    /**
     * Testing the random gif command, and the response structure
     * @group external_service
     * @return void
     */
    public function testAPIRandomGif()
    {
        $headers = array('API_KEY' => 'API_DEMO');
        $response = $this->json('get', '/v1/gifs/random', [], $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure(['title', 'url', 'height', 'width']);
    }

    /**
     * Testing the search gifs command, and the response structure
     * @group external_service
     * @return void
     */
    public function testAPISearchGifs()
    {
        $headers = array('API_KEY' => 'API_DEMO');
        $response = $this->json('get', '/v1/gifs/search', ['q' => 'banana'], $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['title', 'url', 'height', 'width']
        ]);
    } 

    /**
     * Testing we have a HTTP Status Code 401, unauthorized access.
     * Request without API_KEY header
     *
     * @return void
     */
    public function testAPIUnauthorized()
    {
        $response = $this->json('get', '/v1/gifs/random');
        $response->assertStatus(401);
    }
}
