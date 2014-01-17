<?php echo CHtml::beginForm("/user/loginform")?>

<?php echo Chtml::errorSummary($model)?>

<div class="row">
  <?php echo CHtml::activeLabel($model, "name")?>
  <?php echo CHtml::activeTextField($model, "name")?>
</div>

<div class="row">
  <?php echo CHtmL::activeLabel($model, "pass")?>
  <?php echo CHtmL::activePasswordField($model, "pass")?>
</div>

<div class="row">
  <?php echo CHtml::submitButton("Login")?>
</div>

<?php echo CHtml::endForm();?>

