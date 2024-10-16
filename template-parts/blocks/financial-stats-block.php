<div?php
/**
 * Financial Statistics Block template
 *
 * @package Aquila
 */

?>

<?php
$title = get_field('title');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="financial-statistics-wrap">
<div class="financial-statistics-block" style="background-image: url('<?php echo esc_url(get_field('background_image')); ?>');">
<?php if ($title): ?>
        <h2 class="title"><?php echo esc_html($title); ?></h2>
    <?php else: ?>
        <h2 class="title">No title.</h2>
    <?php endif; ?>
    
    <div class="statistic">
        <h3>YTD Revenue</h3>
        <p><?php the_field('ytd_revenue'); ?></p>
    </div>

    <div class="statistic">
        <h3>Growth</h3>
        <p><?php the_field('growth'); ?>%</p>
    </div>

    <div class="statistic">
        <h3>Customer Retention</h3>
        <p><?php the_field('customer_retention'); ?>%</p>
    </div>

    <canvas id="financialChart" width="400" height="200"></canvas>

</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('financialChart').getContext('2d');
        var financialChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['YTD Revenue', 'Growth', 'Customer Retention'], // Example labels
                datasets: [{
                    label: 'Statistics',
                    data: [
                        <?php echo get_field('ytd_revenue'); ?>,
                        <?php echo get_field('growth'); ?>,
                        <?php echo get_field('customer_retention'); ?>
                    ],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 150 // Adjust as necessary
                    }
                }
            }
        });
    });
</script>
</article>
