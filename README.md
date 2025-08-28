# PHP 3-Tier Boilerplate
A lightweight **Three-Tier Architecture** boilerplate for PHP applications (No frameworks, built from scratch).

---

## Project Requirements
- **PHP**: 8.4.12

---

## Local Setup

### Option 1: Using a Direct PHP Executable
1. Export PHP 8.4 in a directory, for example: 'C:\PHP\'
2. Open a terminal in your project `src` directory and start the server:
```cmd
C:\PHP\php.exe -S localhost:8000
```
3. Open your browser and navigate to: http://localhost:8000

### Option 2: Setting PHP in Windows Environment Variables
1. Open System Properties:
   - Right-click This PC → Properties → Advanced system settings → Environment Variables
   - In System variables, locate Path, click Edit, then New, and add your PHP folder path, e.g.: 'C:\PHP'
   - Open a terminal and verify PHP is accessible globally:
```cmd
php -v
```

---

## Notes
 - This boilerplate uses a custom autoloader, routing, and 3-tier architecture without any external frameworks.
 - Recommended for learning or starting small PHP projects with MVC separation.
