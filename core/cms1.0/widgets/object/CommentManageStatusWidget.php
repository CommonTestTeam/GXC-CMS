<?php

/**
 * This is the Widget for manage a Comment
 * 
 * @author Nguyen Tuan Quyen <nguyen.tuan.quyen.it@gmail.com>
 * @version 1.0
 * @package  cmswidgets.object
 *
 */
class CommentManageStatusWidget extends CWidget
{
    
    public $visible=true;
    public $type=0;
    public $object_id=0;
    
 
    public function init()
    {
        
    }

    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    { 
        $this->doAdminSearch($this->type);
    }  
    
    public function doAdminSearch($type=0){
		
		$result=null;
		$model = null;
    	switch ($type){                    
        	case ConstantDefine::COMMENT_STATUS_DISCARDED :
            	$model=new Comment('discarded');			                                                 
                break;
                        
            case ConstantDefine::OBJECT_STATUS_PENDING :
                $model=new Comment('pending');                       
                break;
                    
            case ConstantDefine::OBJECT_STATUS_PUBLISHED :
                $model=new Comment('published');                      
                break;
                    
            default :
                $model=new Comment('search');                      
                break;
                    
        }
        if ($object_id != 0)
        {
        	$dataProvider=new CActiveDataProvider('Comment', array(
			'criteria'=>array(
        		'object_id'=>$this->object_id,
				'order'=>'t.status, t.create_time DESC',
        		),
			));	
        }
        else 
        {
        	$dataProvider=new CActiveDataProvider('Comment', array(
			'criteria'=>array(
				'order'=>'t.status, t.create_time DESC',
        		),
			));
        }
        
		$this->render('cmswidgets.views.comment.comment_manage_widget',array(
			'model'=>$model,
			'result'=>$dataProvider,
		));
    }
}
