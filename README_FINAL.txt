Andrew Yemen - Demo ZIP (Final)

What I changed in this demo ZIP:
- Big banner "Andrew Yemen" and blue theme.
- Bilingual switch (EN / ع) on top-right. Pages show an approved sample job if DB empty.
- One approved sample job included in install.sql so the homepage shows a listing immediately.
- Admin panel at /admin/ with login (use 'admin' after running setup_admin.php to set password to 123456).
- setup_admin.php: run once after importing install.sql to set admin password to 123456, then delete it.
- db_config.php: update with your DB credentials before use.

Quick deployment steps:
1. Create a free hosting account (InfinityFree / 000WebHost). Create a MySQL DB.
2. Edit db_config.php with your DB host, user, pass, and DB name.
3. Import install.sql via phpMyAdmin.
4. Upload all files to public_html or htdocs.
5. Run setup_admin.php once via browser to set admin password to '123456'. Then delete setup_admin.php.
6. Visit your site. The homepage will show the sample approved job automatically.
