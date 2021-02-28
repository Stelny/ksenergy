<?php

namespace App\FrontModule\Presenters;

use App\FrontModule\Presenters\BasePresenter;
use Nette;

class BlogPresenter extends BasePresenter {

    public function renderDefault() {

        $this->template->title = "Ksenergy - Blog";

        $this->template->blog = $this->blogModel->getBlog();


    }

    public function renderDetail($name) {
        
        $blog = $this->blogModel->getBlogByName($name);

        if (empty($blog)) {
           $this->error("Příspěvek nebyl nalezen");
        }  

        $this->template->title = "Ksenergy | Blog - " . $blog->heading;
        $posts = $this->blogModel->getBlog();

        $index = 0;
        
        foreach ($posts as $key => $value) {
            if ($value->id == $blog->id) {
                $index = $key;
            }
        }

        if (isset($posts[$index+1])) {
            $next = $posts[$index+1];
        } else {
            $next = $posts[0];
        }

        if (isset($posts[$index-1])) {
            $prev = $posts[$index-1];
        } else {
            $prev = $posts[count($posts)-1];
        }

        $this->template->next = $next;
        $this->template->prev = $prev;
        $this->template->blog = $blog;

    }

}