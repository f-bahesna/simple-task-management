📝 Simple Task Management

A minimal Laravel 9 project built with PHP 8.2, designed to demonstrate basic project and task management features — including CRUD operations and drag-and-drop task reordering.

⚙️ Requirements

PHP: 8.2.25

Laravel: 9.52.21

Databaes: MySQL

Composer installed

🚀 Installation
# Clone the project
git clone https://github.com/f-bahesna/simple-task-management.git

# Navigate into the project
```
cd simple-task-management
```
# Install dependencies
```
composer install
```
and

# Serve the application
```
php artisan serve
```

The application will start in http://127.0.0.1:8000

## How to Use

1. Create a new project by clicking the “Add Project” button.

The newly created project will appear in the top-left dropdown menu.
If you have multiple projects, you can select any of them from the dropdown to view and manage their respective tasks.

2. When the project is first created, you’ll see no tasks yet — click the green “+” button to add one.

3. You can update or delete any task by clicking on it.

4. To reorder tasks, simply drag and drop them — the priorities will automatically update in ascending order.