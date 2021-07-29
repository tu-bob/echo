<?php


namespace Modules\Media\Libs\StringComparator;



use Modules\Media\Libs\StringComparator\Models\BestMatch;

abstract class BestMatchFinder
{
    private array $options;
    private string $needle;
    private string $key;
    private BestMatch $bestMatch;

    public function __construct($needle, $options, $key)
    {
        $this->needle = $needle;
        $this->options = $options;
        $this->key = $key;
        $this->bestMatch = new BestMatch(0);
    }

    /**
     * Finds model by attributes which matches to the needle
     *
     * @return BestMatch
     */
    public function findBestMatch()
    {
        foreach ($this->options as $option) {
            $score = $this->compare(mb_strtoupper($this->needle), mb_strtoupper($option[$this->key]));
            if ($score > $this->bestMatch->score) {
                $this->bestMatch->score = $score;
                $this->bestMatch->entity = $option;
            }
        }

        return $this->bestMatch;
    }

    public function compMatches($a, $b)
    {
        if ($a->score == $b->score) {
            return 0;
        }
        return ($a->score > $b->score) ? -1 : 1;
    }

    /**
     * @param $rate
     * @return array BestMatch
     */
    public function findBestMatches($rate)
    {
        $bestMatches = [];

        foreach ($this->options as $option) {
            $score = $this->compare(mb_strtoupper($this->needle), mb_strtoupper($option[$this->key]));
            if ($score >= $rate) {
                $bestMatches[] = new BestMatch($score, $option);
            }
        }

        usort($bestMatches, array(BestMatchFinder::class, 'compMatches'));
        return $bestMatches;
    }


    /**
     * @param $needle
     * @param $string
     * @return float
     */
    abstract function compare(string $needle, string $string);
}
