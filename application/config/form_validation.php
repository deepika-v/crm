<?php 
	$config= [

		'Add_University_Rules' => [
									[
										'field' => 'UniversityName',
										'label' => 'University Name',
										'rules' => 'required|xss_clean'
									],
									[
										'field' => 'UniversityShortName',
										'label' => 'University Short Name',
										'rules' => 'required|xss_clean'
									],


								]
	];
?>