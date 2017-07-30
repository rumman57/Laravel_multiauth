@if (Auth::guard('web')->check())
  <p class="text-success">
    <span style="color: green;font-weight: bold;">You are Logged In as a</span>  <strong>USER</strong>
  </p>
@else
  <p class="text-danger">
    <span style="color: crimson;font-weight: bold;">You are Logged Out as a</span>  <strong>USER</strong>
  </p>
@endif

@if (Auth::guard('admin')->check())
  <p class="text-success">
    <span style="color: green;font-weight: bold;">You are Logged In as a</span>  <strong>ADMIN</strong>
  </p>
@else
  <p class="text-danger">
    <span style="color: crimson;font-weight: bold;">You are Logged Out as a</span>  <strong>ADMIN</strong>
  </p>
@endif
