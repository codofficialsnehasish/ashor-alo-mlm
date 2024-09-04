{{--
<li>
    <a href="javascript:void(0);">
        <div class="member-view-box n-ppost">
            <div class="member-header">
                <span>@if($user->is_left == 1) Left @elseif($user->is_right == 1) Right @endif</span>
            </div>
            <div class="member-image">
                <img src="{{!empty($user->user_image) ? $user->user_image : asset('dashboard_assets/images/users/user-14.png')}}" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;" alt="Member" class="rounded-circle">
            </div>
            <div class="member-footer">
                <div class="name"><span>{{ $user->name }}</span></div>
                <div class="downline"><span>({{ $user->user_id }})</span></div>
            </div>
        </div>
        <div class="n-ppost-name" style="background:#00000;">How to be the best like me, Mica</div>
    </a>
    @if ($user->children->count() > 0)
        <ul class="active">
            @foreach ($user->children->where('is_left', 1) as $child)
                @include('admin.customer.tree-node', ['user' => $child])
            @endforeach
            @foreach ($user->children->where('is_right', 1) as $child)
                @include('admin.customer.tree-node', ['user' => $child])
            @endforeach
        </ul>
    @endif
</li>
--}}


<li>
    <a href="javascript:void(0);">
        <div class="member-view-box n-ppost">
            <div class="member-header">
                <span>{{-- @if($user->is_left == 1) Left @elseif($user->is_right == 1) Right @endif --}}</span>
            </div>
            <div class="member-image">
                <img src="{{!empty($user->user_image) ? asset($user->user_image) : asset('dashboard_assets/images/users/user-14.png')}}" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;border: 3px solid @if($user->status==1) green @else red @endif;" alt="Member" class="rounded-circle">
            </div>
            <div class="member-footer">
                <div class="name"><span>{{ $user->name ?? '' }}</span></div>
                <div class="downline"><span>({{ $user->user_id ?? '' }})</span></div>
            </div>
        </div>
        <div class="n-ppost-name">
            <div class="element">
                <label>Name :</label> <strong style="padding-left: 50px;">{{ $user->name }}</strong>
            </div>
            <div class="left">
                <div class="element">
                    <label>Sponsor ID :</label> <strong>{{ $user->agent_id }}</strong>
                </div>
                <div class="element">
                    <label>Joining Date :</label> <strong>{{ formated_date($user->created_at) }}</strong>
                </div>
                <div class="element">
                    <label>Register (Left) :</label> <strong>{{ register_left($user->id) }}</strong>
                </div>
                <div class="element">
                    <label>Activated (Left) :</label> <strong>{{ activated_left($user->id) }}</strong>
                </div>
                <div class="element">
                    <label>Total Left :</label> <strong>{{ total_left($user->id) }}</strong>
                </div>
                <div class="element">
                    <label>Curr. Left BV :</label> <strong>0.00</strong>
                </div>
                <div class="element">
                    <label>Total Left BV :</label> <strong>0.00</strong>
                </div>
                <div class="element">
                    <label>Total User :</label> <strong>{{ total_user($user->id) }}</strong>
                </div>
            </div>
            <div class="right">
                <div class="element">
                    <label>Rank :</label> <strong></strong>
                </div>
                <div class="element">
                    <label>Confirm Date :</label> <strong></strong>
                </div>
                <div class="element">
                    <label>Register (Right) :</label> <strong>{{ register_right($user->id) }}</strong>
                </div>
                <div class="element">
                    <label>Activated (Right) :</label> <strong>{{ activated_right($user->id) }}</strong>
                </div>
                <div class="element">
                    <label>Total Right :</label> <strong>{{ total_right($user->id) }}</strong>
                </div>
                <div class="element">
                    <label>Curr. Right BV :</label> <strong>0.00</strong>
                </div>
                <div class="element">
                    <label>Total Right BV :</label> <strong>0.00</strong>
                </div>
            </div>
        </div>
    </a>
    <ul class="">
        @php
            $leftChild = $user->children->firstWhere('is_left', 1);
            $rightChild = $user->children->firstWhere('is_right', 1);
        @endphp
        @if ($leftChild)
            @include('admin.customer.tree-node', ['user' => $leftChild])
        @else
            <li>
                <a href="javascript:void(0);">
                    <div class="member-view-box">
                        <div class="member-header">
                            <span></span>
                        </div>
                        <div class="member-image">
                            <img src="{{ asset('dashboard_assets/images/users/user-16.png') }}" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;" alt="Member" class="rounded-circle">
                        </div>
                        <div class="member-footer">
                            <div class="name"><span></span></div>
                            <div class="downline"><span></span></div>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if ($rightChild)
            @include('admin.customer.tree-node', ['user' => $rightChild])
        @else
            <li>
                <a href="javascript:void(0);">
                    <div class="member-view-box">
                        <div class="member-header">
                            <span></span>
                        </div>
                        <div class="member-image">
                            <img src="{{ asset('dashboard_assets/images/users/user-16.png') }}" style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;" alt="Member" class="rounded-circle">
                        </div>
                        <div class="member-footer">
                            <div class="name"><span></span></div>
                            <div class="downline"><span></span></div>
                        </div>
                    </div>
                </a>
            </li>
        @endif
    </ul>
</li>
