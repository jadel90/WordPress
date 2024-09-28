<?php
if (post_password_required()) {
    return;
}

if (have_comments()) :
    // Comments exist, display them.
    ?>
    <div id="comments" class="comments-area">
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                // Display a single comment.
                echo esc_html__('One Comment', 'your-theme-textdomain');
            } else {
                // Display the number of comments.
                echo esc_html($comments_number) . esc_html__(' Comments', 'your-theme-textdomain');
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => 'your_custom_comment_function',
            ));
            ?>
        </ol>

        <?php
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
            ?>
            <p class="no-comments">
                <?php esc_html_e('Comments are closed.', 'your-theme-textdomain'); ?>
            </p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php
// Comment form.
comment_form(array(
    'class_form' => 'comment-form',
    'title_reply' => esc_html__('Leave a Comment', 'your-theme-textdomain'),
    'title_reply_to' => esc_html__('Leave a Reply to %s', 'your-theme-textdomain'),
    'cancel_reply_link' => esc_html__('Cancel Reply', 'your-theme-textdomain'),
    'label_submit' => esc_html__('Post Comment', 'your-theme-textdomain'),
    'comment_field' => '<div class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'your-theme-textdomain') . '</label><textarea id="comment" name="comment" cols="45" rows="8" required="required"></textarea></div>',
    'comment_notes_after' => '',
));
?>
