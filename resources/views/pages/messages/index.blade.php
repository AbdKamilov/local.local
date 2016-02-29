@extends('index')

@section('content')

    @include('common.form')
    <div class="text-right"><b>Бардык каттар:</b><i class="badge">{{$count}}</i></div><br/>
    <div class="messages">
        @if(!$messages->isEmpty())
            @foreach($messages as $message)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span>{!! $message->username !!}</span>
                            <span class="pull-right label label-info">{!! $message->updated_at !!}</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! $message->message !!}
                        <hr/>
                        <div class="pull-right">
                            <form action="/message/{{ $message->id }}/delete" method="POST">
                                <input name="_token" hidden value="{!! csrf_token() !!}" />
                            <a class="btn btn-info" href="message/{!! $message->id !!}/edit">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                                <button class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="text-center">
                {!! $messages->render() !!}
            </div>
        @endif
    </div>
@stop
