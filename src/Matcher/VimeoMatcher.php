<?php namespace Anomaly\VideoFieldType\Matcher;

use Collective\Html\HtmlBuilder;

/**
 * Class VimeoMatcher
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VimeoMatcher extends AbstractMatcher
{

    /**
     * The provider.
     *
     * @var string
     */
    protected $provider = 'Vimeo';

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
        $segments = explode('/', substr(parse_url($url, PHP_URL_PATH), 1));

        return end($segments);
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
     * @param       $id
     * @param array $attributes
     * @return string
     */
    public function iframe($id, array $attributes = [])
    {
        return '<iframe
            frameborder="0"
            src="https://player.vimeo.com/video/' . $id . '"
            ' . $this->html->attributes($attributes) . '></iframe>';
    }
}
