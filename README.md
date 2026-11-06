# Student Management System API

Laravel 13 + PHP 8.4 + PostgreSQL + Sanctum + Postman.

## Setup
1. Copy these files into your Laravel project.
2. Configure PostgreSQL in `.env`.
3. Run:
   php artisan migrate
   php artisan db:seed
   php artisan route:list --path=api
   php artisan serve --port=8000

## API
Base URL: http://127.0.0.1:8000/api

Auth:
POST /register
POST /login
GET /me
POST /logout

Students:
GET /students
POST /students
GET /students/{student}
PUT /students/{student}
DELETE /students/{student}

Courses:
GET /courses
POST /courses
GET /courses/{course}
PUT /courses/{course}
DELETE /courses/{course}

Enrollments:
GET /enrollments
POST /enrollments
GET /enrollments/{enrollment}
PUT /enrollments/{enrollment}
DELETE /enrollments/{enrollment}

Use `Authorization: Bearer <token>` for protected routes.
