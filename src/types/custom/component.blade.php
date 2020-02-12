@include("types::layout_header")
        <?php /** @var \Ersaazis\CB\types\custom\CustomModel $column */?>
        {!! $column->getHtml() !!}
@include("types::layout_footer")