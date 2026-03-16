<style>
	.container {
		width: 100%;
		height: 100vh;
		background: #ECEFF7;
		overflow: hidden;
	}

	fieldset {
		margin: 0;
		width: 500px;
		background: #FFFF;
		box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
	}

	h2 {
		font-size: 26px;
		font-weight: 600;
		color: #3B4E62;
		text-transform: uppercase;

	}

	.form-group {
		margin-bottom: 35px;
	}

	#login-form .form-control {
		padding: 25px;
	}

	.colorgraph {
		margin: 30px 0;
	}

	.btn {
		font-weight: 500;
		font-size: 14px;
		letter-spacing: 2px;
		text-transform: uppercase;
	}

	.left-img-side img {
		width: 100%;
		height: 100vh;
		object-fit: cover;
		object-position: left;
	}

	.left-img-side.left-img-side {
		padding: 0;
		position: relative;
	}

	.login-main-content {
		height: 100vh;
		display: flex;
		position: relative;
		align-items: center;
		justify-content: center;
	}

	form#login-form {
		position: relative;
		z-index: 100;
	}

	/* .left-img-side.left-img-side::after {
		content: '';
		position: absolute;
		right: 0;
		top: 0%;
		width: 100%;
		height: 100%;
		background: radial-gradient(#1b2127a6, transparent)
	} */

	/* .login-main-content::after {
		content: '';
		position: absolute;
		left: 0;
		bottom: -20%;
		width: 300px;
		height: 300px;
		background: #2F50A3;
		clip-path: polygon(0 0, 100% 0, 71% 100%, 0% 100%);
	} */

	.box {
		content: '';
		position: absolute;
		top: -15%;
		right: -10%;
		width: 300px;
		border: 20px solid #FFF;
		height: 300px;
		border-radius: 50%;
		/* background: linear-gradient(45deg, #2F50A3, #2f50a373); */
		background: #2F50A3;
		/* clip-path: polygon(28% 0, 100% 0%, 100% 100%, 0% 100%); */
	}

	.logo-img {
		margin: 0;
		position: absolute;
		top: 10%;
		z-index: 1;
		/* background: #2F50A3; */
		padding: 10px;

	}

	.logo-img img {
		width: 100%;
	}

	.flex {
		display: flex;
	}

	.btn-info {
		background: #2F50A3;
		border-radius: 0;
		border: none;
	}

	.btn-success {
		border-radius: 0;
		border: none;
	}

	sub {
		font-size: 13px;
		background: #ECEFF7;
		padding: 14px;
		position: absolute;
		top: 10px;
		right: 10px;
		border-radius: 24px;
		height: 30px;
		display: flex;
		align-items: center;
	}

	@media screen and (max-width:720px) {
		.left-img-side.left-img-side {
			display: none;
		}

		fieldset {
			margin: 0;
			width: 100%;
		}

		.box {
			top: -9%;
			right: -18%;
			width: 200px;
			height: 200px;

		}

		.login-main-content .btn {
			font-weight: 500;
			font-size: 12px;
			letter-spacing: 2px;
			text-transform: uppercase;
		}

		.login-main-content h2 {
			font-size: 20px;
			font-weight: 600;
			color: #3B4E62;
			text-transform: uppercase;
		}

		.login-main-content sub {
			font-size: 12px;
			padding: 0 25px;
			font-weight: 600;
			height: 29px;
		}
	}
</style>
<div class="container p-0">

	<div class="row m-0">
		<div class="col-md-6 col-xs-12 col-sm-12  left-img-side p-0">
			<figure>
				<img src="https://jogsportswear.com/wp-content/uploads/2023/06/bg-banner-your-look-done-right-r2-scaled.jpg" alt="">
			</figure>
		</div>
		<div class="col-md-6 col-xs-12 col-sm-12  login-main-content">
			<figure class="logo-img"><img src="https://jogsports.com/assets/images/sponsors/jogs.png" alt=""></figure>
			<div class="box"></div>
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'login-form',
				'action' => Yii::app()->request->baseUrl . '/login/userLogin',
				'enableClientValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
				)
			));
			?>
			<fieldset>
				<sub style="float: right;">v.0.001d</sub>
				<h2>Please Sign In</h2>
				<hr class="colorgraph">

				<?php if (Yii::app()->user->hasFlash('error')) : ?>
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
				<div class="row flex">
					<div class="col-xs-4 col-sm-12 col-md-6">
						<input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
					</div>
					<div class="col-xs-8 col-sm-12 col-md-6">
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