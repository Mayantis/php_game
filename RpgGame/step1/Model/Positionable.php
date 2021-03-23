<?php

namespace Model;

trait Positionable {

    /** @var int */
    protected int $x;

    /** @var int */
    protected int $y;


    /**
     * Get the value of x
     *
     * @return array
     */
    public function getXY(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }

    /**
     * Get the value of x
     *
     * @return self
     */
    public function setXY(int $x, int $y): self
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }

    /**
     * Get the value of x
     *
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Set the value of x
     *
     * @param int $x
     *
     * @return self
     */
    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get the value of y
     *
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * Set the value of y
     *
     * @param int $y
     *
     * @return self
     */
    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }
}

?>