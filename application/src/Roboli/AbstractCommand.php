<?php

/**
 * Base command class for Foo Robo.li
 *
 * @see http://robo.li/
 */
namespace Roboli;

use \Robo\Common\ConfigAwareTrait as configTrait;

abstract class AbstractCommand extends \Robo\Tasks
{
    use configTrait;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
    }

    /**
     * @var string $taskDir path to Tasks dir relative to our namespace
     */
    protected $taskDir = 'Task';

    /**
     * Magic __call that tries to find and execute a correct task based
     * on called method name that must start with 'task'
     *
     * @param string $method Method name that was called
     * @param array $args Arguments that were passed to the method
     *
     * @return
     */
    public function __call($method, $args = null)
    {
        if (preg_match('/^task([A-Z]+.*?)([A-Z]+.*)$/', $method, $matches)) {
            $className = __NAMESPACE__ . "\\" . $this->taskDir . "\\" . $matches[1] . "\\" . $matches[2];
            if (!class_exists($className)) {
                throw new \RuntimeException("Failed to find class '$className' for '$method' task");
            }

            return $this->task($className, $args);
        }
        throw new \RuntimeException("Called to undefined method '$method' of '" . get_called_class() . "'");
    }
}
