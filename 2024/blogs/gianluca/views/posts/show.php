<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/Post.php';
require_once __DIR__ . '/../../models/Comment.php';

$postId = isset($matches[1]) ? (int)$matches[1] : 0;
$post = new Post();
$comment = new Comment();

$postData = $post->getPostById($postId);
$comments = $comment->getCommentsByPostId($postId);

if (!$postData) {
    redirect('/');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_comment'])) {
    $commentId = (int)$_POST['comment_id'];
    $comment = new Comment();

    if ($comment->deleteComment($commentId, $_SESSION['user_id'])) {
        redirect("/2024/blogs/gianluca/post/{$postId}");
    } else {
        $error = 'Beim Löschen ist ein Fehler aufgetreten.';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment']) && isLoggedIn()) {
    $content = sanitizeInput($_POST['comment']);

    if (empty($content)) {
        $error = 'Der Kommentar darf nicht leer sein.';
    } else {
        if ($comment->createComment($postId, $_SESSION['user_id'], $content)) {
            $success = 'Kommentar wurde erfolgreich hinzugefügt.';
            $comments = $comment->getCommentsByPostId($postId);
        } else {
            $error = 'Beim Speichern des Kommentars ist ein Fehler aufgetreten.';
        }
    }
}

include __DIR__ . '/../../layouts/header.php';
?>

    <div class="max-w-4xl mx-auto">
        <article class="bg-slate-800 rounded-lg shadow-lg overflow-hidden mb-8">
            <?php if ($postData['image_url']): ?>
                <div class="w-full h-96 relative">
                    <img src="<?php echo htmlspecialchars($postData['image_url']); ?>"
                         alt="<?php echo htmlspecialchars($postData['title']); ?>"
                         class="w-full h-full object-cover">
                </div>
            <?php endif; ?>

            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">
                    <?php echo htmlspecialchars($postData['title']); ?>
                </h1>

                <div class="flex items-center space-x-4 text-slate-400 mb-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center mr-2">
                            <?php echo getInitials($postData['username']); ?>
                        </div>
                        <span><?php echo htmlspecialchars($postData['username']); ?></span>
                    </div>
                    <span>•</span>
                    <time datetime="<?php echo $postData['created_at']; ?>">
                        <?php echo formatDate($postData['created_at']); ?>
                    </time>
                </div>

                <div class="prose prose-invert max-w-none">
                    <?php echo nl2br(htmlspecialchars($postData['content'])); ?>
                </div>
            </div>
        </article>

        <?php include __DIR__ . '/../../components/rating.php'; ?>
        <div class="bg-slate-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-6">Kommentare (<?php echo count($comments); ?>)</h2>

            <?php if ($error): ?>
                <?php echo displayError($error); ?>
            <?php endif; ?>

            <?php if ($success): ?>
                <?php echo displaySuccess($success); ?>
            <?php endif; ?>

            <?php if (isLoggedIn()): ?>
                <form method="POST" class="mb-8">
                    <div class="flex space-x-4">
                        <div class="w-10 h-10 rounded-full bg-primary-600 flex-shrink-0 flex items-center justify-center">
                            <?php echo getInitials($_SESSION['username']); ?>
                        </div>
                        <div class="flex-1">
                        <textarea name="comment"
                                  rows="3"
                                  class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white resize-none"
                                  placeholder="Schreiben Sie einen Kommentar..."
                                  required></textarea>
                            <button type="submit"
                                    class="mt-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                Kommentieren
                            </button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <div class="bg-slate-700 rounded-lg p-4 mb-8 text-center">
                    <p class="text-slate-300 mb-2">Melden Sie sich an, um zu kommentieren</p>
                    <a href="/2024/blogs/gianluca/login" class="text-primary-400 hover:text-primary-300">
                        Jetzt anmelden
                    </a>
                </div>
            <?php endif; ?>

            <?php if (empty($comments)): ?>
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-slate-400">Noch keine Kommentare vorhanden.</p>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php foreach ($comments as $comment): ?>
                        <div class="flex space-x-4" id="comment-<?php echo $comment['id']; ?>">
                            <div class="w-10 h-10 rounded-full bg-primary-600 flex-shrink-0 flex items-center justify-center">
                                <?php echo getInitials($comment['username']); ?>
                            </div>
                            <div class="flex-1">
                                <div class="bg-slate-700 rounded-lg p-4">
                                    <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">
                                        <?php echo htmlspecialchars($comment['username']); ?>
                                    </span>
                                        <time class="text-sm text-slate-400">
                                            <?php echo formatDate($comment['created_at']); ?>
                                        </time>
                                    </div>
                                    <p class="text-slate-300">
                                        <?php echo nl2br(htmlspecialchars($comment['content'])); ?>
                                    </p>
                                </div>
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['user_id']): ?>
                                    <button onclick="deleteComment(<?php echo $comment['id']; ?>)"
                                            class="mt-2 text-sm text-red-400 hover:text-red-300">
                                        L&#246;schen
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function deleteComment(commentId) {
            if (confirm('M\u00F6chten Sie diesen Kommentar wirklich l\u00F6schen?')) {
                const formData = new FormData();
                formData.append('delete_comment', true);
                formData.append('comment_id', commentId);

                fetch(window.location.href, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                })
                    .then(response => {
                        if (response.ok) {
                            const commentElement = document.getElementById('comment-' + commentId);
                            if (commentElement) {
                                commentElement.remove();
                            }
                        } else {
                            alert('Fehler beim L\u00F6schen');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Fehler beim L\u00F6schen');
                    });
            }
        }
    </script>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>