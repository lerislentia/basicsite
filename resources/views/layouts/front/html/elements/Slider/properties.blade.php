<form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="background">
                background
            </label>
            <input id="IdBackground" type="text" name="background" value="{{ isset($element['array_data']['background']) ? $element['array_data']['background'] : old('background') }}">
        </div>

        <div class="form-group">
            <label for="header">
                header
            </label>
            <input id="IdHeader" type="text" name="header" value="{{ isset($element['array_data']['header']) ? $element['array_data']['header'] : old('header') }}">
        </div>

        <div class="form-group">
            <label for="paragraph">
                paragraph
            </label>
            <input id="IdParagraph" type="text" name="paragraph" value="{{ isset($element['array_data']['paragraph']) ? $element['array_data']['paragraph'] : old('paragraph') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="submit" value="{{ __('back.save') }}">
</form>