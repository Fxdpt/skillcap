# SkillCap

## Installation

Download this repo then run

`composer install`

create a .env.local at the root of the project then configurate your database as follow:

`DATABASE_URL=mysql://<username>:<password>@127.0.0.1:3306/<databaseName>?serverVersion=5.7`

you need to create the database, for this run

`php bin/console doctrine:database:create`

Apply the migrations to import database structure

`php bin/console doctrine:migrations:migrate`

Then you're good to go!  Launch your server and start creating your first skills !

`symfony serve -d`

you can also try import somes fixtures : (the skills gonna be create without categories)

`php bin/console doctrine:fixtures:load`

## Purpose

SkillCap is an app that help you track some skills that you want to learn, and let you follow your progressions with Step By Step completions.

Create Global Types and related Categories, then create your skills and your tasks !

## Feedback

feels free to make issues and Pull Request about SkillCap ! 

## Coming Soon

- WYSIWYG Description Editor: you can actually type HTML that will be rendered but gonna be tricky for you if you have no knowledge of HTML / Bootstrap
- React Front-End: Actually the visuals are rendered by Twig, i'm working (and learning btw) on a React version