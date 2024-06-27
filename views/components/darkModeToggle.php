<div class="form-group">
    <select class="form-select form-select-sm" id="themeToggle">
        <option value="system">System Theme</option>
        <option value="light">Light Mode</option>
        <option value="dark">Dark Mode</option>
    </select>
</div>

<script>
    $(document).ready(function() {
        // Check the saved mode from cookies
        var mode = getCookie('mode') || 'system';
        setTheme(mode);
        $('#themeToggle').val(mode);

        // Toggle theme on select change
        $('#themeToggle').change(function() {
            var selectedMode = $(this).val();
            setTheme(selectedMode);
            setCookie('mode', selectedMode, 365);
        });

        // Set the theme based on the selected mode
        function setTheme(mode) {
            if (mode === 'dark') {
                enableDarkMode();
            } else if (mode === 'light') {
                disableDarkMode();
            } else {
                setSystemMode();
            }
        }

        // Enable dark mode
        function enableDarkMode() {
            $('html').attr('data-bs-theme', 'dark');
        }

        // Disable dark mode
        function disableDarkMode() {
            $('html').attr('data-bs-theme', 'light');
        }

        // Set system mode
        function setSystemMode() {
            var darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            if (darkModeMediaQuery.matches) {
                enableDarkMode();
            } else {
                disableDarkMode();
            }
        }

        // Set cookie
        function setCookie(name, value, days) {
            var expires = '';
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = '; expires=' + date.toUTCString();
            }
            document.cookie = name + '=' + (value || '') + expires + '; path=/';
        }

        // Get cookie
        function getCookie(name) {
            var nameEQ = name + '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1, c.length);
                }
                if (c.indexOf(nameEQ) === 0) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
            return null;
        }
    });
</script>