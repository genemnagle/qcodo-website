<?php
	require(__DATAGEN_CLASSES__ . '/WikiPageGen.class.php');

	/**
	 * The WikiPage class defined here contains any
	 * customized code for the WikiPage class in the
	 * Object Relational Model.  It represents the "wiki_page" table 
	 * in the database, and extends from the code generated abstract WikiPageGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package Qcodo Website
	 * @subpackage DataObjects
	 * 
	 */
	class WikiPage extends WikiPageGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objWikiPage->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('WikiPage Object %s',  $this->intWikiVersionId);
		}

		/**
		 * Updates this object's CompiledHtml field with the content stored in the Content field,
		 * using QTextStyle.
		 * 
		 * This method does NOT call save on the object, it only updates the field.
		 * @return void
		 */
		public function CompileHtml() {
			$this->strCompiledHtml = QTextStyle::DisplayAsHtml($this->strContent);
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of WikiPage objects
			return WikiPage::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::WikiPage()->Param1, $strParam1),
					QQ::GreaterThan(QQN::WikiPage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single WikiPage object
			return WikiPage::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::WikiPage()->Param1, $strParam1),
					QQ::GreaterThan(QQN::WikiPage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of WikiPage objects
			return WikiPage::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::WikiPage()->Param1, $strParam1),
					QQ::Equal(QQN::WikiPage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = WikiPage::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`wiki_page`.*
				FROM
					`wiki_page` AS `wiki_page`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return WikiPage::InstantiateDbResult($objDbResult);
		}
*/




		// Override or Create New Properties and Variables
		// For performance reasons, these variables and __set and __get override methods
		// are commented out.  But if you wish to implement or override any
		// of the data generated properties, please feel free to uncomment them.
/*
		protected $strSomeNewProperty;

		public function __get($strName) {
			switch ($strName) {
				case 'SomeNewProperty': return $this->strSomeNewProperty;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'SomeNewProperty':
					try {
						return ($this->strSomeNewProperty = QType::Cast($mixValue, QType::String));
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						return (parent::__set($strName, $mixValue));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
*/
	}
?>