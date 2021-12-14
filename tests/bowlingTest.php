<?php

require_once __DIR__ . '/../Game.php';

use PHPUnit\Framework\TestCase;


class bowlingTest extends TestCase
{
    private Game $game;

    /** @test */
    function rollZeroScoreIsZero()
    {
        $this->game->roll(0);
        self::assertEquals(0, $this->game->score());

    }

    /** @test */
    function openFramesAddsPins()
    {
        $this->game->roll(4);
        $this->game->roll(2);
        self::assertEquals(6, $this->game->score());
    }

    /** @test */
    function spareAddsNextBall()
    {
        $this->game->roll(4);
        $this->game->roll(6);
        $this->game->roll(3);
        $this->game->roll(0);

        self::assertEquals(16, $this->game->score());
    }

    /** @test */
    function aTenInTwoFramesIsNotASpare()
    {
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(4);
        $this->game->roll(2);

        self::assertEquals(15, $this->game->score());
    }

    /** @test */
    function aStrikeAddsTwoNextBalls()
    {
        $this->game->roll(10);
        $this->game->roll(3);
        $this->game->roll(2);

        self::assertEquals(20, $this->game->score());
    }

    /** @test */
    function perfectGameTestScoreIs300()
    {
        for($i=0; $i<12; $i++)
            $this->game->roll(10);

        self::assertEquals(300, $this->game->score());
    }

    protected function setUp(): void
    {
        $this->game = new Game();
    }
}