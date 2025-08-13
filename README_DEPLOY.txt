Andrew Yemen - Full Job Site (PHP + MySQL)

Files added/changed:
- register.php, login.php, logout.php
- profile.php (edit profile, upload resume for jobseekers)
- employer.php (view employer profile and jobs)
- apply.php (apply to a job; jobseekers only)
- post_job.php updated to require employer login
- admin/applications.php (view applications)
- install.sql (creates full schema)
- setup_admin.php (run once to set admin password to '123456')

Deployment steps (summary):
1. Create a MySQL database on your free hosting and note the DB credentials.
2. Edit db_config.php with the DB details.
3. Import install.sql via phpMyAdmin.
4. Upload files to public_html/htdocs.
5. Run setup_admin.php once via browser to set admin password to '123456', then delete the file.
6. Register a new employer or jobseeker or login as admin to manage site.
7. Employers can post jobs (they will be pending until admin approves).
8. Jobseekers can create profiles and apply to jobs.

If you want, I can further style pages (CSS) and add icons before you upload. Let me know.
