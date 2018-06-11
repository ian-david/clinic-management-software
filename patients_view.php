<?php


	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/patients.php");
	include("$currDir/patients_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('patients');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "patients";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`patients`.`id`" => "id",
		"`patients`.`last_name`" => "last_name",
		"`patients`.`first_name`" => "first_name",
		"`patients`.`gender`" => "gender",
		"`patients`.`sexual_orientation`" => "sexual_orientation",
		"if(`patients`.`birth_date`,date_format(`patients`.`birth_date`,'%m/%d/%Y'),'')" => "birth_date",
		"`patients`.`age`" => "age",
		"`patients`.`image`" => "image",
		"`patients`.`address`" => "address",
		"`patients`.`city`" => "city",
		"`patients`.`state`" => "state",
		"`patients`.`zip`" => "zip",
		"CONCAT_WS('-', LEFT(`patients`.`home_phone`,3), MID(`patients`.`home_phone`,4,3), RIGHT(`patients`.`home_phone`,4))" => "home_phone",
		"CONCAT_WS('-', LEFT(`patients`.`work_phone`,3), MID(`patients`.`work_phone`,4,3), RIGHT(`patients`.`work_phone`,4))" => "work_phone",
		"CONCAT_WS('-', LEFT(`patients`.`mobile`,3), MID(`patients`.`mobile`,4,3))" => "mobile",
		"`patients`.`tobacco_usage`" => "tobacco_usage",
		"`patients`.`alcohol_intake`" => "alcohol_intake",
		"`patients`.`history`" => "history",
		"`patients`.`surgical_history`" => "surgical_history",
		"`patients`.`obstetric_history`" => "obstetric_history",
		"`patients`.`genetic_diseases`" => "genetic_diseases",
		"`patients`.`contact_person`" => "contact_person",
		"`patients`.`other_details`" => "other_details",
		"`patients`.`comments`" => "comments",
		"DATE_FORMAT(`patients`.`filed`, '%c/%e/%Y %l:%i%p')" => "filed",
		"DATE_FORMAT(`patients`.`last_modified`, '%c/%e/%Y %l:%i%p')" => "last_modified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`patients`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => '`patients`.`birth_date`',
		7 => '`patients`.`age`',
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => 17,
		18 => 18,
		19 => 19,
		20 => 20,
		21 => 21,
		22 => 22,
		23 => 23,
		24 => 24,
		25 => '`patients`.`filed`',
		26 => '`patients`.`last_modified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`patients`.`id`" => "id",
		"`patients`.`last_name`" => "last_name",
		"`patients`.`first_name`" => "first_name",
		"`patients`.`gender`" => "gender",
		"`patients`.`sexual_orientation`" => "sexual_orientation",
		"if(`patients`.`birth_date`,date_format(`patients`.`birth_date`,'%m/%d/%Y'),'')" => "birth_date",
		"`patients`.`age`" => "age",
		"`patients`.`image`" => "image",
		"`patients`.`address`" => "address",
		"`patients`.`city`" => "city",
		"`patients`.`state`" => "state",
		"`patients`.`zip`" => "zip",
		"CONCAT_WS('-', LEFT(`patients`.`home_phone`,3), MID(`patients`.`home_phone`,4,3), RIGHT(`patients`.`home_phone`,4))" => "home_phone",
		"CONCAT_WS('-', LEFT(`patients`.`work_phone`,3), MID(`patients`.`work_phone`,4,3), RIGHT(`patients`.`work_phone`,4))" => "work_phone",
		"CONCAT_WS('-', LEFT(`patients`.`mobile`,3), MID(`patients`.`mobile`,4,3))" => "mobile",
		"`patients`.`tobacco_usage`" => "tobacco_usage",
		"`patients`.`alcohol_intake`" => "alcohol_intake",
		"`patients`.`history`" => "history",
		"`patients`.`surgical_history`" => "surgical_history",
		"`patients`.`obstetric_history`" => "obstetric_history",
		"`patients`.`genetic_diseases`" => "genetic_diseases",
		"`patients`.`contact_person`" => "contact_person",
		"`patients`.`other_details`" => "other_details",
		"`patients`.`comments`" => "comments",
		"DATE_FORMAT(`patients`.`filed`, '%c/%e/%Y %l:%i%p')" => "filed",
		"DATE_FORMAT(`patients`.`last_modified`, '%c/%e/%Y %l:%i%p')" => "last_modified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`patients`.`id`" => "ID",
		"`patients`.`last_name`" => "Last name",
		"`patients`.`first_name`" => "First name",
		"`patients`.`gender`" => "Gender",
		"`patients`.`sexual_orientation`" => "Sexual orientation",
		"`patients`.`birth_date`" => "Birth date",
		"`patients`.`age`" => "Age",
		"`patients`.`address`" => "Address",
		"`patients`.`city`" => "City",
		"`patients`.`state`" => "State",
		"`patients`.`zip`" => "Zip",
		"`patients`.`home_phone`" => "Home phone",
		"`patients`.`work_phone`" => "Work phone",
		"`patients`.`mobile`" => "Mobile",
		"`patients`.`tobacco_usage`" => "Tobacco usage",
		"`patients`.`alcohol_intake`" => "Alcohol Intake",
		"`patients`.`history`" => "History",
		"`patients`.`surgical_history`" => "Surgical history",
		"`patients`.`obstetric_history`" => "Obstetric history",
		"`patients`.`genetic_diseases`" => "Genetic diseases",
		"`patients`.`contact_person`" => "Contact person in case of Emergency",
		"`patients`.`other_details`" => "Other details",
		"`patients`.`comments`" => "Comments",
		"`patients`.`filed`" => "Filed",
		"`patients`.`last_modified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`patients`.`id`" => "id",
		"`patients`.`last_name`" => "last_name",
		"`patients`.`first_name`" => "first_name",
		"`patients`.`gender`" => "gender",
		"`patients`.`sexual_orientation`" => "sexual_orientation",
		"if(`patients`.`birth_date`,date_format(`patients`.`birth_date`,'%m/%d/%Y'),'')" => "birth_date",
		"`patients`.`age`" => "age",
		"`patients`.`address`" => "address",
		"`patients`.`city`" => "city",
		"`patients`.`state`" => "state",
		"`patients`.`zip`" => "zip",
		"CONCAT_WS('-', LEFT(`patients`.`home_phone`,3), MID(`patients`.`home_phone`,4,3), RIGHT(`patients`.`home_phone`,4))" => "home_phone",
		"CONCAT_WS('-', LEFT(`patients`.`work_phone`,3), MID(`patients`.`work_phone`,4,3), RIGHT(`patients`.`work_phone`,4))" => "work_phone",
		"CONCAT_WS('-', LEFT(`patients`.`mobile`,3), MID(`patients`.`mobile`,4,3))" => "mobile",
		"`patients`.`tobacco_usage`" => "tobacco_usage",
		"`patients`.`alcohol_intake`" => "alcohol_intake",
		"`patients`.`history`" => "history",
		"`patients`.`surgical_history`" => "surgical_history",
		"`patients`.`obstetric_history`" => "obstetric_history",
		"`patients`.`genetic_diseases`" => "genetic_diseases",
		"`patients`.`contact_person`" => "contact_person",
		"`patients`.`other_details`" => "other_details",
		"`patients`.`comments`" => "comments",
		"DATE_FORMAT(`patients`.`filed`, '%c/%e/%Y %l:%i%p')" => "filed",
		"DATE_FORMAT(`patients`.`last_modified`, '%c/%e/%Y %l:%i%p')" => "last_modified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`patients` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 1;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 20;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "patients_view.php";
	$x->RedirectAfterInsert = "patients_view.php?SelectedID=#ID#";
	$x->TableTitle = "Patients";
	$x->TableIcon = "resources/table_icons/administrator.png";
	$x->PrimaryKey = "`patients`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 120, 70, 150, 50, 150, 50, 100, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Last name", "First name", "Gender", "Sexual orientation", "Age", "Image", "State", "Mobile", "Tobacco usage", "Alcohol Intake", "History", "Surgical history", "Obstetric history", "Genetic diseases");
	$x->ColFieldName = array('last_name', 'first_name', 'gender', 'sexual_orientation', 'age', 'image', 'state', 'mobile', 'tobacco_usage', 'alcohol_intake', 'history', 'surgical_history', 'obstetric_history', 'genetic_diseases');
	$x->ColNumber  = array(2, 3, 4, 5, 7, 8, 11, 15, 16, 17, 18, 19, 20, 21);

	// template paths below are based on the app main directory
	$x->Template = 'templates/patients_templateTV.html';
	$x->SelectedTemplate = 'templates/patients_templateTVS.html';
	$x->TemplateDV = 'templates/patients_templateDV.html';
	$x->TemplateDVP = 'templates/patients_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `patients`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='patients' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `patients`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='patients' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`patients`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: patients_init
	$render=TRUE;
	if(function_exists('patients_init')){
		$args=array();
		$render=patients_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: patients_header
	$headerCode='';
	if(function_exists('patients_header')){
		$args=array();
		$headerCode=patients_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: patients_footer
	$footerCode='';
	if(function_exists('patients_footer')){
		$args=array();
		$footerCode=patients_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>