<div>
    @if(!$question)
        {{ __('Nothing to do!') }}
    @else
        <x-jet-action-section>
            <x-slot name="title">
                {{ $question->quiz->title }} ({{ $dueQuestionCount - 1 }} more to do)
            </x-slot>

            <x-slot name="description">
                question = {{ $question->question }}<br>
                question id = {{ $question->id }}<br>
                current slot = {{ $question->slot()->first()->slot_id ?? 1 }}<br>
                total answers = {{ $question->answers_count }}<br>
                skipped = {{ $question->answers_sum_skipped ?? 0 }}<br>
                correct = {{ $question->answers_sum_correct ?? 0 }}<br>
                incorrect = {{ $question->answers_count - $question->answers_sum_correct }}<br>
            </x-slot>

            <x-slot name="content">
                <div id="answer" class="max-w-xl text-sm text-gray-600" style="display: none">
                    {{ $question->answer }}
                </div>

                <div class="mt-5">
                    <x-jet-danger-button wire:click="answer(false)" wire:loading.attr="disabled">
                        {{ __('Wrong') }}
                    </x-jet-danger-button>

                    <x-jet-secondary-button wire:click="answer(false, true)" wire:loading.attr="disabled">
                        {{ __('Skip') }}
                    </x-jet-secondary-button>

                    <x-jet-secondary-button id="toggle" wire:loading.attr="disabled">
                        {{ __('Show answer') }}
                    </x-jet-secondary-button>

                    <x-jet-button wire:click="answer(true)" wire:loading.attr="disabled">
                        {{ __('Correct') }}
                    </x-jet-button>
                </div>
            </x-slot>
        </x-jet-action-section>
    @endif
</div>

<script>
    const targetDiv = document.getElementById("answer");
    const btn = document.getElementById("toggle");
    btn.onclick = function () {
        if (targetDiv.style.display !== "none") {
            targetDiv.style.display = "none";
            btn.innerHTML = "{{ __('Show Answer') }}";
        } else {
            targetDiv.style.display = "block";
            btn.innerHTML = "{{ __('Hide Answer') }}";
        }
    }
</script>
