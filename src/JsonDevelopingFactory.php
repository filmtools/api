<?php
namespace FilmTools\HttpApi;

class JsonDevelopingFactory {

    /**
     * @return JsonDeveloping
     */
    public function __invoke()
    {
        return new JsonDeveloping;
    }
}
