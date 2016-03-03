<?php namespace Anomaly\VideoFieldType\Matcher;

use Anomaly\VideoFieldType\Matcher\Contract\MatcherInterface;

/**
 * Class YouTubeMatcher
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\VideoFieldType\Matcher
 */
class YouTubeMatcher implements MatcherInterface
{
    /**
     * Return the video ID from the video URL.
     *
     * @param $url
     * @return int
     */
    public function id($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);

        return array_get($query, 'v');
    }

    /**
     * Return if the provided URL matches the vendor.
     *
     * @param $url
     * @return bool
     */
    public function matches($url)
    {
        return str_contains($url, 'youtube.com');
    }

    /**
     * Return the embed URL for a given video URl.
     *
     * @param $url
     * @return string
     */
    public function embed($url)
    {
        return 'https://www.youtube.com/embed/' . $this->id($url);
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
            width="' . array_get($options, 'width') . '"
            height="' . array_get($options, 'height') . '"
            src="https://www.youtube.com/embed/' . $id . '"
            frameborder="0"
            ' . array_get($options, 'options', 'allowfullscreen') . '></iframe>';
    }
}
