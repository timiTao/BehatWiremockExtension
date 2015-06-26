<?php
/**
 * This file is part of the Behat.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Service;

/**
 * Class Service
 *
 * @package Behat\WiremockExtension\Service
 */
class Service implements ServiceInterface
{
    /**
     * Path to load new mappings
     */
    const PATH_NEW_MAPPINGS = '/__admin/mappings/new';
    /**
     * Path to reset actual mappings
     */
    const PATH_RESET_MAPPINGS = '/__admin/mappings/reset';
    /**
     * Path to reset service
     */
    const PATH_RESET_SERVICE = '/__admin/reset';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $mappingPath;

    /**
     * @param $name
     * @param $client
     * @param $mappingPath
     */
    function __construct($name, $client, $mappingPath)
    {
        $this->client = $client;
        $this->name = $name;
        $this->mappingPath = $mappingPath;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Reset path of this service
     *
     * @return boolean
     */
    public function resetMapping()
    {
        $this->client->post(self::PATH_RESET_MAPPINGS);
    }

    /**
     * Reset service: logs, mappings
     *
     * @return void
     */
    public function resetService()
    {
        $this->client->post(self::PATH_RESET_SERVICE);
    }

    /**
     * Load mappings from source
     *
     * @return void
     */
    public function loadMappings()
    {
        $content = file_get_contents($this->mappingPath);
        $this->client->post(self::PATH_NEW_MAPPINGS, ['body' => $content]);
    }
}
