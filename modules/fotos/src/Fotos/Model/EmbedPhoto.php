<?php

namespace Fotos\Model;

class EmbedPhoto extends \Mix\Model\Model
{
    const UPLOAD_DIR = 'uploads/fotos/';

    protected $alias = 'fotos';

    public function __construct($type, \Mix\Application $app = null)
    {
        $this->setOption('type', $type);
        parent::__construct($app);
    }

    /*protected static $types = array();*/

    public function init()
    {
        $type = $this->getOption('type');
        $imageField = \Mix\Model\Field\Gallery::instantiateImageFieldOfType($type);
        if (empty($imageField)) {
            $this->image('foto', 'Foto', null, null, 'K', 'fotos')
                ->addThumb('thumb_', 200, 200, 'KR', 'fotos')
                ->mandatory();
        } else {
            $imageField->setName('foto');
            $this->addField($imageField);
        }
        $this->text('objeto_tipo', 'Tipo')->mandatory();
        $this->integer('objeto_id', 'ID');
        $this->boolean('visivel_site', 'Visível no site?');
        $this->text('titulo', 'Título')->maxLength(255);
        $this->text('descricao', 'Descrição');
        $this->visivel_site = 1;
    }

    public function makeItCover($type, $typeId = null)
    {
        $id = $this->id();
        if (empty($id)) {
            return false;
        }
        $db = static::getConnection();
        $query = $db->createQueryBuilder();
        $query->update(static::getTable())
            ->set('capa', '0')
            ->where('objeto_tipo=' . $query->createNamedParameter($type));

        if ($typeId === null) {
            $query->andWhere('objeto_id IS NULL');
        } else {
            $query->andWhere('objeto_id=' . $query->createNamedParameter($typeId));
        }
        $query->execute();

        $query = $db->createQueryBuilder();
        $query->update(static::getTable())
            ->set('capa', '1')
            ->set('visivel_site', '1')
            ->where('objeto_tipo=' . $query->createNamedParameter($type))
            ->andWhere('id=' . $query->createNamedParameter($id));

        if ($typeId === null) {
            $query->andWhere('objeto_id IS NULL');
        } else {
            $query->andWhere('objeto_id=' . $query->createNamedParameter($typeId));
        }

        return $query->execute();
    }

    public static function bulkDelete($type, $photosIds)
    {
        if (empty($photosIds)) {
            return false;
        }

        if (!is_array($photosIds)) {
            $photosIds = array($photosIds);
        }
        $photosIds = array_map('intval', $photosIds);
        $query = self::getConnection()->createQueryBuilder();
        $query->delete(self::getTable())
            ->where('id IN (' . implode(', ', $photosIds) . ')')
            ->andWhere('objeto_tipo=' . $query->createNamedParameter($type));

        return $query->execute();
    }

    public static function bulkUpdate($type, $photosIds, $field, $value, $ignoreCover = false)
    {
        if (empty($photosIds)) {
            return false;
        }

        if (!is_array($photosIds)) {
            $photosIds = array($photosIds);
        }
        $photosIds = array_map('intval', $photosIds);
        $query = self::getConnection()->createQueryBuilder();
        $query->update(self::getTable())
            ->where('id IN (' . implode(', ', $photosIds) . ')')
            ->andWhere('objeto_tipo=' . $query->createNamedParameter($type))
            ->set($field, $value);

        if ($ignoreCover) {
            $query->andWhere('capa=0');
        }

        return $query->execute();
    }

    public function modifyPhotoField($callback)
    {
        call_user_func($callback, $this->getField('photo'), $this);
    }

    public static function getTable()
    {
        return 'fotos';
    }

    public static function getPrimaryKey()
    {
        return 'id';
    }

    /*
    public static function registerType($type, $model, $modifyImageFieldCallback = null)
    {
        self::$types[$type] = array(
            'model' => $model,
            'modifyImageFieldCallback' => $modifyImageFieldCallback
        );
    }

    public static function isRegistered($type)
    {
        return isset(self::$types[$type]);
    }

    public function getRegisteredTypeInfo($type)
    {
        if (!self::isRegistered($type)) {
            return null;
        }
        return self::$types[$type];
    }*/

    public static function getPendingItems($type)
    {
        $db = static::getConnection();
        $query = $db->createQueryBuilder();
        $query->select('*')
            ->from(static::getTable())
            ->where('objeto_tipo=' . $query->createNamedParameter($type))
            ->andWhere('objeto_id IS NULL');

        return $query->execute()->fetchAll();
    }

    public static function getItems($type, $id, $onlyCoverPhoto = false, $coverFirst = true, $onlyVisible = false)
    {
        $db = static::getConnection();
        $query = $db->createQueryBuilder();

        $query->select('*')
            ->from(static::getTable())
            ->where('objeto_tipo=' . $query->createNamedParameter($type));

        if (is_array($id)) {
            $query->andWhere($query->expr()->in('objeto_id', $id));
        } else {
            $query->andWhere('objeto_id=' . $query->createNamedParameter($id));
        }
        if ($coverFirst) {
            $query->orderBy('capa', 'DESC');
        }
        $query->orderBy('ordem');

        if ($onlyCoverPhoto) {
            $query->andWhere('capa=1');
        }

        if ($onlyVisible) {
            $query->andWhere('visivel_site=1');
        }

        return $query->execute()->fetchAll();
    }

    public static function countItems($type, $typeId = null)
    {
        $db = static::getConnection();
        $query = $db->createQueryBuilder();
        $query->select('COUNT(*) as total')
            ->from(self::getTable())
            ->where('objeto_tipo=' . $query->createNamedParameter($type));

        if ($typeId === null) {
            $query->andWhere('objeto_id IS NULL');
        } else {
            $query->andWhere('objeto_id=' . $query->createNamedParameter($typeId));
        }

        $result = $query->execute()->fetch();

        return $result['total'];
    }

    public static function processPendingItems($type, $typeId)
    {
        $db = static::getConnection();
        $query = $db->createQueryBuilder();
        $query->update(self::getTable())->set('objeto_id', $typeId)
            ->where('objeto_tipo=' . $query->createNamedParameter($type))
            ->andWhere('objeto_id IS NULL');

        return $query->execute();
    }
}
