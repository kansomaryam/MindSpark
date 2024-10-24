<?php
// Check if the ACF fields are defined and retrieve their values
$title = get_field('title');
$metric_1_title = get_field('metric_1_title');
$metric_1_value = get_field('metric_1_value');
$metric_2_title = get_field('metric_2_title');
$metric_2_value = get_field('metric_2_value');
$metric_3_title = get_field('metric_3_title');
$metric_3_value = get_field('metric_3_value');
$description = get_field('description');
?>


<div class="financial-statistics-wrapper">
<div class="financial-statistics-block">
    <?php if ($title): ?>
        <h2 class="title"><?php echo esc_html($title); ?></h2>
    <?php else: ?>
        <h2 class="title">No title.</h2>
    <?php endif; ?>



    <div class="financial-metrics">
        <?php if ($metric_1_title && $metric_1_value): ?>
            <div class="metric">
                <h3><?php echo esc_html($metric_1_title); ?></h3>
                <p><?php echo esc_html($metric_1_value); ?></p>
            </div>
        <?php else: ?>
            <div class="metric">
                <h3>No data for Metric 1</h3>
            </div>
        <?php endif; ?>

        <?php if ($metric_2_title && $metric_2_value): ?>
            <div class="metric">
                <h3><?php echo esc_html($metric_2_title); ?></h3>
                <p><?php echo esc_html($metric_2_value); ?></p>
            </div>
        <?php else: ?>
            <div class="metric">
                <h3>No data for Metric 2</h3>
            </div>
        <?php endif; ?>

        <?php if ($metric_3_title && $metric_3_value): ?>
            <div class="metric">
                <h3><?php echo esc_html($metric_3_title); ?></h3>
                <p><?php echo esc_html($metric_3_value); ?></p>
            </div>
        <?php else: ?>
            <div class="metric">
                <h3>No data for Metric 3</h3>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($description): ?>
        <p class="financial-description"><?php echo esc_html($description); ?></p>
    <?php else: ?>
        <p class="financial-description">No description available.</p>
    <?php endif; ?>
</div>
</div>