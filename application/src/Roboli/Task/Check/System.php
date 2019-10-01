<?php
namespace Roboli\Task\Check;

use Robo\Result;

class System extends \Roboli\AbstractTask
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        try {
            $this->_phpVersion();
            $this->_systemDirectory();
            $this->_applicationDirectory();
            $this->_cacheDirectory();
            $this->_logsDirectory();
            $this->_pcre();
            $this->_spl();
            $this->_mysql();

            // TODO: adicionar mais verificações

            return Result::success($this, "Everyting is fine");
        }
        catch(\Exception $exception) {
            $this->printTaskError($exception->getMessage());

            return Result::error($this, "System check failed");
        }
    }

    private function _phpVersion()
    {
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            throw new \Exception(
                "PHP version is below 5.6: " . PHP_VERSION
            );
        }

        $this->printTaskSuccess("PHP version: " . PHP_VERSION);
    }

    private function _systemDirectory()
    {
        if (!is_dir(SYSPATH) || !is_file(SYSPATH . 'classes/Kohana' . EXT)) {
            throw new \Exception(
                'The configured system directory does not exist or does not contain required files.'
            );
        }

        $this->printTaskSuccess("System Directory: " . SYSPATH);
    }

    private function _applicationDirectory()
    {
        if (!is_dir(APPPATH) || !is_file(APPPATH . 'bootstrap' . EXT)) {
            throw new \Exception(
                'The configured application directory does not exist or does not contain required files.'
            );
        }

        $this->printTaskSuccess("Application Directory: " . APPPATH);
    }

    private function _cacheDirectory()
    {
        if (!is_dir(APPPATH) || !is_dir(APPPATH . 'cache') || !is_writable(APPPATH . 'cache')) {
            throw new \Exception(
                'The ' . APPPATH . 'cache' . DS . ' directory is not writable'
            );
        }

        $this->printTaskSuccess("Cache Directory: " .  APPPATH . 'cache' . DS);
    }

    private function _logsDirectory()
    {
        if (!is_dir(APPPATH) || !is_dir(APPPATH . 'logs') || !is_writable(APPPATH . 'logs')) {
            throw new \Exception(
                'The ' . APPPATH . 'logs' . DS . ' directory is not writable'
            );
        }

        $this->printTaskSuccess("Logs Directory: " .  APPPATH . 'logs' . DS);
    }

    private function _pcre()
    {
        if (!@preg_match('/^.$/u', 'ñ')) {
            throw new \Exception(
                'PCRE has not been compiled with UTF-8 support.'
            );
        }
        elseif (!@preg_match('/^\pL$/u', 'ñ')) {
            throw new \Exception(
                'PCRE has not been compiled with Unicode property support'
            );
        }

        $this->printTaskSuccess("PCRE UTF-8");
    }

    private function _spl()
    {
        if (!function_exists('spl_autoload_register')) {
            throw new \Exception(
                'PHP SPL is either not loaded or not compiled in'
            );
        }

        $this->printTaskSuccess("SPL Enabled");
    }

    private function _mysql()
    {
        if (!function_exists('mysql_connect')) {
            $this->printTaskWarning(
                'Mysql extension not loaded'
            );
        } else {
            $this->printTaskSuccess("MySQL Enabled");
        }
    }
}
