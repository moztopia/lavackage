## 📦 Lavackage

**Moztopia Lavackage** is a Laravel 11+ package offering contributor-friendly commands, logging utilities, and shared framework helpers. Designed for clarity, reversibility, and ergonomic workflows.

---

### 🚀 Installation

```bash
composer require moztopia/lavackage
```

Lavackage uses Laravel's auto-discovery, so no manual provider registration is needed.

---

### 🛠️ Available Commands

#### `lavackage:log`

Manage Laravel's default log file with clear, reversible options:

```bash
php artisan lavackage:log [--clear] [--backup] [--threshold=LEVEL]
```

- `--clear` → wipes `laravel.log` safely  
- `--backup` → creates a timestamped backup before clearing  
- `--threshold=LEVEL` → filters log entries by severity (`info`, `warning`, `error`, etc.)

---

### 🧪 Testing

Lavackage uses Pest + Testbench for isolated Laravel testing:

```bash
./vendor/bin/pest
```

All tests run inside a temporary Laravel sandbox — no files are written to your repo.

---

### 🧩 Package Structure

```
src/
├── Console/
│   └── Commands/
│       └── LogCommand.php
├── LavackageServiceProvider.php
tests/
└── Feature/
    └── Commands/
        └── Log/
            └── LogBackupTest.php
```

---

### 🧑‍💻 Contributing

We welcome PRs and feedback! Please follow Moztopia’s contributor guidelines:

- Use branded headers and blank lines for clarity  
- Ensure all commands are reversible and container-safe  
- Log operator actions via Laravel-native methods

---

### 🌐 Links

- 🌍 [Moztopia](https://www.moztopia.com)  
- 🐘 [Packagist: moztopia/lavackage](https://packagist.org/packages/moztopia/lavackage)  
- 🛠️ [GitHub: moztopia/lavackage](https://github.com/moztopia/lavackage)