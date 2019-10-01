<?php
namespace Fotos;

use Mix\Controller\Controller;
use Mix\Model\Field\Gallery;

class EmbedController extends Controller
{
    
    public function embedAction()
    {   
        $id             = $this->getRequest()->get('id');
        $type           = $this->getRequest()->get('type');
        $hasDescription = Gallery::hasDescription($type);
        $hasTitle       = Gallery::hasTitle($type);



        $photo = new Model\EmbedPhoto($type);
        $form  = new \Mix\Model\Form($photo, \URL::site($this->getRequest()->getPathInfo()));
        
        if ($form->isSubmitted($this->getRequest())) {
            
            $photo->objeto_tipo = $type;
            if (!empty($id)) {
                $photo->objeto_id = $id;
            }
            
            $countPhotos = Model\EmbedPhoto::countItems($type, $id);
            $name        = isset($_FILES['foto']) ? $_FILES['foto']['name'] : 'Foto';
            
            if ($photo->save()) {
                if ($countPhotos == 0) {
                    $photo->makeItCover($type, $id);
                }
                if (!$this->getRequest()->isXmlHttpRequest()) {
                    return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                        'success' => true
                    ));
                } else {
                    $this->addSuccessFlash(sprintf('<strong>%s:</strong> %s', $name, 'Foto adicionada com sucesso.'));
                }
                
                $data = array(
                    'type' => $type
                );
                if (!empty($id)) {
                    $data['id'] = $id;
                }
                
                return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                    'success' => true
                ));
            } else {
                $error = $photo->getField('foto')->getError();
                $this->addErrorFlash(sprintf('<strong>%s:</strong> %s', $name, $error));
                return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                    'success' => false,
                    'error'   => $error
                ));
            }
        }
        $data = array('photos' => array());
        
        if (!empty($id)) {
            $data['photos']  = Model\EmbedPhoto::getItems($type, $id, false, false);
        } else {
            $data['pending'] = Model\EmbedPhoto::getPendingItems($type);
        }
        $data['model']   = $photo;
        $data['form']    = $form;
        $data['type']    = $type;
        $data['type_id'] = $id;
        $data['hasTitle']       = $hasTitle;
        $data['hasDescription'] = $hasDescription;
        $data['urlGenerator']   = Gallery::getUrlGenerator($type);
        $data['info']           = $photo->getField('foto')->getInfo();

        $photo->getField('foto')->setInfo(null);
        
        return $this->renderView('fotos/embed', $data);
    }
    
    public function updatePositionsAction()
    {
        $photos = $this->getRequest()->request->get('photos');
        if (empty($photos)) {
            return '';
        }
        
        foreach ($photos as $p) {
            \Mix\Model\Field\Gallery::updatePhotoPosition($p['id'], $p['pos']);
        }
        return 'OK';
    }
    
    public function updateInfoAction() 
    {
        $validFields = array(
            'visivel_site', 'capa', 'titulo', 'descricao'
        );
        
        $id   = $this->getRequest()->get('id');
        $type = $this->getRequest()->get('type');
        
        $field   = $this->getRequest()->request->get('field');
        $photoId = $this->getRequest()->request->get('photoId');
        $value   = $this->getRequest()->request->get('value');
        
        if (!in_array($field, $validFields)) {
            return 'erro';
        }
        
        $photo = Model\EmbedPhoto::findById($photoId, null, function() use($type) {
            return new Model\EmbedPhoto($type);
        });
        
        if (empty($photo)) {
            return 'erro';
        }
        
        $photo->{$field} = $value;
        
        if ($field == 'capa') {
            return $photo->makeItCover($type, $photo->objeto_id) ? 'ok' : 'erro';            
        } else {
            if ($photo->save()) {
                return 'ok';
            } else {
                return 'Erro: ' . $photo->getError($field);
            }
        }
    }
    
    public function bulkAction()
    {
        $validActions = array('delete', 'make_visible', 'make_invisible');
        $action       = $this->getRequest()->request->get('bulk_action');
        $photos       = $this->getRequest()->request->get('photos');
        $type         = $this->getRequest()->get('type');
        $typeId       = $this->getRequest()->get('type_id');
        $data         = array(
            'type'    => $type,
            'id'      => $typeId
        );
        
        $redirectUrl = \URL::site(\Route::get('embed_photos')->uri($data));
        
        if (empty($photos) || !in_array($action, $validActions)) {
            return $this->redirect($redirectUrl);
        }
        $message = null;
        switch ($action) {
            case 'delete':
                $result = Model\EmbedPhoto::bulkDelete($type, $photos);
                $message = 'Foto(s) excluída(s) com sucesso.';
                break;
            case 'make_visible':
                $result  = Model\EmbedPhoto::bulkUpdate($type, $photos, 'visivel_site', 1);
                $message = 'Foto(s) atualizada(s) com sucesso.';
                break;
            case 'make_invisible':
                $result  = Model\EmbedPhoto::bulkUpdate($type, $photos, 'visivel_site', 0, true);
                $message = 'Foto(s) atualizada(s) com sucesso.';
                break;
        }
        if ($result) {
            $this->addSuccessFlash($message);
        }
        
        return $this->redirect($redirectUrl);
    }
    
    
    public function coverAction()
    {
        $id     = $this->getRequest()->get('id');
        $type   = $this->getRequest()->get('type');
        $typeId = $this->getRequest()->get('type_id');
        
        $photo = Model\EmbedPhoto::findById($id, null, function ($data) use ($type) {
            $model = new Model\EmbedPhoto($type);
            return $model;
        });
        if (empty($photo) || $photo->objeto_tipo != $type || ($photo->objeto_id != $typeId && !is_null($photo->objeto_id))) {
            $this->addErrorFlash('Foto não encontrada.');            
        } else {
            if ($photo->makeItCover($type, $typeId)) {
                $this->addSuccessFlash('Foto de capa atualizada com sucesso.');
            } else {
                $this->addErrorFlash('Ocorreu um erro ao atualizar a foto da capa. Tente novamente.');
            }                
        }
        $data = array(
            'type' => $type
        );
        if (!empty($typeId)) {
            $data['id'] = $typeId;
        }
        return $this->redirect(\URL::site(\Route::get('embed_photos')->uri($data)));
    }
    
    public function deleteAction()
    {
        $id     = $this->getRequest()->get('id');
        $type   = $this->getRequest()->get('type');
        $typeId = $this->getRequest()->get('type_id');
        
        $photo = Model\EmbedPhoto::findById($id, null, function ($data) use ($type) {
            $model = new Model\EmbedPhoto($type);
            return $model;
        });
        if (empty($photo) || $photo->objeto_tipo != $type || ($photo->objeto_id != $typeId && !is_null($photo->objeto_id))) {
            $this->addErrorFlash('Foto não encontrada.');            
        } else {
            if ($photo->delete()) {
                $this->addSuccessFlash('Foto excluída com sucesso.');
            } else {
                $this->addErrorFlash('Ocorreu um erro ao tentar excluir a foto. Tente novamente.');
            }                
        }
        $data = array(
            'type' => $type
        );
        if (!empty($typeId)) {
            $data['id'] = $typeId;
        }
        return $this->redirect(\URL::site(\Route::get('embed_photos')->uri($data)));
    }
}