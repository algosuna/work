<?php 

$pix_options =array(

	array(
		'name' 	=> 	__('Email Id', 'drivetheme'),
		'desc' 	=> 	__('Enter the email id', 'drivetheme'),
		'id'	=>	'mailto',
		'std'	=>	'example@example.com', //optional
		'type'	=>	'text',
		//'con'	=>	false //true to display inbetween shortcodes
		),

	array(
		'name' 	=> 	__('Animation', 'drivetheme'),
		'desc' 	=> 	__('Do you like to animate this element?', 'drivetheme'),
		'id'	=>	'animate',		
		'std'	=>	false,
		'type'	=>	'checkbox',
		'val'   =>  array('No', 'Yes') // False Value First
		),

	array(
		'name' 	=> 	__('Animation Transition', 'drivetheme'),
		'desc' 	=> 	__('Choose Animation Transition', 'drivetheme'),
		'id'	=>	'transition',
		'std'	=>	'fadeIn',
		'options'=> array('flash','bounce','shake','tada','swing','wobble','pulse','flip','flipInX','flipInY','fadeIn','fadeInUp','fadeInDown','fadeInLeft','fadeInRight','fadeInUpBig','fadeInDownBig','fadeInLeftBig','fadeInRightBig','slideInDown','slideInLeft','slideInRight','bounceIn','bounceInUp','bounceInDown','bounceInLeft','bounceInRight','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','lightSpeedIn','hinge','rollIn'),
		'type'	=>	'select',
		),

	array(
		'name' 	=> 	__('Animation Duration', 'drivetheme'),
		'desc' 	=> 	__('Enter the Duration (Ex: 500ms or 1s)', 'drivetheme'),
		'id'	=>	'duration',
		'std'	=>	'1s', //optional
		'type'	=>	'text',
		),

	array(
		'name' 	=> 	__('Animation Delay', 'drivetheme'),
		'desc' 	=> 	__('Enter the Delay (Ex: 100ms or 1s)', 'drivetheme'),
		'id'	=>	'delay',
		'std'	=>	'100ms', //optional
		'type'	=>	'text',
		),

);

?>