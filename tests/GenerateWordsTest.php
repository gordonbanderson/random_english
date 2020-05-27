<?php

namespace Tests\Suilven\RandomEnglish;

use TzLion\Wiktionator\DbWiktionator;

class GenerateWordsTest extends \PHPUnit\Framework\TestCase
{
    public function testGeneration()
    {
        error_log('Test is running');

        /** @var DbWiktionator $w */
        $w = \TzLion\Wiktionator\Wiktionator::getInstance(['db', 'root', 'secret', 'enwiktionary']);
        $categories = $w->getWordCategories('dog');
        error_log(print_r($categories, 1));

        $this->saveWordsForCategory('English_verbs', 'english_verbs.txt', 100);

        for ($i = 0; $i < 100; $i++) {
            // error_log($w->getRandomWordInCategory('English_verbs'));
        }

        $categoriesThatMatter = [
            'English_nouns' => 'english_nouns.txt',
            'English_verbs' => 'english_verbs.txt',
            'English_transitive_verbs' => 'english_transitive_verbs.txt',
            'English_intransitive_verbs' => 'english_intransitive_verbs.txt',
            'English_locatives' => 'english_locatives.txt',
            'English_countable_nouns' => 'english_countable_nouns.txt',
            'English_adjectives' => 'english_adjectives.txt',
            'English_contractions' => 'english_contractions.txt',
            'English_informal_terms' => 'english_informal_terms.txt',
            'English_lemmas' => 'english_lemmas.txt',
            'English_control_verbs' => 'english_control_verbs.txt',
            'English_modal_verbs' => 'english_modal_verbs.txt',
            'English_irregular_verbs' => 'english_irregular_verbs.txt',
            'English_prepositions' => 'english_prepositions.txt',
            'English_sequence_adverbs' => 'english_sequence_adverbs.txt',
            'English_hyperboles' => 'english_hyperboles.txt',
            'English_1-syllable_words' => 'english_1-syllable_words.txt',
            'English_2-syllable_words' => 'english_2-syllable_words.txt',
            'English_3-syllable_words' => 'english_3-syllable_words.txt',
            'English_reporting_verbs' => 'english_reporting_verbs.txt',
            'English_informal_terms' => 'english_informal_terms.txt',
            'English_conjunctions' => 'english_conjunctions.txt',
            'English_degree_adverbs' => 'english_degree_adverbs.txt',
            'English_intensifiers' => 'english_intensifiers.txt',
            'English_duration_adverbs' => 'english_duration_adverbs.txt',
            'English_frequency_adverbs' => 'english_frequency_adverbs.txt',
            'English_auxiliary_verb_forms' => 'english_auxiliary_verb_forms.txt'
        ];

        $wordsPerCategory = [];
        $words = $w->getWordsInCategory('English_basic_words', 100000);
        foreach ($words as $word) {
            error_log('--');
            error_log($word);
            $categories = $w->getWordCategories($word);
            error_log(print_r($categories, 1));

            if (!empty($categories)) {
                foreach ($categories as $category) {
                    if (in_array($category, array_keys($categoriesThatMatter))) {
                        error_log('    - ' . $category);
                        if (!isset($wordsPerCategory[$category])) {
                            $wordsPerCategory[$category] = [];
                        }
                        $wordsPerCategory[$category][] = $word;
                    }
                }
            }
        }

        foreach(array_keys($categoriesThatMatter) as $category) {
            $words = $wordsPerCategory[$category];
            //error_log(print_r($words, 1));
            error_log($category . ' --> ' . sizeof($words));
            $file = $categoriesThatMatter[$category];
            file_put_contents($file, implode("\n", $words));
        }

        # $this->saveWordsForCategory('English_nouns', 'english_nouns.txt', 1000);
        # $this->saveWordsForCategory('English_basic_words', 'english_basic_words.txt', 1000);
        # $this->saveWordsForCategory('English_transitive_verbs', 'english_transitive_verbs.txt', 1000);
        # $this->saveWordsForCategory('English_verbs', 'english_verbs.txt', 1000);
        #  $this->saveWordsForCategory('English_nouns', 'nouns.txt', 1000);
        #  $this->saveWordsForCategory('English_nouns', 'nouns.txt', 1000);
        #  $this->saveWordsForCategory('English_nouns', 'nouns.txt', 1000);
        #  $this->saveWordsForCategory('English_nouns', 'nouns.txt', 1000);
        # $this->saveWordsForCategory('English_nouns', 'nouns.txt', 1000);
        # $this->saveWordsForCategory('English_nouns', 'nouns.txt', 1000);


    }

    private function saveWordsForCategory($category, $file, $amount)
    {
        $bulkSize = 200;
        $pages = 1 + abs($amount / $bulkSize);
        $wordsForCategoryTxt = "";
        $w = \TzLion\Wiktionator\Wiktionator::getInstance(['db', 'root', 'secret', 'enwiktionary']);

        for ($i = 1; $i < $pages; $i++) {
            error_log($i);
            $words = $w->getRandomWordsInCategory($category, $bulkSize);
            foreach ($words as $word) {
                $wordsForCategoryTxt .= $word . "\n";
            }
            echo '.';
        }

        file_put_contents($file, $wordsForCategoryTxt);
        error_log($wordsForCategoryTxt);
    }
}