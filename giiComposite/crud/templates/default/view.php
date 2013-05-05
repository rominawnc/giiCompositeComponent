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
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>
<?php
	$primaryKeyCode = " #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>";
	if (is_array($this->tableSchema->primaryKey)){
		$primaryKeyCode= " ".implode(" - ",array_keys($this->tableSchema->primaryKey));
	}
?>


$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'Update <?php echo $this->modelClass; ?>', 'url'=>array('update', <?php echo $primaryKeyList;?>)),
	array('label'=>'Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', <?php echo $primaryKeyList;?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>
<h1>View <?php echo $this->modelClass. $primaryKeyCode?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>
