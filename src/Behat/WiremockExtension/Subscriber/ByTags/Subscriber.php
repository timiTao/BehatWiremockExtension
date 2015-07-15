<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Subscriber\ByTags;

use Behat\Behat\EventDispatcher\Event\BeforeScenarioTested;
use Behat\WiremockExtension\Service\ServiceInterface;
use Behat\WiremockExtension\Subscriber\AbstractSubscriber;

/**
 * Class Subscriber
 *
 * @package Behat\WiremockExtension\Subscriber\ByTags
 */
class Subscriber extends AbstractSubscriber
{
    protected $correctTags = [];

    /**
     * @param array $correctTags
     */
    public function setCorrectTags($correctTags)
    {
        $this->correctTags = $correctTags;
    }

    /**
     * @return array
     */
    public function getCorrectTags()
    {
        return $this->correctTags;
    }

    /**
     * @param BeforeScenarioTested $event
     */
    public function resetMapping(BeforeScenarioTested $event)
    {
        $tags = $this->getCorrectTags();
        $services = $this->services;
        foreach ($event->getScenario()->getTags() as $tag) {
            if (!in_array($tag, $tags)) {
                continue;
            }

            $serviceAlias = array_search($tag, $tags);

            if (!isset($services[$serviceAlias])) {
                continue;
            }

            /** @var ServiceInterface $service */
            $service = $services[$serviceAlias];
            $service->resetMapping();
            $service->loadMappings();
        }
    }
}
