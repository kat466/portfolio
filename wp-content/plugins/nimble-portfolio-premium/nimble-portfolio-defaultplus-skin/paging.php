<div class="-pages">
    <?php
    $page_links = $this->paginate_links(array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format' => '?paged=%#%" rel="%#%',
        'current' => max(1, $portfolio->atts['pagenum'] ? $portfolio->atts['pagenum'] : get_query_var('paged')),
        'total' => $portfolio->queryObj->max_num_pages,
        'prev_text' => 'Prev',
        'next_text' => 'Next'
    ));
    foreach ($page_links as $page_link) {
        echo $page_link;
    }
    ?>
</div>