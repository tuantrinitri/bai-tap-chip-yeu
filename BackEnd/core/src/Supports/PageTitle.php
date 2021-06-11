<?php

namespace Core\Supports;

class PageTitle
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @param $title
     *
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param bool $full
     * @return string
     *
     */
    public function getTitle($full = true)
    {
        if (empty($this->title)) {
            return setting('site_name', config('cms.site_name'));
        }

        if (!$full) {
            return $this->title;
        }

        return $this->title . ' | ' . setting('site_name', config('cms.site_name'));
    }
}