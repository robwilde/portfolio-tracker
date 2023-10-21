## Install and run:
- `cp .env.example .env`
- `composer install`
- Set up your database
- You can create a free MarketStack account (if you want up-to-date market data) and fill out these values
  - `MARKET_STACK_ACCESS_KEY`
  - `MARKET_STACK_URI`
  - `MARKET_STACK_TIMEOUT`
- `php artisan migrate`
- `php artisan db:seed`. It will import the sample data from `storage/imports/transactions.csv`
- `php artisan serve`
- `npm install'
- `npm run dev`
- Login with `demo@portfolio.com` and `password`

It will import a dummy CSV full of demo transactions, so you have a lot of sample data. If you run the seeder you don't need to do anything else.
If you register a free Market Stack account and set the .env variables (see .env.example) it will also update the market data.

However, you can also run the imports manually.

## Imports:
`php artisan transaction:import`
- Import transactions from `storage/transactions.csv`
- Updates the holdings
- Updates the value of portfolios
- Also updates the special "aggregate" portfolios

`php artisan dividend:import`
- Imports only the dividend payouts from `storage/transactions.csv`

`php artisan market-stack:update-market-values`
- Updates every holding's market value from Market Stack using the current market price

`php artisan market-stack:update-dividends`
- Updates every stock's dividend data from Market Stack using the current dividend
