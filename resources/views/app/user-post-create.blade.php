@extends('layouts.home')

@section('content')
    <section>
        <div>
			<div class="main-container">
				<div class="editor-container editor-container_classic-editor" id="editor-container">
					<div class="editor-container__editor">
                        <div id="editor">
                        </div>
                        <x-form.form action="{{ route('posts.store') }}" method="POST">
                            <x-form.button>Save</x-form>
                        </x-form>

                    </div>
				</div>
			</div>
		</div>
    </section>
@endsection
