<?php

namespace MyProject\Models\Courses;

use MyProject\Models\ActiveRecordEntity;

class CoursPurchased extends ActiveRecordEntity
{
    protected int $id;
    protected string $title;
    protected int $purchased;
    protected int $userId;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPurchased(): int
    {
        return $this->purchased;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    protected static function getNameTable(): string
    {
        return 'coursPurchased';
    }
}