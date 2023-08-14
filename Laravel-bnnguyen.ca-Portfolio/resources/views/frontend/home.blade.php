@extends('frontend.layout')

@section('content')
<section class="container lg:max-w-3xl flex flex-col justify-center mx-auto lg:my-20 space-y-4 p-4">
    <h1 class="text-5xl text-amber-600 font-semibold">Nam Nguyen</h1>
    <div class="flex md:space-x-10 md:flex-row flex-col dark:text-slate-300">
        <div class="flex-1 flex flex-col space-y-4">
            <div>I am a Software Developer with experience in Web Development and Mobile Application Development. Previously, I was a Web Developer at <a href="https://www.facebook.com/VTCode/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">VTCode</a>, <a href="https://www.linkedin.com/company/evolable-asia/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">Evolable Asia CO., LTD.</a>, <a href="https://www.linkedin.com/company/anvy-digital/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">Anvy Digital</a>. </div>

            <div>
                I completed my Bachelor's degree, Mathematics & Computer Sciences, at <a href="https://www.linkedin.com/school/vnuhcm---university-of-science/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">VNUHCM - University of Science</a>
            </div>

            <div>
            Currently, I am a student at Fanshawe College (London, ON), pursuing postgraduate program in Mobile Application Development. I am looking for a Co-op position for 4 months, 09/2023 - 12/2023. The course is expected to be completed by December 31, 2023.
            </div>

            <div>Technologies that I have been working with:</div>
            <ul class="list-inside list-disc columns-2 font-mono text-gray-500 dark:text-slate-300 text-sm">
                <li>CakePHP Laravel</li>
                <li>Wordpress</li>
                <li>jQuery</li>
                <li>React</li>
                <li>React Native</li>
                <li>iOS: Swift SwiftUI</li>
                <li>Android: Kotlin</li>
                <li>NextJS</li>
                <li>MySQL PostgreSQL</li>
                <li>CentOS Ubuntu</li>
            </ul>
        </div>
        <div class="mt-4 flex justify-center items-start">
            <img alt="Picture of Nam" src="/template/frontend/img/avatar.jpg" width="546" height="546" decoding="async" data-nimg="1" class="w-60" loading="lazy" style="color:transparent"/>
        </div>
    </div>
</section>
<section class="container max-w-5xl flex flex-col justify-center my-20 space-y-4 px-4 mx-auto">
    <h2 class="text-3xl font-medium">Things I've built</h2>
    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-4">
        <div class="relative flex flex-col space-y-4 p-4 rounded overflow-hidden border dark:border-slate-600 divide-y dark:divide-slate-600">
            <div class="flex-grow">
                <div class="pb-4">
                    <h3 class="text-gray-900 dark:text-slate-200 font-semibold text-xl">
                        <img alt="Shop Online Logo" src="/template/frontend/img/shoponline-logo.png" class="LogoBuilt" />
                        <a href="https://shop.bnnguyen.ca/" target="_blank" class="hover:text-amber-600" rel="noreferrer" aria-label="Shop Online">Shop Online</a><a href="https://shop.bnnguyen.ca/" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="Shop Online">
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="OpenInNewIcon">
                                <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                            </svg>
                        </a>
                    </h3>
                </div>
                <div class="text-gray-700 dark:text-slate-300"> A website I made myself to memorize knowledge and apply Laravel to build a website selling clothes, allowing customers to order online.</div>
            </div>
            <div class="my-4 pt-4">
                <ul class="list-inside flex text-xs font-mono flex-wrap gap-3 dark:text-slate-300">
                    <li>Laravel</li>
                    <li>jQuery</li>
                    <li>AdminLTE</li>
                </ul>
            </div>
        </div>
        <div class="relative flex flex-col space-y-4 p-4 rounded overflow-hidden border dark:border-slate-600 divide-y dark:divide-slate-600">
            <div class="flex-grow">
                <div class="pb-4">
                    <h3 class="text-gray-900 dark:text-slate-200 font-semibold text-xl">
                        <img alt="Work Online Logo" src="/template/frontend/img/vtgroup-logo.png" class="LogoBuilt" />
                        <a href="https://qlda.spaceaa.com/" target="_blank" class="hover:text-amber-600" rel="noreferrer" aria-label="Work Online">Work Online</a>
                        <a href="https://qlda.spaceaa.com/" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="Work Online">
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="OpenInNewIcon">
                                <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                            </svg>
                        </a>
                    </h3>
                </div>
                <div class="text-gray-700 dark:text-slate-300">This is an internal website with features for storing data, contracts, messages, saving files, calculating salary, overtime, timekeeping, and record storage.</div>
            </div>
            <div class="my-4 pt-4">
                <ul class="list-inside flex text-xs font-mono flex-wrap gap-3 dark:text-slate-300">
                    <li>CakePHP</li>
                    <li>jQuery</li>
                    <li>NodeJS</li>
                    <li>MariaDB</li>
                </ul>
            </div>
        </div>
        <div class="relative flex flex-col space-y-4 p-4 rounded overflow-hidden border dark:border-slate-600 divide-y dark:divide-slate-600">
            <div class="flex-grow">
                <div class="pb-4">
                    <h3 class="text-gray-900 dark:text-slate-200 font-semibold text-xl">
                        <img alt="FSearch App Logo" src="/template/frontend/img/fsearch-logo.png" class="LogoBuilt" />
                        <a href="https://play.google.com/store/apps/details?id=ca.bnnguyen.fsearch" target="_blank" class="hover:text-amber-600" rel="noreferrer" aria-label="FSearch App">FSearch App</a>
                        <a href="https://play.google.com/store/apps/details?id=ca.bnnguyen.fsearch" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="FSearch App">
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="OpenInNewIcon">
                                <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                            </svg>
                        </a>
                    </h3>
                </div>
                <div class="text-gray-700 dark:text-slate-300">This app allows users to search businesses in Canada by city, province, search term, and users can view the location of a specific business on a map.</div>
            </div>
            <div class="my-4 pt-4">
                <ul class="list-inside flex text-xs font-mono flex-wrap gap-3 dark:text-slate-300">
                    <li>Kotlin</li>
                    <li>Yelp APIs</li>
                    <li>Retrofit MVVM</li>
                </ul>
            </div>
        </div>
        <div class="relative flex flex-col space-y-4 p-4 rounded overflow-hidden border dark:border-slate-600 divide-y dark:divide-slate-600">
            <div class="flex-grow">
                <div class="pb-4">
                    <h3 class="text-gray-900 dark:text-slate-200 font-semibold text-xl">
                        <a href="https://github.com/bnnguyen8/INFO6134-Capstone-Project-Group-A" target="_blank" class="hover:text-amber-600" rel="noreferrer" aria-label="FSearch App">Fanshawe Notes</a>
                        <a href="https://github.com/bnnguyen8/INFO6134-Capstone-Project-Group-A" target="_blank" class="hover:text-amber-600 transition ease-in-out duration-300 text-2xl" rel="noreferrer" aria-label="FSearch App">
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="OpenInNewIcon">
                                <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                            </svg>
                        </a>
                    </h3>
                </div>
                <div class="text-gray-700 dark:text-slate-300">A React Native application that allows users to effortlessly create and edit notes, search by text, sort by date, customize backgrounds, create folders, and set reminders.</div>
            </div>
            <div class="my-4 pt-4">
                <ul class="list-inside flex text-xs font-mono flex-wrap gap-3 dark:text-slate-300">
                    <li>React Native</li>
                    <li>Redux</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
