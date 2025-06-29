@php
  $routeName = request()->route()->getName();
  $routeNameArr = explode('.', $routeName);
  $moduleName = ucwords($routeNameArr[1]);
  // echo $moduleName;
@endphp
<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
  <!-- SIDEBAR HEADER -->
  <div
    :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="flex items-center gap-2 pt-8 sidebar-header pb-7 h-15 overflow-hidden"
  >
    <a href="{{route('admin.dashboard')}}">
      <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
        <img class="dark:hidden" 
              src="{{asset('images/admin/logo.png')}}" 
              alt="Logo" 
        />
        
        <img
          class="hidden dark:block"
          src="{{asset('images/admin/logo.png')}}"
          alt="Logo"
        />
      </span>

      <img
        class="logo-icon"
        :class="sidebarToggle ? 'lg:block' : 'hidden'"
        src="{{asset('images/logo_icon.jpg')}}"
        alt="Logo"
      />
    </a>
  </div>
  <!-- SIDEBAR HEADER -->

  <div
    class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
  >
    <!-- Sidebar Menu -->
    <nav x-data="{selected: $persist('Dashboard'), moduleName: '{{ $moduleName }}'}">
      <!-- Menu Group -->
      <div>
        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
            class="menu-group-title"
            :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            MENU
          </span>

          <svg
            :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
            class="mx-auto fill-current menu-group-icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
              fill=""
            />
          </svg>
        </h3>

        <ul class="flex flex-col gap-4 mb-6">
          <!-- Menu Item Dashboard -->
           <li>
            <a
              href="{{route('admin.dashboard')}}"
              @click="selected = 'Dashboard'"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'Dashboard',
                      'menu-item-inactive' => $moduleName != 'Dashboard'
                    ])
              {{-- :class=" (selected === 'Dashboard') ? 'menu-item-active' : 'menu-item-inactive'" --}}
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'Dashboard',
                  'menu-item-icon-inactive' => $moduleName != 'Dashboard'
                ])
                {{-- :class="(selected === 'Dashboard') && (page === 'admin.dashboard') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'" --}}
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                  fill=""
                />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Dashboard
              </span>
            </a>
          </li>
          
          <!-- Menu Item Modules -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Modules' ? '':'Modules')"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'Modules',
                      'menu-item-inactive' => $moduleName != 'Modules'
                    ])
              :class=" (selected === 'Modules') || (page === 'admin.modules.index' || page === 'admin.modules.create') ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'Modules',
                  'menu-item-icon-inactive' => $moduleName != 'Modules'
                ])
                :class="(selected === 'Modules') || (page === 'admin.modules.index' || page === 'admin.modules.create') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="m3.196 12.87-.825.483a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .758 0l7.25-4.25a.75.75 0 0 0 0-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 0 1-2.276 0L3.196 12.87Z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="m3.196 8.87-.825.483a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .758 0l7.25-4.25a.75.75 0 0 0 0-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 0 1-2.276 0L3.196 8.87Z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M10.38 1.103a.75.75 0 0 0-.76 0l-7.25 4.25a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .76 0l7.25-4.25a.75.75 0 0 0 0-1.294l-7.25-4.25Z" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Modules
              </span>

              <svg
                @class([
                  'menu-item-arrow',
                  'menu-item-arrow-active' => $moduleName === 'Modules',
                  'menu-item-arrow-inactive' => $moduleName != 'Modules'
                ])
                :class="[(selected === 'Modules') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>

            <!-- Dropdown Menu Start -->
            <div
              @class([
                'overflow-hidden',
                'transform',
                'translate',
                // 'block' => $moduleName === 'Modules',
                // 'hidden' => $moduleName != 'Modules'
              ])
              :class="(selected === 'Modules' || moduleName === 'Modules') ? 'block' :'hidden'"
            >
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
              >
                <li>
                  <a
                    href="{{ route('admin.modules.index') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.modules.index' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Modules'"
                  >
                    Modules List
                  </a>
                </li>
                <li>
                  <a
                    href="{{ route('admin.modules.create') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.modules.create' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Modules'"
                  >
                    Add New Module
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>
          <!-- Menu Item Modules -->

          <!-- Menu Item UserTypes -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'UserTypes' ? '':'UserTypes')"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'UserTypes',
                      'menu-item-inactive' => $moduleName != 'UserTypes'
                    ])
              :class=" (selected === 'UserTypes') || (page === 'admin.userTypes.index' || page === 'admin.userTypes.create') ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'UserTypes',
                  'menu-item-icon-inactive' => $moduleName != 'UserTypes'
                ])
                :class="(selected === 'UserTypes') || (page === 'admin.userTypes.index' || page === 'admin.userTypes.create') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="m3.196 12.87-.825.483a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .758 0l7.25-4.25a.75.75 0 0 0 0-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 0 1-2.276 0L3.196 12.87Z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="m3.196 8.87-.825.483a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .758 0l7.25-4.25a.75.75 0 0 0 0-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 0 1-2.276 0L3.196 8.87Z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M10.38 1.103a.75.75 0 0 0-.76 0l-7.25 4.25a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .76 0l7.25-4.25a.75.75 0 0 0 0-1.294l-7.25-4.25Z" />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                User Types
              </span>

              <svg
                @class([
                  'menu-item-arrow',
                  'menu-item-arrow-active' => $moduleName === 'UserTypes',
                  'menu-item-arrow-inactive' => $moduleName != 'UserTypes'
                ])
                :class="[(selected === 'UserTypes') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585"
                  stroke=""
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>

            <!-- Dropdown Menu Start -->
            <div
              @class([
                'overflow-hidden',
                'transform',
                'translate',
                // 'block' => $moduleName === 'Usertypes',
                // 'hidden' => $moduleName != 'Usertypes'
              ])
              :class="(selected === 'UserTypes' || moduleName === 'UserTypes') ? 'block' :'hidden'"
            >
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
              >
                <li>
                  <a
                    href="{{ route('admin.userTypes.index') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.userTypes.index' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'UserTypes'"
                  >
                    User Type List
                  </a>
                </li>
                <li>
                  <a
                    href="{{ route('admin.userTypes.create') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.userTypes.create' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'UserTypes'"
                  >
                    Add New User Type
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>
          <!-- Menu Item UserTypes -->

          <!-- Menu Item Calendar -->
          <!-- <li>
            <a
              href="calendar.html"
              @click="selected = (selected === 'Calendar' ? '':'Calendar')"
              class="menu-item group"
              :class=" (selected === 'Calendar') && (page === 'calendar') ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <svg
                :class="(selected === 'Calendar') && (page === 'calendar') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                  fill=""
                />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Calendar
              </span>
            </a>
          </li> -->
          <!-- Menu Item Calendar -->
        </ul>
      </div>
    </nav>
    <!-- Sidebar Menu -->
  </div>
</aside>