<?php

class Game
{
    public int $score = 0;
    public $rolled = [];
    public int $currentBall = 0;


    public function __construct()
    {
        $this->rolled = new SplFixedArray(22);
    }

    public function roll(int $pins)
    {
        $this->rolled[$this->currentBall] = $pins;
        $this->currentBall++;
    }

    public function score(): int
    {
        $score = 0;
        $thisBall = 0;

        for ($i=0; $i<10; $i++){
            if($this->isStrike($thisBall))
            {
                $score+= 10 + $this->rolled[$thisBall+1] + $this->rolled[$thisBall+2];
                $thisBall += 1;
            }
            else if ($this->isSpare($thisBall))
            {
                $score+= 10 + $this->rolled[$thisBall+2];
                $thisBall += 2;
            }
            else
            {
                $score+= $this->rolled[$thisBall] + $this->rolled[$thisBall+1];
                $thisBall += 2;
            }
        }

        return $score;
    }

    /**
     * @param int $thisBall
     * @return bool
     */
    public function isStrike(int $thisBall): bool
    {
        return $this->rolled[$thisBall] == 10;
    }

    /**
     * @param int $thisBall
     * @return bool
     */
    public function isSpare(int $thisBall): bool
    {
        return $this->rolled[$thisBall] + $this->rolled[$thisBall + 1] == 10;
    }
}