<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

                                  TASK MANAGEMENT PROJECT REPORT


FIRST WEEK: Weekly Project Report:

This week, I developed core files for our Laravel Task Manager:

· TaskController.php - Handles CRUD operations with validation · web.php - Defines RESTful routes (GET/POST/PUT/DELETE) · Task.php (Model) - Manages database interactions via Eloquent ORM · create_tasks_table.php (Migration) - Created database schema with title and completed fields · index.blade.php - Displays tasks list (frontend view)

SATURDAY (06.09.25):-

*(10am-11am): I have read the introduction section of the Laravel documentation.

*(2pm-3pm): Laravel Documentation Reading Report

I have read the Laravel documentation in three areas of focus:

Server Requirements – Read about the requirements to host a Laravel application, such as supported PHP versions, needed extensions, and supported server environments.

Server Configuration – Understood configuring various servers like Nginx and FrankenPHP, and setting proper directory permissions to deploy securely and easily.

Optimization – Discussed Laravel's optimization methods, including caching settings, events, routes, and views, that increase application performance and efficiency.

The above understanding will help in enhancing Laravel deployment practices and optimizing applications for production.

*(5pm-6pm): I studied the authentication process in Laravel. I prepared a rough plan on how to implement it, covering key steps like user registration/login, password hashing, session management, and middleware protection.

MONDAY (08.09.25):- 

*(10am-11am):I made a plan to setup & and make changes in database.

*(2pm-3pm):Completed database migration to establish user-task relationships. Successfully tested the model association, confirming users can now own and manage private task lists.

*(5pm-6pm):Fixed critical authentication class errors and implemented secure ownership linking between users and their tasks.

TUESDAY (09.09.25):
DAILY REPORT:
Focused on the TaskController store method. Debugged initial syntax errors. Still working to resolve the "undefined method 'id'" error for user authentication. Researching the correct approach to link tasks to users. Will continue troubleshooting this specific issue in the next session.

WEDNESDAY (10.09.25):
*(10am-11am):
Today I studied the error handling section from the Laravel documentation. I went through how exceptions are handled, the role of the App\Exceptions\Handler class, and the use of logging and reporting methods for debugging.

*(2pm-3pm):Installed Laravel Breeze authentication system. Fixed mass assignment error by adding $fillable to User model. Tested successful user registration, login, and logout flows. Verified database structure with user_id foreign key in place. All authentication scaffolding is now functional. Ready for tomorrow's task: securing TaskController to implement user-specific authorization and data isolation.

*(5pm-6pm):
Focused on Laravel's Authorization system. Learned to use Policies for clean, scalable user permissions. Studied how to organize model-specific rules (like update/delete tasks) securely. Understood the official method to replace manual checks with structured authorization, ensuring robust security and maintainable code. Ready to implement professional-grade access control.

THURSDAY (11.09.25):
*(10am-11am):
Foundational setup (auth, migrations, models) is complete. Today's focus is implementing business logic: defining specific permissions and roles, writing Policy methods (e.g., update() for posts), and applying authorization checks in controllers and Blade views to enforce user access rules.
*(2pm-3pm):Modified index(), edit(), update(), destroy() methods for user-specific access. Added Auth checks. Currently stuck on store() method syntax error - user_id not being set automatically. Troubleshooting relationship-based task creation vs. direct Task::create(). Authorization partially working but task creation blocked. Need to resolve Auth::user()->tasks()->create() implementation.
