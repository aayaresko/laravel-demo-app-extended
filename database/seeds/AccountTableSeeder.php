<?php

use App\Models\Entities\Account;
use App\Models\Entities\AccountProfile;
use App\Models\Entities\Subscriptions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Account();
        $model->nickname = 'admin';
        $model->email = 'admin@test.com';
        $model->password = Hash::make('123456');
        $model->status = Account::STATUS_ACTIVE;
        $model->save();
        $profile = new AccountProfile();
        $profile->first_name = 'John';
        $profile->last_name = 'Doe';
        $profile->birth_date = '1980-08-19';
        $model->profile()->save($profile);
        $subscription = new Subscriptions();
        $subscription->posts = 0;
        $subscription->news = 0;
        $model->subscriptions()->save($subscription);

        $model = new Account();
        $model->nickname = 'aayaresko';
        $model->email = 'aayaresko@gmail.com';
        $model->password = Hash::make('123456');
        $model->status = Account::STATUS_ACTIVE;
        $model->save();
        $profile = new AccountProfile();
        $profile->first_name = 'Andrey';
        $profile->last_name = 'Yaresko';
        $profile->birth_date = '1980-08-19';
        $model->profile()->save($profile);
        $model->subscriptions()->save(new Subscriptions());
    }
}
