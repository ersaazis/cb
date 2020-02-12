@include("types::layout_header")
    <?php /** @var \ersaazis\cb\types\checkbox\CheckboxModel $column */ ?>

    @foreach($column->getCheckboxOptions() as $key=>$value)
        <div class="{{ $column->getDisabled()?"disabled":"" }}">
            <label class='checkbox-inline'>
                <input type="checkbox"
                       {{ $column->getDisabled()?"disabled":"" }}
                       {!!  $column->getOnchangeJsFunctionName()?"onChange='".$column->getOnchangeJsFunctionName()."'":"" !!}
                       {!! $column->getOnclickJsFunctionName()?"onClick='".$column->getOnclickJsFunctionName()."'":"" !!}
                       {!! $column->getOnblurJsFunctionName()?"onBlur='".$column->getOnblurJsFunctionName()."'":"" !!}
                       {{ $column->getValue() && in_array($value, \ersaazis\cb\types\checkbox\CheckboxHelper::parseValuesToArray($column->getValue()))?"checked":"" }}
                       name="{{ $column->getName() }}[]"
                       value="{{ $key }}"> {{ $value }}
            </label>
        </div>
    @endforeach
@include("types::layout_footer")