<?php
function randpass($length = 4,$lower = true,$upper = true,$number = true,$symbol = true) {
		$strings = [
			'lowerCase' => 'abcdefghijklmnopqrstuvwxyz',
			'upperCase' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'numberChars' => '0123456789',
			'symbolChars' => '~!@#$%^&*()_+[]\;\',./~{}|:\"<>?'
		];
		$str = ($lower ? $strings['lowerCase'][rand(0,strlen($strings['lowerCase'])-1)]:'').($upper ? $strings['upperCase'][rand(0,strlen($strings['upperCase'])-1)]:'').($number ? $strings['numberChars'][rand(0,strlen($strings['numberChars'])-1)]:'').($symbol ? $strings['symbolChars'][rand(0,strlen($strings['symbolChars'])-1)]:'');
		$chars = ($lower ? $strings['lowerCase']:'').($upper ? $strings['upperCase']:'').($number ? $strings['numberChars']:'').($symbol ? $strings['symbolChars']:'');
		for($i=strlen($str)+1,$tchars = (strlen($chars)-1);$i<=$length;$i++){
			$str.=$chars[rand(0,$tchars)];
		}
		return str_shuffle($str);
	}
?>
