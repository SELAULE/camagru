<!-- START post -->
<div class="w3-row-padding w3-margin-top w3-animate-left">
    <?php
		$db = DB::getInstance();
		$db->get("gallery",array('user_id', '>', 0));
		$images = $db->results();
		$num_images = $db->count() - 1;
		$items_per_page = 3;
		$total_pages = ceil($num_images/$items_per_page);
        $page = 1;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $this_page_first_result = (intval($page) - 1) * $items_per_page;
        $sql = "SELECT * FROM gallery ORDER BY time_stamp DESC LIMIT " . $items_per_page . " OFFSET " . $this_page_first_result ;
        $db->query($sql);
        $result = $db->results();
        $num_res = $db->count();
        $i = 0;
        $y = 0;
        for ($i=0; $i < $num_res; $i++) {
            $img = $result[$i]->img_name;
            $time = $result[$i]->time_stamp;
            $imgid = $result[$i]->img_id;
            //$img = $images[$num_images]->img_name;
            //$time = $images[$num_images]->time_stamp;
            //$imgid = $images[$num_images]->img_id;
            $total = commentcount($imgid);
            $total_likes = likecount($imgid);
            $db->get("comments",array('img_id', '=', $imgid));
            $comments = $db->results();
            $num_comments = $db->count() - 1;
            echo " <div class='w3-third'>
            <div class = 'w3-card'>
            <img src='".$result[$i]->img_name."' style='width:100%'>"."<br>
            <div class='w3-container'>
            <form action = 'likes.php' method = 'post'>
            <p>$total_likes  <input type='submit' class = 'like' value = 'LIKE'/></p>
            <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/></p>
            <input type='hidden' name='page_no' id = 'page_no' value = '$page'/></p>
            </form>
            <p><span class='mr-2'>$time</span> &bullet;
            <span class= 'ml-1'><span class= 'fa fa-comments'></span>$total</span></p>
            <p><Button class = 'viewComments' onclick='hidetest(".$y.")'>View Comments</button></p>
            <div id = 'hidden".$y."' style = 'display:none' class = 'w3-margin-top w3-animate-top' >";
            $x = 0;
            while ($num_comments >= $x) {
                $com = $comments[$x]->comment;
                echo $com."<br><hr>";
                $x++;
            }
            echo "</div><form action = 'comments.php' method='post'>
            <input style = 'width: 100%' type='text' class= 'w3-input' name='comment' id = 'comment' autocomplete='off' placeholder='Comment on Picture' align = 'left'/>
            <input type='hidden' name='imgid' id = 'imgid' value = '$imgid'/>
            <input type='submit' class = 'like2' value = 'Comment'/>
            <input type='hidden' name='page_num' id = 'page_num' value = '$page'/></p>
            </form>
            <p> </p>
            </div>
            </div>
            </div>
            ";
            $num_images--;
            $y++;
        }
        // echo ($page);
        echo "</div>";
        echo "<div align='center' class='pagination2'>";
        for ($page=1;$page<=$total_pages;$page++) {
        echo '<a href="gallery.php?page=' . $page . '">' . $page . '</a> ';
        }
        echo "</div>";
        ?>
            </div>
        </div>
        <!-- END post -->