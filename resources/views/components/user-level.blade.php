<span class="inline">
    @switch( $level )
        @case(1)
            User
            @break
        @case(2)
            Requester
            @break
        @case(3)
            Acknowledgment
            @break
        @case(4)
            Reviewer-TN
            @break
        @case(5)
            Approver-TN
            @break
        @case(6)
            Reviewer-DCC
            @break
        @case(7)
            Approver-DCC
            @break
        @case(99)
            Admin
            @break
        @default
            Null
    @endswitch
</span>
