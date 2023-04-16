# StreepApp

* StreepApp is a purchase tracking application aimed at self reported sales of FMCG at a small clubs.

* Purchases used to be tracked on a physical chalkboard. 

* Streep App allows for better auditing of purchases and balance mutations and does not require physical access.

* StreepApp was developed in 2014 in PHP, JavaScript and CSS and hosted with XAMPP.

# Deploy

Install XAMPP. Clone this repo to XAMPPs `htdocs` folder. In phpmyadmin, create a data base named `streepapp_db`. Use the phpmyadmin import wizard to import the `streepapp_db.sql` file into the streepapp_db.  Start the Apache and MySQL servers. Navigate to `/localhost/StreepApp/StreepApp`.

## Setting a data base password

By default, phpmyadmin does not require a password for root access. To set a password, 1) in phpmyadmin go to the root user, Edit privileges and Change Password. 2) Add this password to `connectDB.php`. 3) Set this password in `xampp/phpmyadmin/config.inc.php`  at `$cfg['Servers'][$i]['password'] = '';`






