@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block mb-1 font-medium">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2"
            value="{{ old('name', $jobseeker->name ?? '') }}">
    </div>

    <div>
        <label class="block mb-1 font-medium">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2"
            value="{{ old('email', $jobseeker->email ?? '') }}" {{ isset($jobseeker) ? 'disabled' : '' }}>
    </div>

    <div>
        <label class="block mb-1 font-medium">Phone</label>
        <input type="text" name="phone" class="w-full border rounded px-3 py-2"
            value="{{ old('phone', $jobseeker->phone ?? '') }}">
    </div>

    <div>
        <label class="block mb-1 font-medium">Experience (Years)</label>
        <input type="number" name="experience" class="w-full border rounded px-3 py-2"
            value="{{ old('experience', $jobseeker->experience ?? '') }}">
    </div>

    <div>
        <label class="block mb-1 font-medium">Notice Period (Days)</label>
        <input type="number" name="notice_period" class="w-full border rounded px-3 py-2"
            value="{{ old('notice_period', $jobseeker->notice_period ?? '') }}">
    </div>

    <div>
        <label class="block mb-1 font-medium">Job Location</label>
        <select name="location_id" class="w-full border rounded px-3 py-2">
            <option value="">Select Location</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                    {{ (old('location_id') ?? $jobseeker->location_id ?? '') == $location->id ? 'selected' : '' }}>
                    {{ $location->city }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div>
    <label class="block mb-1 font-medium">Skills</label>
    <textarea name="skills" rows="3" class="w-full border rounded px-3 py-2">{{ old('skills', $jobseeker->skills ?? '') }}</textarea>
</div>

<div>
    <label class="block mb-1 font-medium">Resume</label>
    <input type="file" name="resume" class="w-full">
</div>

<div>
    <label class="block mb-1 font-medium">Photo</label>
    <input type="file" name="photo" class="w-full">
</div>

@if (!isset($jobseeker))
    <div>
        <label class="block mb-1 font-medium">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block mb-1 font-medium">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
    </div>
@endif
