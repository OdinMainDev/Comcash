<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Direction;
use App\Models\Merchant;
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
        $currencies = [
            [
                "id" => 1,
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Visa-Master.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Visa/MasterCard RUB",
                        "en" => "Visa/MasterCard RUB",
                    ]
                ]),
                "tag" => "fiat",
                "created_at" => now()
            ],
            [
                "id" => 2,
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Cash.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Наличные RUB",
                        "en" => "Cash RUB",
                    ]
                ]),
                "tag" => "fiat",
                "created_at" => now()
            ],
            [
                "id" => 3,
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Tinkoff.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Тинькофф RUB",
                        "en" => "Tinkoff RUB",
                    ]
                ]),
                "tag" => "fiat",
                "created_at" => now()
            ],
            [
                "id" => 4,
                "name" => "RUB",
                "units" => 2,
                "image" => "/icons/Sberbank.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Сбербанк RUB",
                        "en" => "Sberbank RUB",
                    ]
                ]),
                "tag" => "fiat",
                "created_at" => now()
            ],
            [
                "id" => 5,
                "name" => "BTC",
                "units" => 8,
                "image" => "/icons/Bitcoin.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Bitcoin BTC",
                        "en" => "Bitcoin BTC",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 6,
                "name" => "ETH",
                "units" => 8,
                "image" => "/icons/Ethereum.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Ethereum ETH",
                        "en" => "Ethereum ETH",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 7,
                "name" => "USDT",
                "units" => 2,
                "image" => "/icons/Tether.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Tether ERC20 USDT",
                        "en" => "Tether ERC20 USDT",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 8,
                "name" => "USDT",
                "units" => 2,
                "image" => "/icons/Tether.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Tether TRC20 USDT",
                        "en" => "Tether TRC20 USDT",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 9,
                "name" => "DAI",
                "units" => 2,
                "image" => "/icons/Dai.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Dai DAI",
                        "en" => "Dai DAI",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 10,
                "name" => "ADA",
                "units" => 8,
                "image" => "/icons/Cardano.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Cardano ADA",
                        "en" => "Cardano ADA",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 11,
                "name" => "XRP",
                "units" => 8,
                "image" => "/icons/Ripple.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Ripple XRP",
                        "en" => "Ripple XRP",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 12,
                "name" => "LTC",
                "units" => 8,
                "image" => "/icons/Litecoin.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Litecoin LTC",
                        "en" => "Litecoin LTC",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 13,
                "name" => "LINK",
                "units" => 8,
                "image" => "/icons/Chainlink.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Chainlink LINK",
                        "en" => "Chainlink LINK",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 14,
                "name" => "BCH",
                "units" => 8,
                "image" => "/icons/Bitcoin-cash.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Bitcoin Cash BCH",
                        "en" => "Bitcoin Cash BCH",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 15,
                "name" => "XLM",
                "units" => 8,
                "image" => "/icons/Stellar.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Stellar XLM",
                        "en" => "Stellar XLM",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 16,
                "name" => "TRX",
                "units" => 8,
                "image" => "/icons/Tron.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "TRON TRX",
                        "en" => "TRON TRX",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 17,
                "name" => "DOGE",
                "units" => 8,
                "image" => "/icons/Dogecoin.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Dogecoin DOGE",
                        "en" => "Dogecoin DOGE",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 18,
                "name" => "SOL",
                "units" => 8,
                "image" => "/icons/Solana.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Solana SOL",
                        "en" => "Solana SOL",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 19,
                "name" => "MATIC",
                "units" => 8,
                "image" => "/icons/Polygon.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Polygon MATIC",
                        "en" => "Polygon MATIC",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ],
            [
                "id" => 20,
                "name" => "XMR",
                "units" => 8,
                "image" => "/icons/Monero.png",
                "data" => json_encode([
                    "titles" => [
                        "ru" => "Monero XMR",
                        "en" => "Monero XMR",
                    ]
                ]),
                "tag" => "crypto",
                "created_at" => now()
            ]
        ];
        Currency::truncate();
        Currency::insert($currencies);

        Merchant::truncate();
        Merchant::insert([
            [
                "id" => 1,
                "name" => "Garantex",
                "type" => "garantex",
                "status" => false,
                "created_at" => now()
            ],
            [
                "id" => 2,
                "name" => "MPCVip",
                "type" => "mpcvip",
                "status" => false,
                "created_at" => now()
            ],
            [
                "id" => 3,
                "name" => "Binance",
                "type" => "binance",
                "status" => false,
                "created_at" => now()
            ],
        ]);

        $directions = [];
        $position = 1;
        foreach($currencies as $currency){
            foreach($currencies as $currency2){
                if($currency2['name'] == $currency['name']){
                    continue;
                }
                $name =  json_decode($currency['data'], true)['titles']['en'];
                $name .= " → ";
                $name .= json_decode($currency2['data'], true)['titles']['en'];
                $merchant_from = 3;
                if(in_array($currency['name'], ["BTC", "ETH", "USDT", "DAI"])){
                    $merchant_from = 1;
                }
                if($currency['name'] == "RUB"){
                    $merchant_from = 2;
                }

                $merchant_to = 3;
                if(in_array($currency2['name'], ["BTC", "ETH", "USDT", "DAI"])){
                    $merchant_to = 1;
                }
                if($currency2['name'] == "RUB"){
                    $merchant_to = 2;
                }
                $directions[] = [
                    "name" => $name,
                    "currency_from" => $currency['id'],
                    "currency_to" => $currency2['id'],
                    "merchant_from" => $merchant_from,
                    "merchant_to" => $merchant_to,
                    "position" => $position,
                    "status" => false,
                    "profit_percent" => 5.00,
                    "data" => json_encode([

                    ]),
                    "created_at" => now()
                ];
                $position++;
            }
        }


        
        Direction::truncate();
        Direction::insert($directions);
    }
}
