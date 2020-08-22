# P6_leveque_alexis
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/518915633cf645f4b16c9c5d96aefcaa)](https://www.codacy.com/manual/Alexisleveque-OC/P6_leveque_alexis?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Alexisleveque-OC/P6_leveque_alexis&amp;utm_campaign=Badge_Grade)

This is  README.md file of my repository fot Project 6 of the application developer PHP/Symfony.

## Story of Project

- Create all UML diagrams.
- Create all issues. 
- Development of applications.
- Write README.
- Presentation of project to a mentor.

## Context

See the project context just here >>> https://openclassrooms.com/fr/paths/59/projects/42/assignment

## How to install ?

### Step 1 (optional if you have composer) :
You need to install composer in your workplace. For this, let's go here https://getcomposer.org/download/. 
Download and install it on your computer.

### Step 2 :
Create a directory in your localserver (Exemple for Wamp : C:/wamp64/www). And clone project with this link https://github.com/Alexisleveque-OC/P6_leveque_alexis.git .

### Step 3 : 
Copy file ".env" to ".env.local" (in directory App) whit your information.

### Step 4 :
- For database and Fixtures, in your terminal enter this command "composer prepare".
That's all, your Database is create and fixtures are load ! ;)

### Step 5 :
Run App in your server if you have it or enter this command "symfony server:start"

#### optional
Create a virtualhost, for this :
- Go to your localhost
- In tool tabs, click on "Create a Virtual Host"
- Set fields with your information (ex : "snowtricks.local" and "absolute path"/your_directory(create in the beginning)/P6_leveque_alexis/public )

#### Note 
- If some extension doesn't work correctly you can do this :
In your terminal, go to your directory of project and submit : "composer install"

- If you want test mail, you can use mailtrap. Create account or log in. In home page select your integration to "Php -> Symfony5+" and copy line "MAILER_DSN ...." in .env.local.
- You can use other mail interceptor but you must configure it ;).

- If you want to do some tests, enter in console "composer make-test", the app will be test and fixtures back in original condition.