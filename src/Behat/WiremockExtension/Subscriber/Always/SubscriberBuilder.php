<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Subscriber\Always;

use Behat\WiremockExtension\Collection\Collection;
use Behat\WiremockExtension\Subscriber\SubscriberBuilderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class SubscriberBuilder
 *
 * @package Behat\WiremockExtension\Subscriber\Always
 */
class SubscriberBuilder implements SubscriberBuilderInterface
{
    /**
     * @param Collection $collection
     * @return EventSubscriberInterface
     */
    public function build(Collection $collection)
    {
        return new Subscriber($collection);
    }
}
