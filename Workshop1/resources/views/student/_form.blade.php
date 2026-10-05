@php($student = $student ?? null)

<div class="form-grid">
    <div class="field">
        <label class="field__label" for="name">Full name</label>
        <input
            class="input"
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $student?->name) }}"
            autocomplete="name"
            maxlength="255"
            required
            @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
        >
        @error('name')
            <p class="field__error" id="name-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="email">Email</label>
        <input
            class="input"
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $student?->email) }}"
            autocomplete="email"
            maxlength="255"
            required
            @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
        >
        @error('email')
            <p class="field__error" id="email-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="phone">Phone</label>
        <input
            class="input"
            type="tel"
            id="phone"
            name="phone"
            value="{{ old('phone', $student?->phone) }}"
            autocomplete="tel"
            maxlength="20"
            required
            @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror
        >
        @error('phone')
            <p class="field__error" id="phone-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label class="field__label" for="date_of_birth">
            Date of birth <span class="field__optional">(optional)</span>
        </label>
        <input
            class="input"
            type="date"
            id="date_of_birth"
            name="date_of_birth"
            value="{{ old('date_of_birth', $student?->date_of_birth?->format('Y-m-d')) }}"
            max="{{ now()->subDay()->format('Y-m-d') }}"
            @error('date_of_birth') aria-invalid="true" aria-describedby="date_of_birth-error" @enderror
        >
        @error('date_of_birth')
            <p class="field__error" id="date_of_birth-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field field--full">
        <label class="field__label" for="address">
            Address <span class="field__optional">(optional)</span>
        </label>
        <textarea
            class="textarea"
            id="address"
            name="address"
            autocomplete="street-address"
            maxlength="500"
            @error('address') aria-invalid="true" aria-describedby="address-error" @enderror
        >{{ old('address', $student?->address) }}</textarea>
        @error('address')
            <p class="field__error" id="address-error">{{ $message }}</p>
        @enderror
    </div>
</div>
