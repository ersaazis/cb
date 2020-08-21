@include("types::layout_header")
    <?php /** @var \ersaazis\cb\types\password\PasswordModel $column */ ?>
        <input type='password' title="{{ $column->getLabel() }}"
               placeholder="{{ $column->getPlaceholder() }}"
               {{ $column->getRequired()?'required':''}}
               {{ $column->getReadonly()?'readonly':''}}
               {{ $column->getDisabled()?'disabled':''}}
               class='form-control'
               name="{{ $column->getName() }}"
               id="{{ $column->getName() }}" />
@include("types::layout_footer")