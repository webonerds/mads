<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */

/**
 * @file       _form.php$
 * @created    07/10/2013 12:13:40 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-create-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
	'focus'=>array($model,'username') ,
	'htmlOptions'=>array('autocomplete'=>'off', 'enctype' => 'multipart/form-data'),
)); ?>

<fieldset>

	<label>Basic Info</label>
	<?php echo $form->errorSummary($model); ?>
	<section>
		<?php echo $form->labelEx($model, 'username'); ?>
		<div><?php echo $form->textField($model, 'username', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'username'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'password'); ?>
		<div><?php echo $form->passwordField($model, 'password', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'password'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'firstname'); ?>
		<div><?php echo $form->textField($model, 'firstname', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'firstname'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'lastname'); ?>
		<div><?php echo $form->textField($model, 'lastname', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'lastname'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'private_email'); ?>
		<div><?php echo $form->textField($model, 'private_email', array('required' => 'required', 'type' => 'email')); ?></div>
		<?php echo $form->error($model, 'private_email'); ?>
	</section>

	<section>
		<?php echo $form->labelEx($model, 'paypal_email'); ?>
		<div><?php echo $form->textField($model, 'paypal_email', array('required' => 'required', 'type' => 'email')); ?></div>
		<?php echo $form->error($model, 'paypal_email'); ?>
	</section>
    <section>
		
            <?php echo $form->labelEx($model,'date_of_birth'); ?>
            <div><?php
                     $this->widget( 'zii.widgets.jui.CJuiDatePicker', array(
                  'model' => $model, // Your model
                  'attribute' => 'date_of_birth', // Attribute for input
                  'options' => array(
                          'dateFormat' => Yii::app()->params->dateformat,
                          'changeMonth' => 'true',
                          'value'=>Yii::app()->dateFormatter->format("Y-m-d",strtotime($model->date_of_birth)),
                          'changeYear' => 'true',
                          'showAnim' =>'slide',
                           'showOn' => 'both',
                          //'showOn'=>'button',
                          'buttonImage'=>Yii::app()->baseUrl."/images/canlender.jpg",
                         // 'buttonImageOnly'=>true,
                         'yearRange'=>'1970:2013',
                          'style'=>'padding-left: 9px; z-index:999;',
                        ),
                      
                        'htmlOptions' => array(
                          'autocomplete' => 'off',
                          'size' => 12,
                          'maxlength' => 10,
                          'class'=>'date input pop-up-calendar dp-applied span-4',
                        ),
                      
                ));
          ?></div>
            <?php echo $form->error($model,'date_of_birth'); ?>
        

	</section>

     <section>
		<?php echo $form->labelEx($model, 'phone'); ?>
		<div><?php echo $form->textField($model, 'phone', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'phone'); ?>
	</section>
    <section>
		<?php echo $form->labelEx($model, 'address'); ?>
		<div><?php echo $form->textArea($model, 'address', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'address'); ?>
	</section>
    <section>
		<?php echo $form->labelEx($model, 'sex'); ?>
		<div><?php echo $form->dropDownList($model,'sex',array('empty'=>'selected','male'=>'male','female'=>'female')); ?></div>
		<?php echo $form->error($model, 'sex'); ?>
	</section>



	<section>
		<?php echo $form->labelEx($model, 'profile_description'); ?>
		<div><?php echo $form->textArea($model, 'profile_description', array('required' => 'required')); ?></div>
		<?php echo $form->error($model, 'profile_description'); ?>
	</section>
	
	<section>
		<?php echo $form->labelEx($model, 'profile_picture_media_file_id'); ?>
		<div>
			<?php echo $form->fileField($model, 'profile_picture_media_file_id'); ?>
			<?php ViewFormHelper::imageActions($this, $model, 'profile_picture', array('ShowView' => true)); ?>
			<div class="clearfix"></div><span>(jpg, gif & png only, Max size: 500Kb)</span>
		</div>
		<?php echo $form->error($model, 'profile_picture_filename'); ?>
	</section>
	
	
	

</fieldset>

</fieldset>
 
    
		<?php echo $form->labelEx($model, 'address'); ?>
		
        <script type="text/javascript">
            var lat0 = "<?php // echo $lat0; ?>";
            var lng0 = "<?php //echo $lng0; ?>";
            var zoom = '<?php echo MapSettings::ZOOM_ADS; ?>';
            var map_zoom = '<?php echo MapSettings::MAP_ZOOM_ADS; ?>';
            var map_type = '<?php echo MapSettings::MAP_TYPE_ADS; ?>';
        </script>
        
        <div class="google-map">
            <?php
            echo $form->hiddenField($model,'lat',array('id'=>'lat'));
            echo $form->hiddenField($model,'logn',array('id'=>'lng'));
            ?>
            <div style="width: 600px; height: 400px; clear: both; margin-left: 10px;" id="map_canvas"></div>    
        </div>
        <script type="text/javascript">
        var map = null;
        var geocoder = null;
        // Global stuff
        var mymarker;

        function initializeGMap()
        {
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            if(lat!=0 && lng!=0)
            {
                lat0=lat;
                lng0=lng;
            }
            
            var map_type_id = google.maps.MapTypeId.ROADMAP;
            if (map_type==2) map_type_id = google.maps.MapTypeId.SATELLITE;
            else if (map_type==3) map_type_id = google.maps.MapTypeId.HYBRID;
            
            var myLatlng = new google.maps.LatLng(lat0, lng0);
            var myOptions = {
              zoom: parseInt(zoom),
              center: myLatlng,
              mapTypeId: map_type_id
            };
            
            map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
            
            if(lat!=0 && lng!=0)
            {
                var marker = new google.maps.Marker({
                    position: myLatlng
                });
                marker.setMap(map);
                mymarker = marker;
            }
            
            google.maps.event.addListener(map, 'click', function(event) {
                if (mymarker) mymarker.setMap(null);
                var marker = new google.maps.Marker({
                    position: event.latLng
                });
                marker.setMap(map);
                mymarker = marker;
                $('#lat').val(event.latLng.lat());
                $('#lng').val(event.latLng.lng());
            });
        }
      initializeGMap();
        </script>
    
</fieldset>

<fieldset>


	<section>
		<div><?php echo CHtml::htmlButton('Submit', array('class' => 'submit', 'type' => 'submit')); ?></div>
	</section>

</fieldset>

<?php $this->endWidget(); 