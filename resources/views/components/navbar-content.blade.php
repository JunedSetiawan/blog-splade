<div class="flex-1 ml-2">
    <h2 class="font-semibold text-xl leading-tight">
        {{ $slot }}
    </h2>
</div>
<div class="flex-none space-x-3">
    <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle">
            <div class="indicator">
                <x-heroicon-o-bell-alert />
                <span
                    class="badge badge-md rounded-lg bg-red-500 indicator-item text-base-100">{{ auth()->user()->unreadNotifications->count() }}</span>
            </div>
        </label>
        <div tabindex="0" class="z-10 mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
            <div class="card-body">
                @if (auth()->user()->unreadNotifications->count() < 1)
                    You don't have any notifications for reports.
                @else
                    <ul class="menu bg-base-200 w-full p-0 [&_li>*]:rounded-none">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <li class="text-red-700">
                                Some User Reported This Post
                                <Link href="{{ route('post.show', $notification->data['data']['postId']) }}">
                                {{ $notification->data['data']['postId'] }}</Link> Please, Check it out.
                            </li>
                        @endforeach
                    </ul>
                    <ul class="menu bg-base-200 w-full rounded-box">
                        <li>
                            <Link href="{{ route('mark-as-read') }}">Mark As Read</Link>
                        </li>
                    </ul>
                @endif
                <ul class="menu bg-base-200 w-full rounded-box">
                    @foreach (auth()->user()->readNotifications as $notification)
                        <li class="text-green-700 flex">
                            <p>
                                Some User Reported This Post
                                <Link href="{{ route('post.show', $notification->data['data']['postId']) }}">
                                {{ $notification->data['data']['postId'] }}</Link> Please, Check it out.
                            </p>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    <theme-toggle></theme-toggle>
    <div class="tooltip tooltip-bottom" data-tip="Profile">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar mr-2" @click.prevent="toggle('isProfileOpen')">
                <div class="w-10 rounded-full shadow">
                    <img src="https://api.dicebear.com/6.x/identicon/svg?scale=75&seed={{ Auth::user()->name }}" />
                </div>
            </label>
            <ul v-show="isProfileOpen" tabindex="0"
                class="z-10 menu menu-sm dropdown-content p-2 shadow bg-base-100 rounded-box w-52 space-y-3">
                <span class="badge">{{ Auth::user()->name }}</span>
                <div class="badge badge-primary badge-outline">{{ Auth::user()->email }}</div>
                <li class="my-4">
                    <Link href="{{ route('profile.edit') }}" class="justify-between">
                    Profile
                    </Link>
                </li>
                <li class="my-4">
                    <Link href="{{ route('logout') }}" method="POST">Logout</Link>
                </li>
            </ul>
        </div>
    </div>
</div>
