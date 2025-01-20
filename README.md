<p>Vehicle API</p>
<p>Demo app for Laravel/Sail</p>
<p>Add docker image of phpmyadmin for better mysql UI</p>
<p>Show/Create/Delete methods</p>
<p>run commands</p>
<ul>
    <li>./vendor/bin/sail bash</li>
    <li>php artisan key:generate --ansi</li>
    <li>composer install</li>
    <li>php artisan migrate</li>
    <li>php artisan serve</li>
    <li>npm install</li>
    <li>npm run dev</li>
    <li>composer run dev</li>
</ul>

<p>if system is not windows 10 then uncomment</p>
<pre>
********************************
comment in file  - vendor/laravel/sail/bin/sail 
********************************

# case "${UNAMEOUT}" in
#     Linux*)             MACHINE=linux;;
#     Darwin*)            MACHINE=mac;;
#     *)                  MACHINE="UNKNOWN"
# esac

# if [ "$MACHINE" == "UNKNOWN" ]; then
#     echo "Unsupported operating system [$(uname -s)]. Laravel Sail supports macOS, Linux, and Windows (WSL2)." >&2

#     exit 1
# fi
</pre>
