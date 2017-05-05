<?php namespace Anomaly\VideoFieldType\Matcher;

class FlipbaseMatcher extends AbstractMatcher
{
    protected $provider = 'Flipbase';

    public function id($url)
    {
        $segments = explode('/', substr(parse_url($url, PHP_URL_PATH), 1));
        $host_segments = explode('.', parse_url($url, PHP_URL_HOST));

        return $host_segments[0] . ':' . end($segments);
    }

    public function matches($url)
    {
        return str_contains($url, 'flipbase.com');
    }

    public function embed($url)
    {
        $id = explode(':', $this->id($url));
        return 'https://'.$id[0].'.flipbase.com/embed/'.$id[1];
    }

    public function iframe($id, array $attributes = [])
    {
        $segments = explode(':', $id);
        return '<iframe
            frameborder="0"
            src="https://'.$segments[0].'.flipbase.com/embed/'.$segments[1].'"
            ' . $this->html->attributes($attributes) . '></iframe>';
    }

    public function cover($id)
    {
        dd('not yet implemented');
        return '';
    }

    public function image($id, $image = null)
    {
        dd('not yet implemented');
        return '';
    }
}
