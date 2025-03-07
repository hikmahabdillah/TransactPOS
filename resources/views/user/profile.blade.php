<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>TransactX POS | Profile User</title>
</head>

<body>
    <div class="container mx-auto flex items-center justify-center min-h-screen">
        <div class="card rounded-xl bg-base-100 image-full w-96 shadow-md border border-gray-200 overflow-hidden">
            <figure>
                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Shoes" />
            </figure>
            <div class="card-body p-5">
                <h2 class="card-title text-xl font-semibold">Name: {{ $name }}</h2>
                <p>Id: {{ $id }}</p>
            </div>
        </div>
    </div>
</body>

</html>
