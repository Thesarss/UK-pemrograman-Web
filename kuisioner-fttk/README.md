# Aplikasi Kuisioner FTTK

Sistem manajemen kuisioner berbasis web untuk Fakultas Teknologi Kelautan dan Kebumian (FTTK) menggunakan CodeIgniter 4.

## Technology Stack

- **Framework**: CodeIgniter 4.6.4
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript, jQuery
- **Charts**: Chart.js
- **Export**: PhpSpreadsheet (Excel), mPDF (PDF)
- **PHP Version**: 7.4+

## Features

### Role-Based Access Control
- **Admin**: Manage users, organizational structure (fakultas, jurusan, prodi), and students
- **Kaprodi**: Create and manage questionnaires, view responses and summaries
- **Mahasiswa**: Fill out questionnaires, view notifications
- **Pimpinan**: View cross-prodi summaries and comparative analytics

### Key Features
- Questionnaire period management with deadlines
- Dynamic question builder with multiple choice options
- Progress tracking for questionnaire completion
- Notification system for new questionnaires
- Summary reports with charts
- Export to Excel and PDF
- Activity logging for audit trail
- Session timeout (30 minutes)
- CSRF protection and XSS filtering

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Apache/Nginx with mod_rewrite enabled

### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd kuisioner-fttk
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   - Copy `.env` file and configure database settings
   - Generate encryption key:
     ```bash
     php spark key:generate
     ```

4. **Create database**
   ```sql
   CREATE DATABASE kuisioner_fttk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

5. **Import database schema**
   ```bash
   mysql -u root -p kuisioner_fttk < database/schema.sql
   ```

6. **Import seed data (optional)**
   ```bash
   mysql -u root -p kuisioner_fttk < database/seed.sql
   ```

7. **Set permissions**
   ```bash
   chmod -R 777 writable/
   ```

8. **Run development server**
   ```bash
   php spark serve
   ```

9. **Access the application**
   - Open browser: `http://localhost:8080`

## Project Structure

```
kuisioner-fttk/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Admin.php
│   │   ├── Kaprodi.php
│   │   ├── Mahasiswa.php
│   │   ├── Pimpinan.php
│   │   └── Report.php
│   ├── Models/
│   │   ├── User_model.php
│   │   ├── Fakultas_model.php
│   │   ├── Jurusan_model.php
│   │   ├── Prodi_model.php
│   │   ├── Mahasiswa_model.php
│   │   ├── Periode_model.php
│   │   ├── Pertanyaan_model.php
│   │   ├── Pilihan_jawaban_model.php
│   │   ├── Jawaban_model.php
│   │   ├── Notifikasi_model.php
│   │   ├── Activity_log_model.php
│   │   └── Report_model.php
│   ├── Views/
│   │   ├── templates/
│   │   ├── auth/
│   │   ├── admin/
│   │   ├── kaprodi/
│   │   ├── mahasiswa/
│   │   └── pimpinan/
│   ├── Libraries/
│   │   ├── Pdf_generator.php
│   │   └── Excel_generator.php
│   └── Helpers/
│       ├── auth_helper.php
│       └── notification_helper.php
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   ├── images/
│   │   └── vendor/
│   └── index.php
├── database/
│   ├── schema.sql
│   └── seed.sql
└── .env

```

## Database Schema

### Core Tables
- `user` - User accounts with roles
- `fakultas` - Faculty information
- `jurusan` - Department information
- `prodi` - Study program information
- `mahasiswa` - Student information

### Questionnaire Tables
- `periode_kuisioner` - Questionnaire periods
- `pertanyaan` - Questions
- `pilihan_jawaban_pertanyaan` - Answer options
- `pertanyaan_periode_kuisioner` - Question-period assignments

### Response Tables
- `jawaban` - Student answers
- `notifikasi` - Notifications
- `activity_log` - System activity logs

## Default Credentials

After importing seed data:

- **Admin**: admin / admin123
- **Kaprodi**: kaprodi / kaprodi123
- **Mahasiswa**: mahasiswa / mahasiswa123
- **Pimpinan**: pimpinan / pimpinan123

**⚠️ Change these passwords in production!**

## Development Team

- **Anggota 1 (2301020052)**: Database & Authentication
- **Anggota 2 (2301020112)**: Admin Module
- **Anggota 3 (2301020113)**: Kaprodi Module
- **Anggota 4 (2301020119)**: Mahasiswa Module
- **Anggota 5 (2301020123)**: Reporting & Analytics

## File Naming Convention

Each team member must prefix their files with their NIM:
- **2301020052_**: Database tables, models, and authentication files
- **2301020112_**: Admin controller, views, and activity log
- **2301020113_**: Kaprodi controller, views, and questionnaire tables
- **2301020119_**: Mahasiswa controller, views, and response tables
- **2301020123_**: Report controller, export libraries, and analytics

Example:
- `2301020052_User_model.php`
- `2301020112_Admin.php`
- `2301020113_Periode_model.php`
- `2301020119_Mahasiswa.php`
- `2301020123_Report.php`

## Testing

Run unit tests:
```bash
vendor/bin/phpunit
```

Run property-based tests:
```bash
vendor/bin/phpunit --testsuite property
```

## Security

- CSRF protection enabled
- XSS filtering on all inputs
- Password hashing with bcrypt
- Session timeout (30 minutes)
- SQL injection prevention via Query Builder
- Input validation and sanitization

## License

This project is developed for academic purposes at FTTK.

## Support

For issues and questions, please contact the development team.
