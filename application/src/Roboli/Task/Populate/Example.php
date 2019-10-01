<?php
namespace Roboli\Task\Populate;

use Robo\Result;

class Example extends \Roboli\AbstractPopulate
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->printTaskSuccess("Populate Example!");

        return Result::success($this, "Everyting is fine");
    }
}
