<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Behat\WiremockExtension\Subscriber\ByTags;

use Behat\WiremockExtension\Collection\Collection;
use Behat\WiremockExtension\Subscriber\SubscriberBuilderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class SubscriberBuilder
 *
 * @package Behat\WiremockExtension\Subscriber\ByTags
 */
class SubscriberBuilder implements SubscriberBuilderInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


    /**
     * @param Collection $collection
     * @return EventSubscriberInterface
     */
    public function build(Collection $collection)
    {
        $tags = $this->config['wiremock']['reset_strategy']['options']['services'];

        $byTags = new Subscriber($collection);
        $byTags->setCorrectTags($tags);

        return $byTags;
    }
}
