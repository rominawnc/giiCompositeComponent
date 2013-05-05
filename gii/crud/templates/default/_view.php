<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $data <?php echo $this->getModelClass(); ?> */
?>

<div class="view">


<?php
	$primaryKeyAttributeLabelsArray = array();
	$attributeLabelsCode = "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$this->tableSchema->primaryKey}')); ?>:</b>\n";
	$primaryKeyList = "'id'=>\$data->". $this->tableSchema->primaryKey;
	$primaryKeyDataArray=array();
	$primaryKeyData="\$data->{$this->tableSchema->primaryKey}";	
	if (is_array($this->tableSchema->primaryKey)){
		$primaryKeys=array();

		foreach ($this->tableSchema->primaryKey as $pkIndex=> $pkValue) {
			array_push($primaryKeyAttributeLabelsArray, "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('".$pkValue."')); ?>:</b>\n");
			array_push($primaryKeys,"'".$pkValue."'=>\$data->".$pkValue);
			array_push($primaryKeyDataArray, "\$data->".$pkValue);
		}
		$primaryKeyList=implode(",",$primaryKeys);
		$primaryKeyData= implode(",",$primaryKeyDataArray);
		$attributeLabelsCode = implode("\n", $primaryKeyAttributeLabelsArray);
	}
?>

<?php
	$primaryKeyCode = " #<?php echo \$data->{$this->tableSchema->primaryKey}; ?>";

	if (is_array($this->tableSchema->primaryKey)){
		$primaryKeyCode= " ".implode(" - ",array_keys($this->tableSchema->primaryKey));
	}
?>

<?php
echo $attributeLabelsCode;
echo "\t<?php echo CHtml::link(CHtml::encode(".str_replace(",", ".'-'.", $primaryKeyData)."), array('view', ".$primaryKeyList.")); ?>\n\t<br />\n\n";
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
	if(++$count==7)
		echo "\t<?php /*\n";
	echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?>:</b>\n";
	echo "\t<?php echo CHtml::encode(\$data->{$column->name}); ?>\n\t<br />\n\n";
}
if($count>=7)
	echo "\t*/ ?>\n";
?>

</div>