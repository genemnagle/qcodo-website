<?php
	require(__DATAGEN_CLASSES__ . '/PackageCategoryGen.class.php');

	/**
	 * The PackageCategory class defined here contains any
	 * customized code for the PackageCategory class in the
	 * Object Relational Model.  It represents the "package_category" table 
	 * in the database, and extends from the code generated abstract PackageCategoryGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package Qcodo Website
	 * @subpackage DataObjects
	 * 
	 */
	class PackageCategory extends PackageCategoryGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objPackageCategory->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->strName;
		}

		public function RefreshStats() {
			$this->intPackageCount = $this->CountPackages();
			$objPackage = Package::QuerySingle(QQ::Equal(QQN::Package()->PackageCategoryId, $this->intId), QQ::Clause(
				QQ::LimitInfo(1),
				QQ::OrderBy(QQN::Package()->LastPostDate, false)
			));
			if ($objPackage && $objPackage->LastPostDate)
				$this->dttLastPostDate = new QDateTime($objPackage->LastPostDate);
			else
				$this->dttLastPostDate = null;
			$this->Save();
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of PackageCategory objects
			return PackageCategory::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::PackageCategory()->Param1, $strParam1),
					QQ::GreaterThan(QQN::PackageCategory()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single PackageCategory object
			return PackageCategory::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::PackageCategory()->Param1, $strParam1),
					QQ::GreaterThan(QQN::PackageCategory()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of PackageCategory objects
			return PackageCategory::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::PackageCategory()->Param1, $strParam1),
					QQ::Equal(QQN::PackageCategory()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = PackageCategory::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`package_category`.*
				FROM
					`package_category` AS `package_category`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return PackageCategory::InstantiateDbResult($objDbResult);
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