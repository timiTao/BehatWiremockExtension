<?php
/**
 * This file is part of the Behat.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Collection;

use Behat\WiremockExtension\Service\Service;
use GuzzleHttp\Client;

/**
 * Class Factory
 *
 * @package Behat\WiremockExtension\Collection
 */
class Factory
{
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @param array $parameters
     */
    function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return Collection
     */
    public function factory()
    {
        $connectionsConfig = $this->parameters['wiremock']['servers'];

        $list = new Collection();
        foreach ($connectionsConfig as $key => $serviceConfig) {
            $basePath = $serviceConfig['base_url'];
            $mappingPath = $serviceConfig['mappings_path'];
            $list->add(new Service($key, new Client(['base_url' => $basePath]), $mappingPath));
        }

        return new Collection($list);
    }
}
