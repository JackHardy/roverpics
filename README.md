# Mars Rover Image Viewer Web App

This web application allows users to view images taken by Mars rovers. It retrieves images from the NASA Open APIs and
provides features such as authentication, CRUD operations for token management, and displaying image information.

## Features

* Authentication: The app performs an authentication API call to retrieve a token for subsequent requests. The token is
  obtained from a PHP Laravel backend.
* Token Management: CRUD endpoints are provided to manage tokens.
* Retrieve Rover Photos: The app makes API calls to the NASA Open APIs to retrieve photos taken by Mars rovers. It
  displays images taken by the Curiosity, Opportunity, and Spirit rovers.
* Image Display: Images are displayed in a list format, showing the camera name, earth date, and a thumbnail of the
  image.

## Tech Stack

* Backend: PHP Laravel for server-side development.
* Frontend: Vue.js for building interactive user interfaces.
* APIs: Utilizes NASA Open APIs to fetch Mars rover images.
* Source Control: Git for version control.

## Usage

* Clone the repository from GitHub.
* Install dependencies for both the backend (Laravel) and frontend (Vue.js).
* Set up environment variables, including API keys for the NASA Open APIs.
* Run the migrations and seeder to populate the database with a test user (jack@packchat.com, password).
* Start the server using npm run dev for the frontend and php artisan serve for the backend (or utilise something like
  Laravel Herd).
* Access the application in your web browser.

## Authentication

To authenticate and retrieve a token, click the generate token button which will perform an API call to the
authentication endpoint provided by the backend. The token obtained will then be used for subsequent requests to fetch
rover images.

## Retrieving Rover Photos

The app makes API calls to the NASA Open APIs to retrieve photos taken by Mars rovers. It fetches images from the
/mars-photos/api/v1/rovers/{rover}/photos endpoint.

## Image Display

Images are displayed in a list format, showing the camera name, earth date, and a thumbnail of the image.

---

Note: This readme provides an overview of the Mars Rover Image Viewer Web App and its features. Detailed instructions
for setup and usage may vary depending on the actual implementation.
