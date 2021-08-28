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
    <div class="contact">
        <h3 class="subtitle">Máte nějaké dotazy?</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contact-modal">
            Napište nám
            <i class="fas fa-pen-alt"></i>
        </button>
    </div>
</div>
<div class="modal fade" id="contact-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="contact-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="contact-modal">Napište nám</h3>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times fa-fw"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="E-mail" @if (Auth::user())
                        value="{{ Auth::user()->email }}"
                        @endif>
                        <label for="email">E-mail</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Zpráva" id="message"></textarea>
                        <label for="message">Zpráva</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Odelat</button>
                </form>
            </div>
        </div>
    </div>
</div>
