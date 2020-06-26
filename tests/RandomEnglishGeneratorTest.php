<?php declare(strict_types = 1);

namespace Tests\Suilven\RandomEnglish;

use PHPUnit\Framework\TestCase;
use Suilven\RandomEnglish\RandomEnglishGenerator;

class RandomEnglishGeneratorTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        \srand(1000);
    }


    public function testSentence(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('The [adjective] [noun] [verb] [preposition] the [noun]');
        $this->assertEquals('The quiet bank reply next the god.', $generator->sentence());
    }


    public function testComma(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('It was [adjective] in the [noun], [contraction] [noun] was [adjective]');
        $this->assertEquals('It was quiet in the bank, your bread was low.', $generator->sentence());
    }


    public function testTitle(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('It was [adjective] in the [noun], [contraction] [noun] was [adjective]');
        $this->assertEquals('It Was Quiet In The Bank, Your Bread Was Low', $generator->title());
    }


    public function testCapitalFirstWord(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('[control_verb]!!  You cannot [verb] here');
        $this->assertEquals('Order!! You cannot egg here.', $generator->sentence());
    }


    public function testVerbing(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('What are you [verb_ing]?');
        $this->assertEquals('What are you rounding?', $generator->sentence());
    }


    public function testRandomCountry(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('Can I go on holiday to [country] due to Covid 19?');
        $this->assertEquals('Can I go on holiday to Saint Lucia due to Covid 19?', $generator->sentence());
    }


    public function testRandomColour(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('I like [colour]');
        $this->assertEquals('I like saddle brown.', $generator->sentence());
    }


    public function testRandomWordVerticalBars(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('a|b|c|d');
        for ($i=0; $i<100; $i++) {
            $sentence = $generator->sentence();
            $this->assertTrue(\in_array($sentence, ['A.', 'B.', 'C.', 'D.'], true));
        }
    }


    public function testPluralNoun(): void
    {
        $generator = new RandomEnglishGenerator();
        $generator->setConfig('How many [plural_noun] do you have?');
        $this->assertEquals('How many stranges do you have?', $generator->sentence());
    }

    
    public function testParagraph(): void
    {
        $generator = new RandomEnglishGenerator();
        \error_log($generator->paragraph());
    }


    public function skiptestLots(): void
    {
        $generator = new RandomEnglishGenerator();

        for ($i=0; $i< 100; $i++) {
            \error_log($generator->sentence());
        }
    }
}
