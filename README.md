ManyToManyRelation
==================

Installation and configuration
Copy behavior to extensions/ManyToManyRelationBehavior directory located inside your application
```php
<?php
$model->attachBehavior('ManyToManyRelationBehavior', array(
	'class' => 'ext.ManyToManyRelationBehavior',
	'modelNameRelation' => 'ProductMaterial', // Model for relation
	'fieldNameModelCurrent' =>  'productId', // field Name current Model
	'fieldNameModelRelation' => 'materialId',// filed Name reltion Model 
	'relationList' => $materialList,	//array id record from Relation Model	
));
```
