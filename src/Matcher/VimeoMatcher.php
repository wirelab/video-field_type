<?php namespace Anomaly\VideoFieldType\Matcher;

use Anomaly\VideoFieldType\Matcher\Contract\MatcherInterface;

/**
 * Class VimeoMatcher
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\VideoFieldType\Matcher
 */
class VimeoMatcher implements MatcherInterface
{
    /**
     * Return the video ID from the video URL.
     *
     * @param $url
     * @return int
     */
    public function id($url)
    {
        return substr(parse_url($url, PHP_URL_PATH), 1);
    }

    /**
     * Return if the provided URL matches the vendor.
     *
     * @param $url
     * @return bool
     */
    public function matches($url)
    {
        return str_contains($url, 'vimeo.com');
    }

    /**
     * Return the embed URL for a given video URl.
     *
     * @param $url
     * @return string
     */
    public function embed($url)
    {
        return 'https://player.vimeo.com/video/' . $this->id($url);
    }

    /**
     * Return the embeddable iframe code for a given video ID.
     *
     * @param $id
     * @param array $options
     * @return string
     */
    public function iframe($id, array $options = [])
    {
        return '<iframe
            frameborder="0"
            src="https://player.vimeo.com/video/' . $id . '"
            width="' . array_get($options, 'width', 560) . '"
            height="' . array_get($options, 'height', 315) . '"
            style="' . array_get($options, 'style', '') . '""
            ' . array_get($options, 'options', 'allowfullscreen') . '></iframe>';
    }
}
