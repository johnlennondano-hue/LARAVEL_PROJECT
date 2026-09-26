<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAÑO's Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0a0d;
            background-image:
                radial-gradient(circle at 15% 20%, rgba(147, 51, 234, 0.18) 0%, transparent 45%),
                radial-gradient(circle at 85% 75%, rgba(234, 179, 8, 0.08) 0%, transparent 40%),
                repeating-linear-gradient(135deg, rgba(147, 51, 234, 0.05) 0px, rgba(147, 51, 234, 0.05) 2px, transparent 2px, transparent 22px);
            color: #e4e4e7;
        }

        .comic-font {
            font-family: 'Bangers', cursive;
            letter-spacing: 0.03em;
        }

        .comic-card {
            background: #17171d;
            border: 3px solid #7c3aed;
            box-shadow: 5px 5px 0 #4c1d95, 0 0 22px rgba(147, 51, 234, 0.15);
        }

        .comic-card-sm {
            background: #17171d;
            border: 2.5px solid #7c3aed;
            box-shadow: 4px 4px 0 #4c1d95, 0 0 16px rgba(147, 51, 234, 0.12);
        }

        .hero-band {
            background: linear-gradient(120deg, #0a0a0d 0%, #1e0b3a 45%, #4c1d95 75%, #7c3aed 100%);
            border-bottom: 4px solid #eab308 !important;
        }

        .field {
            background: #0a0a0d;
            border: 2.5px solid #7c3aed;
            color: #e4e4e7;
            transition: all 0.15s ease;
        }
        .field:focus {
            outline: none;
            box-shadow: 3px 3px 0 #eab308;
        }

        .btn-primary {
            background: #7c3aed;
            color: #ffffff;
            border: 2.5px solid #eab308;
            box-shadow: 3px 3px 0 #4c1d95;
            transition: transform 0.1s ease;
        }
        .btn-primary:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0 #4c1d95; }

        .btn-secondary {
            background: #17171d;
            color: #e4e4e7;
            border: 2.5px solid #7c3aed;
            box-shadow: 3px 3px 0 #4c1d95;
            transition: transform 0.1s ease;
        }
        .btn-secondary:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0 #4c1d95; }

        .btn-danger {
            background: #17171d;
            color: #fca5a5;
            border: 2.5px solid #dc2626;
            box-shadow: 3px 3px 0 #7c3aed;
            transition: transform 0.1s ease;
        }
        .btn-danger:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0 #7c3aed; }

        .tab-pill {
            border: 2.5px solid #7c3aed;
            transition: all 0.15s ease;
        }
        .tab-active {
            background: #eab308;
            color: #111111;
            box-shadow: 3px 3px 0 #4c1d95;
        }
        .tab-inactive {
            background: #17171d;
            color: #a1a1aa;
        }
        .tab-inactive:hover { background: #1e1b2e; }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0d; }
        ::-webkit-scrollbar-thumb { background: #7c3aed; border-radius: 0; }
    </style>
</head>
<body class="h-full flex flex-col overflow-x-hidden">

    <!-- HERO BANNER -->
    <header class="hero-band w-full py-6 px-4 md:px-8 border-b-4 border-purple-500">
        <div class="max-w-5xl mx-auto flex items-center justify-between gap-4 flex-wrap">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-full bg-yellow-400 border-3 border-purple-500 flex items-center justify-center text-black text-xl shadow-[3px_3px_0_#111]">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h1 class="comic-font text-3xl md:text-4xl text-white drop-shadow-[2px_2px_0_#111]">DO YOUR TASKS</h1>
                    <p class="text-[11px] md:text-xs text-yellow-200 font-bold uppercase tracking-wider">DAÑO's Daily Task</p>
                </div>
            </div>
            <button onclick="openModal()" class="btn-primary comic-font text-lg px-5 py-2 rounded-xl flex items-center gap-2 shrink-0">
                <i class="fa-solid fa-plus text-sm"></i> NEW MISSION
            </button>
        </div>
    </header>

    <!-- MAIN -->
    <main class="flex-1 w-full">
        <div class="max-w-5xl mx-auto px-4 md:px-8 py-6 space-y-6">

            <div id="alertBox" class="hidden px-4 py-2.5 rounded-xl comic-card-sm text-emerald-300 text-xs font-bold items-center gap-2 justify-center">
                <i class="fa-solid fa-circle-check"></i> <span id="alertText">Task added successfully.</span>
            </div>

            <!-- STAT BADGES -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="comic-card rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-extrabold text-zinc-500 uppercase tracking-wider">Total Missions</p>
                        <h3 id="statTotal" class="comic-font text-3xl mt-0.5 text-zinc-100">0</h3>
                    </div>
                    <div class="w-11 h-11 rounded-full bg-purple-600 border-2 border-purple-500 flex items-center justify-center text-white">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                </div>
                <div class="comic-card rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-extrabold text-zinc-500 uppercase tracking-wider">In Progress</p>
                        <h3 id="statPending" class="comic-font text-3xl mt-0.5 text-amber-600">0</h3>
                    </div>
                    <div class="w-11 h-11 rounded-full bg-yellow-400 border-2 border-purple-500 flex items-center justify-center text-black">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="comic-card rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-extrabold text-zinc-500 uppercase tracking-wider">Completed</p>
                        <h3 id="statCompleted" class="comic-font text-3xl mt-0.5 text-red-600">0</h3>
                    </div>
                    <div class="w-11 h-11 rounded-full bg-red-600 border-2 border-purple-500 flex items-center justify-center text-white">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </div>

            <!-- CONTROL PANEL: tabs + search + priority filter -->
            <div class="comic-card rounded-xl p-4 flex flex-col md:flex-row md:items-center gap-3 justify-between">
                <div class="flex items-center gap-2">
                    <button onclick="setFilter('all')" id="nav-all" class="tab-pill tab-active comic-font text-base px-4 py-1.5 rounded-lg">ALL</button>
                    <button onclick="setFilter('pending')" id="nav-pending" class="tab-pill tab-inactive comic-font text-base px-4 py-1.5 rounded-lg">PENDING</button>
                    <button onclick="setFilter('completed')" id="nav-completed" class="tab-pill tab-inactive comic-font text-base px-4 py-1.5 rounded-lg">DONE</button>
                </div>
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <div class="relative flex-1 md:w-56">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-zinc-500">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" id="searchInput" oninput="handleSearch()" placeholder="Search missions..." class="w-full field pl-9 pr-3 py-2 rounded-lg text-xs font-semibold">
                    </div>
                    <select id="priorityFilter" onchange="renderTasks()" class="field px-3 py-2 rounded-lg text-xs font-semibold">
                        <option value="all">All Levels</option>
                        <option value="Urgent">Urgent</option>
                        <option value="Reminder">Reminder</option>
                    </select>
                </div>
            </div>

            <!-- MISSION FEED -->
            <div>
                <p id="registryFilterTag" class="comic-font text-xl text-zinc-200 mb-3">ALL MISSIONS</p>

                <div id="emptyState" class="hidden comic-card rounded-xl py-14 text-center">
                    <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-zinc-800 border-2 border-purple-500 flex items-center justify-center text-zinc-500">
                        <i class="fa-regular fa-folder-open"></i>
                    </div>
                    <h3 class="comic-font text-xl text-zinc-300">NO MISSIONS FOUND</h3>
                    <p class="text-xs text-zinc-500 mt-1 font-semibold">Tap "NEW MISSION" above to add your first task.</p>
                </div>

                <div id="missionFeed" class="space-y-3">
                    <!-- Dynamic mission cards -->
                </div>
            </div>
        </div>
    </main>

    <!-- ADD/EDIT TASK MODAL -->
    <div id="taskModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 hidden">
        <div class="comic-card rounded-2xl p-6 w-full max-w-md relative bg-[#17171d]">
            <div class="flex items-center justify-between pb-3 mb-4 border-b-2 border-purple-500">
                <h3 id="modalTitle" class="comic-font text-2xl text-zinc-100">ADD NEW MISSION</h3>
                <button onclick="closeModal()" class="w-8 h-8 rounded-lg btn-secondary flex items-center justify-center text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="taskForm" onsubmit="handleFormSubmit(event)" class="space-y-4">
                <input type="hidden" id="taskId">

                <div>
                    <label class="block text-xs font-extrabold text-zinc-400 uppercase mb-1">Mission Name</label>
                    <input type="text" id="taskTitle" required placeholder="Enter task name..." class="w-full field px-3.5 py-2.5 rounded-lg text-sm font-medium">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-zinc-400 uppercase mb-1">Briefing</label>
                    <textarea id="taskDesc" rows="3" placeholder="Enter task description..." class="w-full field px-3.5 py-2.5 rounded-lg text-sm font-medium resize-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-extrabold text-zinc-400 uppercase mb-1">Due Date</label>
                        <input type="date" id="taskDueDate" required class="w-full field px-3.5 py-2.5 rounded-lg text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-zinc-400 uppercase mb-1">Threat Level</label>
                        <select id="taskPriority" class="w-full field px-3.5 py-2.5 rounded-lg text-sm font-medium">
                            <option value="Reminder">Reminder</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-zinc-400 uppercase mb-1">Status</label>
                    <select id="taskStatusSelect" class="w-full field px-3.5 py-2.5 rounded-lg text-sm font-medium">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal()" class="btn-secondary comic-font text-base px-4 py-1.5 rounded-lg">CANCEL</button>
                    <button type="submit" id="submitBtn" class="btn-primary comic-font text-base px-5 py-1.5 rounded-lg">SAVE</button>
                </div>
            </form>
        </div>
    </div>

    <!-- DELETE CONFIRMATION MODAL -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 hidden">
        <div class="comic-card rounded-2xl p-6 w-full max-w-sm relative text-center bg-[#17171d]">
            <div class="flex justify-end">
                <button onclick="closeDeleteModal()" class="w-8 h-8 rounded-lg btn-secondary flex items-center justify-center text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="w-16 h-16 mx-auto rounded-full bg-red-600 border-3 border-purple-500 flex items-center justify-center text-white text-2xl mb-3 -mt-2">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="comic-font text-2xl text-zinc-100">ABORT MISSION?</h3>
            <p class="text-xs text-zinc-400 mt-1.5 leading-relaxed font-semibold">This task will be permanently deleted.<br>This action cannot be undone.</p>
            <div class="flex items-center justify-center gap-2 pt-5">
                <button onclick="closeDeleteModal()" class="btn-secondary comic-font text-base px-5 py-1.5 rounded-lg flex-1">CANCEL</button>
                <button onclick="confirmDelete()" class="btn-danger comic-font text-base px-5 py-1.5 rounded-lg flex-1">DELETE</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT ENGINE -->
    <script>
    // Bridge Laravel database records into your front-end JavaScript
    let tasks = @json($tasks);

    let currentFilter = 'all';
    let currentSearchQuery = '';
    let pendingDeleteId = null;

    const TAB_ACTIVE = "tab-pill tab-active comic-font text-base px-4 py-1.5 rounded-lg";
    const TAB_INACTIVE = "tab-pill tab-inactive comic-font text-base px-4 py-1.5 rounded-lg";

    window.onload = function() {
        const dueDateInput = document.getElementById('taskDueDate');
        if (dueDateInput) {
            dueDateInput.min = new Date().toISOString().split('T')[0];
        }
        renderApp();
    };

    function setFilter(filter) {
        currentFilter = filter;

        const allBtn = document.getElementById('nav-all');
        const pendingBtn = document.getElementById('nav-pending');
        const completedBtn = document.getElementById('nav-completed');

        if (allBtn) allBtn.className = filter === 'all' ? TAB_ACTIVE : TAB_INACTIVE;
        if (pendingBtn) pendingBtn.className = filter === 'pending' ? TAB_ACTIVE : TAB_INACTIVE;
        if (completedBtn) completedBtn.className = filter === 'completed' ? TAB_ACTIVE : TAB_INACTIVE;

        const filterTag = document.getElementById('registryFilterTag');
        if (filterTag) {
            const labels = { all: 'ALL MISSIONS', pending: 'ACTIVE MISSIONS', completed: 'COMPLETED MISSIONS' };
            filterTag.innerText = labels[filter] || 'ALL MISSIONS';
        }
        renderTasks();
    }

    function handleSearch() {
        const searchInput = document.getElementById('searchInput');
        currentSearchQuery = searchInput ? searchInput.value.toLowerCase().trim() : '';
        renderTasks();
    }

    function openModal(id = null) {
        const modal = document.getElementById('taskModal');
        if (!modal) return;
        modal.classList.remove('hidden');

        if (id) {
            const task = tasks.find(t => String(t.id) === String(id));
            if (!task) return;
            document.getElementById('modalTitle').innerText = 'EDIT MISSION';
            document.getElementById('submitBtn').innerText = 'UPDATE';
            document.getElementById('taskId').value = task.id;
            document.getElementById('taskTitle').value = task.title || '';
            document.getElementById('taskDesc').value = task.description || '';
            document.getElementById('taskPriority').value = task.priority || 'Reminder';
            document.getElementById('taskDueDate').value = task.due_date || task.dueDate || '';
            document.getElementById('taskStatusSelect').value = task.status ? task.status.toLowerCase() : 'pending';
        } else {
            document.getElementById('modalTitle').innerText = 'ADD NEW MISSION';
            document.getElementById('submitBtn').innerText = 'SAVE';
            document.getElementById('taskForm').reset();
            document.getElementById('taskId').value = '';
        }
    }

    function closeModal() {
        const modal = document.getElementById('taskModal');
        if (modal) modal.classList.add('hidden');
    }

    function openDeleteModal(id) {
        pendingDeleteId = id;
        const modal = document.getElementById('deleteModal');
        if (modal) modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        pendingDeleteId = null;
        const modal = document.getElementById('deleteModal');
        if (modal) modal.classList.add('hidden');
    }

    function showAlert(msg) {
        const alertBox = document.getElementById('alertBox');
        const alertText = document.getElementById('alertText');
        if (alertBox && alertText) {
            alertText.innerText = msg;
            alertBox.classList.remove('hidden');
            alertBox.classList.add('flex');
            setTimeout(() => { alertBox.classList.add('hidden'); alertBox.classList.remove('flex'); }, 3000);
        }
    }

    function renderApp() {
        updateStats();
        renderTasks();
    }

    function updateStats() {
        if (typeof tasks === 'undefined') return;
        const total = tasks.length;
        const pending = tasks.filter(t => (t.status || '').toLowerCase() === 'pending').length;
        const completed = tasks.filter(t => (t.status || '').toLowerCase() === 'completed').length;

        const setElementText = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.innerText = val;
        };

        setElementText('statTotal', total);
        setElementText('statPending', pending);
        setElementText('statCompleted', completed);
    }

    function renderTasks() {
        if (typeof tasks === 'undefined') return;
        const priorityFilterEl = document.getElementById('priorityFilter');
        const priorityVal = priorityFilterEl ? priorityFilterEl.value : 'all';

        const filtered = tasks.filter(t => {
            const status = (t.status || '').toLowerCase();
            if (currentFilter !== 'all' && status !== currentFilter.toLowerCase()) return false;
            if (priorityVal !== 'all' && t.priority !== priorityVal) return false;
            if (currentSearchQuery &&
                !(t.title || '').toLowerCase().includes(currentSearchQuery) &&
                !(t.description || '').toLowerCase().includes(currentSearchQuery)) return false;
            return true;
        });

        const feed = document.getElementById('missionFeed');
        const emptyState = document.getElementById('emptyState');
        if (!feed || !emptyState) return;

        feed.innerHTML = '';

        if (filtered.length === 0) {
            emptyState.classList.remove('hidden');
            feed.classList.add('hidden');
            updateStats();
            return;
        } else {
            emptyState.classList.add('hidden');
            feed.classList.remove('hidden');
        }

        filtered.forEach(task => {
            const isCompleted = (task.status || '').toLowerCase() === 'completed';
            const dueDateStr = task.due_date || task.dueDate || '';
            const isUrgent = task.priority === 'Urgent';
            const card = document.createElement('div');
            card.className = "comic-card-sm rounded-xl p-4 flex flex-col sm:flex-row sm:items-center gap-3 justify-between";
            card.innerHTML = `
                <div class="flex items-start gap-3 flex-1 min-w-0">
                    <div class="w-2.5 self-stretch rounded-full ${isUrgent ? 'bg-red-600' : 'bg-purple-600'} shrink-0"></div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase border-2 border-purple-500 ${isUrgent ? 'bg-red-500/15 text-red-300' : 'bg-purple-500/15 text-purple-300'}">${escapeHtml(task.priority || 'Normal')}</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase border-2 border-purple-500 ${isCompleted ? 'bg-emerald-500/15 text-emerald-300' : 'bg-yellow-500/15 text-yellow-300'}">${isCompleted ? 'Completed' : 'Pending'}</span>
                            <span class="text-[10px] font-bold text-zinc-500"><i class="fa-regular fa-calendar mr-1"></i>${escapeHtml(dueDateStr)}</span>
                        </div>
                        <h4 class="font-extrabold text-sm text-zinc-100 ${isCompleted ? 'line-through opacity-50' : ''}">${escapeHtml(task.title || '')}</h4>
                        <p class="text-xs text-zinc-400 mt-0.5 line-clamp-2">${escapeHtml(task.description || 'No description provided.')}</p>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 shrink-0 self-end sm:self-center">
                    <button onclick="toggleStatus('${task.id}')" title="${isCompleted ? 'Reopen' : 'Complete'}" class="w-8 h-8 rounded-lg btn-secondary flex items-center justify-center text-xs">
                        <i class="fa-solid ${isCompleted ? 'fa-rotate-left' : 'fa-check'} text-[11px]"></i>
                    </button>
                    <button onclick="openModal('${task.id}')" title="Edit" class="w-8 h-8 rounded-lg btn-secondary flex items-center justify-center text-xs">
                        <i class="fa-solid fa-pen text-[10px]"></i>
                    </button>
                    <button onclick="openDeleteModal('${task.id}')" title="Delete" class="w-8 h-8 rounded-lg btn-danger flex items-center justify-center text-xs">
                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                    </button>
                </div>
            `;
            feed.appendChild(card);
        });
        updateStats();
    }

    async function handleFormSubmit(e) {
        e.preventDefault();
        const id = document.getElementById('taskId').value;
        const title = document.getElementById('taskTitle').value.trim();
        const description = document.getElementById('taskDesc').value.trim();
        const priority = document.getElementById('taskPriority').value;
        const due_date = document.getElementById('taskDueDate').value;
        const status = document.getElementById('taskStatusSelect').value;

        if (!title || !due_date) return;

        const formData = { title, description, priority, due_date, status };
        const url = id ? `/tasks/${id}` : '/tasks';
        const method = id ? 'PUT' : 'POST';

        try {
            let response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                showAlert(id ? 'Task updated successfully.' : 'Task added successfully.');
                closeModal();
                location.reload();
            } else {
                const errorData = await response.json();
                console.error('Validation Errors:', errorData);

                let message = 'Failed to save task.';
                if (errorData.errors) {
                    message += ' ' + Object.values(errorData.errors).flat().join(' ');
                } else if (errorData.message) {
                    message += ' ' + errorData.message;
                }
                alert(message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An unexpected network error occurred.');
        }
    }

    async function toggleStatus(id) {
        try {
            let response = await fetch(`/tasks/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                location.reload();
            } else {
                alert('Failed to update status.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function confirmDelete() {
        if (!pendingDeleteId) return;
        const id = pendingDeleteId;

        try {
            let response = await fetch(`/tasks/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                closeDeleteModal();
                showAlert('Task deleted.');
                location.reload();
            } else {
                alert('Failed to delete task.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
    </script>
</body>
</html>