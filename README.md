# group14-tawk17-project-2023
Applied Web Architecture Project Work

Created by Liis Lepler and Elin Tri 2023

## Table of Contents

- [Trackersaurus](#trackersaurus)
- [API Layer](#api-layer)
- [Database Layer](#database-layer)
- [Business-Logic Layer](#business-logic-layer)
- [Controller Layer](#controller-layer)
- [Controller Base](#controller-base)
- [Frontend Router](#frontend-router)
- [Functions](#functions)
- [Template Class](#template-class)
- [Model Layer](#model-layer)
- [Index](#index)
- [.htaccess](#.htaccess)
- [Views Layer](#views-layer)

## Trackersaurus

This project is a web application that allows parents to manage activities for children and children to report their activities to the parents.

## API Layer

This is the description of the API code for our application.

### API Endpoints

#### `api/router`

- `GET /api/router/routes` - Get all registered routes
- `GET /api/router/routes/{id}` - Get a specific route by ID
- `POST /api/router/routes` - Create a new route
- `PUT /api/router/routes/{id}` - Update a route by ID
- `DELETE /api/router/routes/{id}` - Delete a route by ID

#### `api/restapi`

- `GET /api/restapi/resources` - Get all registered resources
- `GET /api/restapi/resources/{id}` - Get a specific resource by ID
- `POST /api/restapi/resources` - Create a new resource
- `PUT /api/restapi/resources/{id}` - Update a resource by ID
- `DELETE /api/restapi/resources/{id}` - Delete a resource by ID

#### `api/auth`

- `GET /api/auth/me` - Get user information
- `GET /api/auth/children` - Get children information
- `POST /api/auth/create-account` - Register a parent account
- `POST /api/auth/add-child` - Register a child account
- `POST /api/auth/login` - Log in with username and password

#### `api/tasks`

- `GET /api/tasks` - Get all tasks
- `GET /api/tasks/{id}` - Get a specific task by ID
- `POST /api/tasks` - Create a new task
- `PUT /api/tasks/{id}` - Update a task by ID
- `DELETE /api/tasks/{id}` - Delete a task by ID

#### `api/logs`

- `GET /api/logs` - Get all logs
- `GET /api/logs/{id}` - Get a specific log by ID
- `POST /api/logs` - Create a new log
- `PUT /api/logs/{id}` - Update a log by ID
- `DELETE /api/logs/{id}` - Delete a log by ID

#### Root Endpoint

The root endpoint is accessed by sending a GET request to `/`. It serves as the default entry point for the API.

## Database Layer

The database configuration can be found in the `Database` class. The connection info is set in the constructor using the following parameters: Host, User, Password, and Database.

### DinosaurFetcher 

The `DinosaurFetcher` class fetches random dinosaur data from an external API.

### LogsDatabase 

The `LogsDatabase` class provides functions for interacting with the "logs" table in the database.

### TasksDatabase Class

The `TasksDatabase` class provides functions for interacting with the "parenttasks" table in the database.

## Business-Logic Layer 

This is the description of the business layer code for the application.

### AuthService

The `AuthService` class handles authentication-related operations, including registering users, logging in, and updating passwords.

#### `registerUser(user: UserModel, password: string): boolean`

Registers a new user with the provided user model and password. Returns `true` on successful registration, or `false` if the username already exists.

#### `authenticateUser(username: string, test_password: string): User`

Authenticates a user by validating the provided username and password. Returns the user object if the authentication is successful, or `false` otherwise.

#### `updatePassword(user_id: string, password: string): boolean`

Updates the password for a user with the specified user ID. Returns `true` on successful password update.

#### `generateJsonWebToken(user: UserModel): string`

Generates a JSON Web Token (JWT) for the given user. The token includes the user's ID, username, role, parent ID, and expiration time. Returns the generated token as a string.

#### `validateToken(token: string): boolean`

Validates the provided JWT. Checks the token's signature, algorithm, expiration, and other claims. Returns the payload of the token if it is valid, or `false` otherwise.

### DinosaurService

The `DinosaurService` class interacts with an external API to fetch dinosaur data.

#### `getDinosaur(): Dinosaur`

Fetches a random dinosaur from the external API and returns it as a `Dinosaur` object.

### LogsService

The `LogsService` class provides functions for managing logs.

#### `addLog(log: LogsModel): boolean`

Adds a log to the database. Returns `true` on successful insertion.

#### `getLogsForParent(user_id: string): Log[]`

Retrieves logs for a parent user and their associated children. Returns an array of log objects.

#### `getLogsForChild(child_id: string): Log[]`

Retrieves logs for a specific child user. Returns an array of log objects.

#### `getLogById(id: string): Log`

Retrieves a log by its ID. Returns the log object.

#### `updateLogById(log_id: string, log: LogsModel): boolean`

Updates a log with the specified ID using the provided log object. Returns `true` on successful update.

#### `deleteLogById(log_id: string): boolean`

Deletes a log with the specified ID. Returns `true` on successful deletion.

### TasksService

The `TasksService` class provides functions for managing tasks.

#### `addTask(task: TasksModel): boolean`

Adds a task to the database. Returns `true` on successful insertion.

#### `getTasksByParent(parent_id: string): Task[]`

Retrieves tasks for a parent user. Returns an array of task objects.

#### `getTasksForChild(child_id: string): Task[]`

Retrieves tasks for a specific child user. Returns an array of task objects.

#### `getTaskById(id: string): Task`

Retrieves a task by its ID. Returns the task object.

#### `completeTaskById(task_id: string, task: TasksModel): boolean`

Marks a task as completed with the specified ID using the provided task object. Returns `true` on successful completion.

#### `updateTaskById(task_id: string, task: TasksModel): boolean`

Updates a task with the specified ID using the provided task object. Returns `true` on successful update.

#### `deleteTaskById(task_id: string): boolean`

Deletes a task with the specified ID. Returns `true` on successful deletion.

### UsersService

The `UsersService` class provides functions for managing users.

#### `getUserById(id: string): User`

Retrieves a user by their ID. Returns the user object.

#### `getUserByUsername(username: string): User`

Retrieves a user by their username. Returns the user object.

#### `getAllUsers(): User[]`

Retrieves all users from the database. Returns an array of user objects.

#### `updateUser(user_id: string, user: UserModel): boolean`

Updates a user with the specified ID using the provided user object. Returns `true` on successful update.

#### `getChildrenForParent(user_id: string): User[]`

Retrieves children users for a specific parent user. Returns an array of user objects.

#### `deleteUserById(user_id: string): boolean`

Deletes a user with the specified ID. Returns `true` on successful deletion.

#### `deleteChildrenByParentId(user_id: string): boolean`

Deletes all children users associated with a parent user. Returns `true` on successful deletion.

## Controller Layer

### AssetsController

#### `handleRequest()`
Handles the request for an asset file. It checks the validity of the file path, verifies its existence, determines the MIME type, and sends the file contents to the browser if the path is valid. If the path is invalid, it calls the `notFound()` method.

### AuthController

#### `handleRequest()`
Handles the request for various authentication and profile-related actions based on the HTTP method and path. It calls different methods for different actions or shows a "404 not found" page if the path is invalid.

#### `showLoginForm()`
Displays the login form view.

#### `showCreateAccountForm()`
Displays the create account form view.

#### `showAddChildrenForm()`
Displays the add children form view.

#### `showProfilePage()`
Displays the user's profile page view. Retrieves dinosaur data from the DinosaurService and sets the model for the view.

#### `showEditForm()`
Displays the user's profile edit form view.

#### `handlePost()`
Handles all the post requests related to authentication and profile actions. Calls different methods for different post actions or shows a "404 not found" page if the path is invalid.

#### `loginUser()`
Authenticates the user based on the provided username and password. If authentication fails, it displays an error message in the login form view. If successful, it sets the user session and redirects to the profile page.

#### `registerUser()`
Registers a new user based on the provided username, password, and other details. It performs validation checks, such as matching passwords and checking for existing usernames. If successful, it redirects to the appropriate page based on the user's role.

#### `logoutUser()`
Logs out the user by destroying the session and redirects to the home page.

#### `updateUser()`
Updates the user's profile based on the provided data from the URL and request body. It retrieves the user's ID from the URL, updates the username, and calls the UsersService to update the user in the database. If successful, it redirects to the profile page; otherwise, it shows an error page.

#### `deleteChild()`
Deletes a child user based on the provided child ID from the URL. It calls the UsersService to delete the child user from the database. If successful, it redirects to the appropriate page based on the user's role or shows an error page.

#### `deleteUser()`
Deletes a parent user based on the provided parent ID from the URL. It calls the UsersService to delete the parent user and their children from the database. If successful, it destroys the session and redirects to the home page; otherwise, it shows an error page.

### HomeController
Class for handling requests to "api/Customer".

#### `handleRequest($request_info)`
Handles the request for the home page. If `$request_info` is "not_found," it shows a "404 not found" page; otherwise, it displays the home page view.

### LogsController
Class for handling requests to "home/child-logs".

#### `handleRequest()`
Handles the incoming request by checking the request path and method. It performs the following actions based on the request:

- If the path is "/home/{child id}/new-log" (POST request), it calls the `showNewLogForm()` method.
- If the path is "/home/child-log/{log id}/edit" (POST request), it calls the `showEditForm()` method.
- If the path is invalid, it calls the `notFound()` method.

#### `showNewLogForm()`
Displays the view file "child-logs/new-log.php" to the user.

#### `showEditForm()`
Displays the view file "child-logs/id/edit.php" to the user.

#### `handlePost()`
Handles all POST requests related to child logs. It performs the following actions based on the request:

- If the path is "/home/child-logs/{child id}/new-log", it calls the `newLog()` method.
- If the path is "/home/child-logs/{id}/edit", it calls the `editLog()` method.
- If the path is "/home/child-logs/{log id}/delete", it calls the `deleteLog()` method.
- If the path is invalid, it calls the `notFound()` method.

#### `newLog()`
Creates a new log based on the request body data. It retrieves the selected options for different categories (emotion, social, hobby, school, chore, food) and sets them in the `LogsModel` object. It then calls the `LogsService::addLog()` method to add the log to the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

#### `editLog()`
Updates an existing log based on the request body data. It retrieves the log ID from the request path and updates the selected options for different categories in the `LogsModel` object. It then calls the `LogsService::updateLogById()` method to update the log in the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

#### `deleteLog()`
Deletes an existing log based on the request path. It retrieves the log ID from the request path and calls the `LogsService::deleteLogById()` method to delete the log from the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

### TasksController
Class for handling requests to "home/parent-tasks".

#### `handleRequest()`
Handles the incoming request by checking the request path and method. It performs the following actions based on the request:

- If the path is "/home/{child id}/new-task" (POST request), it calls the `showNewTaskForm()` method.
- If the path is "/home/parent-tasks/{task id}/complete" (POST request), it calls the `showCompleteForm()` method.
- If the path is "/home/parent-tasks/{task id}/edit" (POST request), it calls the `showEditForm()` method.
- If the path is invalid, it calls the `notFound()` method.

#### `showNewTaskForm()`
Displays the view file "parent-tasks/new-task.php" to the user.

#### `showCompleteForm()`
Displays the view file "parent-tasks/complete.php" to the user.

#### `showEditForm()`
Displays the view file "parent-tasks/edit.php" to the user.

#### `handlePost()`
Handles all POST requests related to parent tasks. It performs the following actions based on the request:

- If the path is "/home/parent-tasks/{child id}/new-task", it calls the `newTask()` method.
- If the path is "/home/parent-tasks/{task id}/complete", it calls the `completeTask()` method.
- If the path is "/home/parent-tasks/{task id}/edit", it calls the `editTask()` method.
- If the path is "/home/parent-tasks/{task id}/delete", it calls the `deleteTask()` method.
- If the path is invalid, it calls the `notFound()` method.

#### `newTask()`
Creates a new task based on the request body data. It retrieves the task details (title, description, due date, child ID) from the request and calls the `TasksService::addTask()` method to add the task to the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

#### `completeTask()`
Marks a task as complete based on the request body data. It retrieves the task ID from the request path and calls the `TasksService::completeTaskById()` method to update the task's status in the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

#### `editTask()`
Updates an existing task based on the request body data. It retrieves the task ID from the request path and updates the task details (title, description, due date) in the `TasksModel` object. It then calls the `TasksService::updateTaskById()` method to update the task in the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

#### `deleteTask()`
Deletes an existing task based on the request path. It retrieves the task ID from the request path and calls the `TasksService::deleteTaskById()` method to delete the task from the database. If successful, it redirects the user to the home page; otherwise, it shows an error message.

## Controller Base

The `ControllerBase` class serves as the foundation for all controller classes in the application. It encapsulates common operations and utilities used by controllers, such as rendering views, handling authentication, and managing the current user.

### Class Properties

- `$path_parts`: An array containing the parts of the current request path.
- `$path_count`: The number of parts in the current request path.
- `$query_params`: An array containing the query parameters of the current request.
- `$method`: The HTTP request method.
- `$body`: An array containing the POST request body data.
- `$model`: An array for storing data to be passed to the view.
- `$home`: The home path of the application.
- `$user`: The current user (initialized as `false`).

### Constructor

- `__construct($path_parts, $query_params)`: Initializes the class properties by setting the current request path, query parameters, request method, request body, and home path. It also starts the session and calls the `setUser()` method to set the current user.

### Methods

- `viewPage($view, $status = 200)`: Renders the specified view file to the user with the given HTTP status code.
- `notFound()`: Renders the "notFound" view file with a 404 status code.
- `unauthorized()`: Renders the "auth/unauthorized" view file with a 401 status code.
- `forbidden()`: Renders the "auth/unauthorized" view file with a 403 status code.
- `redirect($url)`: Redirects the user to the specified URL.
- `error()`: Displays an error message and the backtrace when an error occurs.
- `setUser()`: Sets the `$user` property by retrieving the user from the session.
- `requireAuth($authorized_roles = [])`: Checks if the user is authenticated and has the required roles. Renders the "auth/unauthorized" view file with a 401 status code if the user is not authenticated. Renders the "auth/unauthorized" view file with a 403 status code if the user is authenticated but does not have the required roles.
- `removeEmptyStrings($arr)`: Removes empty strings from the given array and returns the filtered array.

By extending the `ControllerBase` class, other controller classes can inherit these properties and methods to streamline their implementation. This promotes code reuse, simplifies common operations, and enforces consistent behavior across different controllers in the application.


## Frontend Router
It handles routing API requests and loading the appropriate controllers based on the requested resource.

### File Structure

- `index.php`: Entry point of the application. Handles the initial request.
- `functions.php`: Contains common utility functions used throughout the application.
- `controllers/`: Directory containing controller classes for different resources.
  - `AuthController.php`: Controller class for handling authentication-related requests.
  - `HomeController.php`: Controller class for handling home page requests.
  - `AssetsController.php`: Controller class for serving static assets.
  - `TasksController.php`: Controller class for handling tasks-related requests.
  - `LogsController.php`: Controller class for handling logs-related requests.

### FrontendRouter Class

The `FrontendRouter` class is responsible for routing API requests to the appropriate controller based on the requested resource. It loads the necessary controller classes and handles the request.

## Functions 

### getHomePath Function

The `getHomePath` function retrieves the home path based on the requested URI.

### getUser Function

The `getUser` function retrieves the user information from the session.

## Template Class

The `Template` class provides a static method `header` to generate the HTML header section for a webpage.

### header Method

The `header` method generates the HTML header section with the provided title and optional error message. It includes CSS and JavaScript files, sets up navigation links, and displays an error message if provided.

## Model Layer

This is the description of the model classes for different database tables.

### LogsModel Class

The `LogsModel` class represents the logs-table in the database. It contains properties for log information such as log_id, child, emotion, social, hobby, school, chore, and food.

### TasksModel Class

The `TasksModel` class represents the parents-tasks-table in the database. It contains properties for task information such as task_id, school, chore, food, child, status, and parent.

### UserModel Class

The `UserModel` class represents the users-table in the database. It contains properties for user information such as user_id, username, password_hash, user_role, and parent_id.

## Index

This is the description of the index file responsible for handling API and frontend requests based on the URL path.

### API Requests

API requests are handled by the `APIRouter` class. If the URL path starts with "api", the API router is loaded, and the request is handled accordingly.

### Frontend Requests

Frontend requests are handled by the `FrontendRouter` class. If the URL path starts with "home", the frontend router is loaded, and the request is handled accordingly.

### Redirect

If the URL path is not recognized as API or frontend, the index file redirects the request to the "home" path.

## .htaccess

This file uses mod_rewrite to redirect all incoming web requests to `index.php`, except for requests that match an existing file or directory. 

## Views Layer

The views layer in this application contains the presentation layer, which includes various views for different resources. These views are responsible for rendering HTML content and displaying it to the users.

### File Structure

The views layer consists of the following views:

- `home.php`: View for the home page with the different views for the users - when they are not logged in and when they are logged in as a parent or as a child.
- `notFound.php`: View for displaying a "not found" error page.
- `auth`: Views for displaying user related content, including profile page, logging in and creating an account pages, adding children page, and an editing page, as well as unauthorized page.
- `child-logs`: Views for displaying child log-related content, including creating a new log or editing an existing log.
- `parent-tasks`: Views for displaying parent tasks-related content, including creating a new task, editing an existing task or completing an existing task.

























