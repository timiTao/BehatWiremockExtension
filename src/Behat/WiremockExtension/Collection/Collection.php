<?php
/**
 * This file is part of the Behat.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Collection;

use Behat\WiremockExtension\Service\ServiceInterface;

/**
 * Class Collection
 *
 * @package Behat\WiremockExtension\Collection
 */
class Collection extends \ArrayObject
{
    /**
     * @param ServiceInterface $service
     */
    public function add(ServiceInterface $service)
    {
        $this->offsetSet($service->getName(), $service);
    }
}
