# 🏗️ Laravel Clean Architecture - Todo App

This is a **Clean Architecture** implementation of a **Todo App** in Laravel, following **SOLID, ACID, KISS** principles. It includes:  
✅ **Domain-Driven Design (DDD)** with Entities, Value Objects & Services  
✅ **Repository Pattern** for data access  
✅ **Event-Driven Architecture** using Laravel Events & Listeners  
✅ **Unit & Functional Tests** using **PestPHP**  
✅ **Dockerized Environment** (Nginx, PHP)

---

## 📂 **Project Structure**

```
📦 laravel_clean_architecture_todo
 ┣ 📂 config                     # Docker configuration files
 ┃ ┣ 📂 nginx
 ┃ ┃ ┣ default.conf
 ┃ ┣ 📂 php
 ┃ ┃ ┣ docker-php-ext.ini
 ┣ 📂 src
 ┃ ┣ 📂 app
 ┃ ┃ ┣ 📂 Todo
 ┃ ┃ ┃ ┣ 📂 Application            # 🚀 Application Layer (Services)
 ┃ ┃ ┃ ┃ ┣ 📂 Services             # Business logic (use cases)
 ┃ ┃ ┃ ┣ 📂 Domain                 # 🏛️ Domain Layer (Core Business)
 ┃ ┃ ┃ ┃ ┣ 📂 Entities             # Domain Objects (Todo)
 ┃ ┃ ┃ ┃ ┣ 📂 Repositories         # Interfaces for Data Access
 ┃ ┃ ┃ ┃ ┣ 📂 ValueObjects         # Value Objects (e.g., TaskTitle, DueDate)
 ┃ ┃ ┃ ┣ 📂 Infrastructure         # 🏗️ Infrastructure (Persistence)
 ┃ ┃ ┃ ┃ ┣ 📂 Repositories         # Implementations of Repositories
 ┃ ┃ ┣ 📂 Http                     # 🌍 Web Layer (Controllers, Requests)
 ┃ ┃ ┣ 📂 Events                   # 📢 Event-Driven (TodoUpdated)
 ┃ ┃ ┣ 📂 Listeners                # 👂 Listeners (Handle Todo Events)
 ┃ ┣ 📂 database                   # 📊 Migrations & Seeders
 ┃ ┣ 📂 tests                      # 🧪 PestPHP Tests
 ┃ ┃ ┣ ...(others laravel folders)
 ┣ 📜 docker-compose.yml
 ┣ 🐳 Dockerfile
 ┣ 📜 README.md
==========
```
---

## 🛠️ **Installation & Setup**

### **1️⃣ Prerequisites**
- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/)

### **2️⃣ Clone & Setup**
```sh
git clone https://github.com/your-repo/laravel-clean-architecture-todo.git
cd laravel-clean-architecture-todo
cp .env.example .env
```

### **3️⃣ Run the Dockerized App**
```sh
docker-compose up -d
docker exec -it todo-app composer install
docker exec -it todo-app php artisan key:generate
docker exec -it todo-app php artisan migrate --seed
```

🚀 **App Running at**: `http://localhost:8000/api/todos`

---

## 📌 **CRUD API Endpoints**

| Method | Endpoint               | Description            | Example Payload (JSON) |
|--------|------------------------|------------------------|------------------------|
| `GET`  | `/api/todos`           | Get all todos         | N/A                    |
| `GET`  | `/api/todos/{id}`      | Get single todo       | N/A                    |
| `POST` | `/api/todos`           | Create a new todo     | `{ "title": "Task 1", "due_date": "2030-01-01" }` |
| `PUT`  | `/api/todos/{id}`      | Update a todo         | `{ "title": "Updated Task", "due_date": "2031-01-01" }` |
| `PATCH`| `/api/todos/{id}/complete` | Mark as completed | N/A |
| `DELETE` | `/api/todos/{id}`    | Delete a todo        | N/A |

---

## 📢 **Event-Driven Architecture**

### **How It Works?**
1️⃣ When a **Todo is updated** or **completed**, a `TodoUpdated` event is fired.  
2️⃣ A `SendTodoUpdatedNotification` listener handles it.  
3️⃣ The listener logs the updated Todo details **asynchronously** via Laravel Queues.

### **Setup Queues**
```sh
docker exec -it todo-app php artisan queue:table
docker exec -it todo-app php artisan migrate
docker exec -it todo-app php artisan queue:work
```

🔍 **Monitor Events in Logs**:
```sh
docker exec -it todo-app tail -f storage/logs/laravel.log
```

---

## 🧪 **Running Tests (PestPHP)**

### **1️⃣ Run All Tests**
```sh
docker exec -it todo-app ./vendor/bin/pest
```

### **2️⃣ Test Examples**

#### ✅ **Unit Test: Service Layer**
```php
it('creates a new todo', function () {
    $mockRepo = Mockery::mock(TodoRepositoryInterface::class);
    $mockRepo->shouldReceive('save')->once()->andReturn(new Todo(1, new TaskTitle("Test"), "Description", new DueDate("2030-01-01")));
    
    $service = new TodoService($mockRepo);
    $todo = $service->create("Test", "Description", "2030-01-01");

    expect($todo->getTitle()->getValue())->toBe("Test");
});
```

#### ✅ **Functional Test: API**
```php
it('creates a new todo via API', function () {
    postJson('/api/todos', [
        'title' => 'New Task',
        'due_date' => '2030-01-01',
    ])->assertStatus(201);
});
```

---

## 📖 **Concepts & Architecture**

### 🏛 **1. Clean Architecture Principles**
✅ **Separation of Concerns**: Business logic (Domain) is separate from the Framework.  
✅ **Dependency Inversion**: Services depend on abstractions (Repositories).  
✅ **Entities Are Pure PHP**: No Laravel dependencies inside Domain layer.

### 🏗 **2. Design Patterns Used**
✅ **Repository Pattern**: Abstracts data access logic.  
✅ **Event-Driven Architecture**: Uses Laravel Events & Listeners.  
✅ **Value Objects**: Prevents invalid states (e.g., `TaskTitle`, `DueDate`).

### 🛠 **3. SOLID Principles**
✅ **S**ingle Responsibility: Each class has one job.  
✅ **O**pen/Closed: New features can be added without modifying existing code.  
✅ **L**iskov Substitution: Interfaces ensure flexibility.  
✅ **I**nterface Segregation: Repository interface is separate from Eloquent models.  
✅ **D**ependency Inversion: Services depend on interfaces, not concrete classes.

---

## 🎯 **Why Use This Architecture?**
✅ **Scalable**: Easy to extend (e.g., add Email Notifications, WebSockets).  
✅ **Testable**: Business logic is unit-testable without Laravel dependencies.  
✅ **Maintainable**: Clear separation of concerns.

---

## 🎉 **Contributing**
Pull requests are welcome! Please follow the coding standards and best practices.

---

## 📄 **License**
This project is open-source and available under the [MIT License](LICENSE).