<?php
class ManyToManyRelationBehavior extends CBehavior{
	/***
	 * @var string name model Relation 
	 */
	public $modelNameRelation;
	/**
	* @var string field name for the relationship with the current models
	*/
	public $fieldNameModelCurrent = null;
	/**
	* @var string field name for the relationship with the external models
	*/
	public $fieldNameModelRelation = null;
	/**
	* @var array list of values ​​of the current model
	*/
	public $relationList = array();

	public function events() {
		return array_merge(parent::events(), array(
				'onAfterSave' => 'afterSave',
		));
	}

	public function afterSave($event){
		if (is_array($this->relationList)){
			$model = $this->modelNameRelation;
			$delete = $model::model()->deleteAll("{$this->fieldNameModelCurrent} =:param", array(
					":param" => $this->owner->id,
			));
			foreach ($this->relationList as $value){
				$model = new $this->modelNameRelation;
				$model->{$this->fieldNameModelRelation} = intval($value);
				$model->{$this->fieldNameModelCurrent} = $this->owner->id;
				if (!$model->save()){
					Yii::log('Unable to save relation: '.serialize($model->getErrors()), 'warning');
					$this->owner->addError($this->fieldNameModelCurrent, Yii::t('Admin', 'Unable to save Relation'));
					return false;
				}
			}
			return true;
		}
		
	}
}