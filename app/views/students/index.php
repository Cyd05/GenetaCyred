<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Records Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      min-height: 100vh;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      color: #e2e8f0;
    }

    /* Glassmorphism effect */
    .glass-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    .glass-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 40px rgba(0,0,0,0.3);
    }

    /* Neon gradient text */
    .gradient-text {
      background: linear-gradient(90deg, #06b6d4, #3b82f6, #8b5cf6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 700;
    }

    /* Table hover */
    .table-hover tr:hover {
      background-color: rgba(99, 102, 241, 0.1);
      transition: 0.3s;
    }
  </style>
</head>

<body class="flex items-center justify-center p-6">

  <div class="w-full max-w-6xl glass-card">
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
      <div class="flex items-center gap-4">
        <div class="bg-gradient-to-r from-cyan-400 to-blue-600 p-4 rounded-2xl shadow-lg">
          <!-- Palit na logo ng user -->
          <i class="fas fa-school text-white text-3xl"></i>
        </div>
        <div>
          <h1 class="text-3xl md:text-4xl gradient-text">Student Records</h1>
          <p class="text-slate-400 text-sm mt-1">Manage and organize your student database with ease</p>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <!-- Search -->
        <form method="get" action="<?=site_url()?>" class="relative flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search students..." 
            class="pl-12 pr-4 py-3 bg-white/90 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 w-full md:w-80 transition-all duration-300 shadow-sm text-gray-700">
          <button type="submit" class="absolute left-0 top-0 h-full px-4 text-gray-500 hover:text-cyan-600 transition-colors">
            <i class="fas fa-search"></i>
          </button>
        </form>

        <!-- Add New Student -->
        <a href="<?=site_url('students/create');?>"
           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1">
          <i class="fas fa-user-plus"></i>
          <span>Add Student</span>
        </a>
      </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-xl border border-gray-200/30 shadow">
      <table class="w-full text-left border-collapse table-hover">
        <thead>
          <tr class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white">
            <th class="px-6 py-4">ID</th>
            <th class="px-6 py-4">First Name</th>
            <th class="px-6 py-4">Last Name</th>
            <th class="px-6 py-4">Email</th>
            <th class="px-6 py-4 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200/20">
          <?php foreach (html_escape($users) as $index => $user): ?>
          <tr class="<?= $index % 2 === 0 ? 'bg-white/5' : 'bg-transparent' ?>">
            <td class="px-6 py-4 font-bold text-cyan-400">#<?= $user['id']; ?></td>
            <td class="px-6 py-4 flex items-center gap-2">
              <div class="bg-cyan-100 text-cyan-700 rounded-full w-8 h-8 flex items-center justify-center">
                <!-- New user icon -->
                <i class="fas fa-user-graduate text-xs"></i>
              </div>
              <span class="font-medium"><?= $user['first_name']; ?></span>
            </td>
            <td class="px-6 py-4"><?= $user['last_name']; ?></td>
            <td class="px-6 py-4 text-slate-400"><?= $user['email']; ?></td>
            <td class="px-6 py-4 flex justify-center gap-3">
              <a href="<?=site_url('students/update/'.$user['id']);?>"
                 class="px-4 py-2.5 bg-blue-50 text-blue-700 rounded-lg font-medium border border-blue-200 hover:bg-blue-100 transition">
                 <i class="fas fa-edit"></i> Edit
              </a>
              <a href="<?=site_url('students/delete/'.$user['id']);?>"
                 onclick="return confirm('Delete this student?');"
                 class="px-4 py-2.5 bg-red-50 text-red-600 rounded-lg font-medium border border-red-200 hover:bg-red-100 transition">
                 <i class="fas fa-trash"></i> Delete
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- FOOTER -->
    <div class="text-center text-sm text-slate-400 pt-6">
      Student Records Management © <?= date('Y'); ?>
    </div>
  </div>
</body>
</html>
