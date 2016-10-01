<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 26.08.16
 * Time: 20:46
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $table = 'chat_messages';

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'author_id',
    ];

    /**
     * {@inheritdoc}
     *
     * @return static
     */
    public function author()
    {
        return $this->belongsTo(Account::class, 'author_id');
    }

    /**
     * @return string
     */
    public function getCreatedAttribute()
    {
        $decorator = new DateFormatDecorator($this);
        return $decorator->formatAttributeValue('created_at');
    }
}