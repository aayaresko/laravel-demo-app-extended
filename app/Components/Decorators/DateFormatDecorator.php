<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 18.08.16
 * Time: 21:09
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Decorators;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

/**
 * Class DateFormatDecorator.
 *
 * Works with dates.
 * Format timestamp as a string in human readable format.
 *
 * @package App\Components\Decorators
 */
class DateFormatDecorator extends BaseDecorator
{
    public $time_format = '%H:%M';

    protected $offset = 0;

    /**
     * DateFormatDecorator constructor.
     *
     * {@inheritdoc}
     *
     * @param mixed $model
     */
    public function __construct($model)
    {
        parent::__construct($model);
        $this->offset = session('browser_timezone_offset', 0);
    }

    /**
     * Generates a date string.
     *
     * It based on value of specified attribute and diff between 'today' and 'that day'.
     * Will return 'Today at 19:20:10' if attribute value day is the same as now.
     * Will return 'Yesterday at 19:20:10' if attribute value day is smaller then now.
     * In any other cases will return something like '25 January at 19:20:10'.
     * It use offset of user's browser timezone from session storage to adjust date look.
     * It doesn't change attribute value of the model.
     *
     * @param string $attribute
     * @return string
     */
    public function formatAttributeValue($attribute)
    {
        $value = $this->model->{$attribute};
        if ($value) {
            if ($value instanceof Carbon) {
                $container = $value;
            } else {
                $container = new Carbon($value);
            }
            if ($this->offset > 0) {
                $container->addSeconds($this->offset);
            } elseif ($this->offset < 0) {
                $container->subSeconds($this->offset);
            }
            $container->setLocale(App::getLocale());
            if ($container->isToday()) {
                $part = trans('content.created_at', ['day' => trans('content.today')]);
            } elseif ($container->isYesterday()) {
                $part = trans('content.created_at', ['day' => trans('content.yesterday')]);
            } else {
                $part = $container->formatLocalized('%e %B');
            }
            return "{$part} {$container->formatLocalized('%H:%M')}";
        }
    }
}