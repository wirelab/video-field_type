<?php namespace Anomaly\VideoFieldType\Matcher\Command;

use Anomaly\VideoFieldType\Matcher\Contract\MatcherInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;

/**
 * Class GetMatcher
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetMatcher
{

    /**
     * The video URL.
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new GetMatcher instance.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Handle the command.
     *
     * @param  Repository            $config
     * @param  Container             $container
     * @return MatcherInterface|null
     */
    public function handle(Repository $config, Container $container)
    {
        foreach ($config->get('anomaly.field_type.video::matchers') as $matcher) {
            if ($this->matches($matcher = $container->make($matcher))) {
                return $matcher;
            }
        }

        return null;
    }

    /**
     * Return the match result for the matcher.
     *
     * @param  MatcherInterface $matcher
     * @return bool
     */
    protected function matches(MatcherInterface $matcher)
    {
        return $matcher->matches($this->url);
    }
}
