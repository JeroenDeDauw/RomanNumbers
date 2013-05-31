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
	 * @dataProvider numbersWithMultipleDigitsProvider
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
		$argLists[] = array( 'MMMCMXCIX', 3999 );
		$argLists[] = array( 'DCCCXCIX', 899 );

		return $argLists;
	}

	/**
	 * @dataProvider toBigNumberProvider
	 */
	public function testFormatToBigNumber( $toBigNumber ) {
		$formatter = new RomanNumberFormatter();

		$this->setExpectedException( 'OutOfBoundsException' );
		$formatter->formatNumber( $toBigNumber );
	}

	public function toBigNumberProvider() {
		$argLists = array();

		$argLists[] = array( 4000 );
		$argLists[] = array( 10000 );

		return $argLists;
	}

	/**
	 * @dataProvider toSmallNumberProvider
	 */
	public function testFormatToSmallNumber( $toSmallNumber ) {
		$formatter = new RomanNumberFormatter();

		$this->setExpectedException( 'OutOfRangeException' );
		$formatter->formatNumber( $toSmallNumber );
	}

	public function toSmallNumberProvider() {
		$argLists = array();

		$argLists[] = array( 0 );
		$argLists[] = array( -1 );
		$argLists[] = array( -42 );
		$argLists[] = array( -9001 );

		return $argLists;
	}

	/**
	 * @dataProvider invalidNumberProvider
	 */
	public function testFormatInvalidNumber( $invalidNumber ) {
		$formatter = new RomanNumberFormatter();

		$this->setExpectedException( 'InvalidArgumentException' );
		$formatter->formatNumber( $invalidNumber );
	}

	public function invalidNumberProvider() {
		$argLists = array();

		$argLists[] = array( '1' );
		$argLists[] = array( '0' );
		$argLists[] = array( '42' );
		$argLists[] = array( '4.2' );
		$argLists[] = array( 4.2 );
		$argLists[] = array( 4.0 );
		$argLists[] = array( 9000.1 );
		$argLists[] = array( 0.0001 );
		$argLists[] = array( false );
		$argLists[] = array( true );
		$argLists[] = array( null );

		return $argLists;
	}



}
