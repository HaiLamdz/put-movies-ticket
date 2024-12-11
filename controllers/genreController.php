<?php
class genreControler
{
    public $modelGenre;

    public function __construct()
    {
        $this->modelGenre = (new modelGenre);
    }

    public function listGenres()
    {
        $genres = $this->modelGenre->getAllGenre();
    }
}