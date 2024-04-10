import { settingsLayoutTypes } from '@/shared/models/types/settings'

export const defaultCurrencyYouSend = {
  "id": 5,
  "name": "BTC",
  "units": 8,
  "image": "/icons/Bitcoin.png",
  "data": {
      "titles": {
          "ru": "Bitcoin BTC",
          "en": "Bitcoin BTC"
      }
  },
  "tag": "crypto"
}

export const defaultCurrencyYouGet = {
  "id": 6,
  "name": "ETH",
  "units": 8,
  "image": "/icons/Ethereum.png",
  "data": {
      "titles": {
          "ru": "Ethereum ETH",
          "en": "Ethereum ETH"
      }
  },
  "tag": "crypto"
}

export const settingsLayouts:settingsLayoutTypes[] = [
  'first_name', 
  'second_name', 
  'last_name',
  'email',
  'phone',
  'telegram',
  'from_address',
  'to_address',
  'from_card',
  'to_card',
  'passport',
]