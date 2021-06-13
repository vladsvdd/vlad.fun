<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Courses\Courses;

class CoursesController extends AbstractController
{
    public function coursesMain(){
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        $this->view->renderHtml('courses/coursesMain.php');
    }
    public function coursesDescription(){
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        $this->view->renderHtml('courses/kurs-html-dlya-nachinayushih/kurs-html-dlya-nachinayushih.php');
    }

    public function view(int $idCourses, int $page = 1)
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        /**
         * получаю статьи
         */
        $courses = Courses::getById($idCourses);

        if ($courses === null) {
            throw new NotFoundException();
        }
        /*
         * загружаю страницу view пользователю
         */
        $this->view->renderHtml('courses/kurs-html-dlya-nachinayushih/viewCourse.php',
            [
                'courses' => $courses,
            ]
        );
    }
}