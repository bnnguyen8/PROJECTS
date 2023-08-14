<script>
    !function() {
        try {
            var d = document.documentElement
                , c = d.classList;
            c.remove('light', 'dark');
            var e = localStorage.getItem('theme');
            if ('system' === e || (!e && true)) {
                var t = '(prefers-color-scheme: dark)'
                    , m = window.matchMedia(t);
                if (m.media !== t || m.matches) {
                    d.style.colorScheme = 'dark';
                    c.add('dark')
                } else {
                    d.style.colorScheme = 'light';
                    c.add('light')
                }
            } else if (e) {
                c.add(e || '')
            }
            if (e === 'light' || e === 'dark')
                d.style.colorScheme = e
        } catch (e) {}
    }()
</script>
<header class="sticky top-0 z-10 dark:bg-slate-900 backdrop-blur bg-white supports-backdrop-blur:bg-white/95 dark:bg-slate-900/75 transition-colors duration-500 lg:z-40 lg:border-b lg:border-slate-900/10 dark:border-slate-50/[0.06]">
    <div class="xl:container xl:mx-auto sm:flex md:items-center md:px-4 md:py-3">
        <div class="flex items-center justify-between px-4 py-3 md:p-0 font-medium flex-grow">
            <div class="flex space-x-4 items-center justify-center">
                <a href="https://github.com/bnnguyen8" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="github">
                    <style data-emotion="css 1cw4hi4">
                        .css-1cw4hi4 {
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                            width: 1em;
                            height: 1em;
                            display: inline-block;
                            fill: currentColor;
                            -webkit-flex-shrink: 0;
                            -ms-flex-negative: 0;
                            flex-shrink: 0;
                            -webkit-transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            font-size: inherit;
                        }
                    </style>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" role="img" viewBox="0 0 24 24" data-testid="GitHubIcon">
                        <path d="M12 1.27a11 11 0 00-3.48 21.46c.55.09.73-.28.73-.55v-1.84c-3.03.64-3.67-1.46-3.67-1.46-.55-1.29-1.28-1.65-1.28-1.65-.92-.65.1-.65.1-.65 1.1 0 1.73 1.1 1.73 1.1.92 1.65 2.57 1.2 3.21.92a2 2 0 01.64-1.47c-2.47-.27-5.04-1.19-5.04-5.5 0-1.1.46-2.1 1.2-2.84a3.76 3.76 0 010-2.93s.91-.28 3.11 1.1c1.8-.49 3.7-.49 5.5 0 2.1-1.38 3.02-1.1 3.02-1.1a3.76 3.76 0 010 2.93c.83.74 1.2 1.74 1.2 2.94 0 4.21-2.57 5.13-5.04 5.4.45.37.82.92.82 2.02v3.03c0 .27.1.64.73.55A11 11 0 0012 1.27"></path>
                        <title>Github</title>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/in/bnamnguyen/" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="linkedin">
                    <style data-emotion="css 1cw4hi4">
                        .css-1cw4hi4 {
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                            width: 1em;
                            height: 1em;
                            display: inline-block;
                            fill: currentColor;
                            -webkit-flex-shrink: 0;
                            -ms-flex-negative: 0;
                            flex-shrink: 0;
                            -webkit-transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            font-size: inherit;
                        }
                    </style>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" role="img" viewBox="0 0 24 24" data-testid="LinkedInIcon">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                        <title>LinkedIn</title>
                    </svg>
                </a>
                <a href="mailto:bnnguyen8@gmail.com" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="mailto">
                    <style data-emotion="css 1cw4hi4">
                        .css-1cw4hi4 {
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                            width: 1em;
                            height: 1em;
                            display: inline-block;
                            fill: currentColor;
                            -webkit-flex-shrink: 0;
                            -ms-flex-negative: 0;
                            flex-shrink: 0;
                            -webkit-transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            font-size: inherit;
                        }
                    </style>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" role="img" viewBox="0 0 24 24" data-testid="EmailIcon">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"></path>
                        <title>Email</title>
                    </svg>
                </a>
            </div>
            <div id="topRightNavClick" class="sm:hidden">
                <button type="button" class="block text-gray-500 hover:text-amber-700 focus:text-amber-700 focus:outline-none" aria-label="Problem List">
                    <style data-emotion="css vubbuv">
                        .css-vubbuv {
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                            width: 1em;
                            height: 1em;
                            display: inline-block;
                            fill: currentColor;
                            -webkit-flex-shrink: 0;
                            -ms-flex-negative: 0;
                            flex-shrink: 0;
                            -webkit-transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                            font-size: 1.5rem;
                        }
                    </style>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="MoreVertIcon">
                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <nav id="topRightNav" class="text-lg items-center justify-between sm:flex sm:p-0 sm:text-md hidden">
            <?php
                $class1 = "block px-2 py-1 mx-2 rounded hover:text-amber-600 hover:dark:text-amber-600 transition ease-in-out duration-300 text-end font-semibold text-amber-600";

                $class2 = "block px-2 py-1 mx-2 rounded hover:text-amber-600 hover:dark:text-amber-600 transition ease-in-out duration-300 text-end text-slate-700 dark:text-slate-200";

                if(request()->path() == "resume") {
                    $tmp = $class1;
                    $class1 = $class2;
                    $class2 = $tmp;
                }
            ?>
            <a href="/" class="{{ $class1 }}">About </a>
            <a href="/resume" class="{{ $class2 }}">Resume</a>
        </nav>
    </div>
    <div class="lg:hidden"></div>
</header>