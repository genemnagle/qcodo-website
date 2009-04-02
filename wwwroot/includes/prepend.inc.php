<?php
	if (!defined('__PREPEND_INCLUDED__')) {
		// Ensure prepend.inc is only executed once
		define('__PREPEND_INCLUDED__', 1);


		///////////////////////////////////
		// Define Server-specific constants
		///////////////////////////////////	
		/*
		 * This assumes that the configuration include file is in the same directory
		 * as this prepend include file.  For security reasons, you can feel free
		 * to move the configuration file anywhere you want.  But be sure to provide
		 * a relative or absolute path to the file.
		 */
		require(dirname(__FILE__) . '/configuration.inc.php');


		//////////////////////////////
		// Include the Qcodo Framework
		//////////////////////////////
		require(__QCODO_CORE__ . '/qcodo.inc.php');


		///////////////////////////////
		// Define the Application Class
		///////////////////////////////
		/**
		 * The Application class is an abstract class that statically provides
		 * information and global utilities for the entire web application.
		 *
		 * Custom constants for this webapp, as well as global variables and global
		 * methods should be declared in this abstract class (declared statically).
		 *
		 * This Application class should extend from the ApplicationBase class in
		 * the framework.
		 */
		abstract class QApplication extends QApplicationBase {
			/**
			 * This is called by the PHP5 Autoloader.  This method overrides the
			 * one in ApplicationBase.
			 *
			 * @return void
			 */
			public static function Autoload($strClassName) {
				// First use the Qcodo Autoloader
				if (!parent::Autoload($strClassName)) {
					// TODO: Run any custom autoloading functionality (if any) here...
				}
			}

			////////////////////////////
			// QApplication Customizations (e.g. EncodingType, etc.)
			////////////////////////////
			// public static $EncodingType = 'ISO-8859-1';

			////////////////////////////
			// Additional Static Methods
			////////////////////////////
			public static $NavBarArray = array(
				array('About', '/', 80, array(
					array('Home', '/', 50),
					array('Overview', '/test.php/1/2', 70),
					array('Presentations', '/test.php/1/3', 80),
					array('Showcase', '/test.php/1/4', 60))),
				array('Learn', '/test.php/2', 80, array(
					array('Demos', '/test.php/2/1', 60),
					array('Examples Site', '/test.php/2/2', 90),
					array('API Cheet Sheet', '/test.php/2/3', 100),
					array('API Online Guide', '/test.php/2/4', 100))),
				array('Get', '/test.php/3', 80, array(
					array('Qcodo Release', '/test.php/3/1', 90),
					array('Community Contributions', '/test.php/3/2', 135))),
				array('Community', '/forums/', 125, array(
					array('Forums', '/forums/', 60),
					array('Wiki', '/test.php/4/2', 60),
					array('Other Projects', '/test.php/4/3', 98))),
				array('Development', '/test.php/5', 135, array(
					array('Bug Tracking', '/test.php/5/1', 90),
					array('Contribute', '/test.php/5/2', 80),
					array('Donate', '/test.php/5/3', 60)))
				);
			const NavAbout = 1;
			const NavLearn = 2;
			const NavGet = 3;
			const NavCommunity = 4;
			const NavDevelopment = 5;
			
			const NavAboutHome = 1;
			const NavAboutOverview = 2;
			const NavAboutPresentations = 3;
			const NavAboutShowcase = 4;
			
			const NavLearnDemos = 1;
			const NavLearnExamples = 2;
			const NavLearnApiSheet = 3;
			const NavLearnApiOnline = 4;
			
			const NavGetQcodo = 1;
			const NavGetCommunity = 2;
			
			const NavCommunityForums = 1;
			const NavCommunityWiki = 2;
			const NavCommunityOther = 3;
			
			const NavDevelopmentBugs = 1;
			const NavDevelopmentContribute = 2;
			const NavDevelopmentDonate = 3;

			// Login and Authorization/Authentication

			/**
			 * @var Person
			 */
			public static $Person;

			/**
			 * This shouuld be called on the top of any page that requires authentication.
			 * This checks to make sure a person is actually logged in on order to view the page.
			 * This will redirect to the login page if the user is NOT logged in.
			 * @param $intMinimumPersonTypeId
			 * @return void
			 */
			public static function Authenticate($intMinimumPersonTypeId = null) {
				return QApplication::$Person;
			}

			/**
			 * Called within prepend.inc.php to hidrate the $Person object into QApplication
			 * if the person_id is stored in session (e.g. if a Person is logged in)
			 * @return void
			 */
			public static function InitializePerson() {
				if (array_key_exists('intPersonId', $_SESSION))
					QApplication::$Person = Person::Load($_SESSION['intPersonId']);
			}

			/**
			 * Logs in a Person/User
			 * @param Person $objPerson
			 * @return void
			 */
			public static function LoginPerson(Person $objPerson) {
				$_SESSION['intPersonId'] = $objPerson->Id;
				QApplication::$Person = $objPerson;
			}

			/**
			 * Logs out the Person (if currently logged in)
			 * @return void
			 */
			public static function LogoutPerson() {
				$_SESSION['intPersonId'] = null;
				unset($_SESSION['intPersonId']);
			}
			
		}


		//////////////////////////
		// Custom Global Functions
		//////////////////////////	
		// TODO: Define any custom global functions (if any) here...


		////////////////
		// Include Files
		////////////////
		// TODO: Include any other include files (if any) here...


		///////////////////////
		// Setup Error Handling
		///////////////////////
		/*
		 * Set Error/Exception Handling to the default
		 * Qcodo HandleError and HandlException functions
		 * (Only in non CLI mode)
		 *
		 * Feel free to change, if needed, to your own
		 * custom error handling script(s).
		 */
		if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
			set_error_handler('QcodoHandleError');
			set_exception_handler('QcodoHandleException');
		}


		////////////////////////////////////////////////
		// Initialize the Application and DB Connections
		////////////////////////////////////////////////
		QApplication::Initialize();
		QApplication::InitializeDatabaseConnections();


		/////////////////////////////
		// Start Session Handler (if required)
		/////////////////////////////
		session_start();
		QApplication::InitializePerson();


		//////////////////////////////////////////////
		// Setup Internationalization and Localization (if applicable)
		// Note, this is where you would implement code to do Language Setting discovery, as well, for example:
		// * Checking against $_GET['language_code']
		// * checking against session (example provided below)
		// * Checking the URL
		// * etc.
		// TODO: options to do this are left to the developer
		//////////////////////////////////////////////
		if (isset($_SESSION)) {
			if (array_key_exists('country_code', $_SESSION))
				QApplication::$CountryCode = $_SESSION['country_code'];
			if (array_key_exists('language_code', $_SESSION))
				QApplication::$LanguageCode = $_SESSION['language_code'];
		}

		// Initialize I18n if QApplication::$LanguageCode is set
		if (QApplication::$LanguageCode)
			QI18n::Initialize();
		else {
			// QApplication::$CountryCode = 'us';
			// QApplication::$LanguageCode = 'en';
			// QI18n::Initialize();
		}
	}
?>