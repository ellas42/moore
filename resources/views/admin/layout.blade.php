<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin — @yield('title', 'Mooré Connections')</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=Cormorant+Garamond:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
<style>
:root {
  --base:  #FAF7F2; --blush: #F0E8DC;
  --taupe: #9C8874; --brown: #6B4F3A;
  --dark:  #2C1A0E; --white: #FFFFFF;
  --sans:  'DM Sans', sans-serif;
  --serif: 'Cormorant Garamond', serif;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--sans); background: var(--base); color: var(--dark); display: flex; min-height: 100vh; }

/* sidebar */
.sidebar {
  width: 240px; background: var(--dark); min-height: 100vh;
  padding: 36px 0; display: flex; flex-direction: column;
  position: fixed; top: 0; left: 0;
}
.sidebar-logo {
  padding: 0 28px 36px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
}
.sidebar-logo p {
  font-family: var(--serif); font-size: 20px;
  color: var(--white); margin-top: 4px;
}
.sidebar-logo span {
  font-size: 9px; letter-spacing: 3px; text-transform: uppercase;
  color: var(--taupe);
}
.sidebar-nav { padding: 28px 0; flex: 1; }
.sidebar-nav a {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 28px; color: rgba(255,255,255,0.6);
  text-decoration: none; font-size: 13px; font-weight: 400;
  transition: all 0.2s; border-left: 2px solid transparent;
}
.sidebar-nav a:hover,
.sidebar-nav a.active {
  color: var(--white);
  background: rgba(255,255,255,0.06);
  border-left-color: var(--taupe);
}
.sidebar-icon { font-size: 16px; width: 20px; text-align: center; }
.sidebar-footer {
  padding: 20px 28px;
  border-top: 1px solid rgba(255,255,255,0.08);
}
.sidebar-footer a {
  font-size: 12px; color: rgba(255,255,255,0.4);
  text-decoration: none; transition: color 0.2s;
}
.sidebar-footer a:hover { color: var(--white); }

/* main */
.admin-main {
  margin-left: 240px; flex: 1; padding: 40px 48px;
  max-width: calc(100vw - 240px);
}
.admin-header { margin-bottom: 36px; }
.admin-header h1 {
  font-family: var(--serif); font-size: 32px; font-weight: 400;
  color: var(--dark);
}
.admin-header p {
  font-size: 13px; color: var(--taupe); margin-top: 4px;
}

/* flash messages */
.flash {
  padding: 14px 20px; margin-bottom: 24px;
  font-size: 13px; border-left: 3px solid var(--taupe);
  background: var(--blush); color: var(--brown);
}

/* stat cards */
.stats-grid {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 20px; margin-bottom: 40px;
}
.stat-card {
  background: var(--white); padding: 28px;
  border: 1px solid rgba(156,136,116,0.12);
}
.stat-label {
  font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
  color: var(--taupe); margin-bottom: 10px;
}
.stat-value {
  font-family: var(--serif); font-size: 38px;
  color: var(--dark); line-height: 1;
}
.stat-sub { font-size: 12px; color: var(--taupe); margin-top: 6px; }

/* tables */
.admin-table-wrap { background: var(--white); border: 1px solid rgba(156,136,116,0.12); overflow: hidden; }
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th {
  font-size: 9px; letter-spacing: 2.5px; text-transform: uppercase;
  color: var(--taupe); padding: 14px 20px; text-align: left;
  border-bottom: 1px solid rgba(156,136,116,0.15); background: var(--base);
}
.admin-table td {
  padding: 14px 20px; font-size: 13px; color: var(--dark);
  border-bottom: 1px solid rgba(156,136,116,0.08);
  vertical-align: middle;
}
.admin-table tr:last-child td { border-bottom: none; }
.admin-table tr:hover td { background: var(--base); }

/* badges */
.badge {
  display: inline-block; padding: 3px 10px;
  font-size: 10px; letter-spacing: 1px; text-transform: uppercase;
  font-weight: 500;
}
.badge-green  { background: #e8f5e9; color: #2e7d32; }
.badge-yellow { background: #fff8e1; color: #f57f17; }
.badge-grey   { background: #f5f5f5; color: #757575; }
.badge-red    { background: #fdecea; color: #c62828; }

/* buttons */
.btn-admin {
  font-family: var(--sans); font-size: 11px; font-weight: 500;
  letter-spacing: 1.5px; text-transform: uppercase;
  padding: 10px 24px; text-decoration: none; display: inline-block;
  cursor: pointer; border: none; transition: all 0.2s;
}
.btn-admin-dark  { background: var(--dark); color: var(--white); }
.btn-admin-dark:hover { background: var(--brown); }
.btn-admin-ghost {
  background: transparent; color: var(--brown);
  border: 1px solid rgba(156,136,116,0.4);
}
.btn-admin-ghost:hover { background: var(--blush); }
.btn-admin-danger { background: #fdecea; color: #c62828; }
.btn-admin-danger:hover { background: #f5c6cb; }

/* forms */
.admin-form { background: var(--white); padding: 36px; border: 1px solid rgba(156,136,116,0.12); max-width: 680px; }
.form-group { margin-bottom: 22px; }
.form-group label {
  display: block; font-size: 10px; letter-spacing: 2px;
  text-transform: uppercase; color: var(--brown); margin-bottom: 8px;
}
.form-group input,
.form-group textarea,
.form-group select {
  width: 100%; font-family: var(--sans); font-size: 14px;
  color: var(--dark); background: var(--base);
  border: 1px solid rgba(156,136,116,0.25);
  padding: 12px 16px; outline: none;
  transition: border-color 0.2s; -webkit-appearance: none;
}
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus { border-color: var(--taupe); background: var(--white); }
.form-group textarea { min-height: 120px; resize: vertical; }
.form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-check { display: flex; align-items: center; gap: 10px; }
.form-check input[type="checkbox"] { width: 18px; height: 18px; accent-color: var(--dark); }
.form-check label {
  font-size: 13px; text-transform: none; letter-spacing: 0;
  color: var(--brown); margin-bottom: 0;
}
.form-hint { font-size: 11px; color: var(--taupe); margin-top: 6px; }
.form-actions { display: flex; gap: 14px; margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(156,136,116,0.15); }

/* section titles */
.section-title {
  font-family: var(--serif); font-size: 22px; font-weight: 400;
  color: var(--dark); margin-bottom: 20px;
}
.section-header {
  display: flex; justify-content: space-between;
  align-items: center; margin-bottom: 20px;
}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">
    <p>Mooré</p>
    <span>Admin Panel</span>
  </div>
  <nav class="sidebar-nav">
    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="sidebar-icon">◈</span> Dashboard
    </a>
    <a href="{{ route('admin.events') }}"
       class="{{ request()->routeIs('admin.events*') ? 'active' : '' }}">
      <span class="sidebar-icon">◇</span> Events
    </a>
    <a href="{{ route('admin.bookings') }}"
       class="{{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
      <span class="sidebar-icon">◻</span> Bookings
    </a>
    <a href="{{ route('admin.subscribers') }}"
       class="{{ request()->routeIs('admin.subscribers') ? 'active' : '' }}">
      <span class="sidebar-icon">◯</span> Subscribers
    </a>
  </nav>
  <div class="sidebar-footer">
    <a href="{{ route('home') }}">← View Site</a><br><br>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
            style="background:none;border:none;cursor:pointer;font-size:12px;color:rgba(255,255,255,0.4);font-family:var(--sans);">
        Sign Out
    </button>
</form>
  </div>
</aside>

<main class="admin-main">
  @if(session('success'))
    <div class="flash">{{ session('success') }}</div>
  @endif
  @yield('content')
</main>

</body>
</html>