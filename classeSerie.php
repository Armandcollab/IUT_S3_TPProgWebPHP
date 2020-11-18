<?php
    class Series
    {
        protected $id;
        protected $title;
        protected $poster;
        public function __get($name)
        {
            return $this->{$name};
        }
    };