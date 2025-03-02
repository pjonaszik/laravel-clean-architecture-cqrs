<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\SimpleCache\InvalidArgumentException;
use Exception;

class GenerateEncryptionKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:generate-encryption-keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates or rotates RSA encryption keys securely and caches them.';

    /**
     * Execute the console command.
     * @throws InvalidArgumentException
     * @throws \SodiumException
     */
    public function handle(): void
    {
        $this->info('🔐 Generating new EdDSA key pair');
        // Write keys to files
        try {
            $keyPair = sodium_crypto_sign_keypair();
            $privateKey = base64_encode(sodium_crypto_sign_secretkey($keyPair));
            $publicKey = base64_encode(sodium_crypto_sign_publickey($keyPair));

            // Store the private and public keys separately
            cache()->forever('private_key', $privateKey);
            cache()->forever('public_key', $publicKey);
            // Convert to PEM format
//            $publicPem = "-----BEGIN PUBLIC KEY-----\n" . chunk_split(base64_encode($publicKey), 64, "\n") . "-----END PUBLIC KEY-----";
//            $privatePem = "-----BEGIN PRIVATE KEY-----\n" . chunk_split(base64_encode($privateKey), 64, "\n") . "-----END PRIVATE KEY-----";

        } catch (Exception $e) {
            $this->error('❌ Error generating public/private keys: ' . $e->getMessage());
            return;
        }

        $this->info('✅ EdDSA key pair successfully generated, and cached.');
    }
}
