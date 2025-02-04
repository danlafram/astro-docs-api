 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>AstroDocs - EULA</title>
     <link rel="icon" href="{{ asset('img/Astro-logo.png') }}">

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Styles / Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])

 </head>
 @include('includes.analytics')

 <body class="font-sans antialiased flex flex-col">
     <div class="bg-white">
         <!-- Header -->
         <header class="text-black border-b border-black mb-10">
             <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                 <div class="flex lg:flex-1">
                     <a href="/" class="-m-1.5 p-1.5">
                         <span class="sr-only">AstroDocs</span>
                         <img class="h-20 w-20" src="{{ asset('img/Astro-logo.png') }}" alt="">
                     </a>
                 </div>
                 <div class="flex lg:hidden">
                     <button type="button"
                         class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                         <span class="sr-only">Open main menu</span>
                         <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             aria-hidden="true" data-slot="icon">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                 d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                         </svg>
                     </button>
                 </div>
                 <div class="hidden lg:flex lg:gap-x-12">
                     {{-- <a href="product" class="text-sm/6 font-semibold text-white">Product</a> --}}
                     <a href="/#product" class="text-sm/6 font-semibold text-black">Features</a>
                     {{-- <a href="#" class="text-sm/6 font-semibold text-white">Marketplace</a> TODO: Send this URL to atlassian marketplace --}}
                     <a href="/#contact" class="text-sm/6 font-semibold text-black">Contact</a>
                     <a href="/#faq" class="text-sm/6 font-semibold text-black">FAQ</a>
                     <a href="/install" class="text-sm/6 font-semibold text-white">Install</a>
                 </div>
                 <div class="hidden lg:flex lg:flex-1 lg:justify-end">

                 </div>
             </nav>
             <!-- Mobile menu, show/hide based on menu open state. -->
             <div class="lg:hidden hidden" role="dialog" aria-modal="true">
                 <!-- Background backdrop, show/hide based on slide-over state. -->
                 <div class="fixed inset-0 z-50"></div>
                 <div
                     class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10">
                     <div class="flex items-center justify-between">
                         <a href="#" class="-m-1.5 p-1.5">
                             <span class="sr-only">Your Company</span>
                             <img class="h-8 w-auto"
                                 src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                                 alt="">
                         </a>
                         <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400">
                             <span class="sr-only">Close menu</span>
                             <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true" data-slot="icon">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                             </svg>
                         </button>
                     </div>
                     <div class="mt-6 flow-root">
                         <div class="-my-6 divide-y divide-gray-500/25">
                             <div class="space-y-2 py-6">
                                 <a href="#"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Product</a>
                                 <a href="#"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Features</a>
                                 <a href="#"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Marketplace</a>
                                 <a href="#"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Company</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </header>
     </div>
     <div class='mx-20 pb-20'>
         <h1>End User License Agreement of Astro-docs</h1>
         <p>This End User License Agreement governs the use of our application in a legally binding way. You must
             read this document carefully.</p>
         <p>Our application is provided by:</p>
         <p>Astro Docs - A division of spoke.dev</p>
         <p><strong>Contact email:</strong> dan@spoke.dev</p>
         <p>This document was generated with the use of the <a
                 href="https://www.iubenda.com/en/help/22363-what-is-an-eula">End User License Agreement (EULA)
                 template</a>.</p>
         <h2>What you should know at a glance</h2>
         <p>Please note that some provisions may only apply to certain categories of users. In particular, certain
             provisions may only apply to consumers or to those users that do not qualify as consumers. Such
             limitations are always explicitly mentioned within each affected clause. In the absence of any such
             mention, clauses apply to all users.</p>
         <h2>TERMS OF USE</h2>
         <p>Unless stated otherwise, the terms in this section apply generally when using our application.</p>
         <p>Specific or additional conditions may apply in certain situations and are noted in this document.</p>
         <p>By using our application, you confirm the following:</p>
         <ul>
             <li>you are older than 18;</li>
             <li>you are not in a country under a U.S. government embargo or designated as a "terrorist-supporting"
                 country;</li>
             <li>you are not on any U.S. government list of prohibited or restricted parties.</li>
         </ul>
         <h3>Account registration</h3>
         <p>To use our application, you can register or create an account by providing complete and truthful
             information. You can also use our application without an account, but this might limit some features.
         </p>
         <p>You are responsible for keeping your login details confidential and must choose passwords that meet the
             highest standards of strength as allowed by our application.</p>
         <p>By registering, you agree to take full responsibility for all activities under your username and
             password. You must immediately inform us using the contact details in this document if you believe your
             personal information, account, or login details have been violated, disclosed, or stolen.</p>
         <h4>Conditions for account registration</h4>
         <p>Registration of accounts on our application is subject to the conditions outlined below. By registering,
             you agree to meet such conditions.</p>
         <ul>
             <li>It is not permitted to register accounts by bots or any other automated methods;</li>
             <li>You must register only one account, unless otherwise specified;</li>
             <li>Your account must not be shared with other persons unless otherwise specified.</li>
         </ul>
         <h4>Account termination</h4>
         <p>You can close your account and stop using our service anytime by contacting us at the contact details
             provided in this document.</p>
         <h4>Account suspension and deletion</h4>
         <p>We reserve the right to suspend or delete your account at any time and without notice if we find it
             inappropriate, offensive, or in violation of these terms.</p>
         <p>Suspending or deleting accounts does not entitle you to claim for any compensation, damages, or
             reimbursement.</p>
         <p>The suspension or deletion of accounts due to causes attributable to you does not exempt you from paying
             any applicable fees or prices.</p>
         <h3>Content on this application</h3>
         <p>Unless otherwise noted, all content on our application is owned or provided by us or our licensors.</p>
         <p>We do our best to ensure the content on our application complies with all laws and respects third-party
             rights. However, this may not always be achievable. If you believe your rights are being infringed,
             without prejudice to any legal prerogatives to enforce your rights, please report any issues using the
             contact details provided in this document.</p>
         <h4>Removal of content from parts of this application available through the App Store</h4>
         <p>If the reported content is deemed objectionable, it will be removed and those who provided the content
             will be prevented from using our application.</p>
         <h3>Access to external resources</h3>
         <p>Through our application, you may access external resources provided by third parties. You acknowledge
             and accept that we have no control over these resources and are not responsible for their content or
             availability.</p>
         <p>Conditions for third-party resources, including any rights granted in their content, are governed by
             those third parties' terms and conditions or by applicable law.</p>
         <h3>Acceptable use</h3>
         <p>Our application may only be used within the scope of what is provided for, under this document and
             applicable law.</p>
         <p>You are solely responsible for ensuring your use of our application does not violate any laws,
             regulations, or third-party rights.</p>
         <p>We reserve the right to protect our interests by denying you access to our application, terminating
             contracts, and reporting any misconduct to the appropriate authorities if you are involved in or
             suspected of the following:</p>
         <ul>
             <li>violating laws, regulations, or these terms;</li>
             <li>infringing on third-party rights;</li>
             <li>significantly impairing our legitimate interests;</li>
             <li>offending us or any third party.</li>
         </ul>
         <h3>Software license</h3>
         <p>Any intellectual or industrial property rights, as well as other exclusive rights on software or
             technical features related to our application, are owned by us and/or our licensors.</p>
         <p>Provided you comply with these terms, we grant you a revocable, non-exclusive, non-sublicensable, and
             non-transferable license to use the software and other technical features on our application for its
             intended purposes.</p>
         <p>This license does not give you any rights to access, use, or share the original source code. All
             techniques, algorithms, and procedures in the software and related documentation are the sole property
             of us or our licensors.</p>
         <p>All rights and licenses granted to you will immediately end if the agreement is terminated or expires.
         </p>
         <p>Despite the above, under this license, you can download, install, use, and run the software on one cloud
             instance of Atlassian, as long as your devices are common and up-to-date with current technology and
             market standards.</p>
         <p>We reserve the right to release updates and improvements to our application and its related software.
             You may need to download and install these updates to keep using them.</p>
         <p>However, in order to get access to completely new versions or releases of the software you may need to
             purchase a separate license.</p>
         <p>Notwithstanding the foregoing, you undertake to immediately delete any copies of the software upon the
             expiry of the license.</p>
         <p>The software licensed will be valid and functional for 2 years since it has been made available to you,
             and in any case for the entire duration of the subscription, subject to the conditions of the agreement
             including, without limitation, any required updates. It is understood that the possible occurrence of
             errors and occasional technical faults is inherent to the nature of software. To the extent required
             under applicable law and/or the agreement, we commit to resolving possible defects and/or faults
             impairing the software’s functionality during the validity period, unless these result from any
             improper or irregular use of the software, including (without limitation) your failure to implement any
             required updates.</p>
         <h3>Purchase via app store</h3>
         <p>Our application or specific products available for sale may be purchased via a third-party app store. To
             access such purchases, you must follow the instructions provided on the relevant online store (such as
             "Apple App Store" or "Google Play"), which may vary depending on the particular device in use.</p>
         <p>Unless otherwise specified, purchases done via third-party online stores are also subject to third
             parties’ terms and conditions, which will always prevail upon these terms in case of conflict. You must
             read such third-party’ terms and conditions of sale carefully and accept them.</p>
         <h3>Contract duration</h3>
         <h4>Subscriptions</h4>
         <p>Subscriptions allow you to receive the product regularly over time.</p>
         <p>The above will prevail upon any conflicting or diverging provision of this document.</p>
         <h4>Termination</h4>
         <p>Subscriptions may be terminated by sending us a clear and unambiguous termination notice using the
             contact details provided in this document.</p>
         <h2>LIABILITY AND INDEMNIFICATION</h2>
         <p>We limit our liability as much as legally allowed when executing agreements with you. This means our
             responsibility for damages is reduced to the maximum extent permitted by law unless explicitly stated
             otherwise or agreed upon with you.</p>
         <h4>Indemnification</h4>
         <p>You agree to indemnify us and our affiliates, officers, directors, and employees from any claims or
             demands made by third parties due to or in connection with any culpable violation of these terms or
             third-party rights related to your use of the service to the extent allowed by law.</p>
         <h4>Limitation of liability</h4>
         <p>Unless explicitly stated otherwise and subject to applicable law, you cannot claim damages against us
             (or any individual or entity acting on our behalf).</p>
         <p>However, this exclusion does not apply to damages affecting life, health, or physical integrity, damages
             arising from the breach of significant contractual obligations (such as those necessary to fulfill the
             contract's purpose), and/or damages resulting from intentional or gross negligence, provided that our
             application has been used appropriately and correctly by you.</p>
         <p>Unless damages stem from intentional or gross negligence, or they impact life, health, or physical
             integrity, our liability is limited to typical and foreseeable damages at the time the contract was
             entered into.</p>
         <h3>US users</h3>
         <h4>Disclaimer of warranties</h4>
         <p>Our application is provided on an “as is” and “as available” basis. When you use our application, you
             are doing so at your own risk. We explicitly state that we are not making any promises or guarantees,
             whether they are express, implied, or even required by law. These include assurances about the quality
             of the service, its suitability for your specific needs, or whether it infringes on anyone else's
             rights. Please keep in mind that any advice or information you receive from us or through our service
             does not create any warranties beyond what we have explicitly stated here.</p>
         <p>Additionally, while we strive to provide accurate and reliable content, we cannot guarantee that it is
             always going to be the case. We do not guarantee that the service will always meet your requirements or
             be available when you need it. There might be interruptions, or it might not function correctly due to
             factors beyond our control. While we do our best to keep everything running smoothly, we cannot ensure
             that the service will be free of harmful elements like viruses. If you choose to download any content
             from our service, you are assuming the risk, and we are not responsible for any damage it might cause
             to your devices or data.</p>
         <p>We do not endorse or guarantee any products or services advertised through our service or any links we
             provide. We are not involved in any transactions between you and third-party providers, so any
             interactions or agreements you make with them are solely your responsibility.</p>
         <p>Our service might not always be accessible or may not work correctly with your web browser, mobile
             device, or operating system. While we strive to provide a seamless experience, we cannot guarantee it
             in every situation. As such, we want to clarify that we cannot be held responsible for any perceived or
             actual damages that result from issues related to the content, operation, or use of our service.</p>
         <p>While we may have certain exclusions and limitations in our agreement, these may not apply to you
             depending on the laws of your jurisdiction. Federal law, as well as laws in some states and other
             jurisdictions, may offer protections that supersede our disclaimers and exclusions. This means that you
             may have specific legal rights that are not affected by our agreement. It is essential to understand
             your rights, as they may vary from state to state or country to country. We want to emphasize that any
             disclaimers or exclusions in our agreement will only be enforced to the extent permitted by applicable
             law.</p>
         <h4>Limitation of liability</h4>
         <p>To the maximum extent permitted by applicable law, in no event shall we, along with our subsidiaries,
             affiliates, officers, directors, agents, partners, suppliers, or employees, be liable for:</p>
         <ul>
             <li>any indirect, punitive, incidental, special, consequential, or exemplary damages arising from or
                 related to your use of, or inability to use, the service. This includes damages for loss of
                 profits, goodwill, use, data, or other intangible losses;</li>
             <li>any damage, loss, or injury resulting from hacking, tampering, or unauthorized access to your
                 account or the information within it;</li>
             <li>errors, mistakes, or inaccuracies in the content provided;</li>
             <li>personal injury or property damage resulting from your use of the service;</li>
             <li>unauthorized access to our secure servers or personal information stored therein;</li>
             <li>interruption or cessation of transmission to or from the service;</li>
             <li>bugs, viruses, trojan horses, or similar harmful elements transmitted through the service;</li>
             <li>errors or omissions in any content posted, transmitted, or made available through the service;</li>
             <li>defamatory, offensive, or illegal conduct of any user or third party. Our liability is limited to
                 the amount you have paid us in the preceding 12 months, or the duration of your agreement with us,
                 whichever is shorter.</li>
         </ul>
         <p>This limitation of liability section will apply to the fullest extent permitted by law in the applicable
             jurisdiction whether the alleged liability is based on contract, tort, negligence, strict liability, or
             any other basis, even if you have been advised of the possibility of such damage.</p>
         <p>Please note that in some jurisdictions, the exclusion or limitation of incidental or consequential
             damages may not be allowed. This means that these limitations or exclusions might not apply to you. You
             have specific legal rights, which may vary depending on your jurisdiction. The disclaimers, exclusions,
             and limitations of liability outlined here may not apply to the extent prohibited by applicable law.
         </p>
         <h4>Indemnification</h4>
         <p>By using and accessing the service, you agree to defend, indemnify, and hold us, our subsidiaries,
             affiliates, officers, directors, agents, co-branders, partners, suppliers, and employees harmless from
             any claims, damages, losses, liabilities, costs, or expenses, including legal fees, arising from:</p>
         <ul>
             <li>your use of the service, including any data or content you transmit or receive;</li>
             <li>your violation of these terms, including any breach of representations and warranties;</li>
             <li>your violation of third-party rights, such as privacy or intellectual property rights;</li>
             <li>your violation of statutory laws, rules, or regulations;</li>
             <li>any content submitted from your account, including third-party access using username, password, or
                 other security measures, including misleading, false, or inaccurate information;</li>
             <li>your intentional misconduct; or</li>
             <li>any statutory provision by you or your affiliates, officers, directors, agents, co-branders,
                 partners, suppliers, and employees to the extent permitted by law.</li>
         </ul>
         <h2>INFORMATION ABOUT THIS DOCUMENT</h2>
         <p>This document was generated with the use of the <a
                 href="https://www.iubenda.com/en/help/22363-what-is-an-eula">End User License Agreement (EULA)
                 template</a>.</p>
         <h2>COMMON PROVISIONS</h2>
         <h3>No waiver</h3>
         <p>Our failure to assert any right or provision under these terms does not waive that right or provision.
             No waiver will constitute a continuing waiver of such term or any other term.</p>
         <h3>Service interruption</h3>
         <p>To maintain the best service level, we reserve the right to interrupt the service for maintenance,
             updates, or other changes, with appropriate notification.</p>
         <p>We may suspend or discontinue the service within legal limits. If discontinued, we will assist you in
             withdrawing personal data and respect your rights regarding continued product use and compensation
             under applicable law.</p>
         <p>The service may be unavailable due to events beyond our reasonable control, such as infrastructure
             breakdowns or blackouts.</p>
         <h3>Service reselling</h3>
         <p>You may not reproduce, duplicate, copy, sell, or exploit any part of our application without our express
             written permission, granted either directly or through a legitimate reselling programme.</p>
         <h3>Privacy policy</h3>
         <p>For information on the use of personal data, you can refer to our application's privacy policy.</p>
         <h3>Intellectual property rights</h3>
         <p>Without prejudice to any more specific provisions in these terms, all intellectual property rights
             associated with our application, including copyrights, trademark rights, patent rights, and design
             rights, are exclusively owned by us or our licensors. These rights are protected by applicable laws and
             international treaties concerning intellectual property.</p>
         <p>All trademarks, whether nominal or figurative, and any other marks, trade names, service marks, word
             marks, illustrations, images, or logos associated with our application, are and remain the exclusive
             property of us or our licensors. These are also protected by applicable laws and international treaties
             related to intellectual property.</p>
         <h3>Changes to the terms</h3>
         <p>We reserve the right to modify these terms at any time, informing you of any changes.</p>
         <p>Such changes will only affect the relationship with you from the date communicated onwards.</p>
         <p>Your continued use of the service will signify your acceptance of the revised terms. If you do not wish
             to be bound by the changes, you must stop using the service and terminate the agreement.</p>
         <p>The applicable previous version will govern the relationship prior to your acceptance. You can obtain
             any previous version from us.</p>
         <p>If legally required, we will notify you in advance of when the modified terms will take effect.</p>
         <h3>Assignment of contract</h3>
         <p>We reserve the right to transfer, assign, dispose of by novation, or subcontract any or all rights or
             obligations under these terms, considering your legitimate interests. Provisions about changes to these
             terms will apply accordingly.</p>
         <p>You cannot assign or transfer your rights or obligations under these terms without our written
             permission.</p>
         <h3>Contact</h3>
         <p>All communications regarding the use of our application must be sent using the contact information
             provided in this document.</p>
         <h3>Severability</h3>
         <p>Invalidity or unenforceability of any provision under applicable law will not affect the validity of
             other provisions, which will remain in full force and effect.</p>
         <h4>US users</h4>
         <p>Any invalid or unenforceable provision will be interpreted to the extent reasonably required to render
             it valid, enforceable, and consistent with its original intent. This document constitutes the entire
             agreement between you and us and supersede all other communications, including but not limited to prior
             agreements concerning such subject matter, to the fullest extent permitted by law.</p>
         <h4>EU users</h4>
         <p>If any provision of this document is void, invalid, or unenforceable, we both agree to do our best to
             find, in an amicable way, an agreement on valid and enforceable provisions. In case of failure to do
             so, the void, invalid, or unenforceable provisions will be replaced by the applicable statutory
             provisions.</p>
         <p>Regardless of the above, the nullity, invalidity, or impossibility of enforcing a particular provision
             of this document will not nullify the entire agreement, unless the severed provisions are essential for
             it, or of such importance that we both would not have entered into the contract if we had known that
             the provision would not be valid, or in cases where the remaining provisions would translate into an
             unacceptable hardship for you or us.</p>
         <h3>Governing law</h3>
         <p>These terms are governed by the law of the place where we are based, as outlined in the relevant section
             of this document, without regard to conflict of laws principles.</p>
         <h4>Prevalence of national law</h4>
         <p>However, regardless of the above, if the law of the country that you are based on provides for higher
             applicable consumer protection standards, such higher standards will prevail.</p>
         <h3>Venue of jurisdiction</h3>
         <p>The jurisdiction over any controversy related to these terms lies with the courts of the place where we
             are based, as outlined in the relevant section of this document.</p>
         <h4>Exception for consumers in Europe</h4>
         <p>However, regardless of the above, this does not apply if you qualify as a European consumer or if you
             are a consumer based in the United Kingdom, Switzerland, Norway, or Iceland.</p>
         <h4>UK consumers</h4>
         <p>If you are a consumer based in England and Wales, you may bring legal proceedings related to these terms
             in the English and Welsh courts. If you are a consumer based in Scotland, you may bring legal
             proceedings in either the Scottish or the English courts. If you are a consumer based in Northern
             Ireland, you may bring legal proceedings in either the Northern Irish or the English courts.</p>
         <h4>US users</h4>
         <p>We both agree to waive any right to trial by jury in any court in connection with any action or
             litigation. Any claims under these terms shall proceed individually and we both agree not to join in a
             class action or other proceeding with or on behalf of others.</p>
         <h3>US users</h3>
         <h4>Surviving provisions</h4>
         <p>Our agreement will continue in effect until it is terminated by either our application or you. Upon
             termination, the provisions contained in this document that by their context are intended to survive
             termination or expiration will survive, including but not limited to the following:</p>
         <ul>
             <li>your grant of licenses under this document will survive indefinitely;</li>
             <li>your indemnification obligations will survive for a period of five years from the date of
                 termination;</li>
             <li>the disclaimer of warranties and representations, and the stipulations under the section containing
                 indemnity and limitation of liability provisions, will survive indefinitely.</li>
         </ul>
     </div>
 </body>

 </html>
