## PokeKing Readme

After you have cloned the project, run:
1. `composer install`
2. `php artisan migrate`

In order to collect all pokemon names and urls run the following seeder.
`php artisan db:seed --class=PokemonsTableSeeder`

In order to retrieve pokemon profiles run the following seeder.
`php artisan db:seed --class=PokemonProfilesTableSeeder`


