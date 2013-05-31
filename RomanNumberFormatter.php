<?php

class RomanNumberFormatter {

	protected $symbolMap = array(
		array( 'I', 'V' ),
		array( 'X', 'L' ),
		array( 'C', 'D' ),
		array( 'M' ),
	);

	public function __construct( array $symbolMap = array() ) {
		if ( $symbolMap !== array() ) {
			$this->symbolMap = $symbolMap;
		}
	}

	public function formatNumber( $number ) {
		$this->ensureNumberIsAnInteger( $number );
		$this->ensureNumberIsWithinBounds( $number );
		return $this->constructRomanString( $number );
	}

	protected function ensureNumberIsAnInteger( $number ) {
		if ( !is_int( $number ) ) {
			throw new InvalidArgumentException( 'Can only translate integers to roman' );
		}
	}

	protected function ensureNumberIsWithinBounds( $number ) {
		if ( $number < 1 ) {
			throw new OutOfRangeException( 'Numbers under one cannot be translated to roman' );
		}

		if ( $number > $this->getUpperBound() ) {
			throw new OutOfBoundsException( 'The provided number is to big to be fully translated to roman' );
		}
	}

	public function getUpperBound() {
		$symbolGroupCount = count( $this->symbolMap );
		$valueOfOne = pow( 10, $symbolGroupCount - 1 );

		$hasFiveSymbol = array_key_exists( 1, $this->symbolMap[$symbolGroupCount - 1] );

		return $valueOfOne * ( $hasFiveSymbol ? 9 : 4 ) - 1;
	}

	protected function constructRomanString( $number ) {
		$romanNumber = '';

		for ( $i = 0; $i < count( $this->symbolMap ) ; $i++ ) {
			$divisor = pow( 10, $i + 1 );
			$remainder = $number % $divisor;
			$digit = $remainder / pow( 10, $i );

			$number -= $remainder;
			$romanNumber = $this->formatDigit( $digit, $i ) . $romanNumber;

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