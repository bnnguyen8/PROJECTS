@extends('frontend.layout')

@section('content')
<section class="container max-w-3xl flex flex-col justify-center my-5 sm:my-10 px-4 mx-auto gap-8">
    <div class="flex items-center">
        <h1 class="text-3xl sm:text-5xl font-semibold flex-grow dark:text-slate-200">Resume</h1>
        <div><a href="/docs/NamNguyen-Resume.pdf" target="_blank"
                class="bg-amber-700 hover:bg-amber-800 transition ease-in-out duration-300 rounded py-2 px-4 font-bold text-white inline-flex items-center gap-2"
                rel="noreferrer" aria-label="View Resume PDF">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="OpenInNewIcon">
                                <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                            </svg>PDF Version</a>
            </div>
    </div>
    <div class="flex flex-col gap-4 rounded overflow-hidden">
        <h2 class="font-medium text-2xl text-amber-600">Education</h2>
        <div class="divide-y dark:divide-slate-600">
            <div class="grid grid-cols-3 py-4 gap-4">
                <div class="col-span-3 sm:col-span-1 justify-self-start"><span
                        class="inline-block dark:text-emerald-400 font-mono text-sm font-medium">Sep 2022 - Dec
                        2023 (Expected)</span></div>
                <div class="col-span-3 sm:col-span-2 flex flex-col">
                    <div class="font-bold dark:text-slate-200">Post-graduate in Mobile Application Development</div>
                    <div class="mb-2 dark:text-slate-300">Fanshawe College, London, ON, Canada</div>
                    <ul class="list-inside list-disc mb-4 dark:text-slate-300">
                        <li>Acquiring a diverse range of abilities for the creation, evaluation, and launch of mobile apps for both iOS and Android devices.</li>
                        <li>User interface and user experience UI/UX</li>
                        <li>GPA: 4.13/4.2</li>
                    </ul>
                    <ul class="list-inside flex text-xs font-mono flex-wrap gap-3">
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">iOS Swift SwiftUI MVVM</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">Java Kotlin MVVM</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">React Native</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">Web Design UI/UX</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">Progressive Web App</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">Firebase Firestore</li>
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-3 py-4 gap-4">
                <div class="col-span-3 sm:col-span-1 justify-self-start"><span
                        class="inline-block dark:text-emerald-400 font-mono text-sm font-medium">Sep 2004 – May 2009</span></div>
                <div class="col-span-3 sm:col-span-2 flex flex-col">
                    <div class="font-bold dark:text-slate-200">Bachelor's degree, Mathematics & Computer Sciences</div>
                    <div class="mb-2 dark:text-slate-300">VNUHCM - University of Science, Ho Chi Minh, Vietnam</div>
                    <ul class="list-inside list-disc mb-4 dark:text-slate-300">
                        <li>Mastery of algorithms and theories in mathematics such as advanced math, advanced statistical probability, advanced mechanics, algorithms</li>
                    </ul>
                    <ul class="list-inside flex text-xs font-mono flex-wrap gap-3">
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">Advanced Mathematics</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">C++</li>
                        <li class="bg-slate-200 dark:bg-slate-500 px-2 rounded">SQL</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-4 rounded overflow-hidden mb-16">
        <h2 class="font-medium text-2xl text-amber-600">Experience</h2>
        <div class="divide-y dark:divide-slate-600">
            <div class="grid grid-cols-3 py-4 gap-4">
                <div class="col-span-3 sm:col-span-1 justify-self-start"><span
                        class="inline-block dark:text-emerald-400 font-mono text-sm font-medium">Aug 2016 - Aug 2022</span></div>
                <div class="col-span-3 sm:col-span-2 flex flex-col">
                    <div class="font-bold dark:text-slate-200">Senior Web Engineer</div>
                    <div class="mb-2 dark:text-slate-300"><a href="https://www.facebook.com/VTCode/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">VTCode</a></div>
                    <ul class="list-inside list-disc dark:text-slate-300">
                        <li>Design and build an internal website with features for storing data, contracts, messages, saving files, calculating salary, overtime, timekeeping, and record storage.</li>
                        <li>CentOS · MySQL · CakePHP · jQuery · Git · HTML · CSS · jQuery</li>
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-3 py-4 gap-4">
                <div class="col-span-3 sm:col-span-1 justify-self-start"><span
                        class="inline-block dark:text-emerald-400 font-mono text-sm font-medium">Dec 2014 - Aug 2016</span></div>
                <div class="col-span-3 sm:col-span-2 flex flex-col">
                    <div class="font-bold dark:text-slate-200">Senior Web Engineer</div>
                    <div class="mb-2 dark:text-slate-300"><a href="https://www.linkedin.com/company/evolable-asia/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">Evolable Asia CO., LTD.</a></div>
                    <ul class="list-inside list-disc dark:text-slate-300">
                        <li>Maintain and build various websites related to tourism in Japan.</li>
                        <li>jQuery UI · GitFlow · CakePHP · LAMP (Ubuntu, Apache, MySQL, PHP) · WordPress</li>
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-3 py-4 gap-4">
                <div class="col-span-3 sm:col-span-1 justify-self-start"><span
                        class="inline-block dark:text-emerald-400 font-mono text-sm font-medium">Nov 2013 - Dec 2014</span></div>
                <div class="col-span-3 sm:col-span-2 flex flex-col">
                    <div class="font-bold dark:text-slate-200">Web Development Team Lead</div>
                    <div class="mb-2 dark:text-slate-300"><a href="https://www.linkedin.com/company/anvy-digital/" target="_blank" rel="noreferrer" class="text-amber-600 rounded hover:text-amber-700 transition ease-in-out duration-300 font-medium">Anvy Digital</a></div>
                    <ul class="list-inside list-disc dark:text-slate-300">
                        <li>Build a website named worktrack to help the company manage printing-related orders.</li>
                        <li>Ubuntu · MySQL · MongoDB · CakePHP · Laravel · jQuery · HTML · CSS · jQuery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection