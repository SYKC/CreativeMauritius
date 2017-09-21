![LOGO](https://res.cloudinary.com/xdisrupt/image/upload/v1502990223/creativemauritius.com/momentale_logo.png)
# Momentale 
###### Redefining online storytelling.
Momentale is a simple and intuitive content managing platform focused on improving storytelling through realtime collaborative writing. Momentale is built on top of Laravel framework and thus makes it highly modular in terms of developing themes and plugins.

##How to install
###Step 1: Clone the repository
```bash
git clone https://VEEGISHx@bitbucket.org/VEEGISHx/momentale.git
```

###Step 2: Install Dependencies
```bash
composer install
```

###Step 3: Generate a new Application Key
```bash
php artisan key:generate
```

###Step 4: Run Migrations
```bash
php artisan migrate
```

###Step 5: Install Node Modules
```bash
npm install
```

###Step 6: Compiling assets
Run the following command to compile all assets specified in gulpfile.js
```bash
gulp watch
```

If an error occurs then run this command:

```bash
npm rebuild node-sass
```