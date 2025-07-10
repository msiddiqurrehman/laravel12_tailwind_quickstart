@php
  $routeName = request()->route()->getName();
  $routeNameArr = explode('.', $routeName);
  $moduleName = ucwords($routeNameArr[1]);
  $moduleName = ($moduleName == 'Permissions')? 'Roles' : $moduleName;
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
          <!-- Menu Item Dashboard -->
          
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

          <!-- Menu Item Countries -->
          <li>
            <a
              href="{{route('admin.countries.index')}}"
              @click="selected = 'Countries'"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'Countries',
                      'menu-item-inactive' => $moduleName != 'Countries'
                    ])
              {{-- :class=" (selected === 'Dashboard') ? 'menu-item-active' : 'menu-item-inactive'" --}}
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'Countries',
                  'menu-item-icon-inactive' => $moduleName != 'Countries'
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
                  d="M13.09 3.294c1.924.95 3.422 1.69 5.472.692a1 1 0 0 1 1.438.9v9.54a1 1 0 0 1-.562.9c-2.981 1.45-5.382.24-7.25-.701a38.739 38.739 0 0 0-.622-.31c-1.033-.497-1.887-.812-2.756-.77-.76.036-1.672.357-2.81 1.396V21a1 1 0 1 1-2 0V4.971a1 1 0 0 1 .297-.71c1.522-1.506 2.967-2.185 4.417-2.255 1.407-.068 2.653.453 3.72.967.225.108.443.216.655.32Z"
                  fill=""
                />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Countries
              </span>
            </a>
          </li>
          <!-- Menu Item Countries -->

          <!-- Menu Item States -->
          <li>
            <a
              href="{{route('admin.states.index')}}"
              @click="selected = 'States'"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'States',
                      'menu-item-inactive' => $moduleName != 'States'
                    ])
              {{-- :class=" (selected === 'Dashboard') ? 'menu-item-active' : 'menu-item-inactive'" --}}
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'States',
                  'menu-item-icon-inactive' => $moduleName != 'States'
                ])
                {{-- :class="(selected === 'Dashboard') && (page === 'admin.dashboard') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'" --}}
                width="24"
                height="24"
                viewBox="0 0 260 165"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M258,23.765l-5.217-3.73l-2.621-7.979l-6.633-0.567l-1.653,11.521l-2.101,3.329l-1.298,2.219l-7.767,2.124l-6.445,1.535
                    l-5.194,6.728l1.464,3.116l-10.883,6.894l-3.329,4.225l-3.116,2.314l-8.428,5.005l-4.651-1.417l3.589-8.475l-5.312-7.389
                    l-1.558-6.185l-3.966-2.125l-6.799,6.209l-1.393,5.312l2.054,6.704l-2.03,7.625l-3.093,0.496l-1.723-4.533l-0.874-4.697l1.676-9.656
                    l-1.345-1.723l2.101-5.194l12.701-1.818l-4.58-4.532l-9.963,2.762l-4.886-3.353l-8.169,3.919l-7.294-0.732l2.502-7.979l-5.17-2.88
                    l-4.58,0.26l-5.902-2.857l-8.38-0.023l-27.928-1.417l-34.491-4.698l-14.07-2.88l-3.942-0.897L24.687,2.235l-1.605,5.052
                    l-7.744-2.644l-0.189,12.512l2.715,1.228l-4.084,2.738L5.919,36.136l-0.142,5.406L2,50.347l0.236,9.868l7.649,30.784l8.853,4.958
                    l4.107,5.477l0.803,5.265l12.441,1.628l-0.779,1.181l18.367,10.788l10.246,1.606l4.721-2.149l8.924,1.181l7.176,7.554l1.96,6.445
                    l7.106,4.863l2.88-4.485l6.893,0.236l9.703,14.188l2.101,7.342l9.962,2.03l-1.274-5.571l3.021-6.374l7.838-4.462l9.655-7.72
                    l8.31,2.526l2.243-1.935l5.43,4.06l6.043-1.983l0.874-5.028l5.902-1.677l5.193-1.038l7.342,0.33l6.351,3.589l4.674-3.683
                    l8.522,6.515l-0.094,6.729l5.288,7.932l10.08,5.807l0.567-11.048l-4.061-8.782l-7.483-12.819l1.865-8.546l7.531-8.522l2.266-4.816
                    l11.638-14.637l-2.455-3.966l0.071-0.024l0.236-0.047l0.425-0.094l0.118-0.024l-3.99-3.588l0.307-4.084l-1.354-1.354l4.116,0.339
                    l1.204-0.591l0.756-2.927l0.142-0.023l0.047-0.024l-3.636-7.649l1.558-1.676l4.604,0.685l-0.945-7.72l1.181-0.354l7.554-3.943
                    l2.078-3.092l0.236,0.141l0.59,0.874l2.101-2.526l-3.022-5.926l-0.047-1.298l3.99-5.973L258,23.765z M35.9,132.856l-2.856,1.015
                    l-6.964,3.305l-3.565,5.335l0.921,7.153l-2.999,5.572l7.98,7.53l20.373-2.549l-0.755-22.239L35.9,132.856z"
                  fill=""
                />
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                States
              </span>
            </a>
          </li>
          <!-- Menu Item States -->

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
                viewBox="0 0 32 32"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M19.307 3.21a2.91 2.91 0 1 0-.223 1.94a11.636 11.636 0 0 1 8.232 7.049l1.775-.698a13.576 13.576 0 0 0-9.784-8.291m-2.822 1.638a.97.97 0 1 1 0-1.939a.97.97 0 0 1 0 1.94m-4.267.805l-.717-1.774a13.576 13.576 0 0 0-8.291 9.784a2.91 2.91 0 1 0 1.94.223a11.636 11.636 0 0 1 7.068-8.233m-8.34 11.802a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94m12.607 8.727a2.91 2.91 0 0 0-2.599 1.62a11.636 11.636 0 0 1-8.233-7.05l-1.774.717a13.576 13.576 0 0 0 9.813 8.291a2.91 2.91 0 1 0 2.793-3.578m0 3.879a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94M32 16.485a2.91 2.91 0 1 0-4.199 2.599a11.636 11.636 0 0 1-7.05 8.232l.718 1.775a13.576 13.576 0 0 0 8.291-9.813A2.91 2.91 0 0 0 32 16.485m-2.91.97a.97.97 0 1 1 0-1.94a.97.97 0 0 1 0 1.94"/><path fill="currentColor" d="M19.19 16.35a3.879 3.879 0 1 0-5.42 0a4.848 4.848 0 0 0-2.134 4.014v1.939h9.697v-1.94a4.848 4.848 0 0 0-2.143-4.014m-4.645-2.774a1.94 1.94 0 1 1 3.88 0a1.94 1.94 0 0 1-3.88 0m-.97 6.788a2.91 2.91 0 1 1 5.819 0z"/>
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

          <!-- Menu Item Roles & Permissions -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Roles' ? '':'Roles')"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'Roles',
                      'menu-item-inactive' => $moduleName != 'Roles'
                    ])
              :class=" (selected === 'Roles') || (page === 'admin.roles.index' || page === 'admin.roles.create') ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'Roles',
                  'menu-item-icon-inactive' => $moduleName != 'Roles'
                ])
                :class="(selected === 'Roles') || (page === 'admin.roles.index' || page === 'admin.roles.create') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 128 128"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                {{-- <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M28.07 21L22 15l6.07-6l1.43 1.41L24.86 15l4.64 4.59L28.07 21zM22 30h-2v-5a5 5 0 0 0-5-5H9a5 5 0 0 0-5 5v5H2v-5a7 7 0 0 1 7-7h6a7 7 0 0 1 7 7zM12 4a5 5 0 1 1-5 5a5 5 0 0 1 5-5m0-2a7 7 0 1 0 7 7a7 7 0 0 0-7-7z"/> --}}
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M92.4285,92.70214a9.558,9.558,0,0,0-5.151-6.93676C78.32095,81.29915,58.66671,74.703,58.66671,74.703V68.21353l.54712-.4129a18.77694,18.77694,0,0,0,7.12945-11.93294l.11012-.69162h.53333a7.2534,7.2534,0,0,0,6.71314-4.51443,7.8988,7.8988,0,0,0,.98752-3.82622,7.26756,7.26756,0,0,0-.51614-2.69076,3.753,3.753,0,0,0-1.45547-2.33981l-1.81335-1.101.45075-1.96817c3.27573-14.2796-7.78668-27.14161-22.6409-27.496-.36127-.00688-.71912-.01029-1.07354-.00344-.35442-.00685-.71225-.00344-1.07354.00344C31.711,11.594,20.6486,24.456,23.9243,38.73564l.45075,1.96817-1.81332,1.101a3.753,3.753,0,0,0-1.4555,2.33981,7.26754,7.26754,0,0,0-.51611,2.69076,7.89848,7.89848,0,0,0,.98752,3.82622,7.25339,7.25339,0,0,0,6.71311,4.51443h.53333l.11012.69162a18.77694,18.77694,0,0,0,7.12945,11.93294l.54712.4129V74.703S16.95657,81.29915,8,85.76538a9.55783,9.55783,0,0,0-5.151,6.93676c-1.53464,8.95659-1.80645,24.06542-1.80645,24.06542H94.235S93.96311,101.65873,92.4285,92.70214Z"/>
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M121.37018,34.15191V27.59562a16.35974,16.35974,0,1,0-32.71949,0v6.57a6.06113,6.06113,0,0,0-5.58722,6.03394V61.1398A6.079,6.079,0,0,0,89.11805,67.16H120.9097a6.05661,6.05661,0,0,0,6.04774-6.0477V40.179A6.05471,6.05471,0,0,0,121.37018,34.15191ZM107.80409,51.05109l-.39861.31615v5.38109a2.25825,2.25825,0,0,1-1.16831,2.09607,2.545,2.545,0,0,1-2.48092-.055,2.40684,2.40684,0,0,1-1.14768-2.048V51.381l-.12374-.1031-.25428-.20616A4.28921,4.28921,0,0,1,101.021,45.89a4.36726,4.36726,0,0,1,4.79008-2.52908h.00688a4.44018,4.44018,0,0,1,3.608,4.26777A4.21607,4.21607,0,0,1,107.80409,51.05109Zm7.61458-16.89919H94.59533V27.59562a10.41167,10.41167,0,1,1,20.82334,0Z"/>
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Roles & Permissions
              </span>

              <svg
                @class([
                  'menu-item-arrow',
                  'menu-item-arrow-active' => $moduleName === 'Roles',
                  'menu-item-arrow-inactive' => $moduleName != 'Roles'
                ])
                :class="[(selected === 'Roles') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
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
                // 'block' => $moduleName === 'Roles',
                // 'hidden' => $moduleName != 'Roles'
              ])
              :class="(selected === 'Roles' || moduleName === 'Roles') ? 'block' :'hidden'"
            >
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
              >
                <li>
                  <a
                    href="{{ route('admin.roles.index') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.roles.index' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Roles'"
                  >
                    Role List
                  </a>
                </li>
                <li>
                  <a
                    href="{{ route('admin.roles.create') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.roles.create' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Roles'"
                  >
                    Add New Role
                  </a>
                </li>
                <li>
                  <a
                    href="{{ route('admin.permissions.index') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.permissions.index' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Roles'"
                  >
                    Permission List
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>
          <!-- Menu Item Roles & Permissions -->

          <!-- Menu Item Designations -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Designations' ? '':'Designations')"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'Designations',
                      'menu-item-inactive' => $moduleName != 'Designations'
                    ])
              :class=" (selected === 'Designations') || (page === 'admin.designations.index' || page === 'admin.designations.create') ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'Designations',
                  'menu-item-icon-inactive' => $moduleName != 'Designations'
                ])
                :class="(selected === 'Designations') || (page === 'admin.designations.index' || page === 'admin.designations.create') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 512.162 512.162"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
              <path d="M490.714,315.112v-44.2l17.6-45.4c10.3-24-0.8-51.9-24.7-62.3l-182-79.3c-28.9-12.1-62.1-12.1-91.3,0.1l-181.5,79 c-24,10.5-35.2,38.6-25.1,62.1l17.7,45.6v43.1c-12.5,6.3-21.3,18.9-21.3,33v11.2c0,20.9,15.7,40.2,37.2,45.9 c87.1,22.8,156.6,33.4,218.7,33.4c77.2,0,147.1-17.1,214.7-33.7c20.1-4.9,41.4-22.8,41.4-46.1v-9.1 C512.114,333.612,502.714,321.712,490.714,315.112z M261.214,139.412c9.4,1.9,16.7,9.7,18.7,19.1c1.9,9.4-2,15.5-7.6,20.8 l5.1,10.2c6.4,12.9,2.7,28.5-8.8,37.1l-12.5,9.4l-11.6-8.7c-12-9-15.9-25.3-9.2-38.7l4.6-9.2c-4.6-4.4-8.1-9.3-8.1-16.2 C231.814,148.112,245.614,136.212,261.214,139.412z M448.014,309.312h-383.9v-21.3h383.9V309.312z"/>
                {{-- <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="m3.196 8.87-.825.483a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .758 0l7.25-4.25a.75.75 0 0 0 0-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 0 1-2.276 0L3.196 8.87Z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M10.38 1.103a.75.75 0 0 0-.76 0l-7.25 4.25a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .76 0l7.25-4.25a.75.75 0 0 0 0-1.294l-7.25-4.25Z" /> --}}
              </svg>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Designations
              </span>

              <svg
                @class([
                  'menu-item-arrow',
                  'menu-item-arrow-active' => $moduleName === 'Designations',
                  'menu-item-arrow-inactive' => $moduleName != 'Designations'
                ])
                :class="[(selected === 'Designations') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
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
                // 'block' => $moduleName === 'Designations',
                // 'hidden' => $moduleName != 'Designations'
              ])
              :class="(selected === 'Designations' || moduleName === 'Designations') ? 'block' :'hidden'"
            >
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
              >
                <li>
                  <a
                    href="{{ route('admin.designations.index') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.designations.index' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Designations'"
                  >
                    Designation List
                  </a>
                </li>
                <li>
                  <a
                    href="{{ route('admin.designations.create') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.designations.create' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Designations'"
                  >
                    Add New Designation
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>
          <!-- Menu Item Designations -->

          <!-- Menu Item Users -->
          <li>
            <a
              href="#"
              @click.prevent="selected = (selected === 'Users' ? '':'Users')"
              @class([
                      'menu-item', 
                      'group',
                      'menu-item-active' => $moduleName === 'Users',
                      'menu-item-inactive' => $moduleName != 'Users'
                    ])
              :class=" (selected === 'Users') || (page === 'admin.users.index' || page === 'admin.users.create') ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <svg
                @class([
                  'menu-item-icon-active' => $moduleName === 'Users',
                  'menu-item-icon-inactive' => $moduleName != 'Users'
                ])
                :class="(selected === 'Users') || (page === 'admin.users.index' || page === 'admin.users.create') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
              <path d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"/>
                {{-- <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="m3.196 8.87-.825.483a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .758 0l7.25-4.25a.75.75 0 0 0 0-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 0 1-2.276 0L3.196 8.87Z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="" d="M10.38 1.103a.75.75 0 0 0-.76 0l-7.25 4.25a.75.75 0 0 0 0 1.294l7.25 4.25a.75.75 0 0 0 .76 0l7.25-4.25a.75.75 0 0 0 0-1.294l-7.25-4.25Z" /> --}}
              </svg>
              {{-- <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
              </svg> --}}
              

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Users
              </span>

              <svg
                @class([
                  'menu-item-arrow',
                  'menu-item-arrow-active' => $moduleName === 'Designations',
                  'menu-item-arrow-inactive' => $moduleName != 'Designations'
                ])
                :class="[(selected === 'Users') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
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
              ])
              :class="(selected === 'Users' || moduleName === 'Users') ? 'block' :'hidden'"
            >
              <ul
                :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9"
              >
                <li>
                  <a
                    href="{{ route('admin.users.index') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.users.index' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Users'"
                  >
                    User List
                  </a>
                </li>
                <li>
                  <a
                    href="{{ route('admin.users.create') }}"
                    class="menu-dropdown-item group"
                    :class="page === 'admin.users.create' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                    @click="selected = 'Users'"
                  >
                    Add New User
                  </a>
                </li>
              </ul>
            </div>
            <!-- Dropdown Menu End -->
          </li>
          <!-- Menu Item Users -->

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