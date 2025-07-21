<?php
/**
 * The template for displaying comments
 *
 * @package WP_Blank
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area bg-white rounded-lg shadow-sm border border-gray-200 p-8">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title text-2xl font-bold text-gray-900 mb-6">
            <?php
            $wp_blank_comment_count = get_comments_number();
            if ('1' === $wp_blank_comment_count) {
                printf(
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'wp-blank'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx(
                        '%1$s thought on &ldquo;%2$s&rdquo;',
                        '%1$s thoughts on &ldquo;%2$s&rdquo;',
                        $wp_blank_comment_count,
                        'comments title',
                        'wp-blank'
                    )),
                    number_format_i18n($wp_blank_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation([
            'prev_text' => '&larr; ' . __('Older Comments', 'wp-blank'),
            'next_text' => __('Newer Comments', 'wp-blank') . ' &rarr;',
            'class'     => 'comments-navigation mb-6',
        ]); ?>

        <ol class="comment-list space-y-6">
            <?php
            wp_list_comments([
                'style'      => 'ol',
                'short_ping' => true,
                'callback'   => 'wp_blank_comment_callback',
            ]);
            ?>
        </ol><!-- .comment-list -->

        <?php the_comments_navigation([
            'prev_text' => '&larr; ' . __('Older Comments', 'wp-blank'),
            'next_text' => __('Newer Comments', 'wp-blank') . ' &rarr;',
            'class'     => 'comments-navigation mt-6',
        ]); ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments text-gray-600 italic mt-6">
                <?php esc_html_e('Comments are closed.', 'wp-blank'); ?>
            </p>
        <?php endif; ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    // Comment form
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $html_req = ($req ? " required='required'" : '');

    $fields = [
        'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-1">' . __('Name', 'wp-blank') . ($req ? ' <span class="text-red-500">*</span>' : '') . '</label>
                            <input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        </div>',
        'email'  => '<div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">' . __('Email', 'wp-blank') . ($req ? ' <span class="text-red-500">*</span>' : '') . '</label>
                            <input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        </div>
                    </div>',
        'url'    => '<div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-1">' . __('Website', 'wp-blank') . '</label>
                        <input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    </div>',
    ];

    comment_form([
        'title_reply'          => __('Leave a Reply', 'wp-blank'),
        'title_reply_to'       => __('Leave a Reply to %s', 'wp-blank'),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title text-xl font-semibold text-gray-900 mb-6">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => ' <small>',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __('Cancel reply', 'wp-blank'),
        'label_submit'         => __('Post Comment', 'wp-blank'),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
        'format'               => 'xhtml',
        'comment_field'        => '<div class="mb-4">
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">' . _x('Comment', 'noun', 'wp-blank') . ' <span class="text-red-500">*</span></label>
                                    <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                  </div>',
        'must_log_in'          => '<p class="must-log-in text-gray-600 mb-4">' . sprintf(
            wp_kses(
                __('You must be <a href="%s">logged in</a> to post a comment.', 'wp-blank'),
                ['a' => ['href' => []]]
            ),
            wp_login_url(apply_filters('the_permalink', get_permalink()))
        ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as text-gray-600 mb-4">' . sprintf(
            wp_kses(
                __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'wp-blank'),
                ['a' => ['href' => [], 'title' => []]]
            ),
            get_edit_user_link(),
            $user_identity,
            wp_logout_url(apply_filters('the_permalink', get_permalink()))
        ) . '</p>',
        'comment_notes_before' => '<p class="comment-notes text-sm text-gray-600 mb-4"><span id="email-notes">' . __('Your email address will not be published.', 'wp-blank') . '</span> ' . ($req ? __('Required fields are marked <span class="text-red-500">*</span>', 'wp-blank') : '') . '</p>',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_form'           => 'comment-form mt-8 pt-8 border-t border-gray-200',
        'class_submit'         => 'bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors cursor-pointer',
        'name_submit'          => 'submit',
        'fields'               => $fields,
    ]);
    ?>

</div><!-- #comments -->

<?php
// Custom comment callback function
if (!function_exists('wp_blank_comment_callback')) :
    function wp_blank_comment_callback($comment, $args, $depth) {
        $tag = ($args['style'] === 'div') ? 'div' : 'li';
        ?>
        <<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment bg-gray-50 rounded-lg p-6'); ?>>
            <div class="comment-body">
                <div class="comment-meta flex items-start space-x-4 mb-4">
                    <div class="comment-author-avatar">
                        <?php echo get_avatar($comment, 48, '', '', ['class' => 'rounded-full']); ?>
                    </div>
                    <div class="flex-1">
                        <div class="comment-author vcard">
                            <?php
                            $comment_author = get_comment_author_link($comment);
                            if ('0' == $comment->comment_approved) {
                                echo '<em class="comment-awaiting-moderation text-sm text-yellow-600">' . __('Your comment is awaiting moderation.', 'wp-blank') . '</em><br />';
                            }
                            echo '<span class="fn font-semibold text-gray-900">' . $comment_author . '</span>';
                            ?>
                        </div><!-- .comment-author -->

                        <div class="comment-metadata text-sm text-gray-600">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    esc_html__('%1$s at %2$s', 'wp-blank'),
                                    get_comment_date('', $comment),
                                    get_comment_time()
                                );
                                ?>
                            </time>
                            <?php
                            comment_reply_link(array_merge($args, [
                                'add_below' => 'comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<span class="reply ml-4">',
                                'after'     => '</span>',
                            ]));
                            ?>
                            <?php edit_comment_link(__('Edit', 'wp-blank'), '<span class="edit-link ml-4">', '</span>'); ?>
                        </div><!-- .comment-metadata -->
                    </div>
                </div>

                <div class="comment-content prose prose-sm max-w-none">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->
            </div><!-- .comment-body -->
        <?php
    }
endif; 