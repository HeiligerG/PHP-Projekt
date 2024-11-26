<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/User.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Bitte füllen Sie alle Felder aus.';
    } else {
        $user = new User();
        if ($user->login($email, $password)) {
            redirect('/');
        } else {
            $error = 'Ungültige E-Mail oder Passwort.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

<div class="max-w-md mx-auto my-8">
    <div class="bg-slate-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Anmelden</h1>

        <?php if ($error): ?>
            <?php echo displayError($error); ?>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    E-Mail
                </label>
                <input type="email" name="email" required
                       class="w-full px-3 py-2 bg-slate-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    Passwort
                </label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 bg-slate-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
            </div>

            <button type="submit"
                    class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                Anmelden
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-slate-400">
            Noch kein Konto?
            <a href="/2024/blogs/gianluca/auth/register" class="text-primary-400 hover:text-primary-300">
                Jetzt registrieren
            </a>
        </p>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>