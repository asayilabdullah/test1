# User Form + MySQL Toggle Task

A simple web page that connects to a MySQL database: users submit a
name and age through a form, the data is saved and shown in a table,
and each row has a **Toggle** button that flips a status (0/1) directly
in the database — updated live without refreshing the page (AJAX).

## Task

**Brief:**
Build a simple web page connected to a database.

**Steps required:**
1. Build the page with HTML, CSS, JavaScript, and connect it to the backend with PHP.
2. A form with two fields (name, age) and a "Submit" button.
3. Save every submitted name/age into a MySQL table.
4. Display the saved data in a table under the form.
5. A "Toggle" button next to each row that flips the person's status (0 ↔ 1).
6. Clicking Toggle updates the database **and** the value shown on screen instantly, with no page refresh.

**Hosting:** InfinityFree
**Deadline:** open, 2 weeks

## How this project meets the brief

| Requirement | Where it's handled |
|---|---|
| HTML/CSS/JS front end | `index.php` (HTML output), `style.css`, `script.js` |
| PHP backend | `config.php`, `index.php`, `toggle.php` |
| Form (name + age + submit) | Top of `index.php` |
| Save to MySQL | `index.php` inserts on submit, using a prepared statement |
| Show data in a table | `index.php` reads and lists all rows below the form |
| Toggle button per row | Rendered in the table, `class="toggle-btn"` |
| Live update, no reload | `script.js` sends a `fetch()` request to `toggle.php`, which updates MySQL and returns the new status as JSON; the page updates the cell text directly |

## Files

| File | Purpose |
|---|---|
| `index.php` | Main page: form, saves new entries, displays the table |
| `config.php` | Database connection settings (**edit this with your real InfinityFree credentials**) |
| `toggle.php` | AJAX endpoint — flips a user's status in the database |
| `script.js` | Handles the Toggle button click and the no-reload update |
| `style.css` | Basic styling |
| `database.sql` | SQL to create the `users` table |

## Database structure

```sql
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  age INT NOT NULL,
  status TINYINT(1) NOT NULL DEFAULT 0
);
```

## Deploying on InfinityFree

1. **Create a free account** at [infinityfree.net](https://infinityfree.net) and create a new hosting account (you'll get a free subdomain, or you can use your own domain).

2. **Create the database:**
   - In the InfinityFree control panel (cPanel), open **MySQL Databases**.
   - Create a new database — note the **database name**, **username**, and **password**.
   - Note the **MySQL hostname** shown there too (usually something like `sqlXXX.infinityfree.com`).

3. **Create the table:**
   - Open **phpMyAdmin** from the control panel.
   - Select your database, go to the **SQL** tab, paste the contents of `database.sql`, and run it.

4. **Update `config.php`** with your real values:
   ```php
   $host    = "sqlXXX.infinityfree.com";
   $db_user = "epiz_XXXXXXXX";
   $db_pass = "your_database_password";
   $db_name = "epiz_XXXXXXXX_dbname";
   ```

5. **Upload the files:**
   - Open **File Manager** (or use FTP with the credentials InfinityFree gives you).
   - Go to the `htdocs` folder.
   - Upload all the files (`index.php`, `config.php`, `toggle.php`, `script.js`, `style.css`).

6. **Visit your site** at your InfinityFree subdomain (e.g. `http://yoursite.infinityfreeapp.com`) — the form and table should be live.

## Uploading to GitHub

1. Create a new repository on GitHub.
2. Upload all the files in this folder (`index.php`, `config.php`, `toggle.php`, `script.js`, `style.css`, `database.sql`, `README.md`).
   - ⚠️ In a real production project you would **not** commit real database
     passwords — here `config.php` is included so the reviewer can see the
     full working setup, but ideally credentials should be kept out of
     version control (e.g. using a `.gitignore`'d config file).
3. In the repo description or README, link the live InfinityFree URL so the task reviewer can test it directly.
