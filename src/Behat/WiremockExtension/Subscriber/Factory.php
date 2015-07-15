<?php
/**
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\WiremockExtension\Subscriber;

use Behat\WiremockExtension\Collection\Collection;
use Behat\WiremockExtension\Exception\WiremockException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class Factory
 *
 * @package Behat\WiremockExtension\Subscriber
 */
class Factory
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $builders;

    /**
     * @param Collection $collection
     * @param $config
     */
    public function __construct(Collection $collection, $config)
    {
        $this->collection = $collection;
        $this->config = $config;
    }

    /**
     * @param string $name
     * @param SubscriberBuilderInterface $builder
     */
    public function registerBuilder($name, SubscriberBuilderInterface $builder)
    {
        $this->builders[$name] = $builder;
    }

    /**
     * @return EventSubscriberInterface
     * @throws WiremockException
     */
    public function factory()
    {
        $selectedStrategy = $this->getSelectedStrategyName();

        if (!isset($this->builders[$selectedStrategy])) {
            throw new WiremockException(sprintf("Given builder '%s' not exists", $selectedStrategy));
        }
        /** @var SubscriberBuilderInterface $builder */
        $builder = $this->builders[$selectedStrategy];

        return $builder->build($this->collection);
    }

    /**
     * @return string
     */
    private function getSelectedStrategyName()
    {
        $strategyName = $this->config['wiremock']['reset_strategy']['name'];

        return $strategyName;
    }

} 