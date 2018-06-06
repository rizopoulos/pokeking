## PokeKing Readme

After you have cloned the project, run:
`composer install`

Change database configuration
Inside `.env` file make the appropriate changes

```
DB_CONNECTION=mysql
DB_HOST=192.168.1.3
DB_PORT=3306
DB_DATABASE=pokeking
DB_USERNAME=root
DB_PASSWORD=123456
```

After run `php artisan migrate` to run all the migrations

## Populate the database

In order to collect all pokemon names and urls run the following seeder.

`php artisan db:seed --class=PokemonsTableSeeder`

In order to retrieve pokemon profiles run the following seeder.

`php artisan db:seed --class=PokemonProfilesTableSeeder`

## See the results

Go to `http://localhost/{YOUR_REPO_FOLDER}/public/pokemons/` to see the Pokemons table