<?php

class RomanNumberFormatter {

	protected $symbolMap;

	public function __construct() {
		$this->symbolMap = array(
			array( 'I', 'V' ),
			array( 'X', 'L' ),
			array( 'C', 'D' ),
			array( 'M' ),
		);
	}

	public function formatNumber( $number ) {
		$romanNumber = '';

		for ( $i = 0; $i < count( $this->symbolMap ) ; $i++ ) {
			$divisor = pow( 10, $i + 1 );
			$remainder = $number % $divisor;
			$digit = $remainder / pow( 10, $i );

			$number -= $remainder;
			$romanNumber .= $this->formatDigit( $digit, $i );

			if ( $number === 0 ) {
				break;
			}
		}

		return $romanNumber;
	}

	protected function formatDigit( $digit, $orderOfMagnitude ) {
		if ( $digit === 0 ) {
			return '';
		}

		if ( $digit === 4 || $digit === 9 ) {
			return $this->formatFourOrNine( $digit, $orderOfMagnitude );
		}

		$romanNumber = '';

		if ( $digit >= 5 ) {
			$digit -= 5;
			$romanNumber .= $this->getFiveSymbol( $orderOfMagnitude );
		}

		$romanNumber .= $this->formatOneToThree( $orderOfMagnitude, $digit );

		return $romanNumber;
	}

	protected function formatFourOrNine( $digit, $orderOfMagnitude ) {
		$firstSymbol = $this->getOneSymbol( $orderOfMagnitude );
		$secondSymbol = $digit === 4 ? $this->getFiveSymbol( $orderOfMagnitude ) : $this->getTenSymbol( $orderOfMagnitude );
		return $firstSymbol . $secondSymbol;
	}

	protected function formatOneToThree( $orderOfMagnitude, $digit ) {
		return str_repeat( $this->getOneSymbol( $orderOfMagnitude ), $digit );
	}

	protected function getOneSymbol( $orderOfMagnitude ) {
		return $this->symbolMap[$orderOfMagnitude][0];
	}

	protected function getFiveSymbol( $orderOfMagnitude ) {
		return $this->symbolMap[$orderOfMagnitude][1];
	}

	protected function getTenSymbol( $orderOfMagnitude ) {
		return $this->symbolMap[$orderOfMagnitude + 1][0];
	}

}