<div class="container">

	<div class="row" style="margin-top:20px">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<?php
				$form = $this->beginWidget('CActiveForm', array(
					'id' => 'login-form',
				    'action' => Yii::app()->request->baseUrl . '/login/userLogin',
				    'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
				    	)
				    ));
			?>
				<fieldset>
					<sub style="float: right;">v.0.001d</sub>
					<h2>Please Sign In</h2>
					<hr class="colorgraph">

					<?php if(Yii::app()->user->hasFlash('error')):?>
						<div class="form-group">
							<div class="alert alert-danger" role="alert">
								<strong>Error!</strong> <?php echo Yii::app()->user->getFlash('error'); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="form-group">
						<?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username', 'required' => true)); ?>
					</div>
					<div class="form-group">
						<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password', 'required' => true)); ?>
					</div>
					<div class="form-group text-right">
					</div>
					<hr class="colorgraph">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="" class="btn btn-lg btn-info btn-block">Forgot Password?</a>
						</div>
					</div>
				</fieldset>
			<?php
			    $this->endWidget();
			?>
		</div>
	</div>

</div>

				
