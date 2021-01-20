<?php


namespace App\Core;


class Controller
{
    /** @var View */
    protected $view;

    /**
     * Controller constructor.
     * @param string|null $pathToViews
     */
    public function __construct(string $pathToViews = null)
    {
        $this->view = new View($pathToViews);
    }
}