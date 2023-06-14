<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<div class="container mx-auto max-w-md mt-20">
  <?php if (!isset($_GET['register'])) : ?>
    <div class="bg-white p-8 shadow-md">
  <h2 class="text-2xl mb-4">Login</h2>
  <form method="POST" action="login.php">
    <div class="mb-4">
      <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
      <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
    </div>
    <div class="mb-4">
      <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
      <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg"
             required>
    </div>
    <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</button>
    <a href="?register" class="text-blue-500 font-bold ml-2">Register</a>
  </form>
</div>
  <?php else : ?>
  <div class="bg-white p-8 shadow-md">
    <h2 class="text-2xl mb-4">Registration</h2>
    <form method="POST" action="register.php">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg" required>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
        <input type="password" id="password" name="password"
               class="w-full px-4 py-2 border rounded-lg" required>
      </div>
      <button type="submit"
              class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Register</button>
      <a href="?login" class="text-blue-500 font-bold ml-2">Back to Login</a>
    </form>
  </div>
  <?php endif; ?>
</div>
</body>

</html>
