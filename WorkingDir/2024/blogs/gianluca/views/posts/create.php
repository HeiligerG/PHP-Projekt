<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/Post.php';

requireLogin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitizeInput($_POST['title'] ?? '');
    $content = sanitizeInput($_POST['content'] ?? '');
    $imageUrl = sanitizeInput($_POST['image_url'] ?? '');

    if (empty($title) || empty($content)) {
        $error = 'Titel und Inhalt sind erforderlich.';
    } else {
        $post = new Post();
        if ($post->createPost($_SESSION['user_id'], $title, $content, $imageUrl)) {
            redirect('/');
        } else {
            $error = 'Beim Erstellen des Beitrags ist ein Fehler aufgetreten.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-slate-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Neuer Blog-Beitrag</h1>

        <?php if ($error): ?>
            <?php echo displayError($error); ?>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-300 mb-2">
                    Titel
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       required
                       class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"
                       placeholder="Geben Sie einen Titel ein">
            </div>

            <div>
                <label for="image_url" class="block text-sm font-medium text-slate-300 mb-2">
                    Bild URL (optional)
                </label>
                <input type="url"
                       id="image_url"
                       name="image_url"
                       class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"
                       placeholder="https://beispiel.com/bild.jpg">
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-slate-300 mb-2">
                    Inhalt
                </label>
                <textarea id="content"
                          name="content"
                          rows="12"
                          required
                          class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white"
                          placeholder="Schreiben Sie hier Ihren Beitrag..."></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="/blog"
                   class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors">
                    Abbrechen
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Veröffentlichen
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-slate-800 rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-medium mb-4">Live-Vorschau</h2>
        <div id="preview" class="prose prose-invert max-w-none">
            <p class="text-slate-400">Ihre Vorschau erscheint hier...</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const contentInput = document.getElementById('content');
        const preview = document.getElementById('preview');

        function updatePreview() {
            const title = titleInput.value;
            const content = contentInput.value;

            preview.innerHTML = `
            ${title ? `<h1 class="text-2xl font-bold mb-4">${title}</h1>` : ''}
            ${content ? `<div class="whitespace-pre-wrap">${content}</div>` : ''}
        `;
        }

        titleInput.addEventListener('input', updatePreview);
        contentInput.addEventListener('input', updatePreview);
    });
</script>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>