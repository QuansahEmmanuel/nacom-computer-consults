/myApp
│
├── /public # Publicly accessible files
│ ├── index.html # Entry page (login or landing)
│ ├── 404.html # Custom 404 page
│ ├── /assets # Images, fonts, icons, etc.
│ ├── /css
│ │ └── styles.css # Tailwind & DaisyUI compiled CSS
│ └── /js
│ └── app.js # General frontend JavaScript
│
├── /views # UI templates (optional with includes)
│ ├── /user # Pages for regular users
│ ├── /admin # Pages for admin
│ ├── /support # Pages for support center
│ └── /partials # Common layout parts (nav, footer)
│
├── /api # Backend PHP scripts
│ ├── auth # login.php, register.php, logout.php
│ ├── user # user-specific APIs
│ ├── admin # admin-specific APIs
│ ├── support # support center APIs
│ └── middleware.php # Auth protection logic
│
├── /includes # Shared PHP logic
│ ├── db.php # DB connection
│ ├── auth.php # Auth/session utilities
│ └── helper.php # Any helper functions
│
├── .htaccess # Apache config for URL protection (optional)
├── tailwind.config.js # Tailwind config
├── postcss.config.js # PostCSS config
├── package.json # npm scripts (for Tailwind build)
└── README.md
