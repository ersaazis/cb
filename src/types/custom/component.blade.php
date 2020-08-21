@include("types::layout_header")
        <?php /** @var \ersaazis\cb\types\custom\CustomModel $column */?>
        {!! $column->getHtml() !!}
@include("types::layout_footer")