<x-layout.default>
    <div x-data="multicolumn">        
        @role(['Admin','Marketing Executive'])
            <x-add-button :link="route('grant_approvals.create')" />
        @endrole
        <div class="panel mt-6 table-responsive">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Grant Approvals
            </h5>
            <table id="myTable" class="whitespace-nowrap table-hover">
                @foreach ($grant_approvals as $grant_approval)
                <tr> 
                    <td>{{ @$grant_approval->code }}</td> 
                    <td>{{ @$grant_approval->Manager->name }}</td>           
                    <td>{{ @$grant_approval->Manager->AreaManager->name }}</td>
                    <td>{{ @$grant_approval->Manager->ZonalManager->name }}</td>
                    <td>{{ @$grant_approval->Doctor->doctor_name }}</td>
                    <td>{{ @$grant_approval->Activity->name }}</td>
                    <td style="text-align:right;"> &#8377;  {{ @$grant_approval->proposal_amount }}</td>           
                    <td style="text-align:right;"> &#8377;  {{ $grant_approval->approval_amount }}</td>           
                    <td>
                        {!! $grant_approval->status == "Open" ? '<span class="badge bg-info"> Open </span>' : ($grant_approval->status == "Level 1 Approved" ? '<span class="badge bg-warning"> Level 1 </span>' : ($grant_approval->status == "Level 2 Approved" ? '<span class="badge bg-success"> Level 2</span>' :  ($grant_approval->status == "Level 1 Rejected" ? '<span class="badge bg-danger"> Level 1 </span>' : ($grant_approval->status == "Level 2 Rejected" ? '<span class="badge bg-danger"> Level 2</span>' : '')) ))  !!}
                    </td>           
                    <td class="float-right">
                        <ul class="flex items-center gap-2" >
                            @role(['Area Manager'])
                            @if($grant_approval->status == "Open")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$grant_approval->id }})">Approval</a>
                                </li>
                            
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="/grant_approvals/rejected/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                </li>
                            @endif
                            @endrole

                            @role(['Zonal Manager'])
                                @if($grant_approval->status == "Level 1 Approved")
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$grant_approval->id }})">Approval</a>
                                </li>
                               
                                    <li style="display: inline-block;vertical-align:top;">
                                        <a href="/grant_approvals/rejected/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                    </li>
                                @endif
                            @endrole
                            @role(['Admin'])
                                <li style="display: inline-block;vertical-align:top;">
                                    <a href="#" class="btn btn-success btn-sm"  @click="toggle({{$grant_approval->id }})">Approval</a>
                                </li>
                                    <li style="display: inline-block;vertical-align:top;">
                                        <a href="/grant_approvals/rejected/{{$grant_approval->id }}" class="btn btn-danger btn-sm">Rejected</a>
                                    </li>
                            @endrole
                            @role(['Area Manager', 'Marketing Executive'])
                            @if($grant_approval->approval_level_1 == false)
                            <li style="display: inline-block;vertical-align:top;">
                                <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />                               
                            </li>
                            @endif
                            @endrole
                            @role(['Zonal Manager'])
                                @if($grant_approval->approval_level_2 == false)
                                <li style="display: inline-block;vertical-align:top;">
                                    <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />                               
                                </li>
                                @endif
                            @endrole
                            @role(['Admin'])
                                @if($grant_approval->status == "Open")
                                <li style="display: inline-block;vertical-align:top;">
                                    <x-edit-button :link=" route('grant_approvals.edit', ['grant_approval'=> $grant_approval->id])" />                               
                                </li>
                                @endif
                            @endrole
                            @role(['Admin'])
                            <li style="display: inline-block;vertical-align:top;">
                                <x-delete-button :link=" route('grant_approvals.destroy', ['grant_approval'=> $grant_approval->id] )" />  
                            </li> 
                            @endrole
                        </ul>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
            :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-4"
                @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300
                    class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                    <div
                        class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                        Approval
                        <button type="button" @click="toggle"
                            class="text-white-dark hover:text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                height="24px" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="w-6 h-6">
                                <line x1="18" y1="6" x2="6"
                                    y2="18"></line>
                                <line x1="6" y1="6" x2="18"
                                    y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5">
                        <form class="space-y-5" action="{{ route('grant_approvals.approval') }}" method="POST">
                        @csrf
                            <div class="relative mb-4">
                            <x-text-input name="id" x-model="id"  :messages="$errors->get('code')" hidden/>
                                <x-combo-input name="amount"  :label="__('Approval Amount')"  :messages="$errors->get('amount')"/>
                            </div>
                            <x-success-button>
                                {{ __('Submit') }}
                            </x-success-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("multicolumn", () => ({
                id: null,
                datatable: null,
                open: false,

                init() {
                    this.open= false;
                    this.datatable = new simpleDatatables.DataTable('#myTable', {
                        data: {
                            headings: ["Code", "Marketing Executive", "Area Manager",  "Zonal Manager", "Doctor", "Activity",  "Proposal Amount", "Approved Amount", "Status", "Action"],
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
