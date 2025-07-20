<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NACOM Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css ">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- <link rel="stylesheet" href="../../public/css/style.css"> -->

    <!-- error message  -->
    <link rel="stylesheet" href="../../public/js/ErrorMessage_Plugin/iziToast.min.css">
    <script src="../../public/js/ErrorMessage_Plugin/iziToast.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loading = document.getElementById('loading');
            loading.style.opacity = '0';
            setTimeout(() => {
                loading.style.display = 'none';
            }, 300); // match CSS transition
        });
    </script>

    <style>
        #loading {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50">