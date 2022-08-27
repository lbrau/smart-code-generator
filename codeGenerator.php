<?php


// Parcours une liste de chiffre entre 1 et 9
// Compte le nombre de fois que les chiffres sont publiés dans l'algo.
// si on un des nombre est publié + de 3 fois, on régénère le code.
// Vérification que les chiffres ne se suivent pas.
// 	En progression
// 	En regréssion
interface SecurityNumberCInterface
{
	public const MAX_DIGITS_NUMBER = 6;
	public const MAX_REPLICATION_NUMBER = 1;

	public function generate(): string;
}

class WalkAndRegenerate implements SecurityNumberCInterface
{

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
		//return '122256';
	}

	/**
	 * Check and validate the dupplication is aggreed according constante.
	 */
	public function hasDupplicateNumbers(string $code)
	{
		$numbersCounters = @$this->organiseNumberByValue($code);
		foreach($numbersCounters as $key => $counter) {
			if (SecurityNumberCInterface::MAX_REPLICATION_NUMBER < $counter) {

				return true;
			}
		}

		return false;
	}

	/**
	 * Check if not number logic suite
	 */
	public function hasSuiteNumbers(string $proposal)
	{
		return $proposal;
	}

	public function getCodeQualityReport()
	{
		return 'quality report wip';
	}

	/**
	 * Walk accross a numbers suite
	 */
	public function organiseNumberByValue(string $numbers): array
	{
		$organizedNumbers = [];
		foreach(str_split($numbers) as $key => $number)
		{
			$organizedNumbers[$number] = $organizedNumbers[$number ?? 'toi'] + 1;
		}

		return $organizedNumbers;
	}

	public function displayCode(string $code): string
	{
		echo "\n --------- $code --------\n ";
		return $code;
	}

	/**
	 * Main function who aggregate all method for code management
	 */
	public function generate(): string
	{
		$this->algoPresentation();
		$proposal = $this->prepareValidcode();
		// todo Make the numbers suite check function. There is a problem if proposal is invalid, how regenerate ?


		return $proposal;
	}

	public function prepareValidcode()
	{
		$proposal = $this->suggestMeACode();
		$isInvalidProposal = $this->hasDupplicateNumbers($proposal); // wip 
		if ($isInvalidProposal) {
			$proposal = $this->prepareValidcode();
		}

		return $proposal;
	}
}

$securityInstance = new WalkAndRegenerate();
$code = $securityInstance->prepareValidcode();
$securityInstance->displayCode($code);
