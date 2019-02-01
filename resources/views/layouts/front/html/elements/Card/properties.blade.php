

	<section class="container">

    <header>
        properties
    </header>
    <form class="form-horizontal" action="" method="POST" id="MyForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label>
                header
            </label>
            <input id="IdHeader" type="text" name="header" value="{{ isset($element['array_data']['header']) ? $element['array_data']['header'] : old('header') }}">
        </div>

        <div class="form-group">
            <label for="order">
                paragraph
            </label>
            <input id="IdParagraph" type="text" name="paragraph" value="{{ isset($element['array_data']['paragraph']) ? $element['array_data']['paragraph'] : old('paragraph') }}">
        </div>

        <div class="form-group">
            <label for="order">
                id (atributo)
            </label>
            <input id="IdAttrId" type="text" name="attrid" value="{{ isset($element['array_data']['attrid']) ? $element['array_data']['attrid'] : old('attrid') }}">
        </div>

        <div class="form-group">
            <label for="attrclass">
                class (atributo)
            </label>
            <input id="IdAttrClass" type="text" name="attrclass" value="{{ isset($element['array_data']['attrclass']) ? $element['array_data']['attrclass'] : old('attrclass') }}">
        </div>

        <input type="hidden" name="locale" value="{{$locale}}">
        <input type="submit" value="save">
    </form>
</section>