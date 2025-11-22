# ClaraVisión Óptica – Full-Stack PHP & MySQL Web Application

ClaraVisión Óptica is a full-stack web project developed with **PHP, MySQL, HTML, CSS and JavaScript**.  
It was created as part of my backend and database learning journey, focusing on real-world concepts such as dynamic content rendering, modular architecture, CRUD operations and database-driven UI components.

This project recreates the structure of a modern optical store website, featuring a dynamic product catalog connected to MySQL, a branded UI and modular reusable components.

---

## Features

### Dynamic Product Catalog  
- Products are retrieved directly from a **MySQL database**  
- Technical details are stored using **JSON fields** inside MySQL  
- Automatic rendering of images, materials, colors and specs  
- Responsive grid layout  

### Featured Products System  
- Special products marked as “featured” in the database  
- Displayed dynamically on the homepage  
- Fully controlled via MySQL  

### Custom Visual Identity  
- Brand colors (ClaraVisión red palette)  
- Logo, icons and UI components  
- Hero image slider created in vanilla JavaScript  
- Reusable header & footer using PHP partials  

### Modular Architecture  
- `partials/header.php` and `partials/footer.php`  
- Clean separation of pages  
- Organized folder structure  
- External JavaScript (`script.js`) and CSS by page  

### Database Integration  
- PHP → MySQL connection  
- JSON decoding for advanced product details  
- Prepared structure for future CRUD operations  
- Ready for admin dashboard implementation  

---

## Learning Goals

This project was built to practice:

- CRUD operations in MySQL  
- Connecting PHP with relational databases  
- Using PHP includes for modular layouts  
- Decoding JSON stored in a database  
- Organizing real web projects  
- Creating dynamic pages instead of static HTML  
- Understanding backend logic while building UI  

---

## Upcoming Features / Roadmap

Planned improvements:

- Admin login system (basic authentication)
- Admin dashboard for managing products, clients and messages  
- Individual product pages  
- Contact form saved to MySQL  
- Appointment (cita) scheduling system  
- Testimonials or reviews section  
- Filters & sorting for the catalog  
- Budget / “add to cart” request system (without payment)  

---

## Folder Structure
/assets
/css
/img
/js
/database
partials/
index.php
catalogue.php
db_connect.example.php
.gitignore
README.md


---

## 💾 Database

- MySQL database with tables such as:
  - `producto`  
  - `cliente`  
  - `cita` (appointments)  
- Product technical information stored as **JSON**  
- Images linked dynamically to the DB  
- Example schema available in `database/` (optional)

---

## Security: About db_connect.php

To protect real database credentials:

- `db_connect.php` is **never uploaded** to GitHub  
- A safe demo version `db_connect.example.php` is included instead  
- `.gitignore` hides sensitive files  

This follows professional backend practices.

---

## Technologies

- **PHP 8**
- **MySQL 8**
- **HTML / CSS / JavaScript**
- **MAMP for local server**
- **Git + GitHub**
- **JSON fields in MySQL**
- **Responsive design**

---

## Running the project locally

1. Start MAMP  
2. Move the project folder into `htdocs/`  
3. Import the SQL file into phpMyAdmin  
4. Update `db_connect.php` with your local credentials  
5. Access

---

## About the project

ClaraVisión is a personal study project that allowed me to combine:

- backend development  
- SQL logic  
- real database structure  
- UI design  
- modular PHP architecture  

It represents my progress toward becoming a full-stack developer and showcases what I’ve learned so far.

---