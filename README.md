# A Simple Chat Application Built Using Laravel Reverb

## Use
Clone this repo and run the migrations, composer install and npm install.  Log in with two different users in two different browser tabs and chat between the two.

```
php artisan reverb:start
```

### Other Considerations
Create users with tinker
```
php artisan tinker

User::factory(6)->create()

exit
```
The users are created with a default password of password.