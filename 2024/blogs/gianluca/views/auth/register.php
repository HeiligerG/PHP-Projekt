<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/User.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Alle Felder müssen ausgefüllt werden.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Die Passwörter stimmen nicht überein.';
    } elseif (strlen($password) < 6) {
        $error = 'Das Passwort muss mindestens 6 Zeichen lang sein.';
    } else {
        $user = new User();
        if ($user->register($username, $email, $password)) {
            $success = 'Registrierung erfolgreich! Sie können sich jetzt anmelden.';
        } else {
            $error = 'Benutzername oder E-Mail bereits vergeben.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

<div class="max-w-md mx-auto my-8">
    <div class="bg-slate-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Registrieren</h1>

        <?php if ($error): ?>
            <?php echo displayError($error); ?>
        <?php endif; ?>

        <?php if ($success): ?>
            <?php echo displaySuccess($success); ?>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    Benutzername
                </label>
                <input type="text" name="username" required
                       class="w-full px-3 py-2 bg-slate-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    E-Mail
                </label>
                <input type="email" name="email" required
                       class="w-full px-3 py-2 bg-slate-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    Passwort
                </label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 bg-slate-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    Passwort bestätigen
                </label>
                <input type="password" name="confirm_password" required
                       class="w-full px-3 py-2 bg-slate-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                Registrieren
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-slate-400">
            Bereits registriert?
            <a href="/2024/blogs/gianluca/login" class="text-primary-400 hover:text-primary-300">
                Hier anmelden
            </a>
        </p>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>