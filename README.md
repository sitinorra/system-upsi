# 🎓 UPSI Complaint System (COSIM)

**Complaint Online System and Information Management**

A comprehensive web-based complaint management system built with CakePHP 5.x for Universiti Pendidikan Sultan Idris (UPSI).

---

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [User Roles](#user-roles)
- [Screenshots](#screenshots)
- [Project Structure](#project-structure)
- [Credits](#credits)

---

## 📖 About

COSIM (UPSI Complaint System) is a student project developed as part of IMS566 coursework. The system streamlines the complaint submission and management process for students, staff, and administrators at UPSI.

**Course:** IMS566  
**Institution:** Universiti Teknologi Mara Puncak Perdana Campus (UiTM PP)  
**Academic Session:** 2025/2026  

---

## ✨ Features

### Student Features
- 📝 Submit complaints online
- 📊 View own complaint history
- 🔍 Search and filter complaints
- 🔒 Mark complaints as confidential

### Staff Features
- 👀 View all submitted complaints
- ✏️ Update complaint status
- 💬 Add staff feedback
- 📈 Track complaint resolution progress
- 🔄 Manage complaint workflow

### Admin Features
- 👥 Manage users (students and staff)
- 🏢 Manage departments
- 📂 Manage complaint categories and types
- 📊 View system statistics
- ⚙️ System configuration

### General Features
- 🔐 Secure authentication system
- 🎨 Modern emerald green and gold theme
- 📱 Fully responsive design
- 🔍 Advanced search and filtering
- 📄 Export capabilities
- 🕒 Automatic timestamps and tracking

---

## 🛠️ Technologies Used

- **Framework:** CakePHP 5.x
- **Language:** PHP 8.1+
- **Database:** MySQL 8.0
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Server:** Apache/Laragon
- **Version Control:** Git & GitHub

---

## 📥 Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Apache
- Git
- Laragon (recommended for Windows)

### Step 1: Clone Repository

```bash
git clone https://github.com/sitinorra/system-upsi/tree/master
cd system_upsi
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Configure Database

1. Copy `config/app_local.example.php` to `config/app_local.php`
2. Edit `config/app_local.php` and update database credentials:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'system_upsi',
    ],
],
```

### Step 4: Run Application

Using Laragon:
- Place project in `D:\566_G\laragon\www\system_upsi`
- Access via: `http://localhost/system_upsi`

Using built-in server:
```bash
bin/cake server -p 8765
```
Then visit: `http://localhost/system_upsi`

---

## 🗄️ Database Setup

### Database Structure

The system uses the following main tables:

- `student` - Student information
- `staff` - Staff information
- `admin` - Admin information
- `users` - All users login credentials 
- `complaints` - Complaint records
- `complaint_types` - Types of complaints (Feedback, Inquiry, Praise, Suggestion)
- `complaint_categories` - Categories (Policy, Administration, Services, etc.)
- `departments` - University departments
- `attachments` - File attachments for complaints
- `feedback` - Staff feedback of a complaint

### Sample Data

The database includes sample data for testing:

**Admin Account:**
- Username: `Noraini`
- Password: `password`

**Staff Account:**
- Username: `Aziz`
- Password: `password`

**Student Account:**
- Username: `Fatimah`
- Password: `password`

---

## 🎯 Usage

### For Students

1. Login with student credentials
2. Navigate to "Submit Complaint"
3. Fill in complaint details:
   - Select complaint type
   - Select category
   - Provide description
   - Attach files (optional)
   - Mark as confidential if needed
4. Submit and track status

### For Staff

1. Login with staff credentials
2. View all complaints or search specific ones
3. Click "View" to see complaint details
4. Update status (Pending → In Progress → Resolved/Rejected)
5. Add staff remarks

### For Admin

1. Login with admin credentials
2. Full access to all features
3. Manage users via "Students" and "Staff" menus
4. Configure system settings
5. Add new student
6. Delete complaint

---

## 👥 User Roles

### 🎓 Student
- Submit complaints
- View own complaints
- Update profile
- **Cannot:** View other students' complaints

### 👔 Staff
- View all complaints
- Update complaint status
- Add remarks
- **Cannot:** Manage users

### 👨‍💼 Admin
- All staff permissions
- Manage students and staff
- System configuration
- Full system access

---

## 📸 Screenshots

### Screenshots
![📸 System Screenshots Folder](https://drive.google.com/drive/folders/1lBs8VVQCUXBv5HXTAyFUfr9suAiE47RZ)

---

## 📁 Project Structure

```
upsi-complaint-system/
├── bin/                    # Console executables
├── config/                 # Configuration files
├── logs/                   # Application logs
├── plugins/               # CakePHP plugins
├── resources/             # Non-web accessible resources
├── src/
│   ├── Controller/        # Controllers
│   ├── Model/            # Models (Table & Entity)
│   ├── View/             # View classes
│   └── Application.php   # Application bootstrap
├── templates/            # View templates
│   ├── Complaints/       # Complaint views
│   ├── Student/          # Student views
│   ├── Staff/            # Staff views
│   ├── Users/            # Login views
│   └── layout/           # Layout templates
├── tests/                # Test files
├── tmp/                  # Temporary files
├── vendor/               # Composer dependencies
├── webroot/              # Public web directory
│   ├── css/              # Stylesheets
│   │   └── custom.css    # Custom theme
│   ├── js/               # JavaScript files
│   └── img/              # Images
├── .gitignore
├── composer.json
└── README.md
```

---

## 🎨 Theme & Design

The system features a modern emerald green and gold color scheme:

- **Primary Color:** Emerald Green (`#065f46`)
- **Accent Color:** Gold (`#f59e0b`)
- **Background:** White/Light gray

---

## 🔒 Security Features

- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ SQL injection prevention (ORM)
- ✅ Session management
- ✅ Role-based access control
- ✅ Input validation and sanitization

---

## 🐛 Known Issues

- None reported at this time

---

## 📝 License

This project is developed for educational purposes as part of IMS566 coursework at UPSI.

---

## 🙏 Acknowledgments

- CakePHP Framework
- Bootstrap Framework
- UPSI & UiTM for the project opportunity
- Course instructor and peers

---

## 📞 Support

For support or questions regarding this project:
- **Email:** cosim@upsi.edu.my
- **GitHub Issues:** [Create an issue](https://github.com/sitinorra/system-upsi
/tree/master/issues)

---

## 📅 Project Timeline

- **Started:** October 2025
- **Completed:** February 2026
- **Status:** ✅ Completed

---

**Made with ❤️ for UPSI**
