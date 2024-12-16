# **Echo.tj**

Run your own music streaming service with **Echo.tj**!  
This is a starter project designed for anyone interested in building a music streaming platform from scratch.

## **Features**
- 🎵 **Music Engine**: Build a scalable, customizable streaming engine.
- 🎧 **Music Player**: Integrated player for a seamless experience.
- 📚 **Music Library**: Manage and organize your songs effortlessly.

#music-engine #music-streaming #music-player #music-library

---

## **Installation Guide**

### **Prerequisites**
Ensure you have the following installed:
- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **Node.js** (for asset management)
- **MySQL** (database)

💡 *Tip: Use [XAMPP](https://www.apachefriends.org/index.html) to handle PHP and MySQL on Windows for an easy setup.*

---
### **Setup**

1. **Clone the Repository**  
   Clone the Echo.tj repository to your local machine:
   ```bash
   git clone https://github.com/tu-bob/echo.git
   cd echo
    ```
2. **Install PHP Dependencies**  
   Use Composer to install the required PHP packages:
    ```bash
    composer install
    ```
3. **Set Up Environment Variables**  
   - Create a `.env` file
   - Copy the contents of `.env.example` to `.env
   - Fill in the database credentials in the `.env` file
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```
4. **Run Database Migrations**  
   Set up the database schema with:
    ```bash
      php artisan migrate
    ```
5. **Install JavaScript Dependencies**  
   Use npm to install frontend dependencies:
    ```bash
    npm install
    ```
6. **Start the Development Server**  
   Run the PHP server:
    ```bash
    php artisan serve
    ```
   By default, the application will be accessible at: http://localhost:8000.

7. **Build Frontend Assets**  
   Build and watch assets for changes during development:
    ```bash
    npm run watch
    ```
   
---

### **Usage**
Your local Echo instance is now live! 🎉 Visit http://localhost:8000 to start exploring.

---

### **Community & Contributions**
- If you run into issues, feel free to open a GitHub issue.
- Contributions are welcome! Submit a pull request to share your ideas.

# **Get Started and Stream On!**
