<?php
/**
 * The template for displaying comment lists
 *
 * Displays all of the head element and everything up until the "header" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Dark Blog Theme AMP
 * @subpackage WP Dark Blog Theme AMP
 *
 *
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
?>

<?php
// START: display comment list
function comment_list($comment, $args, $depth) {
  if ( 'div' === $args['style'] ) {
    $tag       = 'div';
    $add_below = 'comment';
  } else {
    $tag       = 'li';
    $add_below = 'div-comment';
  }

  $args['avatar-args'] = [
    'url'           => get_avatar_url($comment, null),
    'scheme'        => null,
    'class'         => 'image is-48x48'
  ]; ?>

  <<?= $tag . ' '; comment_class( empty( $args['has_children'] ) ? 'children media' : 'parent media' ); ?> id="comment-<?php comment_ID() ?>">
    <figure id="img-comment-<?php comment_ID(); ?>" class="header-comment media-left">
      <?= get_avatar( $comment, null, null, get_comment_author(), $args['avatar-args'] ); ?>
    </figure >
    <div class="media-content">

      <div id="author-comment-<?php comment_ID(); ?>" class="author">
        <strong class="vcard">
          <span class="fn name"><?= get_comment_author(); ?></span>
        </strong>
      </div>
      <div id="date-comment-<?php comment_ID(); ?>">
        <small class="date <?= htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
          <?php 
            /* translators: 1: date, 2: time */
            printf( 
              __('%1$s at %2$s'),
              get_comment_date(),
              get_comment_time() 
            );
          ?>
        </small>
      </div>
      <hr>
      <div class="body-comment-<?php comment_ID(); ?>">
        <?php comment_text(); ?>
        <?php if ( $comment->comment_approved == '0' ) { ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/>
        <?php } ?>
      </div>
      <br>
  
      <?php
        comment_reply_link( 
          array_merge(
            $args, 
            array( 
              'add_below' => $add_below, 
              'depth'     => $depth, 
              'max_depth' => $args['max_depth'],
              'reply_text' => 'Reply'
            ) 
          )
        );
      ?>
<?php } // END: display comment list ?>

<?php
// add class button reply
function reply_link_class($class){
  $class = str_replace("class='comment-reply-link'", "class='comment-reply-link btn btn-primary'", $class);
  return $class;
}
add_filter('comment_reply_link', 'reply_link_class');
// /. add class button reply

// display comment form
function the_comment_form( $args = array('format' => 'html5'), $post_id = null ) {
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }
 
    // Exit the function when comments for the post are closed.
    if ( ! comments_open( $post_id ) ) {
        /**
         * Fires after the comment form if comments are closed.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );
 
        return;
    }
 
    $commenter     = wp_get_current_commenter();
    $user          = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
 
    $args = wp_parse_args( $args );
    if ( ! isset( $args['format'] ) ) {
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    }
 
    $req      = get_option( 'require_name_email' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];
 
    $fields = [
        'email'  => sprintf(
            '<div class="field"><div class="control">%s</div></div>',
            sprintf(
                '<input id="email" class="input" name="email" %s value="%s" placeholder="Email *" size="30" maxlength="100" aria-describedby="email-notes"%s />',
                ( $html5 ? 'type="email"' : 'type="text"' ),
                esc_attr( $commenter['comment_author_email'] ),
                $html_req
            )
        ),
        'url'    => sprintf(
            '<div class="field"><div class="control">%s</div></div>',
            sprintf(
                '<input id="url" class="input" name="url" %s value="%s" placeholder="Website" size="30" maxlength="200" />',
                ( $html5 ? 'type="url"' : 'type="text"' ),
                esc_attr( $commenter['comment_author_url'] )
            )
        ),
        'author' => sprintf(
            '<div class="field"><div class="control">%s</div></div>',
            sprintf(
                '<input id="author" class="input" name="author" type="text" value="%s" placeholder="Name *" size="30" maxlength="245"%s />',
                esc_attr( $commenter['comment_author'] ),
                $html_req
            )
        )
    ];
    
    if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
        $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
 
        $fields['cookies'] = sprintf(
            '<p class="comment-form-cookies-consent field">%s</p>',
            
            sprintf(
                '<label class="custom-control-label checkbox" for="wp-comment-cookies-consent">%s %s</label>',
                sprintf(
                  '<input id="wp-comment-cookies-consent" class="checkbox" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
                  $consent
                ),
                __( 'Save my name, email, and website in this browser for the next time I comment.' )
            )
        );
 
        // Ensure that the passed fields include cookies consent.
        if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
            $args['fields']['cookies'] = $fields['cookies'];
        }
    }
 
    // $required_text = sprintf(
    //     /* translators: %s: Asterisk symbol (*). */
    //     ' ' . __( 'Required fields are marked %s' ),
    //     '<span class="required">*</span>'
    // );
 
    /**
     * Filters the default comment form fields.
     *
     * @since 3.0.0
     *
     * @param string[] $fields Array of the default comment fields.
     */
    $fields = apply_filters( 'comment_form_default_fields', $fields );
 
    $defaults = array(
        'fields'               => $fields,
        'comment_field'        => sprintf(
            '<div class="field"><div class="control">%s</div></div>',
            '<textarea id="comment" class="textarea" name="comment" placeholder="Masukkan Komentar atau Masukan Anda, atau Bisa Request Artikel untuk Kami Terbitkan" cols="45" rows="8" maxlength="65525" required="required"></textarea>'
        ),
        'must_log_in'          => sprintf(
            '<p class="must-log-in">%s</p>',
            sprintf(
                /* translators: %s: Login URL. */
                __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                /** This filter is documented in wp-includes/link-template.php */
                wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
            )
        ),
        'logged_in_as'         => sprintf(
            '<p class="logged-in-as">%s</p>',
            sprintf(
                /* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
                __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
                get_edit_user_link(),
                /* translators: %s: User name. */
                esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
                $user_identity,
                /** This filter is documented in wp-includes/link-template.php */
                wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
            )
        ),
        'comment_notes_before' => sprintf(
					'<div class="comment-notes">%s%s</div>',
            sprintf(
							'<span id="email-notes">%s</span>',
							__( 'Your email address will not be published.' )
            ),
            ( $req ? $required_text : '' )
        ),
        'comment_notes_after'  => '',
        'action'               => site_url( '/wp-comments-post.php' ),
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_form'           => 'tag-form-class',
        'class_submit'         => 'button is-link',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Tinggalkan Balasan' ),
        /* translators: %s: Author of the comment being replied to. */
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="title is-3 reply-title">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => '<small>',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<div class="form-submit field">%1$s %2$s</div>',
        'format'               => 'xhtml',
    );
 
    /**
     * Filters the comment form default arguments.
     *
     * Use {@see 'comment_form_default_fields'} to filter the comment fields.
     *
     * @since 3.0.0
     *
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
 
    // Ensure that the filtered args contain all required default values.
    $args = array_merge( $defaults, $args );
 
    // Remove aria-describedby from the email field if there's no associated description.
    if ( false === strpos( $args['comment_notes_before'], 'id="email-notes"' ) ) {
        $args['fields']['email'] = str_replace(
            ' aria-describedby="email-notes"',
            '',
            $args['fields']['email']
        );
    }
 
    /**
     * Fires before the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_before' );
    ?>
    <section id="respond" class="respond comments-form-articles section">
        <?php
        echo $args['title_reply_before'];
 
        comment_form_title( $args['title_reply'], $args['title_reply_to'] );
 
        echo $args['cancel_reply_before'];
 
        cancel_comment_reply_link( $args['cancel_reply_link'] );
 
        echo $args['cancel_reply_after'];
 
        echo $args['title_reply_after'];
 
        if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) :
 
            echo $args['must_log_in'];
            /**
             * Fires after the HTML-formatted 'must log in after' message in the comment form.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_must_log_in_after' );
 
        else :
 
            printf(
                '<div class="%s">
                <form action-xhr="'. admin_url('admin-ajax.php?action=amp_comment_submit') . '" method="post" id="%s" class="%s"%s>',
                esc_url( $args['action'] ),
                esc_attr( $args['id_form'] ),
                esc_attr( $args['class_form'] ),
                ( $html5 ? '' : '' )
            );
 
            /**
             * Fires at the top of the comment form, inside the form tag.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_top' );
 
            if ( is_user_logged_in() ) :
 
                /**
                 * Filters the 'logged in' message for the comment form for display.
                 *
                 * @since 3.0.0
                 *
                 * @param string $args_logged_in The logged-in-as HTML-formatted message.
                 * @param array  $commenter      An array containing the comment author's
                 *                               username, email, and URL.
                 * @param string $user_identity  If the commenter is a registered user,
                 *                               the display name, blank otherwise.
                 */
                echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
 
                /**
                 * Fires after the is_user_logged_in() check in the comment form.
                 *
                 * @since 3.0.0
                 *
                 * @param array  $commenter     An array containing the comment author's
                 *                              username, email, and URL.
                 * @param string $user_identity If the commenter is a registered user,
                 *                              the display name, blank otherwise.
                 */
                do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
 
            else :
 
                echo $args['comment_notes_before'];
 
            endif;
 
            // Prepare an array of all fields, including the textarea.
            $comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];
 
            /**
             * Filters the comment form fields, including the textarea.
             *
             * @since 4.4.0
             *
             * @param array $comment_fields The comment fields.
             */
            $comment_fields = apply_filters( 'comment_form_fields', $comment_fields );
 
            // Get an array of field names, excluding the textarea
            $comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );
 
            // Get the first and the last field name, excluding the textarea
            $first_field = reset( $comment_field_keys );
            $last_field  = end( $comment_field_keys );
 
            foreach ( $comment_fields as $name => $field ) {
 
                if ( 'comment' === $name ) {
 
                    /**
                     * Filters the content of the comment textarea field for display.
                     *
                     * @since 3.0.0
                     *
                     * @param string $args_comment_field The content of the comment textarea field.
                     */
                    echo apply_filters( 'comment_form_field_comment', $field );
 
                    echo $args['comment_notes_after'];
 
                } elseif ( ! is_user_logged_in() ) {
 
                    if ( $first_field === $name ) {
                        /**
                         * Fires before the comment fields in the comment form, excluding the textarea.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_before_fields' );
                    }
 
                    /**
                     * Filters a comment form field for display.
                     *
                     * The dynamic portion of the filter hook, `$name`, refers to the name
                     * of the comment form field. Such as 'author', 'email', or 'url'.
                     *
                     * @since 3.0.0
                     *
                     * @param string $field The HTML-formatted output of the comment form field.
                     */
                    echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
 
                    if ( $last_field === $name ) {
                        /**
                         * Fires after the comment fields in the comment form, excluding the textarea.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_after_fields' );
                    }
                }
            }
 
            $submit_button = sprintf(
                $args['submit_button'],
                esc_attr( $args['name_submit'] ),
                esc_attr( $args['id_submit'] ),
                esc_attr( $args['class_submit'] ),
                esc_attr( $args['label_submit'] )
            );
 
            /**
             * Filters the submit button for the comment form to display.
             *
             * @since 4.2.0
             *
             * @param string $submit_button HTML markup for the submit button.
             * @param array  $args          Arguments passed to comment_form().
             */
            $submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );
 
            $submit_field = sprintf(
                $args['submit_field'],
                $submit_button,
                get_comment_id_fields( $post_id )
            );
 
            /**
             * Filters the submit field for the comment form to display.
             *
             * The submit field includes the submit button, hidden fields for the
             * comment form, and any wrapper markup.
             *
             * @since 4.2.0
             *
             * @param string $submit_field HTML markup for the submit field.
             * @param array  $args         Arguments passed to comment_form().
             */
            echo apply_filters( 'comment_form_submit_field', $submit_field, $args );
 
            /**
             * Fires at the bottom of the comment form, inside the closing </form> tag.
             *
             * @since 1.5.0
             *
             * @param int $post_id The post ID.
             */
            do_action( 'comment_form', $post_id );
 
            echo '
                <div submit-error>
                  <template type="amp-mustache">{{msg}}</template>
                </div>
                <div submit-success>
                  <template type="amp-mustache">
                    <p>{{msg}}</p>
                    <ul id="comments-list" class="comments-list comments p-0">
                      <li class="comment byuser comment-author-{{data.comment_author}} bypostauthor even thread-even depth-1 list-unstyled children" id="comment-{{data.comment_ID}}">
                        <div class="header-comment">
                          <div id="img-comment-{{data.comment_ID}}" class="thumb-comment"><amp-img alt="{{data.comment_author}}" src="https://secure.gravatar.com/avatar/5c9f85585c5a4639cfa79daed4f7b8fc?s=96&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/5c9f85585c5a4639cfa79daed4f7b8fc?s=96&amp;d=mm&amp;r=g 2x" class="avatar avatar-96 photo avatar-default photo-comment" height="35" width="35"></amp-img></div>
                          <div id="author-comment-{{data.comment_ID}}" class="author"><span class="vcard h6"><a rel="nofollow" href="{{data.comment_author}}" class="fn name">{{data.comment_author}}</a></span></div>
                          <div id="date-comment-{{data.comment_ID}}"><a rel="nofollow" href="https://jejakhacker.com/jasa-hack-back-akun-ml/#comment-{{data.comment_ID}}"><span class="date">{{data.comment_date}}</span></a></div>
                        </div>
                        <div class="body-comment-{{data.comment_ID}}"><p>{{data.comment_content}}</p></div>
                        <a rel="nofollow" class="comment-reply-link btn btn-primary" href="#comment-{{data.comment_ID}}" data-commentid="{{data.comment_ID}}" data-postid="38" data-belowelement="div-comment-{{data.comment_ID}}" data-respondelement="respond" data-replyto="Balasan untuk {{data.comment_author}}" aria-label="Balasan untuk {{data.comment_author}}">Reply</a>
                      </li>
                    </ul>
                    <p>Komentar dalam moderasi</p>
                  </template>
                </div>
            </form></div>';
 
        endif;
        ?>
    </section><!-- #respond -->
    <?php
 
    /**
     * Fires after the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_after' );
}
// /. display comment form