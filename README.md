

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

*(5pm-6pm):Tried hard to resolve the Tinker issue to add user_id, but there is still the error.


TUESDAY (09.09.25):-Focused on the TaskController store method. Debugged initial syntax errors. Still working to resolve the "undefined method 'id'" error for user authentication. Researching the correct approach to link tasks to users. Will continue troubleshooting this specific issue in the next session.

WEDNESDAY (10.09.25):

*(10am-11am): Studied the error handling section from the Laravel documentation. Went through how exceptions are handled and the use of logging and reporting methods for debugging.

<<<<<<< HEAD
*(2pm-3pm):
Installed Laravel Breeze authentication system. Fixed mass assignment error by adding $fillable to User model. Tested successful user registration, login, and logout flows. Verified database structure with user_id foreign key in place. All authentication scaffolding is now functional. Ready for tomorrow's task: securing TaskController to implement user-specific authorization and data isolation.
>>>>>>> e807593f65ebfddf9bc3dcc60c0ce02df6f2a6b4
=======
*(5pm-6pm):
Focused on Laravel's Authorization system. Learned to use Policies for clean, scalable user permissions. Studied how to organize model-specific rules (like update/delete tasks) securely. Understood the official method to replace manual checks with structured authorization, ensuring robust security and maintainable code. Ready to implement professional-grade access control.

THURSDAY (11.09.25):

*(10am-11am):
Foundational setup (auth, migrations, models) is complete. Today's focus is implementing business logic: defining specific permissions and roles, writing Policy methods (e.g., update() for posts), and applying authorization checks in controllers and Blade views to enforce user access rules.

*(2pm-3pm):Modified index(), edit(), update(), destroy() methods for user-specific access. Added Auth checks. Currently stuck on store() method syntax error - user_id not being set automatically. Troubleshooting relationship-based task creation vs. direct Task::create(). Authorization partially working but task creation blocked. Need to resolve Auth::user()->tasks()->create() implementation.

*(5pm-6pm):Resolved critical authorization issues that blocked task creation. Fixed missing field configuration in the task model that caused database errors. Verified users can now only access and manage their own tasks, with proper security preventing unauthorized access. Completed authentication and authorization objectives successfully. The system now ensures full data isolation between users.

MONDAY (15.09.25): Studied HTML, CSS and JavaScript and learned its core functionality in details. Prepared a UI design to implement its appliances related to Task Management Portal full stack project.

TUESDAY (16.09.25): Made a frontend design with html'css'javascript of task management.

WEDNESDAY(17.09.25): 

*(10am-11am):Today I finalized the implementation plan for advanced task filtering features, including database schema updates, backend model enhancements, and UI component designs. The development phase is now ready to begin, keeping our project perfectly aligned with the Week 3 roadmap schedule. All foundational planning is complete.

>>>>>>> 1b4faa89b9c4d121c4beb7d968fe866fa0f086e7
