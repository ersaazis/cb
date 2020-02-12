@php /** @var \Ersaazis\CB\models\ColumnModel $column */  @endphp
<input type='hidden' name="{{ $column->getName() }}" value='{{ ($column->getDefaultValue())?:$column->getValue() }}'/>