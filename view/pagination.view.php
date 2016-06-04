<ul class="pagination">
    <li>

      <?php 
        if( $pagination->has_prev() )
        {
            // TODO: smartly generate pagination links (like link_to_other_page in http://flask.pocoo.org/snippets/44/). For building GET params from array use http_build_query()
            echo '<a href="http://'.$_SERVER['HTTP_HOST'].sgp($_SERVER['REQUEST_URI'],'N',$pagination->page-1).'" aria-label="Previous">';
            echo '<span aria-hidden="true">&laquo;</span>';
            echo '</a>';
        }
      ?>
    </li>
    <?php if ($pagination->pages_quantity() > 1): ?>
        <?php for ($i=1; $i<=$pagination->pages_quantity(); $i++): ?>
            <li <?php if($i==$pagination->page) echo 'class="active"'; ?> >
                    
                <a href="http://<?php echo $_SERVER['HTTP_HOST'].sgp($_SERVER['REQUEST_URI'],'N',$i );?>" >
                    <?php echo ($i); ?>
                </a>
            </li>
        <?php endfor; ?>
    <?php endif; ?>
    <li>

      <?php 
        if( $pagination->has_next() )
        {
            echo '<a href="http://'.$_SERVER['HTTP_HOST'].sgp($_SERVER['REQUEST_URI'],'N',$pagination->page+1).'" aria-label="Next">';
            echo '<span aria-hidden="true">&raquo;</span>';
            echo '</a>';
        }
      ?>

    </li>
</ul>