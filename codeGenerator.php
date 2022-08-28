<?php
interface SecurityNumberCInterface
{
	public const MAX_DIGITS_NUMBER = 6;
	public const MAX_REPLICATION_NUMBER = 2;
	public const MAX_NUMBER_LOGIC_SUITE = 3;

	public function generate(): string;
	public function log();
}

class WalkAndRegenerate implements SecurityNumberCInterface
{
	public function algoPresentation()
	{
		echo "#######################################\n ";
		echo "          Demarrage du script          \n ";
		echo "             de génération             \n ";
		echo "                de code 			     \n ";
		echo "#######################################\n ";
	}

	public function suggestMeACode(): string
	{
		if (is_float(1*10**(SecurityNumberCInterface::MAX_DIGITS_NUMBER-1))) {
			throw new \Exception('Maximum digits was reached, you must decrease the MAX_DIGITS_NUMBER value');
		}

		return mt_rand(
			1*10**(SecurityNumberCInterface::MAX_DIGITS_NUMBER-1),
		 	9*10**(SecurityNumberCInterface::MAX_DIGITS_NUMBER-1)
		);
	}

	/**
	 * Check and validate the dupplication is aggreed according constante.
	 */
	public function hasDupplicateNumbers(string $code): bool
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
	public function hasSuiteNumbers(string $proposal): bool
	{
		$numbers = str_split($proposal);
		$addLogicCounter = 1;
		$minusLogicCounter = 1;
		for($i = 0; $i < count($numbers); ++$i) {
			if (!isset($numbers[$i+1])) {
				break;
			}

			$currentNumber = (int)$numbers[$i];
			$nextNumber = (int)$numbers[$i+1];
			$logicSymbol = null;
			if ($nextNumber === $currentNumber+1) {
				$logicSymbol = '+';
				$addLogicCounter++;
			} else if ($nextNumber === $currentNumber-1) {
				$logicSymbol = '-';
				$minusLogicCounter++;
			}
		}

		if (
				SecurityNumberCInterface::MAX_NUMBER_LOGIC_SUITE <= $addLogicCounter
				|| SecurityNumberCInterface::MAX_NUMBER_LOGIC_SUITE <= $minusLogicCounter 
			) {
				return true;
		}

		return false;
	}

	public function getCodeQualityReport(): string
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
			$organizedNumbers[$number]++;
		}

		return $organizedNumbers;
	}

	public function displayCode(string $code): string
	{
		echo "\n --------- $code --------\n ";

		return $code;
	}

	public function prepareValidcode(): string
	{
		$proposal = $this->suggestMeACode();
		$isInvalidProposal = $this->hasDupplicateNumbers($proposal); // wip 
		if ($isInvalidProposal) {
			$proposal = $this->prepareValidcode();
		}

		$isInvalidProposal =  $this->hasSuiteNumbers($proposal);
		if ($isInvalidProposal) {
			$proposal = $this->prepareValidcode();
		}

		return $proposal;
	}

	public function log()
	{
		// todo project logger injection
	}

	/**
	 * Main function who aggregate all method for code management
	 */
	public function generate(): string
	{
		$this->algoPresentation();
		try {
			$proposal = $this->prepareValidcode();
		} catch (\Exception $e) {
			$this->log();
			echo sprintf("L'application a rencontré un problème : %s", $e->getMessage());
		}

		return $proposal;
	}
}

$securityInstance = new WalkAndRegenerate();
$code = $securityInstance->prepareValidcode();

$securityInstance->displayCode($code);
