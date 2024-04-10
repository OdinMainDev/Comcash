import { ICurrency } from "./models/interfaces"

export const defaultCryptoYouGet: ICurrency = {
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
export const defaultCryptoYouSend: ICurrency = {
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

export const defaultCryptoYouPay = {
  id: 5,
  name: 'BTC',
  units: 8,
  image: '/icons/Bitcoin.png',
  tag: 'crypto',
  data: {
    titles: {
      en: 'BTC',
      ru: 'BTC'
    }
  }
}

export const defaultCryptoYouBuy = {
  id: 6,
  name: 'ETH',
  units: 8,
  image: '/icons/Ethereum.png',
  tag: 'crypto',
  data: {
    titles: {
      en: 'ETH',
      ru: 'ETH'
    }
  }
}