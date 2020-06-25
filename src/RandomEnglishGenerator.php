<?php declare(strict_types = 1);

namespace Suilven\RandomEnglish;

use Suilven\RandomEnglish\Helper\LanguageHelper;

class RandomEnglishGenerator
{

    private const POSSIBLE_WORD_TYPES = [
        'noun',
        'countable_noun',

        'adjective',
        'preposition',
        'conjunction',
        'contraction',
        'control_verb',

        'sequence_adverb',
        'frequency_adverb',

        // pluralize and ing these?
        'intransitive_verb',
        'irregular_verb',
        'transitive_verb',
        'verb',
        'adverb',

        'intransitive_verb_ing',
        'irregular_verb_ing',
        'transitive_verb_ing',
        'verb_ing',


        // positions
        'locative',

        'plural_noun',


        // names
        'mens_name',
        'womens_name',
        'country',
        'colour',
    ];

    /** @var string configuration file for sentences */
    private $config = '';

    public function __construct()
    {
        $configFile = \dirname(__FILE__) . '/../config/sentence-structure.cfg';
        $this->setConfig(\file_get_contents($configFile));
    }


    /** @param string $newConfig configuration file of how sentence structures */
    public function setConfig(string $newConfig): void
    {
        $this->config = \trim($newConfig);
    }


    /**
     * Generate a random sentence
     *
     * @param bool $titleCase true to generate a title, false (default) to generate a sentence
     * @return string a random sentence
     */
    public function sentence(bool $titleCase = false): string
    {
        // choose a random sentence structure
        $structures = \explode(\PHP_EOL, $this->config);
        \shuffle($structures);
        $structure = $structures[0];
        
        $expression='/[\s]+/';
        $splits = \preg_split($expression, $structure, -1, \PREG_SPLIT_NO_EMPTY);

        $sentenceArray = [];

        /** @var string $possiblyRandomWord */
        foreach ($splits as $possiblyRandomWord) {
            $randomized = false;

            foreach (self::POSSIBLE_WORD_TYPES as $wordType) {
                $pluralNoun = $this->pluralNounCheck($wordType, $possiblyRandomWord);
                $ing = $this->ingVerbCheck($wordType, $possiblyRandomWord);

                $start = '[' . $wordType . ']';

                // check the start of the word as it may be suffixed by likes of a question of exclamation mark.
                // If no match for the possible word type continue until the next one
                if (\substr($possiblyRandomWord, 0, \strlen($start)) !== $start) {
                    continue;
                }

                // ---- we are now getting a random word from a file ----

                // note the suffix of the word, and append this to the random word
                $restOfWord = \str_replace($start, '', $possiblyRandomWord);

                // This avoids having to use 'countrie' in the sentence structure file : country -> countries
                $wordType = \str_replace('country', 'countrie', $wordType);

                /** @var string $randomWord */
                $randomWord = $this->getRandomWord($wordType);

                if ($pluralNoun) {
                    $helper = new LanguageHelper();
                    $randomWord = $helper->pluralizeNoun($randomWord);
                }

                if ($ing) {
                    $helper = new LanguageHelper();
                    $randomWord = $helper->ingVerb($randomWord);
                }
                $sentenceArray[] =$randomWord . $restOfWord;
                $randomized = true;

                break;
            }

            if ($randomized) {
                continue;
            }

            $sentenceArray[] = $possiblyRandomWord;
        }

        // ensure sentence starts with a capital
        $sentenceArray[0] = \ucfirst($sentenceArray[0]);

        $result = \implode(" ", $sentenceArray) . '.';

        if ($titleCase) {
            $result = \ucwords($result);
            $result = \substr_replace($result, "", -1);
        }

        $result = \str_replace('?.', '?', $result);
        $result = \str_replace('!.', '?', $result);

        return $result;
    }


    /**
     * Generate a random title
     *
     * @return string a random sentence, all in caps, no trailing full stop
     */
    public function title(): string
    {
        return $this->sentence(true);
    }


    /**
     * @param int $maxSentences The maximum number of sentences
     * @return string a paragraph of random sentences
     */
    public function paragraph(int $maxSentences = 10): string
    {
        $nParagraph = \rand(1, $maxSentences);
        $sentences = [];

        for ($i=0; $i< $nParagraph; $i++) {
            $sentences[] = $this->sentence();
        }

        return \implode("  ", $sentences);
    }


    /** @return string a plural noun */
    public function pluralNoun(): string
    {
        $plurableNoun = $this->getRandomWord('countable_noun');

        return $plurableNoun . 's';
    }


    /** @return string a plural verb */
    public function pluralVerb(): string
    {
        // @todo Choose a random verb source file
        $plurableNoun = $this->getRandomWord('verb');

        return $plurableNoun . 's';
    }


    /** @return string doing version of a verb */
    public function verbing(): string
    {
        // @todo Choose a random verb source file
        $plurableNoun = $this->getRandomWord('verb');

        return $plurableNoun . 'ing';
    }


    /**
     * @param string $wordType The word type, e.g. 'noun' or 'verb'
     * @return bool true if this is a plural noun
     */
    public function pluralNounCheck(string &$wordType, string &$possiblyRandomWord): bool
    {
        $pluralNoun = ($wordType === 'plural_noun');
        if ($pluralNoun) {
            $wordType = 'noun';
            $possiblyRandomWord = \str_replace('plural_', '', $possiblyRandomWord);
        }

        return $pluralNoun;
    }


    /** @return bool true if this is a verb with ing */
    public function ingVerbCheck(string &$wordType, string &$possiblyRandomWord): bool
    {
        $ing = \substr($wordType, -4) === '_ing';
        if ($ing) {
            $wordType = \str_replace('_ing', '', $wordType);
            $possiblyRandomWord = \str_replace('_ing', '', $possiblyRandomWord);
        }

        return $ing;
    }


    /**
     * @param string $wordType the type of word, e.g. noun, verb
     * @return string a random word for the given word type
     */
    private function getRandomWord(string $wordType): string
    {
        $wordsFile = \dirname(__FILE__) . '/../words/english_' . $wordType . 's.txt';
        $words = \explode(\PHP_EOL, \trim(\file_get_contents($wordsFile)));
        \shuffle($words);

        return $words[0];
    }
}
