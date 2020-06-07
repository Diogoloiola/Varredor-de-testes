<?php

function moveSemPorONome( $origemComNome, $destinoSemNome) {
	$partes = pathinfo( $origemComNome);
	$destinoComNome = $destinoSemNome . DIRECTORY_SEPARATOR . $partes['basename'];
	return rename( $origemComNome, $destinoComNome );
}

function mostrarArquivos($local) {
	if (!$local) { return false; }

	if (!is_dir($local)) { 
		$arquivo = __DIR__.'/'.$local;
		if (strpos($local, '/test/') && !strpos($local, '/main/') && pathinfo($arquivo)['extension'] == 'java') {
			echo $arquivo.'<br>';
			moveSemPorONome($local, 'nome-repositório/testes');
		}

	} else {
		$dir = opendir($local);
		while ($file = readdir($dir)) {
			if ($file != "." && $file != "..") {
				mostrarArquivos(($local . "/" . $file));
				unset($file);
			}
		}
		closedir($dir);
		unset($dir);
	}
}

mostrarArquivos("nome-repositório");