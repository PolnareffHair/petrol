@echo off
setlocal enabledelayedexpansion

REM Найти первый файл с расширением .scss
for /r %%f in (*.scss) do (
    set "scss_file=%%f"
    goto :found
)
echo SCSS file not found.
exit /b 1

:found
REM Получить имя файла без расширения
set "filename=!scss_file:%cd%\=!"
set "filename=!filename:.scss=!"

REM Компилировать SCSS в CSS
sass "style.scss" "%filename%.css" -w

echo Compilation completed: %filename%.css
