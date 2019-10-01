<?php

/**
 * Base command class for Foo Robo.li
 *
 * @see http://robo.li/
 */
namespace Roboli;

use Robo\Common\ConfigAwareTrait;
use Robo\Result;
use Robo\Task\BaseTask;
use Robo\Tasks;
use Robo\Common\IO;

abstract class AbstractTask extends BaseTask
{
    use IO;

    private $args;

    public function __construct($args)
    {
        $this->args = $args;

        $this->init();
    }

    public function init()
    {
    }

    public function getArgs()
    {
        return $this->args;
    }

    /**
     * {inheritdoc}
     */
    public function run()
    {
    }

    public function error($text)
    {
        $this->printTaskError($text);
    }

    public function success($text)
    {
        $this->printTaskSuccess($text);
    }

    public function warning($text)
    {
        $this->printTaskWarning($text);
    }

    public function info($text)
    {
        $this->printTaskInfo($text);
    }
}
