<?php
require_once __DIR__ . '/../models/Rating.php';

if (!isset($postData) || !isset($postData['id'])) {
    return;
}

$rating = new Rating();
$averageRating = $rating->getAverageRating($postData['id']);
$userRating = isLoggedIn() ? $rating->getUserRating($postData['id'], $_SESSION['user_id']) : null;
$isOwnPost = isLoggedIn() && isset($postData['user_id']) && $postData['user_id'] == $_SESSION['user_id'];
?>

<div class="bg-slate-800 rounded-lg p-4 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Bewertung</h3>
        <div class="flex items-center space-x-2">
            <div class="text-lg font-bold">
                <?php echo number_format($averageRating['avg_rating'] ?? 0, 1); ?>
            </div>
            <div class="flex">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <svg class="w-5 h-5 <?php echo ($i <= ($averageRating['avg_rating'] ?? 0)) ? 'text-yellow-400' : 'text-slate-600'; ?>"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                <?php endfor; ?>
            </div>
            <span class="text-sm text-slate-400">
                (<?php echo $averageRating['rating_count'] ?? 0; ?>)
            </span>
        </div>
    </div>

    <?php if ($isOwnPost): ?>
        <div class="text-center py-2">
            <p class="text-slate-400">Sie können Ihren eigenen Beitrag nicht bewerten.</p>
        </div>
    <?php elseif (isLoggedIn()): ?>
        <div class="flex items-center justify-center space-x-2" id="rating-stars">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <button onclick="ratePost(<?php echo $postData['id']; ?>, <?php echo $i; ?>)"
                        class="rating-star p-2 rounded-full hover:bg-slate-700 transition-colors">
                    <svg class="w-8 h-8 <?php echo ($i <= ($userRating ?? 0)) ? 'text-yellow-400' : 'text-slate-600'; ?>
                                      hover:text-yellow-400 transition-colors"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </button>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-2">
            <a href="/PHP-Projekt/2024/blogs/gianluca/login" class="text-primary-400 hover:text-primary-300">
                Melden Sie sich an, um diesen Beitrag zu bewerten
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    function showCustomAlert(message, type = 'error') {
        const alertHtml = `
        <div class="fixed top-4 right-4 z-50 animate-fade-in" id="custom-alert">
            <div class="bg-${type === 'error' ? 'red' : 'green'}-500/10 border-${type === 'error' ? 'red' : 'green'}-500 border rounded-lg shadow-lg p-4 max-w-md flex items-center">
                <svg class="w-5 h-5 text-${type === 'error' ? 'red' : 'green'}-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${type === 'error'
            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
        }
                </svg>
                <p class="text-${type === 'error' ? 'red' : 'green'}-500 flex-1">${message}</p>
                <button onclick="this.parentElement.remove()" class="ml-4 text-${type === 'error' ? 'red' : 'green'}-500 hover:opacity-75">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    `;

        const existingAlert = document.getElementById('custom-alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        document.body.insertAdjacentHTML('beforeend', alertHtml);

        setTimeout(() => {
            const alert = document.getElementById('custom-alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }

    function ratePost(postId, rating) {
        fetch(`/PHP-Projekt/2024/blogs/gianluca/api/ratings`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                post_id: postId,
                rating: rating
            }),
            credentials: 'same-origin'
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.error || 'Ein Fehler ist aufgetreten.'); });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const stars = document.querySelectorAll('#rating-stars .rating-star svg');
                    stars.forEach((star, index) => {
                        if (index < rating) {
                            star.classList.add('text-yellow-400');
                            star.classList.remove('text-slate-600');
                        } else {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-slate-600');
                        }
                    });

                    showCustomAlert('Ihre Bewertung wurde erfolgreich gespeichert.', 'success');

                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showCustomAlert(error.message || 'Beim Bewerten ist ein Fehler aufgetreten.');
            });
    }
</script>