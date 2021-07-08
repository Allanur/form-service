<aside
	class="sidebar fixed top-0 bottom-0 left-0 w-64 flex-shrink-0 md:shadow transform -translate-x-full md:translate-x-0 transition-transform duration-150 ease-in bg-indigo-500">
	<div class="sidebar-header flex items-center justify-center py-4">
		<div class="inline-flex">
			<a href="#" class="inline-flex flex-row items-center">
				<svg class="w-10 h-10 text-red-400" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" clip-rule="evenodd"
								d="M11.757 2.034a1 1 0 01.638.519c.483.967.844 1.554 1.207 2.03.368.482.756.876 1.348 1.467A6.985 6.985 0 0117 11a7.002 7.002 0 01-14 0c0-1.79.684-3.583 2.05-4.95a1 1 0 011.707.707c0 1.12.07 1.973.398 2.654.18.374.461.74.945 1.067.116-1.061.328-2.354.614-3.58.225-.966.505-1.93.839-2.734.167-.403.356-.785.57-1.116.208-.322.476-.649.822-.88a1 1 0 01.812-.134zm.364 13.087A2.998 2.998 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879.586.585.879 1.353.879 2.121s-.293 1.536-.879 2.121z"
					/>
				</svg>
				<span class="leading-10 text-gray-100 text-2xl font-bold ml-1 uppercase">Form service</span>
			</a>
		</div>
	</div>
	<div class="sidebar-content px-4 py-6">
		<ul class="flex flex-col w-full">
			<li class="my-px">
				<a href="{{ route('home') }}"
					 class="flex flex-row items-center h-10 px-3 rounded-lg {{ request()->routeIs('home') ? 'text-gray-700 bg-gray-100' : 'text-gray-300' }} hover:bg-gray-100 hover:text-gray-700">
              <span class="flex items-center justify-center text-lg text-gray-400">
                <svg
									fill="none"
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									viewBox="0 0 24 24"
									stroke="currentColor"
									class="h-6 w-6">
                  <path
										d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
              </span>
					<span class="ml-3">Dashboard</span>
				</a>
			</li>
			<li class="my-px">
				<span class="flex font-medium text-sm text-gray-300 px-4 my-4 uppercase">Management</span>
			</li>
			<li class="my-px">
				<a href="{{ route('forms.index') }}"
					 class="flex flex-row items-center h-10 px-3 rounded-lg {{ request()->routeIs('forms.*') ? 'text-gray-700 bg-gray-100' : 'text-gray-300' }} hover:bg-gray-100 hover:text-gray-700">
              <span class="flex items-center justify-center text-lg text-gray-400">
                <svg
									fill="none"
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									viewBox="0 0 24 24"
									stroke="currentColor"
									class="h-6 w-6">
                  <path
										d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
              </span>
					<span class="ml-3">Forms</span>
				</a>
			</li>
			<li class="my-px">
				<span class="flex font-medium text-sm text-gray-300 px-4 my-4 uppercase">Account</span>
			</li>
			<li class="my-px">
				<a href="{{ route('password.edit') }}"
					 class="flex flex-row items-center h-10 px-3 rounded-lg {{ request()->routeIs('password.edit') ? 'text-gray-700 bg-gray-100' : 'text-gray-300' }} hover:bg-gray-100 hover:text-gray-700">
              <span class="flex items-center justify-center text-lg text-gray-400">
                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                  <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
              </span>
					<span class="ml-3">Change password</span>
				</a>
			</li>
			<li class="my-px">
				<a href="{{ route('logout') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
					 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<span class="flex items-center justify-center text-lg text-red-400">
							<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
								<path d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
							</svg>
						</span>
					<span class="ml-3">Logout</span>
					<form id="logout-form" class="d-none" action="{{ route('logout') }}" method="post">
						@csrf
					</form>
				</a>
			</li>
		</ul>
	</div>
</aside>
