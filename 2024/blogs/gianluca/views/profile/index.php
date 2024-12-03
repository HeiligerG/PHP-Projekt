<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Post.php';

requireLogin();

$user = new User();
$userDetails = $user->getUserById($_SESSION['user_id']);
$posts = new Post();
$userPosts = $posts->getPostsByUserId($_SESSION['user_id'], 5);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');

    if (empty($username) || empty($email)) {
        $error = 'Bitte füllen Sie alle Felder aus.';
    } else {
        if ($user->updateProfile($_SESSION['user_id'], $username, $email)) {
            $success = 'Profil wurde erfolgreich aktualisiert.';
            $userDetails = $user->getUserById($_SESSION['user_id']);
            $_SESSION['username'] = $username;
        } else {
            $error = 'Beim Aktualisieren ist ein Fehler aufgetreten.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

<div class="max-w-4xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1">
            <div class="bg-slate-800 rounded-lg shadow-lg p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-primary-600 mx-auto flex items-center justify-center text-2xl font-bold mb-4">
                        <?php echo getInitials($userDetails['username']); ?>
                    </div>
                    <h2 class="text-xl font-bold"><?php echo htmlspecialchars($userDetails['username']); ?></h2>
                    <p class="text-slate-400">Blogger</p>
                </div>

                <div class="space-y-2 text-sm text-slate-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span><?php echo htmlspecialchars($userDetails['email']); ?></span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Mitglied seit <?php echo date('d.m.Y', strtotime($userDetails['created_at'])); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-slate-800 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-6">Profil bearbeiten</h2>

                <?php if ($error): ?>
                    <?php echo displayError($error); ?>
                <?php endif; ?>

                <?php if ($success): ?>
                    <?php echo displaySuccess($success); ?>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-300 mb-2">
                            Benutzername
                        </label>
                        <input type="text"
                               id="username"
                               name="username"
                               value="<?php echo htmlspecialchars($userDetails['username']); ?>"
                               required
                               class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                            E-Mail
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="<?php echo htmlspecialchars($userDetails['email']); ?>"
                               required
                               class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                            Speichern
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-800 rounded-lg shadow-lg p-6 mt-6">
                <h2 class="text-xl font-bold mb-6">Letzte Beiträge</h2>

                <?php if (empty($userPosts)): ?>
                    <p class="text-slate-400 text-center py-4">Noch keine Beiträge vorhanden.</p>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($userPosts as $post): ?>
                            <a href="/PHP-Projekt/WorkingDir/2024/blogs/gianluca/post/<?php echo $post['id']; ?>"
                               class="block bg-slate-700 rounded-lg p-4 hover:bg-slate-600 transition-colors">
                                <h3 class="font-medium mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <div class="text-sm text-slate-400">
                                    <?php echo formatDate($post['created_at']); ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>