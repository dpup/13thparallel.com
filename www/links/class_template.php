<?php

/**
 * Simple class for handling the templates used in the link script
 *
 * @author Dan Pupius <http://pupius.co.uk>
 * @version 1.0
 * @since 0.0
 * @copyright ©2004 Daniel Pupius
 */
class Template {
	var $src = "";
	var $html = "";
	var $vars = array();

	function Template($name) {
		$this->src = $GLOBALS['base_path'] . "templates/$name.htm";
		$this->load();
	}

	function load() {
		$this->html = file_get_contents($this->src);

		//strip the template comments
		$this->html = preg_replace("/<!--#(.*)#-->/ms","",$this->html);
	}

	function set_value($var,$val) {
		$this->vars[$var] = $val;
	}

	function render() {
		$s = $this->html;
		foreach($this->vars as $var => $val) $s = str_replace("<#$var#>",$val,$s);
		return $s;
	}
}