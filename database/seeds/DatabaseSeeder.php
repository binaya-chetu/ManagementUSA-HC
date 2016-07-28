<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AppointmentSourcesTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(CategoryAdOnsSeeder::class);
         $this->call(CategoryTypesSeeder::class);
         $this->call(FollowupStatusTableSeeder::class);
         $this->call(InvoiceTableSeeder::class);
         $this->call(OrderDetailsTableSeeder::class);
         $this->call(OrderTableSeeder::class);
         $this->call(PaymentTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(ReasonCodesTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(StatesTableSeeder::class);
         $this->call(WebLeadsTableSeeder::class);
    }
}
