<?php

/*
 * This file is part of the StyleCI SDK.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\SDK;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;

/**
 * This is the client class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class Client
{
    /**
     * The base url.
     *
     * @var string
     */
    const BASE_URL = 'https://api.styleci.io/';

    /**
     * The guzzle client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Create a new client instance.
     *
     * @param \GuzzleHttp\ClientInterface|null $client
     *
     * @return void
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new GuzzleClient(['base_uri' => static::BASE_URL, 'headers' => ['Accept' => 'application/json', 'User-Agent' => 'styleci-sdk/1.0']]);
    }

    /**
     * Get the fixers.
     *
     * @return array
     */
    public function fixers()
    {
        return $this->get('fixers');
    }

    /**
     * Get the presets.
     *
     * @return array
     */
    public function presets()
    {
        return $this->get('presets');
    }

    /**
     * Send a get request, and parse the result as json.
     *
     * @return array
     */
    protected function get($uri)
    {
        $response = $this->client->request('GET', $uri);

        return json_decode($response->getBody(), true);
    }
}