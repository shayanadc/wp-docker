<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<?php $textdoimain = 'hostio'; ?>
<?php if ( have_comments() ) : ?>

            <h2 class="tit_cmt"><?php echo esc_html__( 'Comments', 'hostio' );?></h2>
            <?php wp_list_comments('callback=hostio_theme_comment'); ?>
        <?php endif; ?> 
        
        <?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                'id_form' => '',                                
                'title_reply'=> esc_html__( 'Leave a Comment', 'hostio' ),
                'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<div class="form-group">
                                  <input type="text" id="author" name="author" placeholder="'.esc_html__( 'Name', 'hostio' ).'" required class="form-control form-item">
                                </div>
                            ',
                    'email' => '<div class="form-group">
                                  <input type="text" id="email" name="email"  placeholder="'.esc_html__( 'Email', 'hostio' ).'" required class="form-control form-item">
                                </div>

                    ',    
                                                                                           
                ) ),   
                'comment_field' => '<div class="form-group">
                                      <textarea placeholder="'.esc_html__( 'Comment', 'hostio' ).'" name="comment"'.$aria_req.' id="comment"  rows="3" class="form-control form-item"></textarea>
                                    </div>',                    
                 'label_submit' => esc_html__( 'Submit', 'hostio' ),
                 'comment_notes_before' => '',
                 'comment_notes_after' => '',               
        )
    ?>
    <?php comment_form($comment_args); ?>