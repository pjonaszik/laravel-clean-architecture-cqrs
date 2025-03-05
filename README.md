# 🏗️ Laravel Clean Architecture - Todo App

This is a **Clean Architecture** implementation of a **Todo App** in Laravel, following **SOLID, ACID, KISS** principles. It includes:  
✅ **Domain-Driven Design (DDD)** with Entities, DTOs & Services  
✅ **Repository Pattern** for data access  
✅ **Dockerized Environment** (Nginx, PHP)

---

## 📂 **Project Structure**

```
📦 laravel_clean_architecture
 ┣ 📂 config                      # ⚙️ Configuration files (Docker, Laravel, etc.)
 ┃ ┣ 📂 nginx                     # 🌐 Nginx configuration (reverse proxy)
 ┃ ┃ ┣ default.conf
 ┃ ┣ 📂 php                       # 🐘 PHP-specific configurations
 ┃ ┃ ┣ docker-php-ext.ini
 ┣ 📂 src                         # 📦 Application source code
 ┃ ┣ 📂 app                       
 ┃ ┃ ┣ 📂 Todo                    # 📝 Todo Bounded Context (Main todo App)
 ┃ ┃ ┃ ┣ 📂 Application           # 🚀 Application Layer (Use Cases, Services)
 ┃ ┃ ┃ ┃ ┣ 📂 DTOs                # 📦 Data Transfer Objects (Request Models)
 ┃ ┃ ┃ ┃ ┣ 📂 Services            # 🛠️ Application Services (Coordinators)
 ┃ ┃ ┃ ┣ 📂 Domain                # 🏛️ Domain Layer (Business Logic)
 ┃ ┃ ┃ ┃ ┣ 📂 Entities            # 🎭 Core Business Entities (Todo, etc.)
 ┃ ┃ ┃ ┃ ┣ 📂 Repositories        # 🧩 Repositories interfaces
 ┃ ┃ ┃ ┣ 📂 Infrastructure        # 🏗️ Infrastructure Layer (Persistence, APIs)
 ┃ ┃ ┃ ┃ ┣ 📂 Models              # 🏛️ ORM Models (Eloquent Models)
 ┃ ┃ ┃ ┃ ┣ 📂 Repositories        # 🔄 Repository Implementations (Eloquent)
 ┃ ┃ ┣ 📂 Http                    # 🌍 Web Layer (Controllers, Requests)
 ┃ ┃ ┃ ┣ 📂 Controllers           # 🎮 API Controllers (Thin, Calls Use Cases)
 ┃ ┃ ┃ ┃ ┣ 📂 Todo                # # 🎮 API Todos Controllers
 ┃ ┃ ┃ ┣ 📂 Requests              # 📥 Form Requests (Validation)
 ┃ ┃ ┃ ┃ ┣ 📂 Todo                # # 📥 Todos Form Requests (Validation - extra)
 ┃ ┣ 📂 database                  # 📊 Database Layer (Migrations, Seeders)
 ┃ ┃ ┣ 📂 migrations              # 🔄 Database Migrations
 ┃ ┃ ┣ 📂 seeders                 # 🌱 Data Seeders (Initial Data)
 ┃ ┣ 📂 tests                     # 🧪 Automated Tests (Pest, PHPUnit)
 ┃ ┃ ┣ 📂 Feature                 # 🔍 API & Use Case Tests
 ┃ ┃ ┣ 📂 Unit                    # 🔬 Unit Tests (Domain, Services)
 ┃ ┃ ┣ 📂 Integration             # 🔗 Integration Tests (Repositories, APIs)
 ┣ 📜 docker-compose.yml          # 🐳 Docker Compose (Services Definition)
 ┣ 🐳 Dockerfile                  # 🐘 PHP App Dockerfile
 ┣ 📜 README.md                   # 📖 Documentation
```
---

## 🛠️ **Installation & Setup**

### **1️⃣ Prerequisites**
- [Docker](https://www.docker.com/)
- [Composer](https://getcomposer.org/)

### **2️⃣ Clone & Setup**
```sh
git clone https://github.com/pjonaszik/laravel-clean-architecture.git
cd laravel-clean-architecture
cp .env.example .env
```

### **3️⃣ Run the Dockerized App**
Edit the docker-compose file for you need and then
```sh
make up
```
Or open the *Makefile* to see commands that will be run.

🚀 **Ap(i)p Running at**: `http://localhost:8081/api/v1/todos`

---

## 📌 **CRUD API Endpoints examples**
Check **Each controller FormRequest** to see available options or required fields. Edit them as per your needs 

| Method | Endpoint          | Description            | Example Payload (JSON) |
|--------|-------------------|------------------------|------------------------|
| `GET`  | `/api/v1/todos`   | Get all todos         | N/A                    |
| `GET`  | `/api/v1/todos/{id}` | Get single todo       | N/A                    |
| `POST` | `/api/v1/todos`      | Create a new todo     | `{ "title": "Task 1", "due_date": "2030-01-01" }` |
| `PUT`  | `/api/v1/todos/{id}` | Update a todo         | `{ "title": "Updated Task", "due_date": "2031-01-01" }` |
| `DELETE` | `/api/v1/todos/{id}` | Delete a todo        | N/A |

---

## 📖 **Concepts & Architecture**

### 🏛 **1. Clean Architecture Principles**
✅ **Separation of Concerns**: Business logic (Domain) is separate from the Framework.  
✅ **Dependency Inversion**: Services depend on abstractions (Repositories).  
✅ **Entities Are Pure PHP**: No Laravel dependencies inside Domain layer.

### 🏗 **2. Design Patterns Used**
✅ **Repository Pattern**: Abstracts data access logic.  

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
```sh
Nothing is perfect and finished in an unperfect and unfinite world
```
That's why Pull requests are welcome! Please follow the coding standards and best practices.

---

## 📄 **License**
This project is open-source and available under the [MIT License](LICENSE).