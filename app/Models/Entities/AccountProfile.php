<?php

namespace App\Models\Entities;

use App\Components\Decorators\CombineAttributesDecorator;
use App\Components\Extra\StoresImages;
use Illuminate\Database\Eloquent\Model;

class AccountProfile extends Model
{
    use StoresImages;

    protected $table = 'account_profile';
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
    ];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * @return null|string
     */
    public function getFullNameAttribute()
    {
        $string = $this->getFormattedFullName();
        if (trim($string)) {
            return $string;
        } elseif ($this->account) {
            return $this->account->email;
        } else {
            return null;
        }
    }

    /**
     * Stores profile full name.
     *
     * Parses `$string` and split it to a 'first_name' and 'last_name'.
     *
     * @param $string
     */
    public function setFullNameAttribute($string)
    {
        $items = explode(' ', $string);
        $count = count($items);
        switch ($count) {
            case 1:
                $this->first_name = $items;
                break;
            case 2:
                list($this->first_name, $this->last_name) = $items;
        }
    }

    /**
     * @param string $template
     * @return mixed
     */
    public function getFormattedFullName($template = '{first_name} {last_name}')
    {
        $decorator = new CombineAttributesDecorator($this);
        return $decorator->formatString($template);
    }
}
