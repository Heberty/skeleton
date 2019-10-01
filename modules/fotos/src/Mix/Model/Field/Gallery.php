<?php
namespace Mix\Model\Field;

use Mix\Model\Field\Field;
use Mix\Html\HtmlBuilder;


class Gallery extends Field 
{
        
    protected static $types = array();
    
    function __construct($name, $label, $tipo)
    {
        if (!self::hasType($tipo)) {
            throw new \LogicException('Trying to instantiate a non registered type: ' . $tipo);
        }
        parent::__construct($name, $label);
        $this->setPersistent(false);
        $this->setOption('tipo', $tipo);
    }
    
    public static function registerType($type, $imageFieldOrCreator = null, $hasDescription = true, $hasTitle = true)
    {
        self::$types[$type]                    = array();
        self::$types[$type]['creator']         = $imageFieldOrCreator;
        self::$types[$type]['has_description'] = $hasDescription;
        self::$types[$type]['has_title']       = $hasTitle;
    }

    public static function getUrlGenerator($type)
    {
        if (!self::hasType($type)) {
            return null;
        }
        if (empty(self::$types[$type]['urlGenerator'])) {
            return function ($path, $isThumb) use ($type) {
                $prefix = $isThumb ? 'thumb_' : '';
                return \URL::site('/assets/images/' . $type . '/' . $prefix . $path);
            };
        }
        return self::$types[$type]['urlGenerator'];
    }
    
    public static function unregisterType($type)
    {
        unset(self::$types[$type]);
    }
    
    public static function hasType($type)
    {
        return isset(self::$types[$type]);
    }
    
    public static function hasTitle($type)
    {
        return self::hasType($type) && self::$types[$type]['has_title'];
    }
    
    public static function hasDescription($type)
    {
        return self::hasType($type) && self::$types[$type]['has_description'];
    }
    
    public static function instantiateImageFieldOfType($type)
    {
        if (!self::hasType($type)) {
            return null;
        }
        
        return call_user_func(self::$types[$type]['creator'], $type);
    }
    
    
    public function toHtml(Field $field)
    {
        $data = array(
            'type' => $this->getOption('tipo')
        );
        $id  = $this->getModel()->id();
        
        if (!empty($id)) {
            $data['id'] = $id;
        }
        
        $url = \URL::site(\Route::get('embed_photos')->uri($data));
        
        $tag = new \Mix\Html\Tag('iframe');
        $tag->addClass('input-gallery auto-height');
        $tag->setAttr('width', '100%');
        $tag->setAttr('src', $url);
        return $tag;
    }
    
    public static function updatePhotoPosition($photoId, $position)
    {
        $db = \Application::getDefault()->getDefaultDatabase();
        return $db->update('fotos', array('ordem' => $position), array('id' => $photoId));
    }
    
    public function afterSave($success, $operation)
    {
        parent::afterSave($success, $operation);
        if ($success && $operation == \Mix\Model\Model::OP_INSERT) {
            \Fotos\Model\EmbedPhoto::processPendingItems(
                $this->getOption('tipo'), 
                $this->getModel()->id()
            );
        }
    }
    
}

