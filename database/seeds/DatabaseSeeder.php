<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\UserConfirm;
use App\Models\Role;
use App\Models\Permission;
// Common Data
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Product;
use App\Models\StakeHolder;
use App\Models\Supplier;


class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add roles
            foreach ($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'Admin') {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                // create one user for each role
                $this->createUser($role);
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully');
        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }

        $roleUser = Role::where("name", trim("User"))->first();
        for ($i = 1; $i <= 100; $i++) {
            $this->createUser($roleUser);
        }

        // now lets seed some posts for demo
        $this->createData();
        $this->command->info('Some data seeded.');
        $this->command->warn('All done :)');
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role) {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'Admin') {
            $_user = User::where("id", $user->id)->first();
            $_user->email = "admin@admin.com";
            $_user->username = "admin";
            $_user->save();
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($_user->username);
            $this->command->warn('Password is "secret"');
        }

        UserConfirm::create([
            'user_id' => $user->id,
            'token' => base64_encode($user->email)
        ]);
    }

    // Seed App Data
    private function createData() {
        for ($i = 1; $i <= 100; $i++) {

            $faker = Faker::create();

            $bank = Bank::create([
                "code" => rand(1000, 9999),
                "name" => $faker->name,
                "description" => $faker->text
            ]);

            $brand = Brand::create([
                "name" => $faker->name,
                "description" => $faker->text
            ]);

            $category = Category::create([
                "name" => $faker->name,
                "description" => $faker->text
            ]);
            
            $customer = Customer::create([
                'name'=> $faker->name,
                'email'=> $faker->email,
                'phone'=> $faker->phoneNumber,
                'mobile'=> $faker->phoneNumber,
                'postal_code'=>$faker->creditCardNumber,
                'fax_number'=>$faker->creditCardNumber,
                'address'=>$faker->address,
            ]);
            
            $group = Group::create([
                "name" => $faker->name,
                "description" => $faker->text
            ]);
            
            
            
            $stakeholder = StakeHolder::create([
                'name'=> $faker->name,
                'email'=> $faker->email,
                'phone'=> $faker->phoneNumber,
                'mobile'=> $faker->phoneNumber,
                'postal_code'=>$faker->creditCardNumber,
                'fax_number'=>$faker->creditCardNumber,
                'address'=>$faker->address,
            ]);
            
            $supplier = Supplier::create([
                'name'=> $faker->name,
                'email'=> $faker->email,
                'phone'=> $faker->phoneNumber,
                'mobile'=> $faker->phoneNumber,
                'postal_code'=>$faker->creditCardNumber,
                'fax_number'=>$faker->creditCardNumber,
                'address'=>$faker->address,
            ]);
            
            $purchase = rand(1000,9999);
            $profit = rand(10,100);
            $sale = $purchase + (($profit / 100) * $purchase);

            $sku = "PR".rand(1000, 9999)."".date("Ymd");

            $check = Product::where("sku", $sku)->first();
            
            if(is_null($check)){
                $product = Product::create([
                    'category_id'=> $category->id,
                    'group_id'=> $group->id,
                    'brand_id'=> $brand->id,
                    'sku'=> $sku,
                    'name'=> $faker->name,
                    'price_profit'=> $profit,
                    'price_purchase'=> $purchase,
                    'price_sale'=> $sale,
                    'stock'=> 0,
                    'notes'=> $faker->text,
                    'description'=>$faker->text
                ]);
            }
            
            
        }
    }

}
