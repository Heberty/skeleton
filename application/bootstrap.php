<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH . 'classes/Kohana/Core' . EXT;

if (is_file(APPPATH . 'classes/Kohana' . EXT))
	{
	// Application extends the core
	require APPPATH . 'classes/Kohana' . EXT;
}
else
	{
	// Load empty core extension
	require SYSPATH . 'classes/Kohana' . EXT;
}

require Kohana::find_file('bootstrap', 'constants');
require Kohana::find_file('bootstrap', 'functions');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable Composer auto-loader.
 * And get modules to include autoload capabilities on them
 *
 * @link https://getcomposer.org/doc/00-intro.md#autoloading
 */
$modules = require_once Kohana::find_file('bootstrap', 'modules');
$autoloadDirs = [APPPATH . 'src'];

foreach ($modules as $m) {
	$autoloadDirs[] = $m . DIRECTORY_SEPARATOR . 'src';
}
$autoloadDirs[] = dirname(APPPATH) . DIRECTORY_SEPARATOR . 'src';
//composer autoload
$composerAutoloadFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
if (file_exists($composerAutoloadFile)) {
    $loader = require_once $composerAutoloadFile;
    $loader->addPsr4(null, $autoloadDirs);
}
unset($autoloadDirs);
unset($composerAutoloadFile);

/**
 * Enables configuring the application through `.env` files.
 * You should copy `application/config/.env.default to `application/config/.env` and set/modify the
 * variables as required.
 */
if (!env('APP_NAME') && file_exists(CONFIG . '.env')) {
	$dotenv = new \josegonzalez\Dotenv\Loader([CONFIG . '.env']);
	$dotenv->parse()
		->putenv()
		->toEnv()
		->toServer();
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('UTC');

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(env('APP_ENCODING', 'UTF8'));

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
// setlocale(LC_ALL, 'en_US.utf-8');
setlocale(LC_ALL, env('APP_DEFAULT_LOCALE', 'pt_BR.utf-8'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));



/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------


/**
 * Set the default language
 */
I18n::lang(env('APP_DEFAULT_LANGUAGE', 'pt-br'));

if (isset($_SERVER['SERVER_PROTOCOL']))
	{
	// Replace the default protocol.
	HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
$KOHANA_ENV = env('KOHANA_ENV');

if ($KOHANA_ENV !== null) {
	Kohana::$environment = constant('Kohana::' . strtoupper($KOHANA_ENV));
}
else {
	Kohana::$environment = Kohana::PRODUCTION;
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(require_once Kohana::find_file('bootstrap', 'config'));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(LOGS));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Auto enable all modules
 */
Kohana::modules($modules);

/**
 * Cookie Salt
 * @see  http://kohanaframework.org/3.3/guide/kohana/cookies
 *
 * If you have not defined a cookie salt in your Cookie class then
 * uncomment the line below and define a preferrably long salt.
 */
// Cookie::$salt = NULL;



/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
require_once Kohana::find_file('bootstrap', 'routes');
