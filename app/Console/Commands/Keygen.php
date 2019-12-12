<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Keygen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:keygen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate keys';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('This will invalidate all tokens. Are you sure you want to continue?')) {
            $config = array(
                "digest_alg" => "RS256",
                "private_key_bits" => 4096,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,
            );
            
            // Create the private and public key
            $res = openssl_pkey_new($config);

            // Extract the private key from $res to $privKey
            (openssl_pkey_export($res, $privKey));

            // Extract the public key from $res to $pubKey
            $pubKey = openssl_pkey_get_details($res);

            file_put_contents('storage/id_rsa', $privKey);
            file_put_contents('storage/id_rsa.pub', $pubKey["key"]);

            echo "Keys generated\n\n";
        }
    }
}
