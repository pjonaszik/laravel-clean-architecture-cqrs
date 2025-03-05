# Laravel Clean Architecture - CQRS Todo App

## Overview
This project follows **Clean Architecture** principles, implementing **CQRS (Command Query Responsibility Segregation)** and **Event-Driven Architecture** in Laravel. It includes:

- **Separation of Concerns** using CQRS (Commands for writes, Queries for reads)
- **Domain-Driven Design (DDD)** with Entities, Value Objects & Services
- **Repository Pattern** for data access abstraction
- **Event-Driven Features** (using Laravel Events & Listeners)
- **Unit & Functional Tests** with **PestPHP**
- **Dockerized Setup** (Nginx, PHP, PostgreSQL)

## Architecture Diagram

```
📦 laravel_cqrs_todo
 ┣ 📂 app
 ┃ ┣ 📂 Application       # 🚀 Application Layer (Commands & Queries)
 ┃ ┃ ┣ 📂 Commands       # Handles write operations (Create, Update, Delete)
 ┃ ┃ ┣ 📂 Queries        # Handles read operations
 ┃ ┃ ┣ 📂 Services       # Business logic (use cases)
 ┃ ┣ 📂 Domain           # 🏛️ Domain Layer (Core Business)
 ┃ ┃ ┣ 📂 Entities       # Domain Objects (Todo)
 ┃ ┃ ┣ 📂 Repositories   # Interfaces for Data Access
 ┃ ┃ ┣ 📂 ValueObjects   # Value Objects (e.g., TaskTitle, DueDate)
 ┃ ┣ 📂 Infrastructure   # 🏗️ Infrastructure (Persistence)
 ┃ ┃ ┣ 📂 Repositories   # Implementations of Repositories
 ┃ ┣ 📂 Http            # 🌍 Web Layer (Controllers, Requests)
 ┃ ┣ 📂 Events          # 📢 Event-Driven (TodoUpdated)
 ┃ ┣ 📂 Listeners       # 👂 Listeners (Handle Todo Events)
 ┣ 📂 database           # 📊 Migrations & Seeders
 ┣ 📂 tests              # 🧪 PestPHP Tests
 ┣ 📜 docker-compose.yml # 🐳 Docker Setup
 ┣ 📜 README.md          # 📖 This File
```

---

## Installation & Setup

### Prerequisites
- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/)

### Clone & Setup
```sh
git clone https://github.com/your-repo/laravel-cqrs-todo.git
cd laravel-cqrs-todo
cp .env.example .env
```

### Run with Docker
```sh
docker-compose up -d
docker exec -it todo-app composer install
docker exec -it todo-app php artisan key:generate
docker exec -it todo-app php artisan migrate --seed
```

🚀 **App Running at**: `http://localhost:8000/api/todos`

---

## CQRS Implementation

### **Commands (Write Operations)**
- `CreateTodoCommand` → Create a new Todo
- `UpdateTodoCommand` → Update an existing Todo
- `DeleteTodoCommand` → Delete a Todo

### **Queries (Read Operations)**
- `GetAllTodosQuery` → Get all Todos
- `GetTodoByIdQuery` → Get a single Todo by ID

### **Event-Driven Workflow**
1️⃣ When a **Todo is updated**, a `TodoUpdated` event is fired.
2️⃣ A `SendTodoUpdatedNotification` listener handles it asynchronously.
3️⃣ The listener logs the updated Todo details.

### **Running Events in Queues**
```sh
docker exec -it todo-app php artisan queue:table
docker exec -it todo-app php artisan migrate
docker exec -it todo-app php artisan queue:work
```

---

## API Endpoints

| Method | Endpoint               | Description            | Example Payload (JSON) |
|--------|------------------------|------------------------|------------------------|
| `GET`  | `/api/todos`           | Get all todos         | N/A                    |
| `GET`  | `/api/todos/{id}`      | Get single todo       | N/A                    |
| `POST` | `/api/todos`           | Create a new todo     | `{ "title": "Task 1", "due_date": "2030-01-01" }` |
| `PUT`  | `/api/todos/{id}`      | Update a todo         | `{ "title": "Updated Task", "due_date": "2031-01-01" }` |
| `DELETE` | `/api/todos/{id}`    | Delete a todo        | N/A |

---

## Running Tests with PestPHP

### Run All Tests
```sh
docker exec -it todo-app ./vendor/bin/pest
```

### Example Tests

#### ✅ Unit Test: Service Layer
```php
it('creates a new todo', function () {
    $mockRepo = Mockery::mock(TodoRepositoryInterface::class);
    $mockRepo->shouldReceive('save')->once()->andReturn(new Todo(1, new TaskTitle("Test"), "Description", new DueDate("2030-01-01")));
    
    $service = new TodoService($mockRepo);
    $todo = $service->create("Test", "Description", "2030-01-01");

    expect($todo->getTitle()->getValue())->toBe("Test");
});
```

#### ✅ Functional Test: API
```php
it('creates a new todo via API', function () {
    postJson('/api/todos', [
        'title' => 'New Task',
        'due_date' => '2030-01-01',
    ])->assertStatus(201);
});
```

---

## Why Use CQRS?

✅ **Scalability**: Read and write operations are separated for better performance.
✅ **Testability**: Business logic is decoupled from the framework.
✅ **Maintainability**: Each layer has a clear responsibility.

---

## Contributing
Pull requests are welcome! Follow the best coding practices.

---

## License
This project is open-source under the [MIT License](LICENSE).