<?php
/**
 * Foo HipChat Robo.li commands file
 *
 * @see http://robo.li
 */
namespace Roboli\Command;

use Roboli\AbstractCommand;
use Symfony\Component\Finder\Finder;

class CheckCommand extends AbstractCommand
{
    private $taskClasses;

    public function init()
    {
        $configFileNames = \Kohana::$config->load('tasks')->get('check');

        if(!empty($configFileNames)) {
            foreach ($configFileNames as $fileName) {
                $this->setTaskClass($fileName);
            }
        } else {
            $this->findTaskClasses();
        }
    }

    private function setTaskClass($fileName)
    {
        $className = '\Roboli\Task\Check\\' . $fileName;

        if (class_exists($className)) {
            $this->taskClasses[] = $className;
        }
    }

    /**
     * Search for task classes in all modules as well in the application
     * the command should respect the namespace \Roboli\Task\Populate\NameoftheModel
     *
     * @return void
     */
    private function findTaskClasses()
    {
        try {
            $finder = Finder::create()
                ->ignoreUnreadableDirs(true)
                ->ignoreVCS(true)
                ->name('*.php')
                ->in(
                    [
                        // set the local apllication path
                        'application' . DS . 'src' . DS . 'Roboli' . DS . 'Task' . DS . 'Check',
                    ]
                );

            foreach ($finder as $file) {
                $fileName = substr($file->getRelativePathname(), 0, -4);

                $this->setTaskClass($fileName);
            }
        }
        catch (\InvalidArgumentException $e) {
            // do nothing
        }
    }

    /**
     * Executes all the tasks
     */
    public function check(array $args = [])
    {
        foreach ($this->taskClasses as $className) {
            if (!class_exists($className)) {
                throw new \RuntimeException("Failed to find class '$className' for '$method' task");
            }

            $this->task($className, $args)->run();
        }
    }
}
