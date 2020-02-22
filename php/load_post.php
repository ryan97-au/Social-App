<?php
	ob_start();
	session_start();
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
    include "pdoconnectOnline.inc";
    
    if ($_GET['q'] == "initialize") {
        $query = "select postID from posts ORDER BY postID DESC LIMIT 1";
        $stmt = $conn->prepare($query); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetchAll();
        foreach ($result as $post) {
            $q = $post->postID;
        }
    } else {
        $q = intval($_GET['q']);
    }

    $query = "select * from posts where postID = (select min(postID) from posts where postID > $q);";
    $stmt = $conn->prepare($query); 
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $result = $stmt->fetchAll();
    foreach ($result as $post) {
        $previous = $post->postID;
    }

    if (!isset($previous)){
        $query = "select postID from posts ORDER BY postID DESC LIMIT 1";
        $stmt = $conn->prepare($query); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetchAll();
        foreach ($result as $post) {
            $q = $post->postID;
    }
        
        $query = "select * from posts where postID = (select min(postID) from posts where postID < $q);";
        $stmt = $conn->prepare($query); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetchAll();
        foreach ($result as $post) {
            $previous = $post->postID;
        }
    }

    $query = "select * from posts where postID = (select max(postID) from posts where postID < $q);";
    $stmt = $conn->prepare($query); 
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $result = $stmt->fetchAll();
    foreach ($result as $post) {
        $next = $post->postID;
    }

    if (!isset($next)){
        $query = "select postID from posts ORDER BY postID DESC LIMIT 1;";
        $stmt = $conn->prepare($query); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetchAll();
        foreach ($result as $post) {
            $next = $post->postID;
        }
    }

    $query = 
    "select 
    posts.postID,
    posts.postContent, 
    posts.postDate, 
    posts.postPicture, 
    posts.likes, posts.emojiOne, 
    posts.emojiTwo, posts.emojiThree, 
    posts.emojiFour, posts.emojiFive,
    users.firstName, users.lastName, 
    users.profilePicture
    from 
    posts, users
    where
    users.userID = posts.postedBy
    and
    posts.postID = $q
    order by posts.postDate desc;";
    $stmt = $conn->prepare($query); 
	
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $result = $stmt->fetchAll();
    echo '<div id="comment_space">';

    foreach ($result as $post)
    {
        view_comments($post->postID);
    }
    echo '</div>';    

    foreach ($result as $post)
    {
        echo '<div class="post">';
            echo '<div class="post_id">';
                    echo $post->postID;
            echo '</div>';
            echo '<img src="';
            echo $post->postPicture;
            echo '">';

            echo '<div class="userPost">';

                echo '<img src="';
                    echo $post->profilePicture;
                echo '" class="userPic">';

                echo '<div class="userComment">';
                    echo $post->postContent;
                echo '</div>';


                echo '<div class="userPostDate">';
                    echo $post->firstName.' '.$post->lastName;
                    echo '&nbsp;';
                    echo date( 'd/m/Y', strtotime( $post->postDate ) );
                    echo '&nbsp;';
                echo '</div>';
            
            echo '</div><!-- userPost -->';
            
            $previouslyReacted = "test";
            if(isset($_SESSION['userID']))
            {
                $user = $_SESSION['userID'];
                console_log($user);
                $statement = "SELECT * from post_emojis WHERE userID = $user AND postID = $post->postID";
                
                $result = $conn->query($statement);
                
                $row = $result->fetch();
                if ($row) {
                    $previouslyReacted = $row[2];
                }
            }

            $emojiCount = ($post->emojiOne + $post->emojiTwo + $post->emojiThree + $post->emojiFour + $post->emojiFive);
            echo '<table id="reacted_emojis">
            <tr>';
                    if($post->emojiOne>0){
                        echo '<th>';
                        if ($previouslyReacted == 1){
                            echo '<img class="emoji_img border" id="emoji_like_reacted" src="img/emoji-like.png" alt="Like"></img>';
                        } else {
                            echo '<img class="emoji_img" id="emoji_like_reacted" src="img/emoji-like.png" alt="Like"></img>';
                        }

                        //echo $post->emojiOne;
                        echo '</th>';
                    }
                    if($post->emojiTwo>0){
                        echo '<th>';
                        if ($previouslyReacted == 2){
                            echo '<img class="emoji_img border" id="emoji_love_reacted" src="img/emoji-love.png" alt="Love"></img>';
                        } else {
                            echo '<img class="emoji_img" id="emoji_love_reacted" src="img/emoji-love.png" alt="Love"></img>';
                        }
                        //echo $post->emojiTwo;
                        echo '</th>';
                    }
                    if($post->emojiThree>0){
                        echo '<th>';
                        if ($previouslyReacted == 3){
                            echo '<img class="emoji_img border" id="emoji_laugh_reacted" src="img/emoji-laugh.png" alt="Laugh"></img>';
                        } else {
                            echo '<img class="emoji_img" id="emoji_laugh_reacted" src="img/emoji-laugh.png" alt="Laugh"></img>';
                        }
                        //echo $post->emojiThree;
                        echo '</th>';
                    }
                    if($post->emojiFour>0){
                        echo '<th>';
                        if ($previouslyReacted == 2){
                            echo '<img class="emoji_img border" id="emoji_wow_reacted" src="img/emoji-wow.png" alt="Wow"></img>';
                        } else {
                            echo '<img class="emoji_img" id="emoji_wow_reacted" src="img/emoji-wow.png" alt="Wow"></img>';
                        }
                        //echo $post->emojiFour;
                        echo '</th>';
                    }
                    if($post->emojiFive>0){
                        echo '<th>';
                        if ($previouslyReacted == 2){
                            echo '<img class="emoji_img border" id="emoji_sad_reacted" src="img/emoji-sad.png" alt="Sad"></img>';
                        } else {
                            echo '<img class="emoji_img" id="emoji_sad_reacted" src="img/emoji-sad.png" alt="Sad"></img>';
                        }
                        //echo $post->emojiFive;
                        echo '</th>';
                    }
                echo '<th>';
                    if($emojiCount < 1)
                    {
                        echo '<p id="reacted_emoji_txt" style="font-weight:normal;margin-left:3px;">';
                        echo 'Be the first to react to this post';
                    }else
                    {
                        if($previouslyReacted != "test")
                        {
                            echo '<p id="reacted_emoji_txt">';
                            if ($emojiCount - 1 == 1) {
                                echo 'You and '. ($emojiCount - 1).' other.';
                            } else {
                                echo 'You and '. ($emojiCount - 1).' others.';
                            }
                        }else
                        {
                            echo '<p id="reacted_emoji_txt">';
                            if ($emojiCount == 1){
                                echo $emojiCount.' other.';
                            } else {
                                echo $emojiCount.' others.';
                            }
                        }
                    }
                    echo '</p>
                </th>
            </tr>
            </table>';

        view_latest_comment($post->postID);
        echo '</div><!-- post -->';
        
        // Echo the navigation buttons
        echo '<div id="choose_buttons">';
        echo '<button class="button" id="emoji_button" onkeyup="feedBtnEmoji(event)" onmouseup="feedClickEmoji()">Emoji</button>';
        echo '<button class="button" id="comment_button" onkeyup="feedBtnComment(event)" onmouseup="feedClickComment()">Comment</button>';
        echo '<button class="button" id="choose_cancel_button" onkeyup="feedBtnChooseCancel(event)" onmouseup="feedClickChooseCancel()">Cancel</button>';
        echo '</div>';
        echo '<div id="postNavigationButtons">';
        //echo '<button class="button" id="previous_btn" onkeyup="feedBtnPrevious(event)" onclick="displayPost(-1)">Previous</button>';
        echo "<button class=\"button\" id=\"previous_btn\" onkeyup=\"feedBtnPrevious(event, $previous)\" onmouseup=\"feedBtnPrevious(loadFeed($previous))\">Previous</button>";  
        echo "<button class=\"button\" id=\"next_btn\" autofocus onkeyup=\"feedBtnNext(event, $next)\" onmouseup=\"feedBtnNext(loadFeed($next))\">Next</button>";  
        echo '<button class="button" id="choose_btn" onkeyup="feedBtnChoose(event)" onmouseup="feedBtnChoose(event)" >Choose</button>';
        echo '</div>';
        
        // Echo the new comment form 
        echo '<form name="newCommentForm" action="php/new_comment.php" onsubmit="return validateComment()" method="post">';
        echo '<div id="comment_form">';
        echo "<textarea class=\"post_id\" id=\"comment_post_id\" name=\"comment_post_id\">$q</textarea>";
        echo '<table>';
        echo '<tr>';
        echo '<th>';
        echo '<textarea rows="2" id="comment_text_box" placeholder="Enter comment... (max 90 characters)" maxlength="90" name="content"></textarea>';
        echo '</th>';
        echo '<th>';
        echo '<button class="button" type="submit" id="comment_submit_button" onkeyup="feedBtnCommentsubmit(event)">Submit</button>';
        echo '</th>';
        echo '<th>';
        echo '<button class="button" type="button" value="Cancel" id="comment_cancel_button" onkeyup="feedBtnCommentCancel(event)" onmouseup="feedClickCommentCancel()">Cancel</button>';
        echo '</th>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</form>';	// hide comment form, update latest comment and comments list, prev and next from comment form focus to changing post display

        // Echo a hidden form for the emojis 

        echo '<form id="emoji_form" action="php/emoji_react.php" method="post" class="hidden">';
        echo "<textarea class=\"post_id\" id=\"emoji_form_postID\" name=\"emoji_form_postID\">$q</textarea>";
        echo '<textarea id="emoji_form_information" name="emoji_form_information"></textarea>';
        echo '</form>';

        // Echo the emoji div
        echo '<div id="emoji_selection">';
        echo '<table id="emoji_selection_table">';
        echo '<tr>';
        echo '<th>';
        echo '<figure>';
        echo '<button class="button emojiBtn" id="emoji_like" onkeyup="feedBtnLike(event)" onmouseup="feedClickLike()"><img class="emoji_img" id="emoji_like_img" src="img/emoji-like.png" alt="Like"></img></button>';
        echo '<!-- hide emoji selection, update reacted emojis, prev and next from emoji selection focus to changing post display  -->';
        echo '</figure>';
        echo '</th>';
        echo '<th>';
        echo '<figure>';
        echo '<button class="button emojiBtn" id="emoji_love" onkeyup="feedBtnLove(event)" onmouseup="feedClickLove()"><img class="emoji_img" id="emoji_love_img" src="img/emoji-love.png" alt="Love"></img></button>';
        echo '<!-- hide emoji selection, update reacted emojis, prev and next from emoji selection focus to changing post display  -->';
        echo '</figure>';
        echo '</th>';
        echo '<th>';
        echo '<figure>';
        echo '<button class="button emojiBtn" id="emoji_laugh" onkeyup="feedBtnLaugh(event)" onmouseup="feedClickLaugh()"><img class="emoji_img" id="emoji_laugh_img" src="img/emoji-laugh.png" alt="Laugh"></img></button>';
        echo '<!-- hide emoji selection, update reacted emojis, prev and next from emoji selection focus to changing post display  -->';
        echo '</figure>';
        echo '</th>';
        echo '<th>';
        echo '<figure>';
        echo '<button class="button emojiBtn" id="emoji_wow" onkeyup="feedBtnWow(event)" onmouseup="feedClickWow()"><img class="emoji_img" id="emoji_wow_img" src="img/emoji-wow.png" alt="Wow"></img></button>';
        echo '<!-- hide emoji selection, update reacted emojis, prev and next from emoji selection focus to changing post display  -->';
        echo '</figure>';
        echo '</th>';
        echo '<th>';
        echo '<figure>';
        echo '<button class="button emojiBtn" id="emoji_sad" onkeyup="feedBtnSad(event)" onmouseup="feedClickSad()"><img class="emoji_img" id="emoji_sad_img" src="img/emoji-sad.png" alt="Sad"></img></button>';
        echo '<!-- hide emoji selection, update reacted emojis, prev and next from emoji selection focus to changing post display  -->';
        echo '</figure>';
        echo '</th>';
        echo '<th>';
        echo '<button class="button" id="emoji_cancel_btn" onkeyup="feedBtnEmojiCancel(event)" onmouseup="feedClickEmojiCancel()">Cancel</button>';
        echo '<!-- hide emoji selection, prev and next from emoji selection focus to changing post display  -->';
        echo '</th>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
    }

    function view_comments($postID)
    {
    
        global $errors;
        global $conn;
        try
        {
            $query = 
                "select commentContent, commentDate, firstName from post_comments, users where
                userID = commentBy and
                postID = :postID
                order by commentDate desc
                limit 1, 10;";
    
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':postID',$postID);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetchAll();
    
                echo '<div class="comment_view" >';
            if($stmt->rowCount()>0)
            {
                foreach ($result as $comment)
                {
                    echo '<div class="comment">';
                     echo '<span class="comment_body">';
                     echo $comment->commentContent;
                     echo '</p>';
                     echo '<span class="comment_date">';
                     echo $comment->firstName;
                     echo ' Posted at ';
                     echo date( 'd/m/Y', strtotime( $comment->commentDate ) );
                     echo '</p>';
                    echo '</div>';
                }
            }
            else
            {
                console_log("no comments");	
            }
                echo '</div>';
    
        } catch (PDOException $e)
        {
            die($e->getMessage());		
        }
    }

    function view_latest_comment($postID)
    {
    
        global $errors;
        global $conn;
        try
        {
            $query = 
                "select
                post_comments.commentContent, 
                post_comments.commentDate, 
                users.firstName,
                users.lastName,
                users.profilePicture 
                from 
                post_comments, users 
                where
                users.userID = post_comments.commentBy and
                post_comments.postID = :postID
                order by commentDate desc
                limit 1;";
    
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':postID',$postID);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetchAll();
    
             if($stmt->rowCount()>0)
            {
                foreach ($result as $comment) 
                {
                                
                    echo 
                    '<div id="latestCommentSection">
                        <p id="latestCommentLabel">Latest Comment</p>
                        <div class="latestCommentBar">
                            <div class="latestCommentProfileImage">
                                <img src="'.$comment->profilePicture.'"></img>
                            </div>';
    
                    echo
                            '<div class="latestCommentContent">';
                    echo $comment->commentContent;
                    echo
                        '</div>
                         <div class="latestCommentDate">';
                            echo $comment->firstName; echo ' ';
                            echo $comment->lastName; echo ' ';
                            echo date( 'd/m/Y', strtotime( $comment->commentDate ) );
                    echo
                        '</div>
                        </div>
                    </div>';
                }			
    
            }
            else
            {
                echo 
                '<div id="latestCommentSection">
                    <p id="latestCommentLabel">Latest Comment</p>
                    <div class="latestCommentBar">
                        <div class="latestCommentProfileImage">
                            <img src="img/profile-placeholder.png"></img>
                        </div>';
    
                echo
                        '<div class="latestCommentContent" style="font-weight:normal">';
                echo 'Be the first to comment on this post...';
                echo
                    '</div>
                     <div class="latestCommentDate">';
                echo
                    '</div>
                    </div>
                </div>';	
            }
        } catch (PDOException $e)
        {
            die($e->getMessage());		
        }
    }
?>