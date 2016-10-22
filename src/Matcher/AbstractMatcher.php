<?php namespace Anomaly\VideoFieldType\Matcher;

use Anomaly\VideoFieldType\Matcher\Contract\MatcherInterface;

/**
 * Class AbstractMatcher
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
abstract class AbstractMatcher implements MatcherInterface
{

    /**
     * The provider.
     *
     * @var null|string
     */
    protected $provider = null;

    /**
     * Return the video ID from the video URL.
     *
     * @param $url
     * @return int
     */
    abstract public function id($url);

    /**
     * Return if the provided URL matches the vendor.
     *
     * @param $url
     * @return bool
     */
    abstract public function matches($url);

    /**
     * Return the embed URL for a given video URl.
     *
     * @param $url
     * @return string
     */
    abstract public function embed($url);

    /**
     * Return the embeddable iframe code for a given video ID.
     *
     * @param       $id
     * @param array $attributes
     * @return string
     */
    abstract public function iframe($id, array $attributes = []);

    /**
     * Get the provider.
     *
     * @return null|string
     */
    public function getProvider()
    {
        return $this->provider;
    }
}
