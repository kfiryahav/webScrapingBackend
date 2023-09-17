# Web Scraping Solution with Laravel and MongoDB

This project provides a web scraping solution built with Laravel for the backend and MongoDB as the database. It allows users to collect URLs with specific crawling depth and store successfully fetched webpage URLs in a MongoDB database. This README file contains comprehensive instructions for setting up and running the project.

## Table of Contents
- [Backend Specifications](#backend-specifications)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Running the Project](#running-the-project)

## Backend Specifications
- **Create a Crawler:** The project includes a Laravel-based web crawler that accepts a URL and a crawling depth as input parameters.
- **MongoDB Database:** Successfully fetched webpage URLs are stored in a MongoDB Database.
- **HTTP Response Status:** Only web pages with a successful HTTP response status are stored in the database.
- **Prevent Duplicates:** Duplicate URLs are prevented from being added to the database.

## Prerequisites
Before you can run this project, ensure that you have the following prerequisites installed:
- PHP (7.4 or higher)
- Composer
- MongoDB (either a local installation or MongoDB Atlas)
- Laravel (latest version)

## Installation
Follow these steps to set up the project:

1. Clone this repository to your local machine:
2. Navigate to the project directory.
3. Install PHP dependencies using Composer: `composer install`
4. Set up the MongoDB database configuration by copying the `.env.example` file to `.env`: `cp .env.example .env`
5. Update the `.env` file with your MongoDB connection information:

## Environment Variables
- **DB_URI:** Your MongoDB connection URI.
- **DB_DATABASE:** Your MongoDB database name.

Replace `your_password`, `your_mongodb_uri`, and `your_database_name` with your MongoDB credentials.


**Note that, we use here with mongoDB Atlas, if you wish to configure mongoDB with the regular credentials you can visit: https://github.com/mongodb/laravel-mongodb/blob/master/docs/install.md**

## Running the Project
Once you have completed the installation and configured the environment variables, you can run the project:

1. Migrate the MongoDB collections to create necessary tables: `php artisan migrate`
2. Start the Laravel development server: `php artisan serve`

Access the application in your web browser at http://localhost:8000.

Now, your web scraping solution is up and running. You can use the provided web interface to enter URLs and crawling depths, and the collected data will be stored in your MongoDB database.

