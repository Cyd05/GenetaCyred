<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Records Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'poppins': ['Poppins', 'sans-serif'],
          },
          animation: {
            'fade-in': 'fadeIn 0.8s ease-in-out',
            'slide-up': 'slideUp 0.6s ease-out',
            'float': 'float 6s ease-in-out infinite',
            'glow': 'glow 2s ease-in-out infinite alternate',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            slideUp: {
              '0%': { transform: 'translateY(30px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' },
            },
            glow: {
              '0%': { boxShadow: '0 0 5px rgba(59, 130, 246, 0.5), 0 0 10px rgba(59, 130, 246, 0.3)' },
              '100%': { boxShadow: '0 0 15px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.5)' },
            }
          }
        }
      }
    }
  </script>
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      background-attachment: fixed;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }
    
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: 
        radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 20%);
      z-index: -1;
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.92);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 
        0 15px 35px rgba(0, 0, 0, 0.1),
        0 5px 15px rgba(0, 0, 0, 0.07);
    }
    
    .table-row-hover:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .floating-element {
      animation: float 6s ease-in-out infinite;
    }
    
    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    /* Enhanced pagination styling */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
      flex-wrap: wrap;
    }
    
    .pagination a, .pagination span {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 2.8rem;
      height: 2.8rem;
      padding: 0 0.75rem;
      border-radius: 12px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-size: 0.9rem;
    }
    
    .pagination a {
      background: rgba(255, 255, 255, 0.7);
      border: 1px solid rgba(226, 232, 240, 0.8);
      color: #4a5568;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .pagination a:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-color: transparent;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .pagination .current {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: 1px solid transparent;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
      animation: glow 2s ease-in-out infinite alternate;
    }
    
    .pagination .disabled {
      opacity: 0.4;
      cursor: not-allowed;
      background: rgba(247, 250, 252, 0.5);
      color: #a0aec0;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.05);
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 10px;
    }
    
    /* Shimmer effect for loading */
    .shimmer {
      background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
    }
    
    @keyframes shimmer {
      0% {
        background-position: -200% 0;
      }
      100% {
        background-position: 200% 0;
      }
    }
    
    /* Floating particles */
    .particle {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      animation: float 15s infinite linear;
      z-index: -1;
    }
  </style>
</head>
<body class="min-h-screen font-poppins flex items-center justify-center p-4 md:p-8">
  <!-- Floating particles -->
  <div class="particle" style="width: 40px; height: 40px; top: 10%; left: 5%; animation-delay: 0s;"></div>
  <div class="particle" style="width: 20px; height: 20px; top: 70%; left: 10%; animation-delay: 2s;"></div>
  <div class="particle" style="width: 60px; height: 60px; top: 20%; right: 5%; animation-delay: 4s;"></div>
  <div class="particle" style="width: 30px; height: 30px; top: 80%; right: 15%; animation-delay: 6s;"></div>
  
  <div id="app" class="relative w-full max-w-7xl glass-effect rounded-3xl p-8 md:p-10 flex flex-col gap-10 animate-fade-in">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-center gap-4">
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-4 rounded-2xl shadow-xl floating-element">
          <i class="fas fa-user-graduate text-white text-3xl"></i>
        </div>
        <div>
          <h1 class="text-3xl md:text-4xl font-bold gradient-text">Student Records</h1>
          <p class="text-slate-600 text-sm mt-1">Efficiently manage and organize your student database</p>
        </div>
      </div>
      
      <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <form method="get" action="<?=site_url()?>" class="relative flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search students by name, email..." 
            class="pl-12 pr-4 py-3 bg-white/80 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent w-full md:w-80 transition-all duration-300 shadow-sm">
          <button type="submit" class="absolute left-0 top-0 h-full px-4 text-gray-500 hover:text-purple-600 transition-colors">
            <i class="fas fa-search"></i>
          </button>
        </form>
        
        <a href="<?=site_url('students/create');?>"
           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
          <i class="fas fa-plus-circle"></i>
          <span>Add New Student</span>
        </a>
      </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-2xl border border-blue-100 shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-blue-600 font-medium">Total Students</p>
            <h3 class="text-2xl font-bold text-blue-800 mt-1"><?= count($users) ?? '0' ?></h3>
          </div>
          <div class="bg-blue-100 p-3 rounded-full">
            <i class="fas fa-users text-blue-600 text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-gradient-to-r from-green-50 to-teal-50 p-5 rounded-2xl border border-green-100 shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-green-600 font-medium">Active Records</p>
            <h3 class="text-2xl font-bold text-green-800 mt-1"><?= count($users) ?? '0' ?></h3>
          </div>
          <div class="bg-green-100 p-3 rounded-full">
            <i class="fas fa-check-circle text-green-600 text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-5 rounded-2xl border border-purple-100 shadow-sm">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-purple-600 font-medium">This Month</p>
            <h3 class="text-2xl font-bold text-purple-800 mt-1">+5</h3>
          </div>
          <div class="bg-purple-100 p-3 rounded-full">
            <i class="fas fa-chart-line text-purple-600 text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- TABLE SECTION -->
    <div class="overflow-hidden border border-gray-200/50 rounded-2xl shadow-lg animate-slide-up">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
              <th class="px-6 py-5 text-sm font-semibold uppercase tracking-wider rounded-tl-2xl">
                <div class="flex items-center gap-2">
                  <i class="fas fa-hashtag text-sm"></i>
                  <span>ID</span>
                </div>
              </th>
              <th class="px-6 py-5 text-sm font-semibold uppercase tracking-wider">
                <div class="flex items-center gap-2">
                  <i class="fas fa-user text-sm"></i>
                  <span>First Name</span>
                </div>
              </th>
              <th class="px-6 py-5 text-sm font-semibold uppercase tracking-wider">
                <div class="flex items-center gap-2">
                  <i class="fas fa-user-tag text-sm"></i>
                  <span>Last Name</span>
                </div>
              </th>
              <th class="px-6 py-5 text-sm font-semibold uppercase tracking-wider">
                <div class="flex items-center gap-2">
                  <i class="fas fa-envelope text-sm"></i>
                  <span>Email</span>
                </div>
              </th>
              <th class="px-6 py-5 text-sm font-semibold uppercase tracking-wider text-center rounded-tr-2xl">
                <div class="flex items-center gap-2 justify-center">
                  <i class="fas fa-cogs text-sm"></i>
                  <span>Actions</span>
                </div>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200/50">
            <?php foreach (html_escape($users) as $index => $user): ?>
            <tr class="bg-white/70 hover:bg-white transition-all duration-300 table-row-hover <?= $index % 2 === 0 ? 'bg-blue-50/20' : '' ?>">
              <td class="px-6 py-5 text-sm font-bold text-purple-700">#<?= $user['id']; ?></td>
              <td class="px-6 py-5">
                <div class="flex items-center gap-3">
                  <div class="bg-purple-100 text-purple-700 rounded-full w-8 h-8 flex items-center justify-center">
                    <i class="fas fa-user text-xs"></i>
                  </div>
                  <span class="font-medium text-slate-800"><?= $user['first_name']; ?></span>
                </div>
              </td>
              <td class="px-6 py-5 text-sm font-medium text-slate-800"><?= $user['last_name']; ?></td>
              <td class="px-6 py-5 text-sm text-slate-600 break-all">
                <div class="flex items-center gap-2">
                  <i class="fas fa-envelope text-slate-400 text-xs"></i>
                  <span><?= $user['email']; ?></span>
                </div>
              </td>
              <td class="px-6 py-5 text-sm flex justify-center gap-3">
                <a href="<?=site_url('students/update/'.$user['id']);?>"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-700 rounded-xl font-medium border border-blue-200 hover:bg-blue-100 hover:text-blue-900 hover:shadow-md transition-all duration-200">
                   <i class="fas fa-edit text-xs"></i>
                   <span>Edit</span>
                </a>
                <a href="<?=site_url('students/delete/'.$user['id']);?>"
                   onclick="return confirm('Are you sure you want to delete this student record?');"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-50 text-red-600 rounded-xl font-medium border border-red-200 hover:bg-red-100 hover:text-red-800 hover:shadow-md transition-all duration-200">
                   <i class="fas fa-trash-alt text-xs"></i>
                   <span>Delete</span>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- PAGINATION -->
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 bg-gradient-to-r from-blue-50 to-purple-50 p-5 rounded-2xl border border-blue-100">
      <div class="text-sm text-slate-600 font-medium">
        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
        Showing page <?= isset($current_page) ? $current_page : '1' ?> of student records
      </div>
      
      <div class="pagination">
        <?php 
        // This will work with Lavalust's pagination structure
        // The framework generates the pagination links automatically
        echo $page ?? ''; 
        ?>
      </div>
      
      <div class="text-sm text-slate-600 font-medium hidden sm:block">
        <i class="fas fa-arrows-alt-h text-purple-500 mr-1"></i>
        Navigate through pages
      </div>
    </div>
    
    <!-- FOOTER -->
    <div class="text-center text-sm text-slate-500 pt-6 border-t border-gray-200/50">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <p>Student Records Management System &copy; <?= date('Y'); ?> | All rights reserved</p>
        <div class="flex gap-4 mt-2 md:mt-0">
          <a href="#" class="text-slate-500 hover:text-purple-600 transition-colors"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-slate-500 hover:text-purple-600 transition-colors"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-slate-500 hover:text-purple-600 transition-colors"><i class="fab fa-github"></i></a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
      const tableRows = document.querySelectorAll('tbody tr');
      
      tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
          this.style.transition = 'all 0.3s ease';
        });
      });
      
      // Enhance pagination buttons after page load
      const paginationLinks = document.querySelectorAll('.pagination a');
      paginationLinks.forEach(link => {
        link.classList.add('flex', 'items-center', 'justify-center');
        
        // Add icons for next/previous if they exist
        if (link.textContent.includes('Next') || link.textContent.includes('»')) {
          link.innerHTML = '<i class="fas fa-chevron-right"></i>';
          link.title = 'Next page';
        } else if (link.textContent.includes('Previous') || link.textContent.includes('«')) {
          link.innerHTML = '<i class="fas fa-chevron-left"></i>';
          link.title = 'Previous page';
        } else if (link.textContent.includes('First')) {
          link.innerHTML = '<i class="fas fa-step-backward"></i>';
          link.title = 'First page';
        } else if (link.textContent.includes('Last')) {
          link.innerHTML = '<i class="fas fa-step-forward"></i>';
          link.title = 'Last page';
        }
      });
      
      // Add floating particles
      function createParticle() {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        const size = Math.random() * 30 + 10;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particle.style.animationDuration = `${Math.random() * 10 + 10}s`;
        document.body.appendChild(particle);
        
        // Remove particle after animation completes
        setTimeout(() => {
          particle.remove();
        }, 30000);
      }
      
      // Create initial particles
      for (let i = 0; i < 8; i++) {
        createParticle();
      }
      
      // Add new particles periodically
      setInterval(createParticle, 5000);
    });
  </script>
</body>
</html>