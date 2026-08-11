# Ganga Fernhill Phase — Costsheet App

A CodeIgniter 3 (PHP) + MySQL + Bootstrap 4 application that reproduces the
"COSTSHEET DETAILS & CALCULATIONS" sheet as an online entry form. Submitted
data is stored in MySQL, and a PDF matching the original costsheet design can
be viewed or downloaded for any saved record (built with the bundled TCPDF
library — no extra install needed).

---

## What's included

```
costsheet_ci/
├── application/
│   ├── controllers/Costsheet.php        Form, save, list, PDF actions
│   ├── models/Costsheet_model.php       DB insert / fetch / delete
│   ├── views/
│   │   ├── costsheet_form.php           Bootstrap 4 entry form
│   │   ├── costsheet_success.php        Post-save screen (View/Download PDF)
│   │   ├── costsheet_list.php           Table of all saved costsheets
│   │   └── costsheet_pdf.php            HTML template rendered into the PDF
│   ├── config/database.php              MySQL connection (pre-set for XAMPP)
│   └── third_party/tcpdf/               Bundled TCPDF PDF library
├── database/costsheet.sql               Creates DB + table + 1 sample row
├── system/                              CodeIgniter 3 core (unmodified)
└── index.php
```

---

## How it works

1. **`/costsheet`** — Bootstrap 4 form: customer name, mobile, flat no.,
   type, area, rate, carpet area, MSEB, society formation, club house
   charges, stamp duty, maintenance, registration.
2. On submit (**`/costsheet/save`**), the controller validates the input,
   calculates:
   - `Agr. Cost = Area × Rate`
   - `Total Paid to Developer = Agr. Cost + MSEB + Society Formation + Club House Charges`
   - `GST = 12% of Agr. Cost + 18% of Maintenance` (per the notes on the sheet)
   - `Total Cost = Total Paid to Developer + Stamp Duty + Maintenance + Registration + GST`
   and inserts the full row into the `costsheets` MySQL table.
3. **`/costsheet/pdf/{id}`** — streams a PDF (view inline) built with TCPDF,
   styled to match the original costsheet layout (red project badge, pink/grey
   cost table, notes section).
   **`/costsheet/pdf/{id}/download`** — same PDF, forces a file download.
4. **`/costsheet/list_all`** — table of every saved costsheet, with links to
   view each one's PDF or delete it.

---

## Running locally with XAMPP (Windows / macOS / Linux)

1. **Install XAMPP** (PHP 7.4–8.3 all work) from https://www.apachefriends.org
   if you don't already have it, and start **Apache** and **MySQL** from the
   XAMPP control panel.

2. **Copy the project** into XAMPP's web root:
   - Windows: `C:\xampp\htdocs\costsheet_ci`
   - macOS: `/Applications/XAMPP/htdocs/costsheet_ci`
   - Linux: `/opt/lampp/htdocs/costsheet_ci`

   (Unzip the delivered archive so the `costsheet_ci` folder — the one
   containing `index.php` — sits directly inside `htdocs`.)

3. **Create the database:**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Click **Import**, choose the file `costsheet_ci/database/costsheet.sql`,
     and click **Go**.
   - This creates the `costsheet_db` database, the `costsheets` table, and
     inserts one sample record matching the reference image.

   *(Alternative via command line:)*
   ```
   mysql -u root -p < costsheet_ci/database/costsheet.sql
   ```

4. **Check the DB config** (only needed if your MySQL isn't the XAMPP
   default `root` with no password) in
   `costsheet_ci/application/config/database.php`:
   ```php
   'hostname' => 'localhost',
   'username' => 'root',
   'password' => '',
   'database' => 'costsheet_db',
   ```

5. **Open the app** in your browser:
   ```
   http://localhost/costsheet_ci/
   ```
   (or `http://localhost/costsheet_ci/index.php` if URL rewriting isn't
   enabled — both work, no `.htaccess` changes are required).

6. **Try it:**
   - Fill in the form and click **Save & Generate Costsheet**.
   - On the success page, click **View PDF** or **Download PDF**.
   - Click **View Saved Costsheets** to see every record and re-open its PDF.

---

## Running locally without XAMPP (PHP's built-in server)

If you have PHP (7.4+) and MySQL installed directly on your machine instead
of XAMPP:

```bash
# 1. Create the database (adjust user/password as needed)
mysql -u root -p < costsheet_ci/database/costsheet.sql

# 2. Update application/config/database.php with your MySQL credentials
#    if different from root / (no password)

# 3. Start PHP's built-in server from inside the project folder
cd costsheet_ci
php -S localhost:8080

# 4. Open in your browser
http://localhost:8080/index.php/costsheet
```

Required PHP extensions: `mysqli`, `curl`, `gd`, `mbstring` (all enabled by
default in XAMPP; if using a bare PHP install, enable them in `php.ini`).

---

## Troubleshooting a 500 error on Save

If `/costsheet/save` gives a 500 error, visit the built-in diagnostics page
first — it checks your PHP extensions, DB connection, and table structure
in one place:

```
http://localhost/costsheet_ci/index.php/costsheet/diagnostics
```

It will tell you exactly which of these is the problem:
- A required PHP extension (`mysqli`, `curl`, `gd`, `mbstring`) is missing
- The database isn't reachable
- The `costsheets` table doesn't exist (re-import `database/costsheet.sql`)
- The table exists but is missing columns (re-run the CREATE TABLE statement
  from `database/costsheet.sql`)

The `save()` action also now catches any database error and displays the
exact error message, file, and line instead of a blank 500 page.

## Notes

- `base_url` in `application/config/config.php` is pre-set to
  `http://localhost/costsheet_ci/`. If you deploy under a different folder
  name or host, update that line to match.
- The `costsheets` table stores every field shown on the original sheet plus
  a `created_at` timestamp, so historical costsheets are never overwritten.
- TCPDF is bundled under `application/third_party/tcpdf` — nothing to
  download or install for PDF generation to work.
- To change the branding (project name "GANGA FERNHILL PHASE" / location
  "UNDRI"), edit the defaults in `application/controllers/Costsheet.php`
  (`save()` method) or extend the form to make them editable fields.
