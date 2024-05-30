<x-layout.default>
    @role(['Admin','Marketing Executive'])
        <x-add-button :link="route('free_schemes.create')" />
    @endrole
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Free Schemes</h5>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Marketing Executive</th>
                                <th>Area Manager</th>
                                <th>Zonal Manager</th>
                                <th>Doctor</th>
                                <th>Stockist</th>
                                <th>Chemist</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($free_schemes as $free_scheme)
                            <tr> 
                                <td>{{ @$free_scheme->Manager->name }}</td>           
                                <td>{{ @$free_scheme->Manager->AreaManager->name }}</td>
                                <td>{{ @$free_scheme->Manager->ZonalManager->name }}</td>
                                <td>{{ @$free_scheme->Doctor->doctor_name }}</td>
                                <td>{{ @$free_scheme->Stockist->stockist }}</td>
                                <td>{{ @$free_scheme->Chemist->chemist }}</td>  
                                <td class="whitespace-nowrap">&#8377; {{ @$free_scheme->amount }}</td> 
                                <td class="float-right">
                                    <ul class="flex items-center gap-2" >
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-edit-button :link=" route('free_schemes.edit', ['free_scheme'=> $free_scheme->id])" />                               
                                        </li>
                                        <li style="display: inline-block;vertical-align:top;">
                                            <x-delete-button :link=" route('free_schemes.destroy', ['free_scheme'=> $free_scheme->id] )" />  
                                        </li>                           
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                    {{ $free_schemes->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                id: null,
                datatable: null,
                open: false,

                init() {
                    this.open= false;
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ["Marketing Executive", "Area Manager",  "Zonal Manager", "Doctor", "Stockist",  "Chemist", "Amount", "Action"],
                        },
                        searchable: true,
                        perPage: 30,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                            order: [0, 'desc']
                        }, ],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    })
                },          
               
                toggle(x) {
                    console.log(x);
                    this.id = x;
                    this.open = !this.open;
                },
            }));
        });
    </script>
</x-layout.default>
