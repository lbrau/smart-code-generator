<?php


// Parcours une liste de chiffre entre 1 et 9
// Compte le nombre de fois que les chiffres sont publiés dans l'algo.
// si on un des nombre est publié + de 3 fois, on régénère le code.
// Vérification que les chiffres ne se suivent pas.
// 	En progression
// 	En regréssion

class SecurityNumberChecker
{
	public const MAX_DIGITS_NUMBER = 6;
	public const MAX_RECPLICATION_NUMBER = 3;

	public function algoPresentation()
	{
		echo "#######################################\n ";
		echo "          Demarrage du script          \n ";
		echo "             de génération            \n ";
		echo "                de code 			 \n ";
		echo "#######################################\n ";

	}

	public function suggestMeACode(): string
	{
		return mt_rand(100000, 999999);
	}

	/**
	 * Check and validate the dupplication is aggreed according constante.
	 */
	public function checkDuplicationNumbers(string $proposal):string
	{
		return $proposal;
	}

	public function checkSuiteNumbers(string $proposal)
	{
		return $proposal;
	}

	public function getCodeQualityReport()
	{
		return 'quality report wip';
	}

	public function walkAccrossCode()
	{

	}

	public function displayCode(string $code): string
	{
		echo "--------- {$code} --------";
		return $code;
	}

	public function generateSecurityCode()
	{
		$this->algoPresentation();
		$proposal = $this->suggestMeACode(); // wip
		$proposal = $this->checkSuiteNumbers($proposal); // wip 
		$proposal = $this->checkDuplicationNumbers($proposal); // wip 
		
		return $proposal;
	}
}

$securityInstance = new SecurityNumberChecker();
$securityInstance->displayCode($securityInstance->generateSecurityCode());


