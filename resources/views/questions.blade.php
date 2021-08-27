<div id="questions">
    <h2 class="title">
        Časté dotazy
    </h2>
    <div class="flex-questions">
        <div class="column">
            @foreach ($questions as $question)
                @if (count($questions) / 2 > $loop->index)
                    <div class="question">
                        <a class="btn collapsed" data-bs-toggle="collapse"
                            href="#question-collapse-{{ $loop->index }}" role="button" aria-expanded="false"
                            aria-controls="question-collapse-{{ $loop->index }}">
                            {{ $question->question }}
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="question-collapse-{{ $loop->index }}">
                            <div class="card card-body">
                                {{ $question->answer }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="column">
            @foreach ($questions as $question)
                @if (count($questions) / 2 <= $loop->index)
                    <div class="question">
                        <a class="btn collapsed" data-bs-toggle="collapse"
                            href="#question-collapse-{{ $loop->index }}" role="button" aria-expanded="false"
                            aria-controls="question-collapse-{{ $loop->index }}">
                            {{ $question->question }}
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="question-collapse-{{ $loop->index }}">
                            <div class="card card-body">
                                {{ $question->answer }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
