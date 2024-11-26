<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/BljBlog.php';

requireLogin();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    redirect('/');
}

$bljBlog = new BljBlog();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentName = sanitizeInput($_POST['student_name'] ?? '');
    $blogUrl = sanitizeInput($_POST['blog_url'] ?? '');
    $classYear = sanitizeInput($_POST['class_year'] ?? '');

    if (empty($studentName) || empty($blogUrl) || empty($classYear)) {
        $error = 'Alle Felder müssen ausgefüllt werden.';
    } else {
        if ($bljBlog->addBlog($studentName, $blogUrl, $classYear)) {
            $success = 'Blog wurde erfolgreich hinzugefügt.';
        } else {
            $error = 'Beim Speichern ist ein Fehler aufgetreten.';
        }
    }
}

$blogs = $bljBlog->getAllBlogs();

include __DIR__ . '/../../layouts/header.php';
?>

    <div class="max-w-4xl mx-auto">
        <div class="bg-slate-800 rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-6">BLJ-Blogs verwalten</h1>

            <?php if ($error): ?>
                <?php echo displayError($error); ?>
            <?php endif; ?>

            <?php if ($success): ?>
                <?php echo displaySuccess($success); ?>
            <?php endif; ?>

            <form method="POST" class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Name
                        </label>
                        <input type="text"
                               name="student_name"
                               required
                               class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Blog URL
                        </label>
                        <input type="url"
                               name="blog_url"
                               required
                               class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            Jahrgang
                        </label>
                        <input type="text"
                               name="class_year"
                               required
                               pattern="[0-9]{4}"
                               class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none text-white">
                    </div>
                </div>
                <button type="submit"
                        class="mt-4 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Blog hinzufügen
                </button>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 text-slate-300">Name</th>
                        <th class="px-4 py-2 text-slate-300">URL</th>
                        <th class="px-4 py-2 text-slate-300">Jahrgang</th>
                        <th class="px-4 py-2 text-slate-300">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($blogs as $blog): ?>
                        <tr class="border-t border-slate-700">
                            <td class="px-4 py-3"><?php echo htmlspecialchars($blog['student_name']); ?></td>
                            <td class="px-4 py-3">
                                <a href="<?php echo htmlspecialchars($blog['blog_url']); ?>"
                                   target="_blank"
                                   class="text-primary-400 hover:text-primary-300">
                                    <?php echo htmlspecialchars($blog['blog_url']); ?>
                                </a>
                            </td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($blog['class_year']); ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $blog['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?php echo $blog['is_active'] ? 'Aktiv' : 'Inaktiv'; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>