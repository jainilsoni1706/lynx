<?php

namespace Lynx\System\Request;

use Lynx\System\Exception\ApplicationException;

class Request {

	public $request;

	public function __construct($requests) {
		$this->request = $_REQUEST;
		array_push($this->request, $requests);
	}

	public static function get($key) {
		if (isset($_GET[$key])) {
			return $_GET[$key];
		} else {
			return new ApplicationException("Key not found.", "lynx/request/request.php");
		}
	}

	public static function post($key) {
		if (isset($_POST[$key])) {
			return $_POST[$key];
		} else {
			return new ApplicationException("Key not found.", "lynx/request/request.php");
		}
	}

	public static function all() {
		return $_REQUEST;
	}

	public static function method() {
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function uri() {
		return $_SERVER['REQUEST_URI'];
	}

	public static function isGet() {
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			return true;
		} else {
			return false;
		}
	}

	public static function isPost() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			return true;
		} else {
			return false;
		}
	}

	public static function isPut() {
		if ($_SERVER['REQUEST_METHOD'] == "PUT") {
			return true;
		} else {
			return false;
		}
	}

	public static function isDelete() {
		if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
			return true;
		} else {
			return false;
		}
	}

	public static function isPatch() {
		if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
			return true;
		} else {
			return false;
		}
	}

	public static function isHead() {
		if ($_SERVER['REQUEST_METHOD'] == "HEAD") {
			return true;
		} else {
			return false;
		}
	}

	public static function isOptions() {
		if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
			return true;
		} else {
			return false;
		}
	}

	public static function isAjax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
			return true;
		} else {
			return false;
		}
	}

	public static function isSecure() {
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
			return true;
		} else {
			return false;
		}
	}

	public static function isJson() {
		if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == "application/json") {
			return true;
		} else {
			return false;
		}
	}

	public static function redirect($url, $statusCode = 303) {
		$projectUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
		header('Location: ' . $projectUrl.$url, true, $statusCode);
		die();
	}

	public static function back() {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}

	public static function url($url) {
		$projectUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
		return $projectUrl.$url;
	}

}

function url($url) {
	$projectUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
	return $projectUrl.$url;
}

function redirect($url, $statusCode = 303) {
	$projectUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
	header('Location: ' . $projectUrl.$url, true, $statusCode);
	die();
}