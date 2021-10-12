<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        try {
            DB::connection()->getPdo();
            if(Schema::hasTable('configurations')){
                if(DB::connection()->getDatabaseName()){

                    $driver = $this->getConfig("mail-driver");
                    $host = $this->getConfig("mail-host");
                    $port = $this->getConfig("mail-port");
                    $username = $this->getConfig("mail-username");
                    $password = $this->getConfig("mail-password");
                    $form_address = $this->getConfig("mail-address");
                    $form_name = $this->getConfig("mail-name");
                    $encryption = $this->getConfig("mail-encryption");
    
                    $config = array(
                        'driver'     =>  trim($driver),
                        'host'       =>  trim($host),
                        'port'       => trim($port),
                        'from'       => array('address' => trim($form_address), 'name' => trim($form_name)),
                        'encryption' => trim($encryption),
                        'username'   => trim($username),
                        'password'   => trim($password),
                        'sendmail'   => '/usr/sbin/sendmail -bs',
                        'pretend'    => false,
                    );
    
                    Config::set('mail', $config);
                    
                }else{
                    die("Could not find the database. Please check your configuration.");
                }
            }
        } catch (\Exception $e) {
            die("Could not open connection to database server.  Please check your configuration.");
        }
    }

    private function getConfig($slug){
        $data = DB::table("configurations")->where("slug", $slug)->first();
        return is_null($data) ? $slug : $data->content;
    }
}