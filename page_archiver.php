<?php

/**
 * 文章归档（时间线样式）
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<style>
    .archive-list {
        padding: 0px 10px;
        position: relative;
    }

    .archive-year {
        border-bottom: 1px solid #ebebeb;
    }

    .archive-year:before {
        display: none;
    }

    .archive-item {
        position: relative;
        border-radius: 5px;
    }

    .archive-item:before,
    .archive-item:after {
        content: '';
        z-index: 1;
        position: absolute;
        background: #F4645F;
        width: 2px;
        left: 7px;
        margin-left: 12px;
        height: 6px;
    }

    .archive-item:before {
        top: 0px;
        height: 6px;
    }

    .archive-item:after {
        top: 26px;
        height: calc(100% - 26px);
    }

    .archive-item:hover {
        color: #ff5722;
        background: #F4F4F4;
    }

    .archive-item:hover .meta::after {
        background: #ff5722;
        transform: scale(1);
    }

    .archive-item a:link,
    .archive-item a:active,
    .archive-item a:visited,
    .archive-item a:hover {
        text-decoration: none;
    }

    .meta {
        padding: 6px 0;
        line-height: 1.5;
        height: auto;
        max-width: 100%;
        display: flex;
        font-size: 16px;
        font-weight: 500;
        border-radius: 2px;
        color: #888;
    }

    .meta:after {
        content: '';
        position: absolute;
        top: 8px;
        z-index: 2;
        background: #F4645F;
        margin-left: 14px;
        margin-top: 2px;
        width: 12px;
        height: 12px;
        border-radius: 6px;
        transform: scale(0.5);
        transition: all 0.28s ease;
        -moz-transition: all 0.28s ease;
        -webkit-transition: all 0.28s ease;
        -o-transition: all 0.28s ease;
    }


    .meta time {
        color: #888;
        margin-left: 34px;
        margin-right: 16px;
        flex-shrink: 0;
    }
</style>

<section class="content-wrap">
    <div class="container">
        <div class="row">
            <main class="col-md-8 main-content">
                <article id="arc" class="post">
                    <header class="post-head">
                        <div style="float: left;color: #BDBDBD;">很好! 目前共计<span style="font-weight:600;margin:0 3px;"><?php Typecho_Widget::widget('Widget_Stat')->to($stat)->publishedPostsNum(); ?></span>篇文章，继续加油呀~</div>
                    </header>
                    <section class="post-content">
                        <div id="archives" class="archive-list">

                            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
                            $year = 0;
                            $mon = 0;
                            $i = 0;
                            $j = 0;
                            // while($archives->next()):
                            //     $year_tmp = date('Y',$archives->created);
                            //     $mon_tmp = date('m',$archives->created);
                            //     $y=$year; $m=$mon;
                            //     if ($mon != $mon_tmp && $mon > 0) echo '</ul></li>';
                            //     if ($year != $year_tmp && $year > 0) echo '</ul>';
                            //     if ($year != $year_tmp) {
                            //       $year = $year_tmp;
                            //     //   echo '<h1 class="al_year">'. $year .' 年</h1>'; //输出年份
                            //     }
                            //     if ($mon != $mon_tmp) {
                            //         $mon = $mon_tmp;
                            //         echo '<h2 ><a style="color:#505050;" href="/'. $year .'/'. $mon .'/">'. $year .' 年 '. $mon .' 月</a></h2><ul class="al_post_list">'; //输出月份
                            //     }
                            //     //echo '<li>'.date('d日: ',$archives->created).'<a href="'.$archives->permalink .'">'. $archives->title .'</a>';
                            //     echo '<li><a href="'.$archives->permalink .'">'. $archives->title .'</a>';
                            //     echo ' <span style="color: #959595;">（'.date('Y/m/d',$archives->created).'）</span>';
                            //     //echo '<em>（'. $archives->commentsNum.'条评论）</em>';
                            //     echo '</li>'; //输出文章日期和标题
                            // endwhile;
                            // echo '</ul>';
                            while ($archives->next()) :
                                $year_tmp = date('Y', $archives->created);
                                $mon_tmp = date('m', $archives->created);
                                $y = $year;
                                $m = $mon;
                                if ($year != $year_tmp) {
                                    $year = $year_tmp;
                                    echo '<h2 class="archive-year">' . $year . '</h2>'; //输出年份
                                }
                                echo '<div class="archive-item"><a class="meta" href="' . $archives->permalink . '"><time>' . date('m/d', $archives->created) . '</time>' . $archives->title . '</a></div>';
                            endwhile;
                            ?>
                        </div>
                    </section>
                </article>
            </main>
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>