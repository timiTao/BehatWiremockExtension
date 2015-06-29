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
use Behat\WiremockExtension\Service\ServiceInterface;
use Behat\Behat\EventDispatcher\Event\BeforeScenarioTested;

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
     * @param BeforeScenarioTested $event
     */
    public function resetMapping(BeforeScenarioTested $event)
    {
        /** @var ServiceInterface $service */
        foreach ($this->services as $service) {
            $service->resetMapping();
            $service->loadMappings();
        }
    }
}
