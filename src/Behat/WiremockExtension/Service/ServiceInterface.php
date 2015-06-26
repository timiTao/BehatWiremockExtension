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
 * Interface ServiceInterface
 *
 * @package Behat\WiremockExtension\Service
 */
interface ServiceInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * Reset path of this service
     *
     * @return void
     */
    public function resetMapping();

    /**
     * Reset service: logs, mappings
     * @return void
     */
    public function resetService();

    /**
     * Load mappings from source
     * @return void
     */
    public function loadMappings();
}
