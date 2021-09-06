

## initialisation

For install this app: 

- clone repository.
- run cp .env.example .env
- run php artisan key:generate.
- setup database in .env.
- run php artisan migrate:fresh --seed.

## Functionality

You can : 

- **display all news(50) paginate by 10**
- **create news**
- **update news**
- **request datas are backend validated**
- **delete news**
- **within 5 seconds you can undo delete news**
- **add existing tags(10) to a news or add newly created**
- **search in tags list on title nor content**
- **filter news by tags**
