<?
@session_start();

/*
 * função que verifica o cpf retorna true se for valido e false de for invalido
 */
function is_valid_cpf($cpf) {
	for($i = 0; $i < 10; $i ++) {
		if ($cpf == str_repeat ( $i, 11 ) or ! preg_match ( "@^[0-9]{11}$@", $cpf ) or $cpf == "12345678909")
			return false;
		if ($i < 9)
			$soma [] = $cpf {$i} * (10 - $i);
		$soma2 [] = $cpf {$i} * (11 - $i);
	}
	if (((array_sum ( $soma ) % 11) < 2 ? 0 : 11 - (array_sum ( $soma ) % 11)) != $cpf {9})
		return false;
		
	return (((array_sum ( $soma2 ) % 11) < 2 ? 0 : 11 - (array_sum ( $soma2 ) % 11)) != $cpf {10}) ? false : true;
	
}

/*
 * função que verifica o cnpj retorna true se for valido e false de for invalido
 */
function is_valid_cnpj($cnpj){
	for ($t = 12; $t < 14; $t++) {
		for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
			$d += $cnpj[$c] * $p;
			$p   = ($p < 3) ? 9 : --$p;
		}

		$d = ((10 * $d) % 11) % 10;

		if ($cnpj[$c] != $d) {
			return false;
		}
	}

	return true;
}

/*
 * função que retira todos os caracteres que nao são numeros
 */
function soNumero($string) {
	return preg_replace ( "/[^0-9]/", '', $string );
}

?>