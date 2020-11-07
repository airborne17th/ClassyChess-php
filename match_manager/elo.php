<?php

class Elo
{
    /**
     * How strong a match will impact the players’ ratings
     * @var int The K Factor used.
     */
    const KFACTOR = 16;

    /**
     * Current rating for A.
     * @var int / float
     */
    protected $rating_a;

    /**
     * Current rating for B.
     * @var int / float
     */
    protected $rating_b;

    /**
     * Score for A. Expects 0 or 1.
     * @var int
     */
    protected $score_a;

    /**
     * Score for B. Expects 0 or 1.
     * @var int
     */
    protected $score_b;

    /**
     * Expected core for A when playing B.
     * @var int / float
     */
    protected $expected_a;

    /**
     * Expected core for B when playing A.
     * @var int / float
     */
    protected $expected_b;

    /**
     * New calcuated Elo-rating for A.
     * @var int / float
     */
    protected $new_rating_a;

    /**
     * New calcuated Elo-rating for B.
     * @var int / float
     */
    protected $new_rating_b;

    /**
     * Set data to calculate Elo rating.
     * @param int $rating_a Current rating of A.
     * @param int $rating_b Current rating of B.
     * @param int $score_a  Score of A.
     * @param int $score_b  Score of B.
     */
    public function new_rating($rating_a, $rating_b, $score_a, $score_b)
    {
        $this->rating_a = $rating_a;
        $this->rating_b = $rating_b;

        $this->score_a = $score_a;
        $this->score_b = $score_b;

        list($this->expected_a, $this->expected_b) = $this->_expected_scores_get();
        list($this->new_rating_a, $this->new_rating_b) = $this->_new_ratings_get();
    }

    /**
     * Get the calcuated ratings.
     * @return Array An array containing the new Elo ratings for A & B.
     */
    public function new_rating_get()
    {
        return array (
            $this->new_rating_a,
            $this->new_rating_b
        );
    }

    protected function _expected_scores_get()
    {
        $expected_score_a = 1 / (1 + (pow(10, ($this->rating_b - $rating_a) / 400)));
        $expected_score_b = 1 / (1 + (pow(10, ($this->rating_a - $rating_b) / 400)));

        return array (
            $expected_score_a,
            $expected_score_b
        );
    }

    protected function _new_ratings_get()
    {
        $new_rating_a = $this->rating_a + (SELF::KFACTOR * ($this->score_a - $this->expected_a));
        $new_rating_b = $this->rating_b + (SELF::KFACTOR * ($this->score_b - $this->expected_b));

        return array (
            $new_rating_a,
            $new_rating_b
        );
    }
}
