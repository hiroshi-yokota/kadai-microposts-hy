<ul class="nav nav-tabs nav-justified mb-12">
    {{-- アンケート結果確認 --}}
    <li class="nav-item">
        <a href="{{ route('sys.rept', ['sys' => $user->id]) }}" class="nav-link {{ Request::routeIs('sys.rept') ? 'active' : '' }}">
            <i class="fas fa-poll-h"></i> アンケート結果
            <span class="badge badge-secondary"></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('sys.rept3', ['sys' => $user->id]) }}" class="nav-link {{ Request::routeIs('sys.rept3') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> アンケート回答状況
            <span class="badge badge-secondary"></span>
        </a>
    </li>
    {{-- アンケート設定 --}}
    <li class="nav-item">
        <a href="{{ route('sys.show', ['sys' => $user->id]) }}" class="nav-link {{ Request::routeIs('sys.show') ? 'active' : '' }}">
            <i class="fas fa-share-square"></i> アンケート設定
            <span class="badge badge-secondary"></span>
        </a>
    </li>
    {{-- 設問取り込み取り込み --}}
    <li class="nav-item">
        <a href="{{ route('sys.qlshow', ['sys' => $user->id]) }}" class="nav-link {{ Request::routeIs('sys.qlshow') ? 'active' : '' }}">
            <i class="fas fa-file-import"></i> 設問取り込み
            <span class="badge badge-secondary"></span>
        </a>
    </li>
    {{-- 対象者取り込み --}}
    <li class="nav-item">
        <a href="{{ route('sys.ushow', ['sys' => $user->id]) }}" class="nav-link {{ Request::routeIs('sys.ushow') ? 'active' : '' }}">
            <i class="fas fa-file-import"></i> 対象者取り込み
            <span class="badge badge-secondary"></span>
        </a>
    </li>
</ul>
</ul>