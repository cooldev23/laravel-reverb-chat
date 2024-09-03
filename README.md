# A Simple Chat Application Built Using Laravel Reverb

## Use
Clone this repo
```
git clone https://github.com/cooldev23/laravel-reverb-chat.git
```
Composer install
```
composer install
```
Install dependencies and compile assets
```
npm install && npm run dev
```
Set application key
```
php artisan key:generate
```
Run the migrations
```
php artisan migrate
```
Start the websocket listener
```
php artisan reverb:start
```
Log in with two different users in two different browser tabs and chat between the two.

### Other Considerations
Create users with tinker
```
php artisan tinker

User::factory(6)->create()

exit
```
The users are created with a default password of password.