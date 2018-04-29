
<li class="{{ Request::is('questions*') ? 'active' : '' }}">
    <a href="{!! route('questions.index') !!}"><i class="fa fa-edit"></i><span>Questions</span></a>
</li>

<li class="{{ Request::is('questionCategories*') ? 'active' : '' }}">
    <a href="{!! route('questionCategories.index') !!}"><i class="fa fa-edit"></i><span>Question Categories</span></a>
</li>


<li class="{{ Request::is('questionCategories*') ? 'active' : '' }}">
    <a href="{!! route('generator.questions') !!}"><i class="fa fa-edit"></i><span>Generador</span></a>
</li>

<li class="{{ Request::is('questionCategories*') ? 'active' : '' }}">
    <a href="{!! route('generator.answers') !!}"><i class="fa fa-edit"></i><span>Respuestas</span></a>
</li>
