<?php

namespace App\Models\Concerns;

trait HasYoutubeUrl
{
    /**
     * Isolate the youtube ID from url.
     *
     * @return mixed|null
     */
    public function getYoutubeId()
    {
        $url = $this->getYoutubeUrl();

        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

        return $my_array_of_vars['v'] ?? null;
    }

    /**
     * Retrieve the youtube thumbnail url.
     *
     * @return string
     */
    public function getYoutubeThumbnail()
    {
        $id = $this->getYoutubeId();

        return "https://img.youtube.com/vi/{$id}/mqdefault.jpg";
    }

    /**
     * Retrieve the youtube embed url.
     *
     * @param int $autoplay
     * @return string
     */
    public function getYoutubeEmbedUrl($autoplay = 0)
    {
        $id = $this->getYoutubeId();

        return "https://www.youtube.com/embed/{$id}?autoplay={$autoplay}";
    }

    /**
     * Get the youtube url.
     *
     * @return string
     */
    public function getYoutubeUrl()
    {
        return property_exists($this, 'youtube_field') ? $this->youtube_field : $this->youtube_url;
    }
}
