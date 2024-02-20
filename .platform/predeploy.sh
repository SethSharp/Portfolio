#!/bin/bash

# Navigate to the directory where your Vue.js project is
cd /var/www/html

# Run npm run build
npm run build

composer dump-autoload

# Add more actions as needed
