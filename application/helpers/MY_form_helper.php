<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function form_group($params = array())
{
	$defaults = array(
		'group_class' => 'form-group',
		'required_class' => 'required',
		'required' => FALSE,
		'label' => '',
		'label_class' => 'form-label',
		'label_for' => '',
		'input' => '',
		'hint' => '',
		'hint_class' => 'form-hint',
		'error_class' => 'has-error',
		'field' => '',
	);

	$data = array_merge($defaults, $params);

	// No specific label_for attr and we have a field ref? Use that for label.
	if (empty($data['label_for']) && ! empty($data['field'])) {
		$data['label_for'] = $data['field'];
	}

	$label_el = '';
	$hint_el = '';
	$input_el = '';
	$error_el = '';
	$group_el = '';

	if ($data['required']) {
		$data['group_class'] .= " {$data['required_class']}";
	}

	$error = form_error($data['field'], '', '');
	if ($error) {
		$data['group_class'] .= " {$data['error_class']}";
		$error_el = "<div class='form-input-hint'>{$error}</div>";
	}

	if (strlen($data['label'])) {
		$label_el =  form_label(html_escape($data['label']), $data['label_for'], array('class' => $data['label_class']));
	}

	if (strlen($data['input'])) {
		$input_el = $data['input'];
	}

	if (strlen($data['hint'])) {
		$hint_el = "<div class='{$data['hint_class']}'>{$data['hint']}</div>";
	}

	$group_el = "<div class='{$data['group_class']}'>\n";
	$group_el .= $label_el . "\n";
	$group_el .= $hint_el . "\n";
	$group_el .= $input_el . "\n";
	$group_el .= $error_el . "\n";
	$group_el .= "</div>\n";

	return $group_el;

}