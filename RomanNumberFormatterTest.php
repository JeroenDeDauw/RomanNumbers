<?php

require_once 'RomanNumberFormatter.php';

class RomanNumberFormatterTest extends PHPUnit_Framework_TestCase {

	public function testCanConstruct() {
		new RomanNumberFormatter();
		$this->assertTrue( true );
	}

	/**
	 * @dataProvider simpleNumberProvider
	 */
	public function testFormatSimpleNumber( $expected, $simpleNumber ) {
		$this->assertInputResultsInExpected( $expected, $simpleNumber );
	}

	protected function assertInputResultsInExpected( $expected, $input ) {
		$formatter = new RomanNumberFormatter();
		$result = $formatter->formatNumber( $input );

		$this->assertInternalType( 'string', $result );
		$this->assertEquals( $expected, $result );
	}

	public function simpleNumberProvider() {
		$argLists = array();

		$argLists[] = array( 'I', 1 );
		$argLists[] = array( 'V', 5 );
		$argLists[] = array( 'X', 10 );
		$argLists[] = array( 'L', 50 );
		$argLists[] = array( 'C', 100 );
		$argLists[] = array( 'D', 500 );
		$argLists[] = array( 'M', 1000 );

		return $argLists;
	}

	/**
	 * @dataProvider numberWithRepeatedSymbolsProvider
	 */
	public function testFormatNumberTwo( $expected, $input ) {
		$this->assertInputResultsInExpected( $expected, $input );
	}

	public function numberWithRepeatedSymbolsProvider() {
		$argLists = array();

		$argLists[] = array( 'II', 2 );
		$argLists[] = array( 'III', 3 );
		$argLists[] = array( 'XX', 20 );
		$argLists[] = array( 'XXX', 30 );
		$argLists[] = array( 'MM', 2000 );
		$argLists[] = array( 'MMM', 3000 );

		return $argLists;
	}

	/**
	 * @dataProvider numbersWithFourProvider
	 */
	public function testFormatNumbersWithFour( $expected, $input ) {
		$this->assertInputResultsInExpected( $expected, $input );
	}

	public function numbersWithFourProvider() {
		$argLists = array();

		$argLists[] = array( 'IV', 4 );
		$argLists[] = array( 'XL', 40 );
		$argLists[] = array( 'CD', 400 );

		return $argLists;
	}

	/**
	 * @dataProvider numbersWithNineProvider
	 */
	public function testFormatNumbersWithNine( $expected, $input ) {
		$this->assertInputResultsInExpected( $expected, $input );
	}

	public function numbersWithNineProvider() {
		$argLists = array();

		$argLists[] = array( 'IX', 9 );
		$argLists[] = array( 'XC', 90 );
		$argLists[] = array( 'CM', 900 );

		return $argLists;
	}

	/**
	 * @dataProvider numbersWithNineProvider
	 */
	public function testFormatNumbersMultipleDigits( $expected, $input ) {
		$this->assertInputResultsInExpected( $expected, $input );
	}

	public function numbersWithMultipleDigitsProvider() {
		$argLists = array();

		$argLists[] = array( 'XI', 11 );
		$argLists[] = array( 'XIV', 14 );
		$argLists[] = array( 'XIX', 19 );
		$argLists[] = array( 'XIII', 13 );
		$argLists[] = array( 'XXXIII', 33 );
		$argLists[] = array( 'CXCI', 191 );
		$argLists[] = array( 'MMXMXCVIII', 2998 );

		return $argLists;
	}

}
