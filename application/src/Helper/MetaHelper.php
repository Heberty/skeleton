<?php
namespace Helper;

class MetaHelper
{
    private static $builder = null;

    private static $data = [];

    /**
     * stop creating new objects
     */
    private function __construct()
    {
    }

    /**
     * Stopping Clonning of Object
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Stopping unserialize of object
     */
    private function __wakeup()
    {
    }

    public static function getBuilder()
    {
        if(self::$builder === null){
            self::$builder = new \Utlime\SeoMetaTags\BuilderDelegate(
                new \Utlime\SeoMetaTags\CommonBuilder(),
                new \Utlime\SeoMetaTags\TwitterBuilder(),
                new \Utlime\SeoMetaTags\OpenGraphBuilder()
            );
        }

        return self::$builder;
    }

    /**
     * Creates meta tags in local self::$data memory storage
     *
     * @param string $key
     * @param string $value
     * @param bool $append
     * @return \Utlime\SeoMetaTags\BuilderDelegate
     */
    public static function add($key = null, $value = null, $append = true)
    {
        if(self::has($key) && $append) {
            $value = $value . ', ' . self::$data[$key];
        }

        self::$data[$key] = $value;
    }

    /**
     * Creates a meta tag value if the key is not set yet
     *
     * @param string $key
     * @param string $value
     * @param bool $overrite
     * @return \Utlime\SeoMetaTags\BuilderDelegate
     */
    public static function addDefault($key = null, $value = null)
    {
        if(!self::has($key)) {
            self::add($key, $value);
        }
    }

    /**
     * Checks if a meta-tag is already created
     *
     * @param [type] $key
     * @return boolean
     */
    public static function has($key)
    {
        return array_key_exists($key, self::$data);
    }

    /**
     * Create the meta tags for all local stored data
     *
     * @return void
     */
    private static function addToBuilder()
    {
        $builder = self::getBuilder();

        foreach(self::$data as $key => $value) {
            if($key && $value) {
                $builder->add($key, $value);
            }
        }
    }

    /**
     * Render the meta tags
     *
     * @return string
     */
    public static function render() {
        self::addToBuilder();

        return self::$builder ? self::$builder->build() : '';
    }
}
