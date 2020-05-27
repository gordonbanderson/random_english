<?php


namespace Tests\Suilven\RandomEnglish;


use PHPUnit\Framework\TestCase;
use Suilven\RandomEnglish\RandomEnglishGenerator;

class RandomEnglishGeneratorTest extends TestCase
{
    public function testSentence()
    {
        srand(1000);
        $generator = new RandomEnglishGenerator();
        $this->assertEquals('The strange will around the cup.', $generator->sentence());
    }
}