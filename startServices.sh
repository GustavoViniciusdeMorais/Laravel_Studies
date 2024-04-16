 #!/bin/bash
service php8.1-fpm start
service php8.1-fpm status
service nginx start
service --status-all

# Define the path to the folder containing the SQLite database file
database_folder="api/database"
# Ensure the database folder exists, if not, create it
if [ ! -d "$database_folder" ]; then
    mkdir "$database_folder"
fi
# Define the path to the SQLite database file
database_file="$database_folder/database.sqlite"
# Check if the SQLite database file exists, if not, create it
if [ ! -f "$database_file" ]; then
    touch "$database_file"
    chmod -R 777 "$database_file";
    echo "Database file created.";
fi