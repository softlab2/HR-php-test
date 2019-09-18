<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Weather extends AbstractWidget
{
    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 0;
    
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'name' => '',
        'point' => [],
        'ajaxTimeout' => 0,
    ];

    public function __construct(array $config = [])
    {
        $this->addConfigDefaults([
            'name' => config('weather.default_name'),
            'point' => config('weather.default_point'),
            'ajaxTimeout' => 0,
        ]);
        
        if(!empty($config['reload'])) {
            $this->reloadTimeout = $config['reload'];
        }

        parent::__construct($config);
    }
    
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.weather', [
            'config' => $this->config,
        ]);
    }

    public function placeholder()
    {
        return 'Loading...';
    }
}
