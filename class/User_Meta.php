<?php

namespace Mizner\DTSK;

class User_Meta {

	public function __construct() {

		add_action( 'init', [ $this, 'meta_for_daily_task_list' ], 99 );
	}

	public function meta_for_daily_task_list() {

		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group( array(
				'key'                   => 'group_59556832db6a9',
				'title'                 => 'Daily Tasks',
				'fields'                => array(
					array(
						'key'               => 'field_595568363081f',
						'label'             => 'Daily Tasks',
						'name'              => 'daily_tasks',
						'type'              => 'repeater',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => 'dailyTasks',
						),
						'collapsed'         => '',
						'min'               => 0,
						'max'               => 0,
						'layout'            => 'table',
						'button_label'      => 'Add Task',
						'sub_fields'        => array(
							array(
								'key'               => 'field_5955689230821',
								'label'             => 'Task',
								'name'              => 'daily_task_description',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '',
							),
						),
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'user_form',
							'operator' => '==',
							'value'    => 'all',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => 1,
				'description'           => '',
			) );

		endif;
	}
}
