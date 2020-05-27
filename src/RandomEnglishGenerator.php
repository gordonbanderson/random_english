<?php
namespace Suilven\RandomEnglish;

class RandomEnglishGenerator
{
    /** @var string configuration file for sentences */
    private $config = '';

    const POSSIBLE_WORD_TYPES = ['verb', 'noun', 'preposition'];

    public function __construct()
    {
        $configFile = dirname(__FILE__) . '/../config/sentence-structure.cfg';
        $this->setConfig(file_get_contents($configFile));
    }

    public function setConfig($newConfig)
    {
        $this->config = trim($newConfig);
    }

    public function sentence()
    {
        $structures = explode(PHP_EOL, $this->config);
        shuffle($structures);
        $structure = $structures[0];
        
        $expression='/[\s]+/';
        $splits = preg_split($expression, $structure, -1, PREG_SPLIT_NO_EMPTY);

        $sentenceArray = [];
        foreach ($splits as $possiblyRandomWord) {
            $randomized = false;
            foreach (self::POSSIBLE_WORD_TYPES as $wordType) {
                $start = '[' . $wordType . ']';
                if (substr($possiblyRandomWord, 0, strlen($start)) === $start) {
                    $sentenceArray[] = $this->getRandomWord($wordType);
                    $randomized = true;
                    break;
                }
            }

            if (!$randomized) {
                $sentenceArray[] = $possiblyRandomWord;
            }
        }

        return implode(" ", $sentenceArray) . '.';
    }


    private function getRandomWord($wordType)
    {
        $wordsFile = dirname(__FILE__) . '/../words/english_' . $wordType . 's.txt';
        $words = explode(PHP_EOL, trim(file_get_contents($wordsFile)));
        shuffle($words);
        return $words[0];
    }
}
