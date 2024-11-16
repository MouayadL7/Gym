<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptions = [
            ['name' => 'Basic', 'price' => 165],
            ['name' => 'Premium', 'price' => 200],
            ['name' => 'VIP', 'price' => 365],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::firstOrCreate(
                ['name' => $subscription['name']],
                ['price' => $subscription['price']]
            );
        }
    }
}
