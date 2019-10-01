<?php
namespace Application\Model;

use Symfony\Component\HttpFoundation\Request;


class BaseModel extends \Mix\Model\Model
{
    public static function getImageSizes($type = null)
    {
        $sizes = static::getDefaultPropertyValue('imageSizes');

        if (empty($sizes)) {
            $config = (new static())->application['config']->load(static::getTable())->as_array();

            if (!empty($config) && isset($config['imageSizes'])) {
                $sizes = $config['imageSizes'];
            }
        }

        if ($type && isset($sizes[ $type ])) {
            return $sizes[ $type ];
        }

        return $sizes;
    }

    public function setupImages($configId)
    {
        $config = $this->application['config']->load($configId)->as_array();

        if (!empty($config['imageSizes'])) {
            foreach ($config['imageSizes'] as $field => $imageConfig) {
                $size = $config['imageSizes'][$field];
                $label = isset($imageConfig['label']) ? $imageConfig['label'] : 'Imagem';

                $image = $this
                    ->image($field, $label, $size['w'], $size['h'], 'RC', static::UPLOAD_DIR)
                    ->imageMinWidth($size['w'])
                    ->imageMinHeight($size['h']);

                if (isset($imageConfig['maxSize'])) {
                    $image->fileMaxSize($imageConfig['maxSize'], \Mix\Model\Field\Validation\FileMaxSize::MB);
                }

                if (isset($imageConfig['mandatory']) && $imageConfig['mandatory']) {
                    $image->mandatory();
                }

                if (isset($imageConfig['showInfo'])) {
                    $image->setInfo(
                        "Largura de <strong>$size[w]</strong> pixels e Altura de <strong>$size[h]</strong> pixels."
                    );
                }

                if (!empty($imageConfig['thumbs'])) {
                    foreach ($imageConfig['thumbs'] as $prefix => $thumbSize) {
                        $image->addThumb($prefix . '_', $thumbSize['w'], $thumbSize['h'], 'RC', static::UPLOAD_DIR);
                    }
                }
            }
        }
    }

    public static function beforeParseEntity(&$entity)
    {
        $config = (new static())->application['config']->load(static::getTable())->as_array();
        $request = Request::createFromGlobals();

        if (!empty($config['imageSizes'])) {
            foreach ($config['imageSizes'] as $field => $imageConfig) {
                // resolve as absolute url
                if (!empty($entity[$field])) {
                    $originalField = $entity[$field];
                    $entity[$field] = \URL::site(
                        static::UPLOAD_DIR . $entity[$field],
                        $request->getScheme()
                    );

                    if (!empty($imageConfig['thumbs'])) {
                        foreach ($imageConfig['thumbs'] as $prefix => $thumbSize) {
                            $entity[$prefix . '_' . $field] = \URL::site(
                                static::UPLOAD_DIR . $prefix . '_' . $originalField,
                                $request->getScheme()
                            );
                        }
                    }
                }
            }
        }
    }

    public static function parseEntity($entity)
    {
        static::beforeParseEntity($entity);

        $model = new static();
        $model->populateFromArray($entity, true, self::OP_DB_POPULATE);

        return $model;
    }

    public static function findParsed($modifyQueryCallback, $asArray = false)
    {
        if (is_array($modifyQueryCallback)) {
            $records = $modifyQueryCallback;
        } else {
            $query = static::buildFindQuery([], $modifyQueryCallback);
            $records = $query->execute()->fetchAll();
        }

        if (empty($records)) {
            return [];
        }

        foreach($records as $index => $result) {
            $records[$index] = static::parseEntity($result);

            if ($asArray) {
                $records[$index] = $records[$index]->toArray();
            }
        }

        return $records;
    }

}