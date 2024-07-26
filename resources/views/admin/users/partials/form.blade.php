<div class="form-group">
    <label for="name">Ism</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
</div>

<div class="form-group">
    <label for="password">Parol</label>
    <input type="password" name="password" id="password" class="form-control">
</div>

<div class="form-group">
    <label for="role">Rolu</label>
    <select name="role" id="role" class="form-control">
        <option value="admin" {{ (old('role') ?? ($user->role ?? '')) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="manager" {{ (old('role') ?? ($user->role ?? '')) == 'manager' ? 'selected' : '' }}>Manager</option>
        <option value="staff" {{ (old('role') ?? ($user->role ?? '')) == 'staff' ? 'selected' : '' }}>Xodim</option>
    </select>
</div>

<div class="form-group">
    <label for="status">Status</label>
    <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $user->status ?? '') }}">
</div>

<button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Bekor qilish</a>
