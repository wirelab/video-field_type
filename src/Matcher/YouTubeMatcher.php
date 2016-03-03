<?php namespace Anomaly\VideoFieldType\Matcher;

use Anomaly\VideoFieldType\Matcher\Contract\MatcherInterface;
use Collective\Html\HtmlBuilder;

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
     * The HTML utility.
     *
     * @var HtmlBuilder
     */
    protected $html;

    /**
     * Create a new VimeoMatcher instance.
     *
     * @param HtmlBuilder $html
     */
    public function __construct(HtmlBuilder $html)
    {
        $this->html = $html;
    }

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
     * @param array $attributes
     * @return string
     */
    public function iframe($id, array $attributes = [])
    {
        return '<iframe
            frameborder="0"
            src="https://www.youtube.com/embed/' . $id . '"
            ' . $this->html->attributes($attributes) . '></iframe>';
    }
}
