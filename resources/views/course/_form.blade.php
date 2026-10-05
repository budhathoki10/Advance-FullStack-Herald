@php($course = $course ?? null)

<div class="form-grid">
    <div class="field field--full">
        <label class="field__label" for="name">Course name</label>
        <input
            class="input"
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $course?->name) }}"
            maxlength="255"
            required
            @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
        >
        @error('name')
            <p class="field__error" id="name-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field field--full">
        <label class="field__label" for="description">
            Description <span class="field__optional">(optional)</span>
        </label>
        <textarea
            class="textarea"
            id="description"
            name="description"
            maxlength="2000"
            @error('description') aria-invalid="true" aria-describedby="description-error" @enderror
        >{{ old('description', $course?->description) }}</textarea>
        @error('description')
            <p class="field__error" id="description-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="duration">Duration (weeks)</label>
        <input
            class="input"
            type="number"
            id="duration"
            name="duration"
            value="{{ old('duration', $course?->duration) }}"
            min="1"
            max="520"
            step="1"
            inputmode="numeric"
            required
            @error('duration') aria-invalid="true" aria-describedby="duration-error" @enderror
        >
        @error('duration')
            <p class="field__error" id="duration-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="fee">Fee</label>
        <div class="input-group">
            <span class="input-group__prefix" aria-hidden="true">NPR</span>
            <input
                class="input"
                type="number"
                id="fee"
                name="fee"
                value="{{ old('fee', $course?->fee) }}"
                min="0"
                step="0.01"
                inputmode="decimal"
                required
                @error('fee') aria-invalid="true" aria-describedby="fee-error" @enderror
            >
        </div>
        @error('fee')
            <p class="field__error" id="fee-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="difficulty">Difficulty</label>
        <select
            class="select"
            id="difficulty"
            name="difficulty"
            required
            @error('difficulty') aria-invalid="true" aria-describedby="difficulty-error" @enderror
        >
            <option value="" disabled @selected(! old('difficulty', $course?->difficulty))>Select a level</option>
            @foreach(\App\Models\Course::DIFFICULTIES as $level)
                <option value="{{ $level }}" @selected(old('difficulty', $course?->difficulty) === $level)>
                    {{ ucfirst($level) }}
                </option>
            @endforeach
        </select>
        @error('difficulty')
            <p class="field__error" id="difficulty-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <span class="field__label">Status</span>
        <input type="hidden" name="is_active" value="0">
        <label class="switch" for="is_active">
            <input
                type="checkbox"
                id="is_active"
                name="is_active"
                value="1"
                @checked(old('is_active', $course?->is_active ?? true))
            >
            <span>
                Currently offered
                <span class="field__hint switch__hint">Inactive courses stay on record but aren't open for enrolment.</span>
            </span>
        </label>
        @error('is_active')
            <p class="field__error">{{ $message }}</p>
        @enderror
    </div>
</div>
