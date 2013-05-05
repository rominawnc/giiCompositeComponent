<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>

<?php
	$primaryKeyList = "'id'=>\$model->". $this->tableSchema->primaryKey;
	if (is_array($this->tableSchema->primaryKey)){
		$primaryKeys=array();
		foreach ($this->tableSchema->primaryKey as $pkName=> $pkValue) {
			
			array_push($primaryKeys,"'".$pkValue."'=>\$model->".$pkValue);
		 
	
		}
		$primaryKeyList=implode(",",$primaryKeys);
	}
?>

<?php
	$primaryKeyCode = " #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>";
	if (is_array($this->tableSchema->primaryKey)){
		$primaryKeyCode= " ".implode(" - ",array_keys($this->tableSchema->primaryKey));
	}
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view',$primaryKeyList),
	'Update',
);\n ?>";
?>

<?php echo "<?php\n"; ?>
$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'View <?php echo $this->modelClass; ?>', 'url'=>array('view',<?php echo $primaryKeyList; ?>)),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1>Update <?php echo $this->modelClass. $primaryKeyCode; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>