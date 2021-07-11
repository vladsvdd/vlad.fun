<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotCoursePurchased;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Courses\Courses;
use MyProject\Models\Courses\CoursPurchased;

class CoursesController extends AbstractController
{
    public function coursesMain(){
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        $this->view->renderHtml('courses/coursesMain.php');
    }

    /**
     * @throws NotCoursePurchased
     * @throws UnauthorizedException
     */
    public function coursesDescription(){
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        /**
         * узнаю куплен ли курс
         */
        $coursPurchased = coursPurchased::findOneByColumns(
            ['user_id' => $this->user->getId(),
                'title' => 'kurs-html-dlya-nachinayushih',
                'purchased' => 1]);
        $this->coursPurchased = $coursPurchased;
        if ($this->coursPurchased === null){
            throw new NotCoursePurchased();
        }
        $this->view->renderHtml('courses/kurs-html-dlya-nachinayushih/kurs-html-dlya-nachinayushih.php');
    }

    /**
     * @throws NotCoursePurchased
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function view(int $idCourses, int $page = 1)
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        /**
         * узнаю куплен ли курс
         */
        $coursPurchased = coursPurchased::findOneByColumns(
            ['user_id' => $this->user->getId(),
                'title' => 'kurs-html-dlya-nachinayushih',
                'purchased' => 1]);
        $this->coursPurchased = $coursPurchased;
        if ($this->coursPurchased === null){
            throw new NotCoursePurchased();
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