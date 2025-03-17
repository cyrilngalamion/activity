<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6 text-gray-700">Student List</h1>

                    @if(session('success'))
                        <p class="text-green-600 font-semibold mb-4">{{ session('success') }}</p>
                    @endif

                    <!-- Student Form -->
                    <form action="{{ route('students.store') }}" method="POST" class="bg-gray-100 p-6 rounded-lg shadow-md mb-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-semibold">First Name:</label>
                                <input type="text" name="first_name" required class="w-full border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold">Middle Name:</label>
                                <input type="text" name="middle_name" class="w-full border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold">Last Name:</label>
                                <input type="text" name="last_name" required class="w-full border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold">Age:</label>
                                <input type="number" name="age" required class="w-full border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold">Birthdate:</label>
                                <input type="date" name="birthdate" required class="w-full border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Add Student
                        </button>
                    </form>

                    <!-- Students Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                                <tr>
                                    <th class="py-3 px-6 border">First Name</th>
                                    <th class="py-3 px-6 border">Middle Name</th>
                                    <th class="py-3 px-6 border">Last Name</th>
                                    <th class="py-3 px-6 border">Age</th>
                                    <th class="py-3 px-6 border">Birthdate</th>
                                    <th class="py-3 px-6 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach($students as $student)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="py-3 px-6 border">{{ $student->first_name }}</td>
                                    <td class="py-3 px-6 border">{{ $student->middle_name }}</td>
                                    <td class="py-3 px-6 border">{{ $student->last_name }}</td>
                                    <td class="py-3 px-6 border">{{ $student->age }}</td>
                                    <td class="py-3 px-6 border">{{ $student->birthdate }}</td>
                                    <td class="py-3 px-6 border flex items-center space-x-2">
                                        <!-- Edit Button -->
                                        <button onclick="openEditModal({{ $student }})" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded transition duration-300">
                                            Edit
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded transition duration-300">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Edit Student Modal -->
                    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h2 class="text-xl font-semibold mb-4">Edit Student</h2>
                            <form id="editForm" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="editId">
                                <label class="block text-gray-700 font-semibold">First Name:</label>
                                <input type="text" id="editFirstName" name="first_name" class="w-full border-gray-300 rounded-md p-2 mb-2">
                                <label class="block text-gray-700 font-semibold">Middle Name:</label>
                                <input type="text" id="editMiddleName" name="middle_name" class="w-full border-gray-300 rounded-md p-2 mb-2">
                                <label class="block text-gray-700 font-semibold">Last Name:</label>
                                <input type="text" id="editLastName" name="last_name" class="w-full border-gray-300 rounded-md p-2 mb-2">
                                <label class="block text-gray-700 font-semibold">Age:</label>
                                <input type="number" id="editAge" name="age" class="w-full border-gray-300 rounded-md p-2 mb-2">
                                <label class="block text-gray-700 font-semibold">Birthdate:</label>
                                <input type="date" id="editBirthdate" name="birthdate" class="w-full border-gray-300 rounded-md p-2 mb-2">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Changes</button>
                                <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                            </form>
                        </div>
                    </div>

                    <script>
                        function openEditModal(student) {
                            document.getElementById('editId').value = student.id;
                            document.getElementById('editFirstName').value = student.first_name;
                            document.getElementById('editMiddleName').value = student.middle_name;
                            document.getElementById('editLastName').value = student.last_name;
                            document.getElementById('editAge').value = student.age;
                            document.getElementById('editBirthdate').value = student.birthdate;
                            document.getElementById('editForm').action = `/students/${student.id}`;
                            document.getElementById('editModal').classList.remove('hidden');
                        }

                        function closeEditModal() {
                            document.getElementById('editModal').classList.add('hidden');
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
