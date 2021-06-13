<?php

namespace MyProject\Models\Courses;

use MyProject\Models\ActiveRecordEntity;

class Courses extends ActiveRecordEntity {

    protected int $coursesId;
    protected string $text;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getCoursesId(): int
    {
        return $this->coursesId;
    }

    protected static function getNameTable(): string
    {
        return 'courses';
    }
}