<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Page Not Found</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-in-out;
        }

        h1 {
            font-size: 72px;
            color: #E13300;
        }

        p {
            font-size: 18px;
            margin: 20px 0;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #E13300;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #C12E00;
        }

        .illustration {
            font-size: 100px;
            color: #E13300;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            h1 {
                font-size: 48px;
            }

            p {
                font-size: 16px;
            }

            a {
                font-size: 14px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="illustration">😕</div>
    <h1>404</h1>
    <p>Oops! Halaman yang Anda cari tidak ditemukan.</p>
    <p>Kembali ke <a href="<?php echo base_url(); ?>">Beranda</a></p>
</div>
</body>
</html>
