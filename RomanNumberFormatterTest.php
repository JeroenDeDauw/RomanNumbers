<?php

require_once 'RomanNumberFormatter.php';

class RomanNumberFormatterTest extends PHPUnit_Framework_TestCase {

	public function testCanConstruct() {
		new RomanNumberFormatter();
		$this->assertTrue( true );
	}

	public function testFormatNumberOne() {
		$formatter = new RomanNumberFormatter();
		$result = $formatter->formatNumber( 1 );
		$this->assertInternalType( 'string', $result );
	}

}
