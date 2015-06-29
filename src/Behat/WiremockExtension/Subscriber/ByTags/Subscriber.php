<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Subscriber\ByTags;

use Behat\WiremockExtension\Service\ServiceInterface;
use Behat\Behat\EventDispatcher\Event\BeforeScenarioTested;
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
        if (!$this->holdCorrectTag($event)) {
            return;
        }

        /** @var ServiceInterface $service */
        foreach ($this->services as $service) {
            $service->resetMapping();
            $service->loadMappings();
        }
    }

    /**
     * @param BeforeScenarioTested $event
     * @return bool
     */
    private function holdCorrectTag(BeforeScenarioTested $event)
    {
        foreach ($event->getScenario()->getTags() as $tag) {
            if (in_array($tag, $this->getCorrectTags())) {
                return true;
            }
        }

        return false;
    }
}
