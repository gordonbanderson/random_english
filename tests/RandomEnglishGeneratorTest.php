<?php


namespace Tests\Suilven\RandomEnglish;

use PHPUnit\Framework\TestCase;
use Suilven\RandomEnglish\RandomEnglishGenerator;

class RandomEnglishGeneratorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        srand(1000);
    }

    public function testSentence()
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('The [adjective] [noun] [verb] [preposition] the [noun]');
        $this->assertEquals('The quiet bank cover near the left.',  $generator->sentence());
    }

    public function testComma()
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('It was [adjective] in the [noun], [contraction] [noun] was [adjective]');
        $this->assertEquals('It was quiet in the bank, your bread was low.',  $generator->sentence());
    }

    public function testTitle()
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('It was [adjective] in the [noun], [contraction] [noun] was [adjective]');
        $this->assertEquals('It Was Quiet In The Bank, Your Bread Was Low',  $generator->title());
    }


    public function testCapitalFirstWord()
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('[control_verb]!!  You cannot [verb] here');
        $this->assertEquals('Order!! You cannot boat here.',  $generator->sentence());
    }

    //

    public function skiptestLots()
    {
        srand(1000);
        $generator = new RandomEnglishGenerator();
        for($i=0; $i< 100; $i++) {
            error_log($generator->sentence());
        }
    }
}
