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
        $this->call(UsersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(SupportVendorsTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
        $this->call(MonitorsTableSeeder::class);
        $this->call(CredentialsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(ScheduleTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(LinkedFacilitiesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
