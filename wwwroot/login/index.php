<?php
	require('../includes/prepend.inc.php');

	class QcodoForm extends QcodoWebsiteForm {
		protected $strPageTitle = 'Log In';
		protected $intNavBarIndex = 0;
		protected $intSubNavIndex = 0;

		protected $txtUsername;
		protected $txtPassword;
		protected $btnLogin;
		protected $chkRemember;

		protected function Form_Create() {
			parent::Form_Create();

			// Define Controls
			$this->txtUsername = new QTextBox($this);
			$this->txtUsername->Name = 'Username';
			$this->txtUsername->MaxLength = Person::UsernameMaxLength;
			$this->txtUsername->Required = true;
			
			$this->txtPassword = new QTextBox($this);
			$this->txtPassword->Name = 'Password';
			$this->txtPassword->MaxLength = Person::PasswordMaxLength;
			$this->txtPassword->TextMode = QTextMode::Password;
			$this->txtPassword->Required = true;
			$this->txtPassword->CausesValidation = true;

			$this->btnLogin = new QButton($this);
			$this->btnLogin->Text = 'Log In';
			$this->btnLogin->Name = '&nbsp;';
			$this->btnLogin->CausesValidation = true;

			$this->chkRemember = new QCheckBox($this);
			$this->chkRemember->HtmlEntities = false;

			// Add Actions
			$this->txtUsername->AddAction(new QEnterKeyEvent(), new QFocusControlAction($this->txtPassword));
			$this->txtUsername->AddAction(new QEnterKeyEvent(), new QTerminateAction());
			$this->txtPassword->AddAction(new QEnterKeyEvent(), new QAjaxAction('btnLogin_Click'));
			$this->txtPassword->AddAction(new QEnterKeyEvent(), new QTerminateAction());
			$this->btnLogin->AddAction(new QClickEvent(), new QAjaxAction('btnLogin_Click'));

			// Initial Focus
			$this->txtUsername->Focus();
		}

		protected function btnLogin_Click($strFormId, $strControlId, $strParameter) {
			$objPerson = Person::LoadByUsername(trim(strtolower($this->txtUsername->Text)));
			if ($objPerson && $objPerson->IsPasswordValid($this->txtPassword->Text)) {
				QApplication::LoginPerson($objPerson);
				QApplication::Redirect('/');
			}

			// If we're here, either the username and/or password is not valid
			$this->txtUsername->Warning = 'Invalid username or password';
			$this->txtPassword->Text = null;
			$this->Form_Validate();
		}
	}

	QcodoForm::Run('QcodoForm');
?>