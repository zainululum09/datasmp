# 📘 datasmp - PHP Native MVC API

A simple RESTful API built with native PHP using the MVC architecture pattern. JWT is used for secure user authentication.

---

## 📁 Folder Structure

```
├── app
│   ├── config
│   ├── controllers
│   ├── core
│   ├── models
│   ├── views
├── public
├── tmp
├── vendor
├── index.php
├── init.php
├── composer.json
```

---

## 🔐 Authentication Endpoints

### POST `/auth/login`

Authenticate and retrieve a JWT token.

**Request Body:**

```json
{
  "username": "admin",
  "password": "admin123"
}
```

**Response:**

```json
{
  "status": "success",
  "token": "<jwt-token>"
}
```

### POST `/auth/logout`

Invalidate the JWT token (optional client-side handling).

**Header:**

```
Authorization: Bearer <token>
```

**Response:**

```json
{
  "status": "success",
  "message": "Logout berhasil"
}
```

---

## 🎓 Siswa Endpoints

**All endpoints require JWT Authentication.**

### GET `/siswa`

Fetch all student records.

**Response:**

```json
{
  "status": "success",
  "data": [...],
  "user": "admin"
}
```

### GET `/siswa/getSiswaId/{id}`

Fetch a specific student by ID.

**Response:**

```json
{
  "status": "success",
  "data": { ... }
}
```

### POST `/siswa/create`

Create a new student record.

**Request Body:**

```json
{
  "nis": "12345",
  "nisn": "1234567890",
  "nama": "Budi",
  "jenis_kelamin": "L",
  "tempat_lahir": "Bandung",
  "tanggal_lahir": "2005-08-15",
  "no_hp": "08123456789",
  "alamat": "Jl. Merdeka"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "Siswa ditambahkan"
}
```

### PUT `/siswa/update/{id}`

Update a student record. Only submitted fields will be updated.

**Request Body (partial example):**

```json
{
  "nama": "Budi Update",
  "alamat": "Alamat Baru"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "Siswa diperbarui"
}
```

### DELETE `/siswa/delete/{id}`

Delete a student record.

**Response:**

```json
{
  "status": "success",
  "message": "Siswa dihapus"
}
```

---

## ⚙️ Tech Stack

- PHP Native (No framework)
- MVC Pattern
- PDO for DB operations
- JWT Authentication
- Composer Autoloading

---

## ▶️ Getting Started

1. Clone repo: `git clone https://github.com/your/repo.git`
2. Run `composer install`
3. Set database credentials in `app/config/config.php`
4. Import SQL structure to your DB
5. Run on local server (e.g., XAMPP or PHP built-in server)

---

## 📩 License

MIT
