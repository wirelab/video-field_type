<?php namespace Anomaly\VideoFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\VideoFieldType\Matcher\Command\GetMatcher;
use Anomaly\VideoFieldType\Matcher\Contract\MatcherInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class VideoFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\VideoFieldType
 */
class VideoFieldTypePresenter extends FieldTypePresenter
{

    use DispatchesJobs;

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var VideoFieldType
     */
    protected $object;

    /**
     * Return the embed iframe.
     *
     * @param array $extra
     * @return PluginCriteria
     */
    public function iframe(array $extra = [])
    {
        if (!$this->object->getValue()) {
            return null;
        }

        /* @var MatcherInterface $matcher */
        $matcher = $this->dispatch(new GetMatcher($this->object->getValue()));

        return new PluginCriteria(
            'render',
            function (Collection $options) use ($matcher, $extra) {
                return $matcher->iframe($matcher->id($this->object->getValue()), $options->merge($extra)->all());
            }
        );
    }

    /**
     * Return the embed iframe.
     *
     * @param array $extra
     * @return PluginCriteria
     */
    public function fluid(array $extra = [])
    {
        if (!$this->object->getValue()) {
            return null;
        }

        /* @var MatcherInterface $matcher */
        $matcher = $this->dispatch(new GetMatcher($this->object->getValue()));

        return new PluginCriteria(
            'render',
            function (Collection $options) use ($matcher, $extra) {

                $extra['style'] = 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;';

                return '<div style="position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden;">'.$matcher->iframe($matcher->id($this->object->getValue()), $options->merge($extra)->all()).'</div>';
            }
        );
    }

    /**
     * Return the embed URL.
     *
     * @return string
     */
    public function embed()
    {
        if (!$this->object->getValue()) {
            return null;
        }

        /* @var MatcherInterface $matcher */
        $matcher = $this->dispatch(new GetMatcher($this->object->getValue()));

        return $matcher->embed($this->object->getValue());
    }

    /**
     * Return the video ID.
     *
     * @return int
     */
    public function id()
    {
        if (!$this->object->getValue()) {
            return null;
        }

        /* @var MatcherInterface $matcher */
        $matcher = $this->dispatch(new GetMatcher($this->object->getValue()));

        return $matcher->id($this->object->getValue());
    }
}
