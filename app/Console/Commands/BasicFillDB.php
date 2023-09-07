<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;

class BasicFillDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:basic-fill-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Basic fill data to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Currency::truncate();
        Currency::insert([
            [
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Visa-Master.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Visa/MasterCard RUB",
                        "en" => "Visa/MasterCard RUB",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Cash.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Наличные RUB",
                        "en" => "Cash RUB",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Tinkoff.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Тинькофф RUB",
                        "en" => "Tinkoff RUB",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Sberbank.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Сбербанк RUB",
                        "en" => "Sberbank RUB",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "BTC",
                "units" => 8,
                "image" => "/icons/Bitcoin.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Bitcoin BTC",
                        "en" => "Bitcoin BTC",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "ETH",
                "units" => 8,
                "image" => "/icons/Ethereum.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Ethereum ETH",
                        "en" => "Ethereum ETH",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "USDT",
                "units" => 2,
                "image" => "/icons/Tether.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Tether ERC20 USDT",
                        "en" => "Tether ERC20 USDT",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "USDT",
                "units" => 2,
                "image" => "/icons/Tether.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Tether TRC20 USDT",
                        "en" => "Tether TRC20 USDT",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "DAI",
                "units" => 2,
                "image" => "/icons/Dai.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Dai DAI",
                        "en" => "Dai DAI",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "ADA",
                "units" => 8,
                "image" => "/icons/Cardano.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Cardano ADA",
                        "en" => "Cardano ADA",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "XRP",
                "units" => 8,
                "image" => "/icons/Ripple.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Ripple XRP",
                        "en" => "Ripple XRP",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "LTC",
                "units" => 8,
                "image" => "/icons/Litecoin.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Litecoin LTC",
                        "en" => "Litecoin LTC",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "LINK",
                "units" => 8,
                "image" => "/icons/Chainlink.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Chainlink LINK",
                        "en" => "Chainlink LINK",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "BCH",
                "units" => 8,
                "image" => "/icons/Bitcoin-cash.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Bitcoin Cash BCH",
                        "en" => "Bitcoin Cash BCH",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "XLM",
                "units" => 8,
                "image" => "/icons/Stellar.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Stellar XLM",
                        "en" => "Stellar XLM",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "TRX",
                "units" => 8,
                "image" => "/icons/Tron.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "TRON TRX",
                        "en" => "TRON TRX",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "DOGE",
                "units" => 8,
                "image" => "/icons/Dogecoin.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Dogecoin DOGE",
                        "en" => "Dogecoin DOGE",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "SOL",
                "units" => 8,
                "image" => "/icons/Solana.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Solana SOL",
                        "en" => "Solana SOL",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "MATIC",
                "units" => 8,
                "image" => "/icons/Polygon.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Polygon MATIC",
                        "en" => "Polygon MATIC",
                    ]
                ]),
                "created_at" => now()
            ],
            [
                "name" => "XMR",
                "units" => 8,
                "image" => "/icons/Monero.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Monero XMR",
                        "en" => "Monero XMR",
                    ]
                ]),
                "created_at" => now()
            ]
        ]);
    }
}
