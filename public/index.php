<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NACOM Computer Consults</title>

    <!-- External Resources -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Internal CSS  -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- Axios Connection  -->
    <!-- <script src="./js/axios.min.js "></script> -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Section -->
                <a href="#home" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-computer text-white text-lg"></i>
                    </div>
                    <span class="text-lg sm:text-xl font-bold text-gray-900">NACOM Computer Consults</span>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="#book_services"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Services</a>
                    <a href="#contact"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Contact</a>
                    <a href="../views/auth/login.php"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">Admin
                        Login</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 p-2">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-2 space-y-1">
                <a href="#home" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Home</a>
                <a href="#book_services"
                    class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Services</a>
                <a href="#contact" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Contact</a>
                <a href="../views/auth/login.php"
                    class="block mx-3 mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium text-center">Admin
                    Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative bg-gradient-to-br from-blue-50 to-white min-h-screen flex items-center"
        style="background-image: url('./assets/hero_bg.jpg'); background-size: cover; background-position: center right; background-repeat: no-repeat;">
        <div class="absolute inset-0 bg-white/80"></div>
        <div class="pt-50 md:pt-0 relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="space-y-6">
                        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
                            Professional ICT
                            <span class="text-blue-600 block">Consultancy Services</span>
                        </h1>
                        <p class="text-xl text-gray-600 leading-relaxed max-w-lg">
                            Empowering businesses with cutting-edge technology solutions. From IT support to system
                            integration, we deliver excellence in every project.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#book_services"
                            class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 font-semibold text-center whitespace-nowrap transition-colors">
                            Book a Service
                        </a>
                        <a href="#contact"
                            class="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-lg hover:bg-blue-50 font-semibold text-center whitespace-nowrap transition-colors">
                            Get in Touch
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-8 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">150+</div>
                            <div class="text-gray-600 text-sm">Happy Clients</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">5+</div>
                            <div class="text-gray-600 text-sm">Years Experience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">24/7</div>
                            <div class="text-gray-600 text-sm">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="book_services" class="section-padding bg-white py-20">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center mb-6">Our Professional Services</h1>
            <p class="text-lg text-center text-gray-600 mb-8">
                Comprehensive ICT solutions designed to empower your business with cutting-edge technology and
                expert support.
            </p>

            <!-- Service Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1: IT Support & Troubleshooting -->
                <div class="bg-white rounded-lg shadow-md p-6 border">
                    <div class="flex items-center justify-start space-x-4 mb-4">
                        <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-circle text-blue-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold">IT Support & Troubleshooting</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        24/7 technical support and troubleshooting services to resolve hardware and software issues
                        quickly and efficiently.
                    </p>
                    <div class="text-blue-600 font-medium">Starting at $50/hour</div>
                </div>

                <!-- Card 2: Network Setup & Configuration -->
                <div class="bg-white rounded-lg shadow-md p-6 border">
                    <div class="flex items-center justify-start space-x-4 mb-4">
                        <div class="w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-circle text-yellow-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold">Network Setup & Configuration</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Professional network installation, configuration, and security setup for businesses of all
                        sizes.
                    </p>
                    <div class="text-blue-600 font-medium">Starting at ₵200/hour</div>
                </div>

                <!-- Card 3: Custom Software Development -->
                <div class="bg-white rounded-lg shadow-md p-6 border">
                    <div class="flex items-center justify-start space-x-4 mb-4">
                        <div class="w-6 h-6 bg-green-200 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-code text-green-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold">Custom Software Development</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Bespoke software solutions tailored to your business needs, from web applications to desktop
                        software.
                    </p>
                    <div class="text-blue-600 font-medium">Starting at ₵100/hour</div>
                </div>

                <!-- Card 4: Data Recovery Services -->
                <div class="bg-white rounded-lg shadow-md p-6 border">
                    <div class="flex items-center justify-start space-x-4 mb-4">
                        <div class="w-6 h-6 bg-purple-200 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-box-open text-purple-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold">Data Recovery Services</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Professional data backup and recovery services to protect your valuable business
                        information.
                    </p>
                    <div class="text-blue-600 font-medium">Starting at ₵150/hour</div>
                </div>

                <!-- Card 5: System Maintenance -->
                <div class="bg-white rounded-lg shadow-md p-6 border">
                    <div class="flex items-center justify-start space-x-4 mb-4">
                        <div class="w-6 h-6 bg-red-200 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-heart-pulse text-red-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold">System Maintenance</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Regular system maintenance and optimization to ensure peak performance and security.
                    </p>
                    <div class="text-blue-600 font-medium">Starting at ₵75/hour</div>
                </div>

                <!-- Card 6: IT Consultation -->
                <div class="bg-white rounded-lg shadow-md p-6 border">
                    <div class="flex items-center justify-start space-x-4 mb-4">
                        <div class="w-6 h-6 bg-indigo-200 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-magnifying-glass text-indigo-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold">IT Consultation</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Strategic IT consulting to help you make informed technology decisions for your business
                        growth.
                    </p>
                    <div class="text-blue-600 font-medium">Starting at ₵125/hour</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="services" class="section-padding bg-gray-50 py-20">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl p-12 mx-auto">
            <h2 class="text-4xl font-extrabold text-center mb-4">Book Our Services</h2>
            <p class="text-center text-lg text-gray-700 mb-10">
                Schedule a consultation or book our professional ICT services. We're here to help transform your
                business with technology.
            </p>
            <form id="book_our_service_form" class="grid md:grid-cols-2 gap-8 text-lg">
                <!-- Success Message (Initially Hidden) -->
                <div id="booking_success_message_div"
                    class="hidden flex items-center gap-2 bg-green-100 text-green-800 border border-green-300 p-4 rounded-md col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current shrink-0" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="booking_success_message_text"></span>
                </div>
                <!-- Error Message (Initially Hidden) -->
                <div id="booking_error_message_div"
                    class="hidden flex items-center gap-2 bg-red-100 text-red-800 border border-red-300 p-4 rounded-md col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current shrink-0" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="booking_error_message_text"></span>
                </div>

                <!-- Form Fields -->
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">Full Name *</label>
                    <input id="bks_coustomer_name" type="text" placeholder="Enter your full name"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">Email Address *</label>
                    <input type="email" id="bks_coustomer_email" placeholder="your.email@example.com"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">Phone Number *</label>
                    <input type="tel" id="bks_coustomer_phone_number" placeholder="+233 546 973 655"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">Service Type *</label>
                    <select id="bks_coustomer_service_name"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Service Type</option>
                        <option value="IT Support & Troubleshooting">IT Support & Troubleshooting</option>
                        <option value="Network Setup & Configuration">Network Setup & Configuration</option>
                        <option value="Custom Software Development">Custom Software Development</option>
                        <option value="Data Recovery Services">Data Recovery Services</option>
                        <option value="System Maintenance">System Maintenance</option>
                        <option value="IT Consultation">IT Consultation</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold text-gray-800 mb-2">Preferred Date *</label>
                    <input type="date" id="bks_coustomer_date"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="md:col-span-2">
                    <button type="button" id="book_our_service_btn"
                        class="w-full bg-blue-600 text-white p-5 text-xl font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        Book Service
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- General Enquiries Section -->
    <section class="section-padding bg-white py-20">
        <div class="bg-gray-50 rounded-2xl shadow-xl w-full max-w-5xl p-12 mx-auto">
            <h2 class="text-4xl font-extrabold text-center mb-4">General Enquiries</h2>
            <p class="text-center text-lg text-gray-700 mb-10">
                Have questions about our services? Send us a message and we'll get back to you as soon as
                possible.
            </p>
            <form id="enquiries_form" class="grid md:grid-cols-2 gap-8 text-lg">
                <!-- Success Message (Initially Hidden) -->
                <div id="enquiries_success_message_div"
                    class="hidden flex items-center gap-2 bg-green-100 text-green-800 border border-green-300 p-4 rounded-md col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current shrink-0" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="enquiry_success_message_text"></span>
                </div>
                <!-- Error Message (Initially Hidden) -->
                <div id="enquiries_error_message_div"
                    class="hidden flex items-center gap-2 bg-red-100 text-red-800 border border-red-300 p-4 rounded-md col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current shrink-0" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="enquiry_error_message_text"></span>
                </div>

                <!-- Form Fields -->
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">Full Name *</label>
                    <input type="text" placeholder="Enter your full name" id="enquiries_full_name"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">Email Address *</label>
                    <input type="email" placeholder="your.email@example.com" id="enquiries_email"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold text-gray-800 mb-2">Subject *</label>
                    <input type="text" placeholder="What's this about?" id="enquiries_subject"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold text-gray-800 mb-2">Message *</label>
                    <textarea placeholder="Tell us more about your enquiry..." maxlength="500" id="enquiries_message"
                        class="w-full border border-gray-300 p-4 text-lg rounded-lg h-32 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <div class="text-sm text-gray-500 mt-1 text-right">0/500</div>
                </div>
                <div class="md:col-span-2">
                    <button type="button" id="enquiries_send_message_btn"
                        class="w-full bg-blue-600 text-white p-5 text-xl font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Contact Us</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Get in touch with our team. We're here to help with all your ICT consultancy needs.
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="space-y-8">
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Our Office</h3>
                                <p class="text-gray-600">
                                    2nd Fonpon Link<br />
                                    Dansoman Bechem, Accra<br />
                                    Ghana
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-phone text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                                <p class="text-gray-600">
                                    +233 552 886 141<br />
                                    +233 546 976 655
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-envelope text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">
                                    info@nacomconsults.com<br />
                                    support@nacomconsults.com
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Business Hours</h3>
                                <p class="text-gray-600">
                                    Monday - Friday: 8:00 AM - 6:00 PM<br />
                                    Saturday: 9:00 AM - 2:00 PM<br />
                                    Sunday: Closed<br />
                                    <span class="text-blue-600 font-medium">24/7 Emergency Support Available</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="font-semibold text-gray-900 mb-2">Quick Response Guarantee</h3>
                        <p class="text-gray-600">
                            We respond to all enquiries within 2 hours during business hours and within 24 hours
                            on weekends.
                        </p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="h-full min-h-[400px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4886.317636567357!2d-0.2600174!3d5.5518076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf9778310ced27%3A0xd3cda84de335d0aa!2s2nd%20Fonpon%20Link%2C%20Accra!5e1!3m2!1sen!2sgh!4v1752338535115!5m2!1sen!2sgh"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-computer text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold">NACOM Computer Consults</span>
                    </div>
                    <p class="text-gray-600 mb-4 max-w-md">
                        Professional ICT consultancy services helping businesses leverage technology for growth
                        and efficiency.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=100007814479139&mibextid=ZbWKwL"
                            class="w-8 h-8 flex items-center justify-center">
                            <i class="fab fa-facebook-f text-blue-600 text-xl hover:text-blue-700 cursor-pointer"></i>
                        </a>
                        <a href="https://x.com/snopijeriel?t=dihwG1yYV305ehwG6CIpzg&s=09"
                            class="w-8 h-8 flex items-center justify-center">
                            <i class="fab fa-twitter text-blue-400 text-xl hover:text-blue-500 cursor-pointer"></i>
                        </a>
                        <a href="https://www.linkedin.com/feed/" class="w-8 h-8 flex items-center justify-center">
                            <i class="fab fa-linkedin-in text-blue-700 text-xl hover:text-blue-800 cursor-pointer"></i>
                        </a>
                    </div>
                </div>
                <!-- Services -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Services</h3>
                    <ul class="space-y-3">
                        <li><span class="text-gray-600 hover:text-blue-600 cursor-pointer">IT Support &
                                Troubleshooting</span></li>
                        <li><span class="text-gray-600 hover:text-blue-600 cursor-pointer">Network Setup &
                                Configuration</span></li>
                        <li><span class="text-gray-600 hover:text-blue-600 cursor-pointer">Custom Software
                                Development</span></li>
                        <li><span class="text-gray-600 hover:text-blue-600 cursor-pointer">Data Recovery Services</span>
                        </li>
                        <li><span class="text-gray-600 hover:text-blue-600 cursor-pointer">System Maintenance</span>
                        </li>
                        <li><span class="text-gray-600 hover:text-blue-600 cursor-pointer">IT Consultation</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-2">
                            <div class="w-4 h-4 flex items-center justify-center">
                                <i class="fa-solid fa-phone text-gray-500 text-sm"></i>
                            </div>
                            <span class="text-gray-600">+233 546 973 655</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-4 h-4 flex items-center justify-center">
                                <i class="fa-solid fa-envelope text-gray-500 text-sm"></i>
                            </div>
                            <span class="text-gray-600">info@nacomconsults.com</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <div class="w-4 h-4 flex items-center justify-center mt-0.5">
                                <i class="fa-solid fa-location-dot text-gray-500 text-sm"></i>
                            </div>
                            <span class="text-gray-600">Dansoman Bechem, Accra Ghana</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-200 mt-12 p-6 text-center">
                <p class="text-gray-600 text-sm">&copy; 2025 NACOM Computer Consults. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript Files -->

    <script src="./js/main.js"></script>

</body>

</html>