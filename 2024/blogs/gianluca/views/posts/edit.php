<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/Post.php';

requireLogin();

$postId = isset($matches[1]) ? (int)$matches[1] : 0;
$post = new Post();
$postData = $post->getPostById($postId);

if (!$postData || $postData['user_id'] != $_SESSION['user_id']) {
    redirect('/');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitizeInput($_POST['title'] ?? '');
    $content = sanitizeInput($_POST['content'] ?? '');
    $imageUrl = sanitizeInput($_POST['image_url'] ?? '');

    if (empty($title) || empty($content)) {
        $error = 'Titel und Inhalt sind erforderlich.';
    } else {
        if ($post->updatePost($postId, $_SESSION['user_id'], $title, $content, $imageUrl)) {
            $success = 'Beitrag wurde erfolgreich aktualisiert.';
            $postData = $post->getPostById($postId);
        } else {
            $error = 'Beim Aktualisieren ist ein Fehler aufgetreten.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-slate-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Beitrag bearbeiten</h1>

        <?php if ($error): ?>
            <?php echo displayError($error); ?>
        <?php endif; ?>

        <?php if ($success): ?>
            <?php echo displaySuccess($success); ?>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-300 mb-2">
                    Titel
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="<?php echo htmlspecialchars($postData['title']); ?>"
                       required
                       class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
            </div>

            <div>
                <label for="image_url" class="block text-sm font-medium text-slate-300 mb-2">
                    Bild URL (optional)
                </label>
                <input type="url"
                       id="image_url"
                       name="image_url"
                       value="<?php echo htmlspecialchars($postData['image_url'] ?? ''); ?>"
                       class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-slate-300 mb-2">
                    Inhalt
                </label>
                <textarea id="content"
                          name="content"
                          rows="12"
                          required
                          class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"><?php echo htmlspecialchars($postData['content']); ?></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="/PHP-Projekt/2024/blogs/gianluca/post/<?php echo $postId; ?>"
                   class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors">
                    Abbrechen
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Speichern
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>