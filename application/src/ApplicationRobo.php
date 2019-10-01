<?php

use Robo\Common\ConfigAwareTrait;
use Robo\Config;
use Robo\Robo;
use Robo\Runner as RoboRunner;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

/**
 * Configure the task runner with all the commands available in the modules
 */
class ApplicationRobo
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    private $commandClasses = [];

    public function __construct()
    {
        $this->input = $_SERVER['argv'];
        $this->output = new ConsoleOutput();
        $this->findCommandClasses();
    }

    /**
     * Search for command classes in all modules as well in the application
     * the command should respect the namespace \Roboli\Command\NameoftheCommand
     *
     * @return void
     */
    private function findCommandClasses()
    {
        $finder = Finder::create()
            ->ignoreVCS(true)
            ->name('*Command.php')
            ->in(
                $this->loadPaths()
            );

        foreach ($finder as $file) {
            $fileName = substr($file->getRelativePathname(), 0, -4);
            $className = '\Roboli\Command\\' . $fileName;

            if (class_exists($className)) {
                $this->commandClasses[] = $className;
            }
        }
    }

    private function loadPaths()
    {
        return [
            // set the local apllication path
            'application' . DS . 'src' . DS . 'Roboli' . DS . 'Command',
            // loads the modules paths
            MODPATH . DS . '*' . DS . 'src' . DS . 'Roboli' . DS . 'Command'
        ];
    }

    public function run()
    {
        try {
            $statusCode = \Robo\Robo::run(
                $this->input,
                $this->commandClasses,
                \Kohana::$config->load('app')->get('name'),
                \Kohana::$config->load('app')->get('version'),
                $this->output,
                'mixinternet/project'
            );
        } catch (TaskExitException $e) {
            $statusCode = $e->getCode() ? : 1;
        }

        return $statusCode;
    }
}
