# Flight Info
This full stack web app is a simple review site for airline routes. Users can browse reviews for any airport pair and commercial airline in the world. They can also create an account and post their own reviews.

## Tech Stack
* Apache
* MYSQL (MariaDB)
* PHP
* JQuery

## Deployment Instructions
1. Place the project files in the application folder located in your server
2. Install dependencies
```bash
composer install
```
2. Set up MYSQL tables
```sql
CREATE TABLE user (
    id int AUTO_INCREMENT,
    username varchar(255),
    password varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE review (
    id int AUTO_INCREMENT,
    dep varchar(255),
    arr varchar(255),
    airline varchar(255),
    author varchar(255),
    summary text,
    review_text text, 
    rating int,
    user_id int,
    timestamp datetime,
    PRIMARY KEY (id)
);
```

3. Configure .env file using .env.example
```.env
MY_SQL_HOST="mysqlhost"
MY_SQL_DBNAME="mysqldbname"
MY_SQL_USER="mysqlusername"
MY_SQL_PASSWORD="mysqlpassword"
CLOUDINARY_CLOUD_NAME="mycloudinaryname"
CLOUDINARY_API_KEY="mycloudinaryapikey"
CLOUDINARY_API_SECRET="mycloudinarysecret"
```

4. Create a folder named "user_thumbnails" in your Cloudinary media library or alternatively change the default folder to whichever name you prefer in **controllers/helpers/cloudinary.php**

5. Configure **views/.htaccess** file with a 404 redirect of your choice
```.htaccess
RewriteRule  ^(.+)$ yourdomain [QSA,L]
```

6. Load the homepage and create the first user with username "administrator"

7. Login as "administrator"

8. Seed the user table by going to the Admin page (link is on nav bar) and clicking the button (takes a few minutes to complete)

## About Seed Data
Once the application is properly configured, the search controller (**controllers/review/search.php**) seeds reviews as needed in order to mimic a real production review site. 

When a user search is made, the controller will populate the route in question with seed reviews if there's less than 2 search results. The airlines, users, review text as well as the volume of seed data are picked at random. This can be turned off by commenting out the below code from the controller:
```php
//Create fake reviews if $reviews is empty
if (count($searchResults) < 2) {
    require_once('seedreviews.php');
}
```

## Licence
This project is licensed under the terms of the MIT license.




