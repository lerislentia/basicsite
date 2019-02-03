
<div class="col-4 col-6-medium col-12-small">
    <section class="box">
        <a href="#" class="image featured">
            <img src="{{$image or ''}}" alt="" />
        </a>
        <header>
            <h3>{{$header or 'Ipsum feugiat et dolor'}}</h3>
        </header>
        <p>{{ $paragraph or 'Lorem ipsum dolor sit amet sit veroeros sed amet blandit consequat veroeros lorem blandit adipiscing
            et feugiat phasellus tempus dolore ipsum lorem dolore.'}}</p>
        <footer>
            <ul class="actions">
                <li>
                    <a href="{{$actionhref or '#'}}" class="button alt">{{$actiontext or 'Find out more'}}</a>
                </li>
            </ul>
        </footer>
    </section>
</div>