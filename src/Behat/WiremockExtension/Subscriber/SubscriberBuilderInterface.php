<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\WiremockExtension\Subscriber;


use Behat\WiremockExtension\Collection\Collection;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Interface SubscriberBuilderInterface
 *
 * @package Behat\WiremockExtension\Subscriber
 */
interface SubscriberBuilderInterface
{
    /**
     * @param Collection $collection
     * @return EventSubscriberInterface
     */
    public function build(Collection $collection);
}
