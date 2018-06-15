<p align="center">
        <img src="https://thumbs.dreamstime.com/b/warehouse-sketch-3d-illustration-113675007.jpg" height="100px">
    <h1 align="center">Warehouse Test Assignment</h1>
    <br>
</p>


Documentation
-------------
#General
- admin/user demo auth details:
```
User/Password(Admin): admin/admin123
User/Password(User): user/user123
```
- PHP Support 5.6+.
- Caching Enabled using xcache (not for all pages).
- Using RBAC with permission tables set up for 2 type with proper permissions for managing stocks and vieweing menus (admin && user).
- RBAC is implemented in a way where it checks if user has perms (user->can()).
- Exception messages with intern. support.
- Admin (admin/admin123) can navigate to create perms,roles and invite users to groups through menu links.
- Restrictions from directly accessing admin links are NOT done.
- Admin can do all CRUD operation on products, where users can only do the same where authorID is the userID.
- MySQL Dump is provided in the commit under the name:
```
dbDump.sql
```
- Example of internationalization can be viewed in the code with comments, under:
```
/views/site/index.php
```
- Example of internationalization messages are located under:
```
/messages/ka_GE/app.php
```
- Example setting aliases and using them can be viewed under:
```
/config/web.php && /controllers/ProductController.php && /views/product/view.php
```
- Migrations with Up/Down Support can be viewed under:
```
/migrations/
```

Thanks!.
