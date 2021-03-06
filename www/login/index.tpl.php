<?php require(__INCLUDES__ . '/header.inc.php'); ?>

	<div class="form">
		<h1>Log In</h1>
		<div class="mainForm">
			<p class="instructions">In order to post messages in the Forums, contribute to the Wiki, or upload new files and patches to the Downloads,
			you must be a registered user of the <strong>Qcodo.com</strong> website.</p>

			<br/>
			<?php $this->txtUsername->RenderForForm(); ?>
			<?php $this->txtPassword->RenderForForm(); ?>
			
			<div class="renderWithName"><div class="left">&nbsp;</div><div class="right">
				<?php $this->chkRemember->Render(); ?>
				<span class="instructions forCheckbox">Keep me logged in to <strong>Qcodo.com</strong> on this computer</span>
			</div></div>

			<br/><br/>
			<?php $this->btnLogin->RenderForForm(); ?>
			<br/><br/>
		</div>
		<div class="sidebar">
			<p class="hint">Not yet a member?</p>
			<?php $this->lnkRegister->Render(); ?>
			<br/><br/>
			<p class="hint">Trouble logging in?</p>
			<?php $this->lnkForgot->Render(); ?>
		</div>
	</div>
	

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>