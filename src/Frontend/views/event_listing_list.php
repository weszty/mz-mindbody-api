<?php

use MZoo\MzMindbody as NS;
use MZoo\MzMindbody\Core as Core;

if (( is_array($data->events) ) && ! empty($data->events) ) : ?>
    <table class="mz_event_list_listing">

        <thead>
            <tr class="header" style="display: table-row">
                <th class="mz_event_date_display" scope="header">
                    <?php esc_html_e($data->heading_date); ?>
                </th>
                <th class="mz_event_classDetails" scope="header">
                    <?php esc_html_e($data->heading_time); ?>
                </th>
                <th class="mz_event_name" scope="header">
                    <?php esc_html_e($data->heading_event); ?>
                </th>
                <?php if ($data->locations_count >= 2 ) : ?>
                    <th class="mz_event_location" scope="header">
                    <?php esc_html_e($data->heading_location); ?>
                    </th>
                <?php endif; ?>
            </tr>
        </thead>

    <?php foreach ( $data->events as $date => $events ) : ?>
        <?php foreach ( $events as $event ) : ?>
        <tbody>
            <tr>
                <td><?php echo wp_date(Core\MzMindbodyApi::$date_format, strtotime($event->startDateTime)); ?> <br /><?php esc_html_e($event->sign_up_link->build()); ?></td>
                <td>
            <?php echo wp_date(Core\MzMindbodyApi::$time_format, strtotime($event->startDateTime)); ?> -
            <?php echo wp_date(Core\MzMindbodyApi::$time_format, strtotime($event->endDateTime)); ?>
                </td>
                <td>
            <?php esc_html_e($event->class_name_link->build() . ' ' . $data->with . ' ' . $event->staff_name_link->build()); ?>

                </td>
            <?php
            // Display location if showing schedule for more than one location
            if ($data->locations_count >= 2 ) :
                ?>
                <td>
                <?php esc_html_e($data->locations_dictionary[ $event->location_ID ]['link']); ?>
                </td>
            <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (count($data->events) == 0 ) : ?>
    <h4><?php esc_html_e($data->no_events); ?></h4>
<?php else : ?>
    <div class="error"><?php esc_html_e('Error Retrieving Events', 'mz_mindbody_api'); ?></div>
    <p><?php var_dump($data->events); ?></p>

<?php endif; ?>
