<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Subscriber\Always;

use Behat\Behat\EventDispatcher\Event\BeforeScenarioTested;
use Behat\WiremockExtension\Service\ServiceInterface;
use Behat\WiremockExtension\Subscriber\AbstractSubscriber;

/**
 * Class Subscriber
 *
 * @package Behat\WiremockExtension\Subscriber\Always
 */
class Subscriber extends AbstractSubscriber
{
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
