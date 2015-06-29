<?php
/**
 * This file is part of the Behat.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\WiremockExtension\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Behat\WiremockExtension\Collection\Collection;

/**
 * Class Factory
 *
 * @package Behat\WiremockExtension\Subscriber
 */
class Factory
{
    /**
     * Before any scenario, service will be reset
     */
    const STRATEGY_ALWAYS = 'always';
    /**
     * Before scenario that contain given tag, service will be reset
     */
    const STRATEGY_TAG = 'tag';
    /**
     * Before all scenarios in given suite, service will be reset
     */
    const STRATEGY_SUITE = 'suite';

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param Collection $collection
     */
    function __construct( Collection $collection)
    {
        $this->collection = $collection;
    }


    /**
     * @return EventSubscriberInterface
     */
    public function factory()
    {
        return new Subscriber($this->collection);
    }

} 