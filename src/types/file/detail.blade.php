@php /** @var \ersaazis\cb\models\ColumnModel $column */  @endphp
<div>
    <a href="{{ asset($column->getValue()) }}" target="_blank">{{ basename($column->getValue()) }}</a>
</div>