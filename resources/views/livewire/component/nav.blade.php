<div class=" bg-base-100 flex">

    <div class=" hidden sm:block">
        <a class="btn btn-ghost normal-case text-xl">HiPrent</a>
    </div>

    <div class="flex items-center justify-around w-full">


        <a href="/home">
            <i class="fa-solid fa-house fa-xl"></i>
        </a>


        <a href="/friend">
            <i class="fa-solid fa-user-group fa-xl"></i>
        </a>


        <a href="/chat">
            <i class="fa-solid fa-message fa-xl"></i>
        </a>

        <div class="indicator">
            <i class="fa-solid fa-bell fa-xl"></i>
            <span class="badge badge-xs badge-primary indicator-item">1</span>
        </div>

        <div class="dropdown dropdown-end">
            <label tabindex="0">
                <img src="{{ auth()->user()->profile_photo_path == null ? asset('assets/img/profile-' . auth()->user()->gender . '.jpg') : asset('storage/' . auth()->user()->profile_photo_path) }}"
                    class="w-10 h-10 rounded-full" />
            </label>
            <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                <li>
                    <a class="justify-between">
                        Profile
                        <span class="badge">New</span>
                    </a>
                </li>
                <li><a>Settings</a></li>
                <li><a>Logout</a></li>
            </ul>
        </div>
    </div>

</div>
