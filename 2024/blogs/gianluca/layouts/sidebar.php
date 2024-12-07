<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HolyBlog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950">
<button
        id="burgerButton"
        class="fixed top-6 right-4 z-50 xl:hidden text-white hover:text-gray-300 focus:outline-none">
    <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
    <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerButton = document.getElementById('burgerButton');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');

            function toggleIcons() {
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            }

            burgerButton.addEventListener('click', toggleIcons);
        });
    </script>
</button>

<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 xl:hidden hidden"></div>

<aside id="sidebar" class="transform -translate-x-full xl:translate-x-0 w-full xl:w-64 bg-slate-900 border-r border-slate-800 h-screen fixed left-0 top-0 transition-transform duration-300 ease-in-out z-40">
    <div class="flex flex-col h-full">
        <div class="p-6 border-b border-slate-800">
            <a href="/PHP-Projekt/2024/blogs/gianluca" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                    </svg>
                    <span class="text-2xl font-bold text-white">HolyBlog</span>
                </a>
        </div>

        <?php if (isLoggedIn()): ?>
            <div class="p-6 border-b border-slate-800">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-lg font-bold text-white">
                        <?php echo getInitials($_SESSION['username']); ?>
                    </div>
                    <div>
                        <div class="font-medium text-white">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </div>
                        <div class="text-sm text-slate-400">Blogger</div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="p-6 border-b border-slate-800">
                <div class="space-y-2">
                    <a href="/PHP-Projekt/2024/blogs/gianluca/login" class="flex items-center justify-center px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition-colors">
                        <span>Anmelden</span>
                    </a>
                    <a href="/PHP-Projekt/2024/blogs/gianluca/register" class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <span>Registrieren</span>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="p-4">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">
                Account
            </div>
            <div class="space-y-1">
                <a href="/PHP-Projekt/2024/blogs/gianluca/views/profile/"
                   class="flex items-center text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profil</span>
                </a>
                <a href="/PHP-Projekt/2024/blogs/gianluca/profile/change-password"
                   class="flex items-center text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <span>Passwort ändern</span>
                </a>
            </div>
        </div>
        <nav class="flex-1 p-6">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">
                Navigation
            </div>
            <ul class="space-y-1">
                <li>
                    <a href="/PHP-Projekt/2024/blogs/gianluca" class="flex items-center text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/PHP-Projekt/2024/blogs/gianluca/posts/create" class="flex items-center text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Neuer Beitrag</span>
                    </a>
                </li>
                <li>
                    <a href="/PHP-Projekt/2024/blogs/gianluca/posts/my-posts" class="flex items-center text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span>Meine Beiträge</span>
                    </a>
                </li>
                <li class="sm:block md:block lg:block xl:block 2xl:hidden">
                    <a href="/PHP-Projekt/2024/blogs/gianluca/views/bljblogs/blogs.php" class="flex items-center text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Weitere Blogs</span>
                    </a>
                </li>
            </ul>
        </nav>

        <?php if (isLoggedIn()): ?>
            <div class="p-6 border-t border-slate-800">
                <a href="/PHP-Projekt/2024/blogs/gianluca/logout" class="flex items-center text-red-400 hover:text-red-300 hover:bg-slate-800 px-3 py-2 rounded-lg transition-colors w-full">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Abmelden</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</aside>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const burgerButton = document.getElementById('burgerButton');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleMenu() {
            const isOpen = sidebar.classList.contains('translate-x-0');

            if (isOpen) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                overlay.classList.remove('hidden');
            }
        }

        burgerButton.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1280) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                overlay.classList.add('hidden');
            }
        });
    });
</script>
</html>