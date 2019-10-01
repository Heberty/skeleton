<?php

/**
 * Base command class for Foo Robo.li
 *
 * @see http://robo.li/
 */
namespace Roboli;

use Doctrine\DBAL\DriverManager;
use bheller\ImagesGenerator\ImagesGeneratorProvider;
use Intervention\Image\ImageManagerStatic as Image;
use Roboli\AbstractTask;

abstract class AbstractPopulate extends AbstractTask
{
    protected $_faker;
    protected $_numItems = 10;
    protected $_tmpDir = '.tmp/';

    public function __construct()
    {
        $this->_faker = \Faker\Factory::create();
        $this->_faker->addProvider(new ImagesGeneratorProvider($this->_faker));
        $this->_faker->addProvider(new \Faker\Provider\pt_BR\Address($this->_faker));
        $this->_faker->addProvider(new \Faker\Provider\pt_BR\Person($this->_faker));
        $this->_faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($this->_faker));
    }

    public function faker()
    {
        return $this->_faker;
    }

    public function image($dir, $width = 640, $height = 480, $backgroundColor=null, $textColor=null)
    {
        if(null === $backgroundColor) {
            $backgroundColor = $this->faker()->hexcolor;
        }

        if(null === $textColor) {
            $textColor = '#333333';
        }

        return $this->faker()->imageGenerator($dir, $width, $height, 'png', true, true, $backgroundColor, $textColor);
    }

    protected function _insert($table, $query, array $data)
    {
        $query->insert($table);

        try {
            $query->values($data)->execute();
        }
        catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $exception) {
            self::warning('Record already inserted');
        }
    }

    /**
     * @return \Doctrine\DBAL\Connection
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function getConnection($type)
    {
        $connection = \Kohana::$config->load('database')->get($type);
        return DriverManager::getConnection($connection);
    }

    /**
     * This method need to be called after each run() call to clear
     * the tmp folder and reset the unique index
     *
     * @return void
     */
    protected function afterRun()
    {
        try {
            $this->removeDirectory($this->_tmpDir);
            // reset the index after each task has been completed
            $this->faker()->unique(true);
        }
        catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    protected function _getIds($table)
    {
        $query = self::getConnection('production')
            ->createQueryBuilder()
            ->select('id')
            ->from($table)
            ->execute()
            ->fetchAll();

        return !empty($query) ? array_column($query, 'id') : [];
    }

    public static function mkdir($dirname)
    {
        if(!is_dir($dirname)){
            // Assert the directory exist
            mkdir($dirname, 0777, true);
        }
    }

    protected function removeDirectory($path) {
        $files = glob($path . '/*');
        foreach ($files as $file) {
           is_dir($file) ? removeDirectory($file) : unlink($file);
        }
        if(is_dir($path)) {
            rmdir($path);
        }
        return;
    }

    protected function _createImage( $uploadDir, array $imageSizes = [], $backgroundColor=null)
    {
        try {
            // Assert the directory exist
            self::mkdir($this->_tmpDir);

            $width = isset($imageSizes['default'], $imageSizes['default']['w']) ? $imageSizes['default']['w'] : 800;
            $height = isset($imageSizes['default'], $imageSizes['default']['h']) ? $imageSizes['default']['h'] : 600;

            $filePath = $this->image($this->_tmpDir, $width, $height, $backgroundColor);
            if (!file_exists($filePath)) {
                throw new \Intervention\Image\Exception\NotReadableException("");
            }

            $file = basename($filePath);
            $newPath = DOCROOT . $uploadDir;

            // Assert the directory exist
            self::mkdir($newPath);

            $image = Image::make($filePath);
            $image->backup();

            if(count($imageSizes) > 1) {
                foreach ($imageSizes as $type => $size) {
                    if ($type === 'default') {
                        // Save the original image
                        $image->save($newPath . $file);
                    } else {
                        // Create the Crop
                        $image->reset();
                        $image->fit($size['w'], $size['h']);
                        $image->save($newPath . $type . '_' . $file);
                    }
                }
            } else {
                $image->save($newPath . $file);
            }

            return $file;
        } catch (\Intervention\Image\Exception\NotReadableException $exception) {
            $this->error([
                "Failed do create: " . $filePath,
                $exception->getMessage()
            ]);

            die;
        }
    }
}
