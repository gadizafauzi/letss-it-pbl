@extends('layouts.admin')

@section('title', 'Kenaikan Kelas Massal')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Kenaikan Kelas Massal</h1>
        </div>
    </div>

    {{-- Alert --}}

    <div class="p-4 rounded-xl bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 text-amber-600 dark:text-amber-400 flex items-start gap-3 shadow-sm">
        <i data-lucide="alert-triangle" class="w-5 h-5 shrink-0 mt-0.5"></i>
        <div class="text-sm font-medium">
            <p class="font-bold">Perhatian!</p>
            <p>Pastikan Tahun Ajaran Tujuan sudah benar sebelum mengeksekusi kenaikan kelas. Siswa yang dinaikkan akan memiliki riwayat kelas di tahun ajaran baru tersebut.</p>
        </div>
    </div>

    <form action="{{ route('admin.kenaikan-kelas.process') }}" method="POST" id="promotionForm" 
          x-data="promotionForm()" 
          x-init="initData({{ Js::from($units) }}, {{ Js::from($classes) }})">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- PANEL KIRI: ASAL --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden flex flex-col">
                <div class="p-5 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 flex items-center justify-between">
                    <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <i data-lucide="log-out" class="w-4 h-4 text-slate-500"></i>
                        Data Kelas Asal
                    </h3>
                </div>
                
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun Ajaran Asal</label>
                        <select x-model="source.academic_year_id" @change="fetchStudents()" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $year->status == 'active' ? 'selected' : '' }}>{{ $year->year }} ({{ $year->active_semester }}) {{ $year->status == 'active' ? '[Aktif]' : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Unit</label>
                            <select x-model="source.unit_id" @change="fetchStudents()" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">-- Pilih Unit --</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kelas</label>
                            <select x-model="source.class_id" @change="fetchStudents()" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">-- Pilih Kelas --</option>
                                <template x-for="cls in filteredSourceClasses" :key="cls.id">
                                    <option :value="cls.id" x-text="cls.class_name"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- TABEL SISWA --}}
                <div class="flex-1 overflow-y-auto border-t border-slate-100 dark:border-slate-700 relative min-h-[300px]">
                    
                    {{-- Loading State --}}
                    <div x-show="isLoading" class="absolute inset-0 bg-white/50 dark:bg-slate-800/50 flex flex-col items-center justify-center backdrop-blur-[2px] z-10">
                        <i data-lucide="loader-2" class="w-8 h-8 text-blue-500 animate-spin mb-2"></i>
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-300">Memuat data siswa...</p>
                    </div>

                    {{-- Empty State --}}
                    <div x-show="!isLoading && students.length === 0" class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="users" class="w-8 h-8 text-slate-400"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800 dark:text-white">Tidak Ada Data</h4>
                        <p class="text-xs text-slate-500 mt-1 max-w-[250px]">Pilih Tahun Ajaran, Unit, dan Kelas di atas untuk menampilkan daftar siswa.</p>
                    </div>

                    <table class="w-full text-left border-collapse" x-show="students.length > 0">
                        <thead class="sticky top-0 bg-slate-50 dark:bg-slate-700/50 z-0">
                            <tr>
                                <th class="py-3 px-4 border-b border-slate-200 dark:border-slate-700 w-12 text-center">
                                    <input type="checkbox" x-model="selectAll" @change="toggleAll()" class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                                </th>
                                <th class="py-3 px-4 border-b border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-500 uppercase">NIS</th>
                                <th class="py-3 px-4 border-b border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-500 uppercase">Nama Siswa</th>
                                <th class="py-3 px-4 border-b border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="student in students" :key="student.id">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors cursor-pointer" @click="toggleStudent(student.id)">
                                    <td class="py-3 px-4 border-b border-slate-100 dark:border-slate-700 text-center" @click.stop>
                                        <input type="checkbox" name="student_ids[]" :value="student.id" x-model="selectedStudents" class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 px-4 border-b border-slate-100 dark:border-slate-700 text-sm text-slate-600 dark:text-slate-300" x-text="student.nis"></td>
                                    <td class="py-3 px-4 border-b border-slate-100 dark:border-slate-700 text-sm font-medium text-slate-800 dark:text-slate-100" x-text="student.full_name"></td>
                                    <td class="py-3 px-4 border-b border-slate-100 dark:border-slate-700">
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium"
                                              :class="student.status === 'active' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400'"
                                              x-text="student.status === 'active' ? 'Aktif' : 'Tidak Aktif'">
                                        </span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 bg-slate-50 dark:bg-slate-800/80 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center text-sm">
                    <span class="font-medium text-slate-600 dark:text-slate-300">Total: <span x-text="students.length"></span> Siswa</span>
                    <span class="font-medium text-blue-600 dark:text-blue-400">Terpilih: <span x-text="selectedStudents.length"></span> Siswa</span>
                </div>
            </div>

            {{-- PANEL KANAN: TUJUAN --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden flex flex-col">
                <div class="p-5 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 flex items-center justify-between">
                    <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <i data-lucide="log-in" class="w-4 h-4 text-blue-500"></i>
                        Data Kelas Tujuan
                    </h3>
                </div>
                
                <div class="p-5 space-y-6 flex-1">
                    
                    <div class="p-4 rounded-xl bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun Ajaran Tujuan</label>
                            <select name="target_academic_year_id" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 transition-all font-medium text-blue-700 dark:text-blue-400">
                                <option value="">-- Pilih Tahun Ajaran Baru --</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }} ({{ $year->active_semester }}) {{ $year->status == 'active' ? '[Aktif]' : '' }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-slate-500 mt-2">Siswa akan dipromosikan ke tahun ajaran yang dipilih ini.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 border-t border-slate-100 dark:border-slate-700 pt-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Unit Tujuan</label>
                            <select name="target_unit_id" x-model="target.unit_id" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">-- Pilih Unit Tujuan --</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ke Kelas</label>
                            <select name="target_class_id" x-model="target.class_id" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">-- Pilih Kelas Tujuan --</option>
                                <template x-for="cls in filteredTargetClasses" :key="cls.id">
                                    <option :value="cls.id" x-text="cls.class_name"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="p-6 border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                    <button type="submit" 
                            :disabled="selectedStudents.length === 0 || !target.class_id"
                            class="w-full py-4 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold rounded-xl shadow-md shadow-[#4D7EEB]/30 transition-all flex justify-center items-center gap-2">
                        <i data-lucide="arrow-right-circle" class="w-5 h-5"></i>
                        <span>Proses Kenaikan Kelas (<span x-text="selectedStudents.length"></span> Siswa)</span>
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

@push('scripts')
<script>
function promotionForm() {
    return {
        allUnits: [],
        allClasses: [],
        
        source: {
            academic_year_id: '{{ $academicYears->where("status", "active")->first()?->id }}',
            unit_id: '',
            class_id: ''
        },
        
        target: {
            unit_id: '',
            class_id: ''
        },

        students: [],
        selectedStudents: [],
        selectAll: false,
        isLoading: false,

        initData(units, classes) {
            this.allUnits = units;
            this.allClasses = classes;
        },

        get filteredSourceClasses() {
            if (!this.source.unit_id) return [];
            return this.allClasses.filter(c => c.unit_id == this.source.unit_id);
        },

        get filteredTargetClasses() {
            if (!this.target.unit_id) return [];
            return this.allClasses.filter(c => c.unit_id == this.target.unit_id);
        },

        async fetchStudents() {
            if (!this.source.unit_id || !this.source.class_id || !this.source.academic_year_id) {
                this.students = [];
                this.selectedStudents = [];
                this.selectAll = false;
                return;
            }

            this.isLoading = true;
            this.students = [];
            
            try {
                const response = await fetch(`{{ route('admin.kenaikan-kelas.students') }}?unit_id=${this.source.unit_id}&class_id=${this.source.class_id}&academic_year_id=${this.source.academic_year_id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();
                this.students = data;
                
                // Keep previously selected if they are still in the list, otherwise clear
                this.selectedStudents = this.selectedStudents.filter(id => this.students.find(s => s.id == id));
                this.updateSelectAll();
                
            } catch (error) {
                console.error('Error fetching students:', error);
                alert('Gagal mengambil data siswa.');
            } finally {
                this.isLoading = false;
                setTimeout(() => lucide.createIcons(), 100);
            }
        },

        toggleAll() {
            if (this.selectAll) {
                this.selectedStudents = this.students.map(s => s.id.toString());
            } else {
                this.selectedStudents = [];
            }
        },

        toggleStudent(id) {
            id = id.toString();
            const index = this.selectedStudents.indexOf(id);
            if (index > -1) {
                this.selectedStudents.splice(index, 1);
            } else {
                this.selectedStudents.push(id);
            }
            this.updateSelectAll();
        },

        updateSelectAll() {
            if (this.students.length === 0) {
                this.selectAll = false;
                return;
            }
            this.selectAll = this.selectedStudents.length === this.students.length;
        }
    }
}
</script>
@endpush
@endsection


