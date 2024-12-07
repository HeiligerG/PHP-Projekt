<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/User.php';

requireLogin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = 'Bitte füllen Sie alle Felder aus.';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'Die neuen Passwörter stimmen nicht überein.';
    } elseif (strlen($newPassword) < 8) {
        $error = 'Das neue Passwort muss mindestens 8 Zeichen lang sein.';
    } else {
        $user = new User();
        if ($user->changePassword($_SESSION['user_id'], $currentPassword, $newPassword)) {
            $success = 'Ihr Passwort wurde erfolgreich geändert.';
        } else {
            $error = 'Das aktuelle Passwort ist nicht korrekt.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

    <div class="max-w-xl mx-auto">
        <div class="bg-slate-800 rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Passwort ändern</h1>

            <?php if ($error): ?>
                <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg mb-6">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-6">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-300 mb-2">
                        Aktuelles Passwort
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="current_password"
                               name="current_password"
                               class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"
                               required>
                        <button type="button"
                                onclick="togglePassword('current_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-medium text-slate-300 mb-2">
                        Neues Passwort
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="new_password"
                               name="new_password"
                               class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"
                               minlength="8"
                               required>
                        <button type="button"
                                onclick="togglePassword('new_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-1 text-sm text-slate-400">
                        Mindestens 8 Zeichen
                    </p>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-slate-300 mb-2">
                        Neues Passwort bestätigen
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="confirm_password"
                               name="confirm_password"
                               class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"
                               minlength="8"
                               required>
                        <button type="button"
                                onclick="togglePassword('confirm_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="//PHP-Projekt/2024/blogs/gianluca/"
                       class="px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors">
                        Abbrechen
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                        Passwort ändern
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>