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
use Symfony\Component\EventDispatcher\Event;
use Behat\WiremockExtension\Collection\Collection;
use Behat\WiremockExtension\Service\ServiceInterface;

/**
 * Class Subscriber
 *
 * @package Behat\WiremockExtension\Subscriber
 */
class Subscriber implements EventSubscriberInterface
{
    /**
     * @var Collection
     */
    protected $services;

    /**
     * @param Collection $services
     */
    function __construct(Collection $services)
    {
        $this->services = $services;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'tester.scenario_tested.before' => array('resetMapping')
        );
    }

    /**
     * @param Event $event
     */
    public function resetMapping(Event $event)
    {
        /** @var ServiceInterface $service */
        foreach ($this->services as $service) {
            $service->resetMapping();
            $service->loadMappings();
        }
    }
}
